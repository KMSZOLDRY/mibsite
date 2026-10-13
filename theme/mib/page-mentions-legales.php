<?php
/**
 * Mentions légales : informations obligatoires générées depuis la configuration
 * (LCEN, art. 6-III). Le contenu saisi dans la page WordPress s'affiche à la suite.
 */

defined( 'ABSPATH' ) || exit;

get_header();

$mib_l     = mib_cfg( 'legal' );
$mib_brand = mib_cfg( 'brand' );

while ( have_posts() ) :
	the_post();
	?>
	<article class="page wrap-text">
		<header class="page-head">
			<h1 class="page-title"><?php the_title(); ?></h1>
		</header>
		<div class="prose">
			<h2>Éditeur du site</h2>
			<p>
				<?php echo esc_html( $mib_l['publisher'] ); ?>, <?php echo esc_html( strtolower( $mib_l['status'] ) ); ?><br>
				Nom commercial : <?php echo esc_html( $mib_l['trade_name'] ); ?><br>
				SIRET : <?php echo esc_html( $mib_l['siret'] ); ?><br>
				Adresse : <?php echo esc_html( $mib_l['address'] ); ?><br>
				Contact : <?php echo mib_email_link(); // phpcs:ignore ?>
			</p>

			<h2>Directeur de la publication</h2>
			<p><?php echo esc_html( $mib_l['director'] ); ?></p>

			<h2>Hébergement</h2>
			<p>
				<?php echo esc_html( $mib_l['host_name'] ); ?><br>
				<?php echo esc_html( $mib_l['host_address'] ); ?><br>
				Téléphone : <?php echo esc_html( $mib_l['host_phone'] ); ?>
			</p>

			<?php the_content(); ?>
		</div>
	</article>
	<?php
endwhile;

get_footer();
