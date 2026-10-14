<?php
/**
 * Données structurées JSON-LD (Google + moteurs de réponse IA).
 * Générées depuis la configuration statique : zéro requête SQL.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_head', 'mib_print_schema', 20 );

function mib_print_schema() {
	$brand  = mib_cfg( 'brand' );
	$home   = home_url( '/' );
	$org_id = $home . '#organisation';

	$org = array(
		'@type'         => 'ProfessionalService',
		'@id'           => $org_id,
		'name'          => $brand['name'],
		'alternateName' => array( $brand['long_name'], 'Maninback' ),
		'slogan'        => implode( ' ', $brand['signature'] ),
		'url'           => $home,
		'email'         => $brand['email'],
		'description'   => $brand['description'],
		'address'       => array(
			'@type'           => 'PostalAddress',
			'addressLocality' => $brand['city'],
			'postalCode'      => $brand['postal_code'],
			'addressCountry'  => $brand['country'],
		),
		'areaServed'    => array( '@type' => 'Country', 'name' => 'France' ),
		'knowsAbout'    => array(
			'Performance humaine et coaching',
			'Préparation physique et mentale',
			'Responsabilité sociétale des entreprises (RSE)',
			'Qualité de vie au travail (QVT)',
			'Transformation digitale',
			'Intelligence artificielle',
			'Data et infrastructure informatique',
			'Création de sites web et applications',
			'Design, graphisme et marketing digital',
		),
	);

	$graph = array();

	if ( is_front_page() ) {
		$offers = array();
		foreach ( mib_cfg( 'expertises' ) as $slug => $e ) {
			$offers[] = array(
				'@type'       => 'Offer',
				'itemOffered' => array(
					'@type'       => 'Service',
					'name'        => $e['title'],
					'description' => $e['desc'],
					'url'         => mib_expertise_url( $slug ),
				),
			);
		}
		$org['hasOfferCatalog'] = array(
			'@type'           => 'OfferCatalog',
			'name'            => "Leviers d'intervention MIB",
			'itemListElement' => $offers,
		);
		$graph[] = $org;
	} elseif ( $e = mib_current_expertise() ) {
		$graph[] = array(
			'@type'       => 'Service',
			'name'        => $e['title'],
			'description' => $e['desc'],
			'url'         => mib_expertise_url( $e['slug'] ),
			'serviceType' => $e['title'],
			'areaServed'  => array( '@type' => 'Country', 'name' => 'France' ),
			'provider'    => array( '@id' => $org_id ),
		);
		$graph[] = array( '@type' => 'ProfessionalService', '@id' => $org_id, 'name' => $brand['name'], 'url' => $home );
	} elseif ( is_singular( 'post' ) ) {
		$post    = get_queried_object();
		$graph[] = array(
			'@type'            => 'BlogPosting',
			'headline'         => get_the_title( $post ),
			'description'      => wp_strip_all_tags( get_the_excerpt( $post ) ),
			'datePublished'    => get_the_date( 'c', $post ),
			'dateModified'     => get_the_modified_date( 'c', $post ),
			'mainEntityOfPage' => get_permalink( $post ),
			'inLanguage'       => 'fr-FR',
			'author'           => array( '@id' => $org_id ),
			'publisher'        => array( '@id' => $org_id ),
		);
		$graph[] = array( '@type' => 'ProfessionalService', '@id' => $org_id, 'name' => $brand['name'], 'url' => $home );
	} else {
		return;
	}

	printf(
		'<script type="application/ld+json">%s</script>' . "\n",
		wp_json_encode(
			array(
				'@context' => 'https://schema.org',
				'@graph'   => $graph,
			),
			JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
		)
	);
}

/*
 * Meta description de repli si l'extension SEO n'est pas active.
 */
add_action(
	'wp_head',
	function () {
		if ( defined( 'THE_SEO_FRAMEWORK_VERSION' ) ) {
			return;
		}
		$desc = '';
		if ( is_front_page() ) {
			$desc = mib_cfg( 'brand' )['description'];
		} elseif ( $e = mib_current_expertise() ) {
			$desc = $e['desc'];
		} elseif ( is_singular() ) {
			$desc = wp_strip_all_tags( get_the_excerpt( get_queried_object() ) );
		} elseif ( is_home() ) {
			$desc = "Analyses et retours de terrain des Man in Back : performance humaine, qualité de vie au travail, IA, web et outils numériques.";
		}
		if ( $desc ) {
			printf( '<meta name="description" content="%s">' . "\n", esc_attr( wp_html_excerpt( $desc, 160, '…' ) ) );
		}
	},
	2
);
