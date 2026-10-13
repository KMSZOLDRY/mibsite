<?php
/**
 * Pages : gabarit « Text-Only Premium ».
 * Si la page est l'un des 4 pôles d'expertise (slug déclaré dans la config),
 * on ajoute l'en-tête de pôle, l'appel à l'action et le maillage vers les autres pôles.
 */

defined( 'ABSPATH' ) || exit;

get_header();

$mib_x = mib_current_expertise();

while ( have_posts() ) :
	the_post();
	?>
	<article class="page wrap-text">
		<?php if ( $mib_x ) : ?>
			<nav class="crumbs" aria-label="Fil d'Ariane">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">MIB</a> <span aria-hidden="true">/</span> <span>Expertise <?php echo esc_html( sprintf( '%02d', $mib_x['index'] ) ); ?></span>
			</nav>
		<?php endif; ?>

		<header class="page-head">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php if ( $mib_x ) : ?>
				<p class="page-lead"><?php echo esc_html( $mib_x['lead'] ); ?></p>
				<p class="xp-tags"><?php echo esc_html( $mib_x['tags'] ); ?></p>
			<?php endif; ?>
		</header>

		<div class="prose">
			<?php the_content(); ?>
		</div>

		<?php if ( $mib_x ) : ?>
			<aside class="inline-cta" aria-labelledby="titre-cta-page">
				<h2 id="titre-cta-page" class="label">Parlons de votre contexte</h2>
				<p>Un échange de 15 minutes avec un ingénieur MIB pour qualifier votre besoin.</p>
				<p><?php echo mib_cal_link( 'Planifier un audit technique', 'link-cta' ); // phpcs:ignore ?></p>
			</aside>

			<nav class="related" aria-labelledby="titre-autres">
				<h2 id="titre-autres" class="label">Autres expertises</h2>
				<ul>
					<?php foreach ( mib_cfg( 'expertises' ) as $mib_slug => $mib_e ) : ?>
						<?php
						if ( $mib_slug === $mib_x['slug'] ) {
							continue;
						}
						?>
						<li><a href="<?php echo esc_url( mib_expertise_url( $mib_slug ) ); ?>"><?php echo esc_html( $mib_e['title'] ); ?> <?php echo mib_icon( 'arrow' ); // phpcs:ignore ?></a></li>
					<?php endforeach; ?>
				</ul>
			</nav>
		<?php endif; ?>
	</article>
	<?php
endwhile;

get_footer();
