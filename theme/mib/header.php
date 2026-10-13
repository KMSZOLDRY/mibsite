<?php
/**
 * En-tête : lien d'évitement, logo, pastilles de mesure, bouton MENU, panneau de navigation.
 */

defined( 'ABSPATH' ) || exit;

$mib_metrics = mib_cfg( 'metrics' );
$mib_exp     = mib_cfg( 'expertises' );
$mib_blog    = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : '';
?><!doctype html>
<html lang="fr">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<noscript><style>#mib-menu-btn{display:none}</style></noscript>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#contenu">Aller au contenu principal</a>

<header class="site-header wrap">
	<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php echo is_front_page() ? ' aria-current="page"' : ''; ?>>
		MIB<span class="logo-dot" aria-hidden="true">.</span><span class="sr-only"> — accueil</span>
	</a>

	<div class="header-right">
		<ul class="metrics" aria-label="Mesures de ce site">
			<?php if ( ! empty( $mib_metrics['co2'] ) ) : ?>
				<li class="metric"><span class="metric-dot" aria-hidden="true"></span>CO₂ : <?php echo esc_html( $mib_metrics['co2'] ); ?>
					<?php if ( ! empty( $mib_metrics['co2_date'] ) ) : ?><span class="sr-only"> par visite, mesuré le <?php echo esc_html( $mib_metrics['co2_date'] ); ?></span><?php endif; ?>
				</li>
			<?php endif; ?>
			<?php if ( ! empty( $mib_metrics['rgaa'] ) ) : ?>
				<li class="metric"><a href="<?php echo esc_url( home_url( $mib_metrics['rgaa_page'] ) ); ?>"><span class="metric-dot" aria-hidden="true"></span>RGAA : <?php echo esc_html( $mib_metrics['rgaa'] ); ?></a></li>
			<?php endif; ?>
		</ul>

		<button id="mib-menu-btn" class="menu-btn" type="button" aria-expanded="false" aria-controls="mib-menu">Menu</button>
	</div>
</header>

<div id="mib-menu" class="menu-panel" role="dialog" aria-modal="true" aria-label="Menu principal" hidden>
	<div class="menu-top wrap">
		<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">MIB<span class="logo-dot" aria-hidden="true">.</span><span class="sr-only"> — accueil</span></a>
		<button class="menu-btn" type="button" data-close>Fermer</button>
	</div>
	<nav class="menu-nav wrap" aria-label="Navigation principale">
		<p class="label">Expertises</p>
		<ol class="menu-list">
			<?php
			$mib_i = 0;
			foreach ( $mib_exp as $mib_slug => $mib_e ) :
				++$mib_i;
				?>
				<li><a href="<?php echo esc_url( mib_expertise_url( $mib_slug ) ); ?>"><span class="num" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $mib_i ) ); ?></span><?php echo esc_html( $mib_e['title'] ); ?></a></li>
			<?php endforeach; ?>
		</ol>
		<ul class="menu-secondary">
			<?php if ( $mib_blog ) : ?>
				<li><a href="<?php echo esc_url( $mib_blog ); ?>">Blog</a></li>
			<?php endif; ?>
			<li><?php echo mib_cal_link( 'Planifier un audit de 15 min', '' ); // phpcs:ignore ?></li>
			<li><?php echo mib_email_link(); // phpcs:ignore ?></li>
		</ul>
	</nav>
</div>

<main id="contenu" tabindex="-1">
