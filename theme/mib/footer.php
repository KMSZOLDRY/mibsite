<?php
/**
 * Pied de page : conversion sans formulaire (Cal.com + mail chiffré), navigation, mentions.
 */

defined( 'ABSPATH' ) || exit;

$mib_f     = mib_cfg( 'footer' );
$mib_pages = mib_cfg( 'pages' );
$mib_legal = mib_cfg( 'legal' );
$mib_blog  = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : '';
?>
</main>

<footer class="site-footer">
	<section class="wrap footer-cta beam" aria-labelledby="titre-contact">
		<h2 id="titre-contact" class="cta-title"><?php echo esc_html( $mib_f['cta_title'] ); ?></h2>
		<p class="cta-text"><?php echo esc_html( $mib_f['cta_text'] ); ?></p>
		<div class="cta-actions">
			<?php echo mib_cta_button(); // phpcs:ignore ?>
		</div>
		<p class="cta-mail-line">Ou par e-mail : <?php echo mib_email_link( 'cta-mail' ); // phpcs:ignore ?> <span class="note">— <?php echo esc_html( $mib_f['reply'] ); ?></span></p>
	</section>

	<div class="wrap footer-bottom">
		<div class="footer-brand">
			<?php echo mib_logo(); // phpcs:ignore ?>
			<?php echo mib_signature(); // phpcs:ignore ?>
		</div>
		<nav class="footer-nav" aria-label="Plan du site">
			<ul>
				<?php foreach ( mib_cfg( 'expertises' ) as $mib_slug => $mib_e ) : ?>
					<li><a href="<?php echo esc_url( mib_expertise_url( $mib_slug ) ); ?>"><?php echo esc_html( $mib_e['title'] ); ?></a></li>
				<?php endforeach; ?>
				<?php if ( $mib_blog ) : ?>
					<li><a href="<?php echo esc_url( $mib_blog ); ?>">Blog</a></li>
				<?php endif; ?>
			</ul>
		</nav>
		<ul class="footer-legal">
			<li><a href="<?php echo esc_url( home_url( $mib_pages['legal'] ) ); ?>">Mentions légales</a></li>
			<li><a href="<?php echo esc_url( home_url( $mib_pages['privacy'] ) ); ?>">Confidentialité</a></li>
			<li><a href="<?php echo esc_url( home_url( $mib_pages['accessibility'] ) ); ?>">Accessibilité</a></li>
			<li><?php echo esc_html( $mib_legal['host_note'] ); ?></li>
			<li>© <?php echo esc_html( gmdate( 'Y' ) ); ?> MIB — Man in Back</li>
		</ul>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
