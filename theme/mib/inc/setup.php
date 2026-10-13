<?php
/**
 * Réglages du thème, nettoyage du <head> et chargement des assets.
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array( 'style', 'script', 'navigation-widgets' ) );
		add_theme_support( 'responsive-embeds' );

		// Éditeur Gutenberg verrouillé sur la charte : pas de couleurs ni tailles libres.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/mib.css' );
		add_theme_support( 'disable-custom-colors' );
		add_theme_support( 'disable-custom-gradients' );
		add_theme_support( 'disable-custom-font-sizes' );
		add_theme_support( 'disable-layout-styles' );
		add_theme_support( 'editor-gradient-presets', array() );
		add_theme_support( 'editor-font-sizes', array() );
		add_theme_support(
			'editor-color-palette',
			array(
				array( 'name' => 'Noir minéral', 'slug' => 'ink', 'color' => '#0D0D0D' ),
				array( 'name' => 'Blanc', 'slug' => 'paper', 'color' => '#F5F5F5' ),
				array( 'name' => 'Gris clair', 'slug' => 'muted', 'color' => '#B3B3B3' ),
			)
		);
		remove_theme_support( 'core-block-patterns' );
	}
);

// Pas de patterns distants (requêtes vers wordpress.org dans l'éditeur).
add_filter( 'should_load_remote_block_patterns', '__return_false' );

// Blocs autorisés : du texte structuré, zéro « soupe de div ».
add_filter(
	'allowed_block_types_all',
	function () {
		return array(
			'core/paragraph',
			'core/heading',
			'core/list',
			'core/list-item',
			'core/quote',
			'core/code',
			'core/preformatted',
			'core/table',
			'core/separator',
			'core/image',
			'core/details',
			'core/footnotes',
		);
	}
);

/*
 * Nettoyage du <head> : emojis, oEmbed, liens inutiles, générateur.
 */
add_action(
	'init',
	function () {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'emoji_svg_url', '__return_false' );

		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
		remove_action( 'template_redirect', 'rest_output_link_header', 11 );
		remove_action( 'template_redirect', 'wp_shortlink_header', 11 );

		// Styles globaux et filtres SVG injectés par l'éditeur de site (inutiles ici).
		remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
		remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
		remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
		remove_action( 'wp_head', 'wp_print_auto_sizes_contain_css_fix', 1 );
	}
);

add_filter( 'feed_links_show_comments_feed', '__return_false' );
add_filter( 'should_load_separate_core_block_assets', '__return_false' );

// Aucune pré-connexion DNS vers des domaines tiers.
add_filter(
	'wp_resource_hints',
	function ( $urls, $type ) {
		return 'dns-prefetch' === $type ? array() : $urls;
	},
	10,
	2
);

/*
 * Assets : 1 feuille de style, 1 script différé de moins de 1 Ko, 2 polices.
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'classic-theme-styles' );
		wp_dequeue_style( 'global-styles' );
		wp_dequeue_style( 'core-block-supports' );

		wp_enqueue_style( 'mib', MIB_URI . '/assets/css/mib.css', array(), mib_ver( 'assets/css/mib.css' ) );
		wp_enqueue_script(
			'mib-menu',
			MIB_URI . '/assets/js/menu.js',
			array(),
			mib_ver( 'assets/js/menu.js' ),
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	},
	100
);

// Préchargement des polices auto-hébergées + favicon inline (aucune requête).
add_action(
	'wp_head',
	function () {
		foreach ( array( '800', '400' ) as $w ) {
			printf(
				'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
				esc_url( MIB_URI . '/assets/fonts/inter-' . $w . '.woff2' )
			);
		}
		echo '<link rel="icon" href="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 32 32%27%3E%3Crect width=%2732%27 height=%2732%27 fill=%27%230D0D0D%27/%3E%3Ccircle cx=%2716%27 cy=%2716%27 r=%276%27 fill=%27%2300FF66%27/%3E%3C/svg%3E">' . "\n";
		echo '<meta name="theme-color" content="#0D0D0D">' . "\n";
	},
	1
);

/*
 * Images (blog) : WebP en sortie, tailles intermédiaires réduites.
 */
add_filter(
	'image_editor_output_format',
	function ( $formats ) {
		$formats['image/jpeg'] = 'image/webp';
		$formats['image/png']  = 'image/webp';
		return $formats;
	}
);
add_filter( 'big_image_size_threshold', fn() => 1600 );
add_filter(
	'intermediate_image_sizes_advanced',
	function ( $sizes ) {
		unset( $sizes['1536x1536'], $sizes['2048x2048'] );
		return $sizes;
	}
);
add_filter( 'wp_editor_set_quality', fn() => 75 );

// Extraits du blog.
add_filter( 'excerpt_length', fn() => 32 );
add_filter( 'excerpt_more', fn() => '…' );
