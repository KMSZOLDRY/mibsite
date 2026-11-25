<?php
/**
 * Fonctions utilitaires du thème.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Lit la configuration statique (une seule inclusion par requête).
 *
 * @param string|null $key Clé de premier niveau, ou null pour tout le tableau.
 * @return mixed
 */
function mib_cfg( $key = null ) {
	static $cfg = null;
	if ( null === $cfg ) {
		$cfg = require MIB_DIR . '/config/site.php';
	}
	return null === $key ? $cfg : ( $cfg[ $key ] ?? null );
}

/**
 * Version d'un fichier du thème pour le cache navigateur.
 */
function mib_ver( $rel ) {
	$file = MIB_DIR . '/' . ltrim( $rel, '/' );
	return file_exists( $file ) ? (string) filemtime( $file ) : '1';
}

/**
 * Icônes SVG inline (aucune police d'icônes).
 */
function mib_icon( $name ) {
	$icons = array(
		'arrow'    => '<svg class="icon" width="16" height="16" viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M1 8h13M9 3l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.5"/></svg>',
		'external' => '<svg class="icon" width="14" height="14" viewBox="0 0 16 16" aria-hidden="true" focusable="false"><path d="M5 3h8v8M13 3 3 13" fill="none" stroke="currentColor" stroke-width="1.5"/></svg>',
	);
	return $icons[ $name ] ?? '';
}

/**
 * Lien mailto chiffré (entités HTML) contre les robots collecteurs.
 */
function mib_email_link( $class = '' ) {
	$email = mib_cfg( 'brand' )['email'];
	$enc   = antispambot( $email );
	return sprintf(
		'<a class="%s" href="%s">%s</a>',
		esc_attr( $class ),
		esc_attr( 'mailto:' . antispambot( $email, 1 ) ),
		$enc
	);
}

/**
 * Adresse de prise de contact : lien de rendez-vous s'il existe, sinon e-mail
 * pré-rempli (adresse encodée en entités contre les robots collecteurs).
 *
 * @return array{0:string,1:bool} URL déjà échappée, et vrai si lien externe.
 */
function mib_contact_href( $subject = 'Mon audit offert' ) {
	$cal = mib_cfg( 'brand' )['cal_url'];
	if ( ! empty( $cal ) ) {
		return array( esc_url( $cal ), true );
	}
	$mail = antispambot( mib_cfg( 'brand' )['email'], 1 );
	return array( esc_attr( 'mailto:' . $mail . '?subject=' . rawurlencode( $subject ) ), false );
}

/**
 * Lien de prise de rendez-vous (ou e-mail tant que l'agenda n'existe pas).
 */
function mib_cal_link( $label = 'Demander mon audit offert', $class = 'link-cta' ) {
	list( $href, $ext ) = mib_contact_href();
	return sprintf(
		'<a class="%s" href="%s"%s>%s %s%s</a>',
		esc_attr( $class ),
		$href,
		$ext ? ' rel="noopener" target="_blank"' : '',
		esc_html( $label ),
		mib_icon( 'arrow' ),
		$ext ? '<span class="sr-only"> (nouvel onglet)</span>' : ''
	);
}

/**
 * Données de l'expertise correspondant à la page courante, ou null.
 */
function mib_current_expertise() {
	if ( ! is_page() ) {
		return null;
	}
	$slug = get_post_field( 'post_name', get_queried_object_id() );
	$list = mib_cfg( 'expertises' );
	if ( ! isset( $list[ $slug ] ) ) {
		return null;
	}
	$index = array_search( $slug, array_keys( $list ), true );
	return $list[ $slug ] + array(
		'slug'        => $slug,
		'group_label' => mib_cfg( 'groups' )[ $list[ $slug ]['group'] ] ?? '',
		'index' => $index + 1,
		'total' => count( $list ),
	);
}

/**
 * URL d'une expertise à partir de son slug (sans requête SQL).
 */
function mib_expertise_url( $slug ) {
	return home_url( '/' . $slug . '/' );
}

/**
 * Temps de lecture estimé (200 mots/minute).
 */
function mib_reading_time( $post = null ) {
	$words = str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post ) ) );
	return max( 1, (int) round( $words / 200 ) );
}

/**
 * Logo typographique : « MIB » doré (dégradé CSS) + « Manager In Business ».
 */
function mib_logo( $current = false ) {
	return sprintf(
		'<a class="logo" href="%s"%s><span class="logo-mark">MIB</span><span class="logo-sub">Manager In Business</span><span class="sr-only"> — accueil</span></a>',
		esc_url( home_url( '/' ) ),
		$current ? ' aria-current="page"' : ''
	);
}

/**
 * Bouton d'appel à l'action unique + ligne de réassurance.
 */
function mib_cta_button( $with_note = true, $class = '', $label = null, $subject = 'Mon audit offert' ) {
	$cta = mib_cfg( 'cta' );
	list( $href, $ext ) = mib_contact_href( $subject );
	$out = sprintf(
		'<a class="btn %s" href="%s"%s>%s %s%s</a>',
		esc_attr( $class ),
		$href,
		$ext ? ' rel="noopener" target="_blank"' : '',
		esc_html( $label ?? $cta['label'] ),
		mib_icon( 'arrow' ),
		$ext ? '<span class="sr-only"> (nouvel onglet)</span>' : ''
	);
	if ( $with_note ) {
		$out .= '<p class="btn-note">' . esc_html( $cta['note'] ) . '</p>';
	}
	return $out;
}

/**
 * Signature de marque sur deux lignes (ivoire + sauge).
 */
function mib_signature( $tag = 'p' ) {
	$s = mib_cfg( 'brand' )['signature'];
	return sprintf( '<%1$s class="signature">%2$s <span>%3$s</span></%1$s>', tag_escape( $tag ), esc_html( $s[0] ), esc_html( $s[1] ) );
}

/**
 * Bloc dépliable natif « En savoir plus » (HTML <details>, aucun JavaScript).
 */
function mib_more( $paragraphs, $summary = 'En savoir plus' ) {
	if ( empty( $paragraphs ) ) {
		return '';
	}
	$out = '<details class="more"><summary>' . esc_html( $summary ) . '</summary><div class="more-body">';
	foreach ( (array) $paragraphs as $p ) {
		$out .= '<p>' . esc_html( $p ) . '</p>';
	}
	return $out . '</div></details>';
}
