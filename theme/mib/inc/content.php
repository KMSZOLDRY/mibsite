<?php
/**
 * Traitement automatique du contenu : lazy loading natif et attribut alt
 * garanti sur 100 % des images, même si le rédacteur l'oublie (RGAA 1.2).
 *
 * Utilise le WP_HTML_Tag_Processor natif (WordPress 6.2+) : plus rapide et
 * plus sûr qu'un DOMDocument, et sans altérer le reste du HTML.
 */

defined( 'ABSPATH' ) || exit;

add_filter( 'the_content', 'mib_optimize_media', 99 );

function mib_optimize_media( $content ) {
	if ( '' === $content || ( false === stripos( $content, '<img' ) && false === stripos( $content, '<iframe' ) ) ) {
		return $content;
	}

	$p = new WP_HTML_Tag_Processor( $content );
	while ( $p->next_tag() ) {
		$tag = $p->get_tag();
		if ( 'IMG' === $tag ) {
			if ( null === $p->get_attribute( 'loading' ) ) {
				$p->set_attribute( 'loading', 'lazy' );
			}
			$p->set_attribute( 'decoding', 'async' );
			if ( null === $p->get_attribute( 'alt' ) ) {
				$p->set_attribute( 'alt', '' ); // Image décorative par défaut.
			}
		} elseif ( 'IFRAME' === $tag && null === $p->get_attribute( 'loading' ) ) {
			$p->set_attribute( 'loading', 'lazy' );
		}
	}
	return $p->get_updated_html();
}

/*
 * Liens externes dans le contenu : ouverture sûre (noopener).
 */
add_filter(
	'the_content',
	function ( $content ) {
		if ( false === stripos( $content, 'target="_blank"' ) ) {
			return $content;
		}
		$p = new WP_HTML_Tag_Processor( $content );
		while ( $p->next_tag( 'A' ) ) {
			if ( '_blank' === $p->get_attribute( 'target' ) ) {
				$p->set_attribute( 'rel', 'noopener' );
			}
		}
		return $p->get_updated_html();
	},
	100
);
