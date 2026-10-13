<?php
/**
 * Page introuvable.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<section class="page wrap-text" aria-labelledby="titre-404">
	<header class="page-head">
		<p class="label">Erreur 404</p>
		<h1 id="titre-404" class="page-title">Cette page n'existe pas<span class="accent" aria-hidden="true">.</span></h1>
		<p class="page-lead">Le lien est peut-être ancien ou mal saisi. Voici où reprendre :</p>
	</header>
	<nav class="related" aria-label="Pages principales">
		<ul>
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Accueil <?php echo mib_icon( 'arrow' ); // phpcs:ignore ?></a></li>
			<?php foreach ( mib_cfg( 'expertises' ) as $mib_slug => $mib_e ) : ?>
				<li><a href="<?php echo esc_url( mib_expertise_url( $mib_slug ) ); ?>"><?php echo esc_html( $mib_e['title'] ); ?> <?php echo mib_icon( 'arrow' ); // phpcs:ignore ?></a></li>
			<?php endforeach; ?>
		</ul>
	</nav>
</section>
<?php
get_footer();
