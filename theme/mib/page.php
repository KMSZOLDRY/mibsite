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
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">MIB</a> <span aria-hidden="true">/</span> <span>Levier <?php echo esc_html( strtolower( $mib_x['group_label'] ) ); ?></span>
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
				<h2 id="titre-cta-page" class="inline-cta-title">Où agir en premier ?</h2>
				<p>En 15 minutes, nous regardons votre situation et vous indiquons la priorité.</p>
				<div><?php echo mib_cta_button(); // phpcs:ignore ?></div>
			</aside>

			<nav class="related" aria-labelledby="titre-autres">
				<h2 id="titre-autres" class="label">Autres leviers</h2>
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
