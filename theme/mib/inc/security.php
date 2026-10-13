<?php
/**
 * Durcissement applicatif (sans extension de sécurité qui alourdit la base).
 * Les en-têtes HTTP et blocages serveur sont dans server/.htaccess.
 */

defined( 'ABSPATH' ) || exit;

// XML-RPC et pingbacks : désactivés.
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'pings_open', '__return_false', 20 );
add_filter(
	'wp_headers',
	function ( $headers ) {
		unset( $headers['X-Pingback'] );
		return $headers;
	}
);

// Commentaires : désactivés partout (aucun formulaire, aucun spam).
add_filter( 'comments_open', '__return_false', 20 );
add_filter( 'comments_array', '__return_empty_array', 20 );
add_action(
	'init',
	function () {
		foreach ( get_post_types() as $type ) {
			if ( post_type_supports( $type, 'comments' ) ) {
				remove_post_type_support( $type, 'comments' );
				remove_post_type_support( $type, 'trackbacks' );
			}
		}
	},
	100
);
add_action(
	'admin_menu',
	function () {
		remove_menu_page( 'edit-comments.php' );
	}
);
add_action(
	'wp_before_admin_bar_render',
	function () {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu( 'comments' );
	}
);

// Énumération des comptes : API REST users fermée aux visiteurs, archives auteur coupées.
add_filter(
	'rest_endpoints',
	function ( $endpoints ) {
		if ( ! is_user_logged_in() ) {
			unset( $endpoints['/wp/v2/users'], $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
		}
		return $endpoints;
	}
);
add_action(
	'template_redirect',
	function () {
		if ( is_author() || isset( $_GET['author'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			wp_safe_redirect( home_url( '/' ), 301 );
			exit;
		}
		// Recherche interne désactivée : pas de pages de résultats indexables ni de charge inutile.
		if ( is_search() ) {
			wp_safe_redirect( home_url( '/' ), 301 );
			exit;
		}
		// Pages de pièces jointes : redirection vers le fichier.
		if ( is_attachment() ) {
			$url = wp_get_attachment_url( get_queried_object_id() );
			wp_safe_redirect( $url ? $url : home_url( '/' ), 301 );
			exit;
		}
	},
	1
);

// Messages de connexion neutres.
add_filter( 'login_errors', fn() => 'Identifiants incorrects.' );

// Pas de lien « Propulsé par WordPress » ni de version dans les flux.
add_filter( 'the_generator', '__return_empty_string' );
