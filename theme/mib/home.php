<?php
/**
 * Liste des articles du blog.
 */

defined( 'ABSPATH' ) || exit;

get_header();

$mib_posts_page = get_option( 'page_for_posts' );
?>
<section class="blog wrap-text" aria-labelledby="titre-blog">
	<header class="page-head">
		<h1 id="titre-blog" class="page-title"><?php echo esc_html( $mib_posts_page ? get_the_title( $mib_posts_page ) : 'Blog' ); ?></h1>
		<p class="page-lead">Analyses et retours de terrain de l'équipe MIB : architecture, IA, sobriété numérique, performance humaine.</p>
	</header>

	<?php if ( have_posts() ) : ?>
		<ul class="post-list">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<li class="post-item">
					<p class="meta"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></time> · <?php echo esc_html( mib_reading_time() ); ?> min</p>
					<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="post-excerpt"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
				</li>
			<?php endwhile; ?>
		</ul>
		<?php
		the_posts_pagination(
			array(
				'mid_size'           => 1,
				'prev_text'          => 'Précédent',
				'next_text'          => 'Suivant',
				'screen_reader_text' => 'Pagination des articles',
				'aria_label'         => 'Pagination',
			)
		);
		?>
	<?php else : ?>
		<p>Les premiers articles arrivent bientôt.</p>
	<?php endif; ?>
</section>
<?php
get_footer();
