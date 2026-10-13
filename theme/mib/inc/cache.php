<?php
/**
 * Cache de pages statique sur disque (remplace Nginx FastCGI sur mutualisé).
 *
 * 1. Un visiteur anonyme demande une page : WordPress la calcule une fois,
 *    le HTML est écrit dans wp-content/cache/mib/{hôte}/{chemin}/index.html.
 * 2. Les visites suivantes : Apache sert ce fichier directement via .htaccess,
 *    sans réveiller PHP ni MySQL.
 * 3. Toute modification de contenu vide le cache (site de quelques pages :
 *    une purge globale est plus sûre qu'une purge ciblée).
 */

namespace MIB\Cache;

defined( 'ABSPATH' ) || exit;

const SUBDIR = '/cache/mib';

function root() {
	return WP_CONTENT_DIR . SUBDIR;
}

add_action( 'template_redirect', __NAMESPACE__ . '\\start', 0 );

function should_cache() {
	if ( 'GET' !== ( $_SERVER['REQUEST_METHOD'] ?? '' ) || ! empty( $_SERVER['QUERY_STRING'] ) ) {
		return false;
	}
	if ( ( defined( 'DONOTCACHEPAGE' ) && DONOTCACHEPAGE ) || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return false;
	}
	if ( is_admin() || wp_doing_ajax() || wp_doing_cron() || is_user_logged_in() ) {
		return false;
	}
	if ( is_preview() || is_search() || is_feed() || is_404() || is_trackback() || is_robots() || post_password_required() ) {
		return false;
	}
	foreach ( array_keys( $_COOKIE ) as $name ) {
		if ( preg_match( '/^(wordpress_logged_in|wp-postpass|comment_author|wordpress_no_cache)/', $name ) ) {
			return false;
		}
	}
	return true;
}

function start() {
	if ( should_cache() ) {
		ob_start( __NAMESPACE__ . '\\store' );
	}
}

function path_for_request() {
	$host = strtolower( preg_replace( '/[^a-zA-Z0-9.\-:]/', '', $_SERVER['HTTP_HOST'] ?? '' ) );
	$path = (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH );
	if ( '' === $host || str_contains( $path, '..' ) || ! str_ends_with( $path, '/' ) ) {
		return null;
	}
	$path = preg_replace( '#/+#', '/', $path );
	return root() . '/' . $host . $path . 'index.html';
}

function store( $html ) {
	if ( 200 !== http_response_code() || false === stripos( $html, '</html>' ) ) {
		return $html;
	}
	foreach ( headers_list() as $h ) {
		if ( 0 === stripos( $h, 'content-type:' ) && false === stripos( $h, 'text/html' ) ) {
			return $html;
		}
	}
	$file = path_for_request();
	if ( ! $file ) {
		return $html;
	}
	ensure_root();
	$dir = dirname( $file );
	if ( ! is_dir( $dir ) && ! wp_mkdir_p( $dir ) ) {
		return $html;
	}
	$stamp = "\n<!-- MIB cache " . gmdate( 'Y-m-d H:i:s' ) . ' UTC -->';
	$tmp   = $file . '.' . uniqid( '', true ) . '.tmp';
	if ( false !== file_put_contents( $tmp, $html . $stamp, LOCK_EX ) ) {
		rename( $tmp, $file ); // Écriture atomique.
	}
	return $html;
}

/**
 * Crée le dossier racine et ses règles Apache (en-têtes de la réponse en cache).
 */
function ensure_root() {
	$root = root();
	if ( is_dir( $root ) && file_exists( $root . '/.htaccess' ) ) {
		return;
	}
	wp_mkdir_p( $root );
	$rules = "<IfModule mod_headers.c>\n"
		. "\tHeader set Cache-Control \"public, max-age=0, must-revalidate\"\n"
		. "\tHeader set X-MIB-Cache \"HIT\"\n"
		. "</IfModule>\n"
		. "<FilesMatch \"\\.(php|phtml|tmp)$\">\n\tRequire all denied\n</FilesMatch>\n";
	file_put_contents( $root . '/.htaccess', $rules );
	file_put_contents( $root . '/index.php', "<?php\n// Silence.\n" );
}

/**
 * Vide tout le cache (suppression physique des fichiers).
 */
function purge() {
	$root = root();
	if ( ! is_dir( $root ) ) {
		return;
	}
	$it = new \RecursiveIteratorIterator(
		new \RecursiveDirectoryIterator( $root, \FilesystemIterator::SKIP_DOTS ),
		\RecursiveIteratorIterator::CHILD_FIRST
	);
	foreach ( $it as $item ) {
		$p = $item->getPathname();
		if ( dirname( $p ) === $root && in_array( $item->getFilename(), array( '.htaccess', 'index.php' ), true ) ) {
			continue;
		}
		$item->isDir() ? @rmdir( $p ) : @unlink( $p ); // phpcs:ignore
	}
}

/*
 * Déclencheurs de purge.
 */
add_action(
	'save_post',
	function ( $post_id ) {
		if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
			return;
		}
		purge();
	}
);
foreach ( array( 'deleted_post', 'trashed_post', 'edited_term', 'delete_term', 'switch_theme', 'customize_save_after', 'upgrader_process_complete', 'activated_plugin', 'deactivated_plugin' ) as $hook ) {
	add_action( $hook, __NAMESPACE__ . '\\purge' );
}
foreach ( array( 'blogname', 'blogdescription', 'permalink_structure', 'show_on_front', 'page_on_front', 'page_for_posts', 'posts_per_page', 'autodescription-site-settings' ) as $opt ) {
	add_action( 'update_option_' . $opt, __NAMESPACE__ . '\\purge' );
}

/*
 * Bouton « Vider le cache » dans la barre d'admin.
 */
add_action(
	'admin_bar_menu',
	function ( $bar ) {
		if ( ! current_user_can( 'edit_pages' ) ) {
			return;
		}
		$bar->add_node(
			array(
				'id'    => 'mib-purge',
				'title' => 'Vider le cache MIB',
				'href'  => wp_nonce_url( admin_url( 'admin-post.php?action=mib_purge' ), 'mib_purge' ),
			)
		);
	},
	100
);
add_action(
	'admin_post_mib_purge',
	function () {
		if ( ! current_user_can( 'edit_pages' ) || ! check_admin_referer( 'mib_purge' ) ) {
			wp_die( 'Action non autorisée.' );
		}
		purge();
		wp_safe_redirect( wp_get_referer() ? wp_get_referer() : admin_url() );
		exit;
	}
);

/*
 * Commande WP-CLI : wp mib-cache purge
 */
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	\WP_CLI::add_command(
		'mib-cache purge',
		function () {
			purge();
			\WP_CLI::success( 'Cache MIB vidé.' );
		}
	);
}
