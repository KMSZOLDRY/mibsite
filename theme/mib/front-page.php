<?php
/**
 * Accueil : 3 écrans (Hero, Discipline & douleurs, Expertises), le 4e est le pied de page.
 * Contenu servi depuis la configuration statique : aucune requête SQL de contenu.
 */

defined( 'ABSPATH' ) || exit;

get_header();

$mib_brand = mib_cfg( 'brand' );
$mib_home  = mib_cfg( 'home' );
?>

<section class="hero wrap" aria-labelledby="titre-hero">
	<h1 id="titre-hero" class="hero-title">L'excellence numérique est humaine<span class="accent" aria-hidden="true">.</span></h1>
	<p class="hero-lead"><?php echo esc_html( $mib_brand['description'] ); ?></p>
</section>

<section class="discipline wrap" aria-labelledby="titre-discipline">
	<div class="discipline-intro">
		<h2 id="titre-discipline" class="label">Notre discipline</h2>
		<p class="statement"><?php echo esc_html( $mib_home['discipline'] ); ?></p>
	</div>
	<ul class="pains">
		<?php foreach ( $mib_home['pains'] as $mib_p ) : ?>
			<li class="pain">
				<h3 class="pain-q"><?php echo esc_html( $mib_p['q'] ); ?></h3>
				<p class="pain-a"><?php echo esc_html( $mib_p['a'] ); ?></p>
			</li>
		<?php endforeach; ?>
	</ul>
</section>

<section class="expertises wrap" aria-labelledby="titre-expertises">
	<div class="section-head">
		<h2 id="titre-expertises" class="label">Expertises</h2>
		<p class="section-intro"><?php echo esc_html( $mib_home['expertises_intro'] ); ?></p>
	</div>
	<ol class="xp-list">
		<?php
		$mib_i = 0;
		foreach ( mib_cfg( 'expertises' ) as $mib_slug => $mib_e ) :
			++$mib_i;
			?>
			<li class="xp">
				<span class="num" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $mib_i ) ); ?></span>
				<div class="xp-main">
					<h3 class="xp-title"><a href="<?php echo esc_url( mib_expertise_url( $mib_slug ) ); ?>"><?php echo esc_html( $mib_e['title'] ); ?></a></h3>
					<p class="xp-tags"><?php echo esc_html( $mib_e['tags'] ); ?></p>
				</div>
				<div class="xp-more">
					<div class="xp-more-inner">
						<p class="xp-desc"><?php echo esc_html( $mib_e['desc'] ); ?></p>
						<p class="xp-cta" aria-hidden="true">Découvrir l'expertise <?php echo mib_icon( 'arrow' ); // phpcs:ignore ?></p>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
	</ol>
</section>

<?php
get_footer();
