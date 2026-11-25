<?php
/**
 * MIB — génère la version HTML statique du site à partir du thème WordPress.
 *
 * Usage : php tools/build-static.php [dossier_sortie]   (défaut : dist/)
 *
 * Pourquoi : managerinbusiness.com est sur l'hébergement gratuit OVH (100 Mo,
 * sans PHP/MySQL). Cette version reprend exactement les gabarits et les textes
 * du thème (theme/mib/config/site.php reste la seule source de vérité) et
 * produit des pages HTML à déposer par FTP dans le dossier www/.
 *
 * Aucune dépendance : PHP 8.x en ligne de commande suffit.
 */

const MIB_SITE = 'https://managerinbusiness.com';

$root = dirname( __DIR__ );
$out  = rtrim( $argv[1] ?? $root . '/dist', '/' );

define( 'ABSPATH', $root . '/' );
define( 'MIB_DIR', $root . '/theme/mib' );
define( 'MIB_URI', '/assets' );

/* ---------- Doublures minimales des fonctions WordPress utilisées ---------- */

$GLOBALS['mib_page'] = array();

function esc_html( $t ) { return htmlspecialchars( (string) $t, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8' ); }
function esc_attr( $t ) { return esc_html( $t ); }
function esc_url( $u ) { return esc_html( $u ); }
function tag_escape( $t ) { return preg_replace( '/[^a-z0-9]/', '', strtolower( $t ) ); }
function antispambot( $email, $hex = 0 ) {
	$o = '';
	foreach ( str_split( $email ) as $c ) {
		$o .= ( $hex && ctype_alnum( $c ) ) ? '%' . bin2hex( $c ) : '&#' . ord( $c ) . ';';
	}
	return $o;
}
function home_url( $path = '/' ) { return '/' . ltrim( $path, '/' ); }
function add_action( ...$a ) {}
function add_filter( ...$a ) {}
function get_option( $k ) { return false; }
function is_front_page() { return 'home' === $GLOBALS['mib_page']['type']; }
function is_page() { return 'home' !== $GLOBALS['mib_page']['type']; }
function is_singular( $t = null ) { return false; }
function is_home() { return false; }
function get_queried_object_id() { return 0; }
function get_post_field( $f, $id ) { return $GLOBALS['mib_page']['slug'] ?? ''; }
function bloginfo( $k ) { echo 'UTF-8'; }
function body_class() { echo 'class="' . esc_attr( $GLOBALS['mib_page']['type'] ) . '"'; }
function wp_body_open() {}
function wp_json_encode( $d, $f = 0 ) { return json_encode( $d, $f ); }
function wp_html_excerpt( $t, $n, $more = '' ) { return mb_strlen( $t ) > $n ? mb_substr( $t, 0, $n - 1 ) . $more : $t; }
function get_template_directory_uri() { return MIB_URI; }

$GLOBALS['mib_loop'] = 0;
function have_posts() { return 0 === $GLOBALS['mib_loop']; }
function the_post() { $GLOBALS['mib_loop']++; }
function the_title() { echo esc_html( $GLOBALS['mib_page']['title'] ); }
function the_content() { echo $GLOBALS['mib_page']['content'] ?? ''; }

function wp_head() {
	$p     = $GLOBALS['mib_page'];
	$ver   = fn( $f ) => substr( md5_file( MIB_DIR . '/assets/' . $f ), 0, 8 );
	$title = $p['seo_title'] ?? ( $p['title'] . ' — MIB · Manager In Business' );
	echo '<title>' . esc_html( $title ) . "</title>\n";
	if ( ! empty( $p['desc'] ) ) {
		echo '<meta name="description" content="' . esc_attr( wp_html_excerpt( $p['desc'], 160, '…' ) ) . "\">\n";
	}
	echo '<link rel="canonical" href="' . esc_url( MIB_SITE . $p['path'] ) . "\">\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . "\">\n";
	echo '<meta property="og:type" content="website"><meta property="og:locale" content="fr_FR">' . "\n";
	foreach ( array( '800', '400' ) as $w ) {
		echo '<link rel="preload" href="/assets/fonts/montserrat-' . $w . '.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
	}
	echo '<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 32 32%27%3E%3Crect width=%2732%27 height=%2732%27 fill=%27%230B0B0B%27/%3E%3Ccircle cx=%2716%27 cy=%2716%27 r=%276%27 fill=%27%23D4AF37%27/%3E%3C/svg%3E">' . "\n";
	echo '<meta name="theme-color" content="#0B0B0B">' . "\n";
	echo '<link rel="stylesheet" href="/assets/css/mib.css?v=' . $ver( 'css/mib.css' ) . "\">\n";
	if ( is_front_page() ) {
		mib_print_schema();
	}
}
function wp_footer() {
	$v = substr( md5_file( MIB_DIR . '/assets/js/menu.js' ), 0, 8 );
	echo '<script src="/assets/js/menu.js?v=' . $v . '" defer></script>' . "\n";
}
function get_header() { require MIB_DIR . '/header.php'; }
function get_footer() { require MIB_DIR . '/footer.php'; }

require MIB_DIR . '/inc/helpers.php';
require MIB_DIR . '/inc/schema.php';

/* ---------- Pages à produire ---------- */

$brand = mib_cfg( 'brand' );
$mail  = mib_email_link();

$pages = array(
	array(
		'type'      => 'home',
		'path'      => '/',
		'tpl'       => 'front-page.php',
		'title'     => 'Accueil',
		'seo_title' => 'MIB · Manager In Business — agence Digital & Humain',
		'desc'      => $brand['description'],
	),
	array(
		'type'  => 'page',
		'slug'  => 'mentions-legales',
		'path'  => '/mentions-legales/',
		'tpl'   => 'page-mentions-legales.php',
		'title' => 'Mentions légales',
		'desc'  => 'Mentions légales du site Manager In Business (MIB).',
	),
	array(
		'type'    => 'page',
		'slug'    => 'confidentialite',
		'path'    => '/confidentialite/',
		'tpl'     => 'page.php',
		'title'   => 'Confidentialité',
		'desc'    => 'Données personnelles : ce que Manager In Business collecte, pourquoi, et vos droits.',
		'content' => '<h2>Ce site ne vous suit pas</h2><p>Aucun cookie, aucun outil de mesure d’audience, aucune police ni script chargé depuis un service tiers. Le site est hébergé en France par OVHcloud.</p>'
			. '<h2>Quand vous nous écrivez</h2><p>Si vous nous contactez par e-mail, nous utilisons votre adresse et votre message uniquement pour vous répondre et, si vous le demandez, réaliser votre audit. Ces données ne sont ni vendues ni cédées. Elles sont conservées au plus 3 ans après notre dernier échange.</p>'
			. '<h2>Vos droits</h2><p>Vous pouvez demander l’accès, la rectification ou la suppression de vos données, ou vous opposer à leur utilisation, en écrivant à ' . $mail . '. Vous pouvez aussi saisir la CNIL (cnil.fr).</p>',
	),
	array(
		'type'    => 'page',
		'slug'    => 'accessibilite',
		'path'    => '/accessibilite/',
		'tpl'     => 'page.php',
		'title'   => 'Accessibilité',
		'desc'    => 'Déclaration d’accessibilité du site Manager In Business.',
		'content' => '<p>Ce site est conçu pour être utilisable au clavier et avec un lecteur d’écran : contrastes renforcés, structure de titres, lien d’évitement, menu accessible.</p><p>Il n’a pas encore fait l’objet d’un audit RGAA complet : nous n’affichons donc aucun taux de conformité. Un obstacle ? Écrivez-nous à ' . $mail . ', nous vous répondrons et corrigerons.</p>',
	),
);

foreach ( mib_cfg( 'expertises' ) as $slug => $e ) {
	$pages[] = array(
		'type'    => 'page',
		'slug'    => $slug,
		'path'    => '/' . $slug . '/',
		'tpl'     => 'page.php',
		'title'   => $e['title'],
		'desc'    => $e['desc'],
		'content' => '<p>' . esc_html( $e['desc'] ) . '</p>',
	);
}

/* ---------- Rendu ---------- */

function mib_render( $page ) {
	$GLOBALS['mib_page'] = $page;
	$GLOBALS['mib_loop'] = 0;
	ob_start();
	require MIB_DIR . '/' . $page['tpl'];
	return ob_get_clean();
}

function mib_copy( $from, $to ) {
	if ( ! is_dir( dirname( $to ) ) ) {
		mkdir( dirname( $to ), 0755, true );
	}
	copy( $from, $to );
}

if ( is_dir( $out ) ) {
	exec( 'rm -rf ' . escapeshellarg( $out ) );
}
mkdir( $out, 0755, true );

$urls = array();
foreach ( $pages as $page ) {
	$html = mib_render( $page );
	$dir  = $out . $page['path'];
	if ( ! is_dir( $dir ) ) {
		mkdir( $dir, 0755, true );
	}
	file_put_contents( $dir . 'index.html', $html );
	$urls[] = MIB_SITE . $page['path'];
	printf( "✅ %-40s %6d o\n", $page['path'], strlen( $html ) );
}

foreach ( array( 'css/mib.css', 'js/menu.js', 'fonts/montserrat-400.woff2', 'fonts/montserrat-800.woff2' ) as $f ) {
	mib_copy( MIB_DIR . '/assets/' . $f, $out . '/assets/' . $f );
}
mib_copy( $root . '/server/static.htaccess', $out . '/.htaccess' );
mib_copy( $root . '/server/llms.txt', $out . '/llms.txt' );
file_put_contents( $out . '/robots.txt', "User-agent: *\nAllow: /\n\nSitemap: " . MIB_SITE . "/sitemap.xml\n" );

$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ( $urls as $u ) {
	$xml .= '<url><loc>' . esc_html( $u ) . '</loc><lastmod>' . gmdate( 'Y-m-d' ) . "</lastmod></url>\n";
}
file_put_contents( $out . '/sitemap.xml', $xml . "</urlset>\n" );

// Page 404 : reprend la mise en page, renvoie vers l'accueil.
$GLOBALS['mib_page'] = array( 'type' => 'page', 'path' => '/404.html', 'title' => 'Page introuvable' );
ob_start();
require MIB_DIR . '/404.php';
file_put_contents( $out . '/404.html', ob_get_clean() );

echo "\nSite statique prêt dans {$out}\n";
