<?php
/**
 * En-tête : lien d'évitement, logo, pastilles de mesure, bouton MENU, panneau de navigation.
 */

defined( 'ABSPATH' ) || exit;

$mib_metrics = mib_cfg( 'metrics' );
$mib_groups  = mib_cfg( 'groups' );
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
	<?php echo mib_logo( is_front_page() ); // phpcs:ignore ?>

	<div class="header-right">
		<?php if ( ! empty( $mib_metrics['co2'] ) || ! empty( $mib_metrics['rgaa'] ) ) : ?>
			<ul class="metrics" aria-label="Mesures de ce site">
				<?php if ( ! empty( $mib_metrics['co2'] ) ) : ?>
					<li class="metric"><span class="metric-dot" aria-hidden="true"></span>CO₂ : <?php echo esc_html( $mib_metrics['co2'] ); ?><?php if ( ! empty( $mib_metrics['co2_date'] ) ) : ?><span class="sr-only"> par visite, mesuré le <?php echo esc_html( $mib_metrics['co2_date'] ); ?></span><?php endif; ?></li>
				<?php endif; ?>
				<?php if ( ! empty( $mib_metrics['rgaa'] ) ) : ?>
					<li class="metric"><a href="<?php echo esc_url( home_url( $mib_metrics['rgaa_page'] ) ); ?>"><span class="metric-dot" aria-hidden="true"></span>RGAA : <?php echo esc_html( $mib_metrics['rgaa'] ); ?></a></li>
				<?php endif; ?>
			</ul>
		<?php endif; ?>

		<button id="mib-menu-btn" class="menu-btn" type="button" aria-expanded="false" aria-controls="mib-menu">Menu</button>
	</div>
</header>

<div id="mib-menu" class="menu-panel" role="dialog" aria-modal="true" aria-label="Menu principal" hidden>
	<div class="menu-top wrap">
		<?php echo mib_logo(); // phpcs:ignore ?>
		<button class="menu-btn" type="button" data-close>Fermer</button>
	</div>
	<nav class="menu-nav wrap" aria-label="Navigation principale">
		<div class="menu-groups">
			<?php foreach ( $mib_groups as $mib_gk => $mib_gl ) : ?>
				<div class="menu-group">
					<p class="label"><?php echo esc_html( $mib_gl ); ?></p>
					<ul class="menu-list">
						<?php foreach ( mib_cfg( 'expertises' ) as $mib_slug => $mib_e ) : ?>
							<?php
							if ( $mib_e['group'] !== $mib_gk ) {
								continue;
							}
							?>
							<li><a href="<?php echo esc_url( mib_expertise_url( $mib_slug ) ); ?>"><?php echo esc_html( $mib_e['title'] ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>
		<ul class="menu-secondary">
			<li><a href="<?php echo esc_url( home_url( '/#methode' ) ); ?>" data-close>Méthode</a></li>
			<li><a href="<?php echo esc_url( home_url( '/#qui-sommes-nous' ) ); ?>" data-close>Qui sommes-nous</a></li>
			<?php if ( $mib_blog ) : ?>
				<li><a href="<?php echo esc_url( $mib_blog ); ?>">Blog</a></li>
			<?php endif; ?>
			<li><?php echo mib_email_link(); // phpcs:ignore ?></li>
		</ul>
		<div class="menu-cta"><?php echo mib_cta_button(); // phpcs:ignore ?></div>
	</nav>
</div>

<main id="contenu" tabindex="-1">
