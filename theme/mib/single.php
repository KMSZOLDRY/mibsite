<?php
/**
 * Article de blog.
 */

defined( 'ABSPATH' ) || exit;

get_header();

$mib_posts_page = get_option( 'page_for_posts' );

while ( have_posts() ) :
	the_post();
	?>
	<article class="page wrap-text">
		<nav class="crumbs" aria-label="Fil d'Ariane">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">MIB</a> <span aria-hidden="true">/</span>
			<?php if ( $mib_posts_page ) : ?>
				<a href="<?php echo esc_url( get_permalink( $mib_posts_page ) ); ?>">Blog</a> <span aria-hidden="true">/</span>
			<?php endif; ?>
			<span aria-current="page"><?php the_title(); ?></span>
		</nav>

		<header class="page-head">
			<h1 class="page-title page-title--post"><?php the_title(); ?></h1>
			<p class="meta">
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></time>
				· <?php echo esc_html( mib_reading_time() ); ?> min de lecture
				<?php if ( get_the_modified_date( 'Ymd' ) > get_the_date( 'Ymd' ) ) : ?>
					· mis à jour le <time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date( 'j F Y' ) ); ?></time>
				<?php endif; ?>
			</p>
		</header>

		<div class="prose">
			<?php the_content(); ?>
		</div>

		<aside class="inline-cta" aria-labelledby="titre-cta-post">
			<h2 id="titre-cta-post" class="label">Un sujet similaire chez vous ?</h2>
			<p>Échangez 15 minutes avec un ingénieur MIB.</p>
			<p><?php echo mib_cal_link( 'Planifier un audit technique', 'link-cta' ); // phpcs:ignore ?></p>
		</aside>

		<nav class="related" aria-labelledby="titre-expertises-post">
			<h2 id="titre-expertises-post" class="label">Nos expertises</h2>
			<ul>
				<?php foreach ( mib_cfg( 'expertises' ) as $mib_slug => $mib_e ) : ?>
					<li><a href="<?php echo esc_url( mib_expertise_url( $mib_slug ) ); ?>"><?php echo esc_html( $mib_e['title'] ); ?> <?php echo mib_icon( 'arrow' ); // phpcs:ignore ?></a></li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</article>
	<?php
endwhile;

get_footer();
