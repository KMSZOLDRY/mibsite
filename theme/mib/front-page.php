<?php
/**
 * Accueil — 8 sections (brief MIB) :
 * 1 Impact · 2 Problème · 3 Réponse · 4 Méthode · 5 Capacité d'action · 6 Qui sommes-nous · 7 Confiance · 8 CTA (pied de page).
 * Contenu servi depuis la configuration statique : aucune requête SQL de contenu.
 */

defined( 'ABSPATH' ) || exit;

get_header();

$mib_brand = mib_cfg( 'brand' );
$mib_h     = mib_cfg( 'home' );
$mib_x     = mib_cfg( 'expertises' );
?>

<section class="hero beam" aria-labelledby="titre-hero">
	<div class="wrap hero-inner">
		<p class="label label--sage">Humain × Digital</p>
		<h1 id="titre-hero" class="hero-title">
			<?php
			$mib_parts = preg_split( '/(?<=\.)\s+/u', $mib_brand['promise'] );
			foreach ( $mib_parts as $mib_i => $mib_part ) {
				printf( '<span%s>%s</span> ', count( $mib_parts ) - 1 === $mib_i ? ' class="gold"' : '', esc_html( $mib_part ) );
			}
			?>
		</h1>
		<p class="hero-lead"><?php echo esc_html( $mib_brand['description'] ); ?></p>
		<div class="hero-cta"><?php echo mib_cta_button(); // phpcs:ignore ?></div>
	</div>
</section>

<?php $mib_s = $mib_h['problem']; ?>
<section class="section wrap" aria-labelledby="titre-probleme">
	<div class="section-head">
		<p class="label"><?php echo esc_html( $mib_s['label'] ); ?></p>
		<h2 id="titre-probleme" class="section-title"><?php echo esc_html( $mib_s['title'] ); ?></h2>
		<p class="section-text"><?php echo esc_html( $mib_s['text'] ); ?></p>
	</div>
	<ul class="pains">
		<?php foreach ( $mib_s['pains'] as $mib_p ) : ?>
			<li>
				<a class="pain" href="<?php echo esc_url( mib_expertise_url( $mib_p['to'] ) ); ?>">
					<span class="pain-q">«&nbsp;<?php echo esc_html( $mib_p['q'] ); ?>&nbsp;»</span>
					<span class="pain-to"><?php echo esc_html( $mib_x[ $mib_p['to'] ]['title'] ); ?> <?php echo mib_icon( 'arrow' ); // phpcs:ignore ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</section>

<?php $mib_s = $mib_h['answer']; ?>
<section class="section wrap" aria-labelledby="titre-reponse">
	<div class="section-head">
		<p class="label"><?php echo esc_html( $mib_s['label'] ); ?></p>
		<h2 id="titre-reponse" class="section-title"><?php echo esc_html( $mib_s['title'] ); ?></h2>
		<p class="section-text"><?php echo esc_html( $mib_s['text'] ); ?></p>
	</div>
	<figure class="loop">
		<ol class="loop-steps">
			<?php foreach ( $mib_s['loop'] as $mib_i => $mib_l ) : ?>
				<li class="loop-step">
					<span class="loop-num" aria-hidden="true"><?php echo esc_html( sprintf( '%02d', $mib_i + 1 ) ); ?></span>
					<strong><?php echo esc_html( $mib_l['t'] ); ?></strong>
					<span><?php echo esc_html( $mib_l['d'] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ol>
		<figcaption class="loop-note"><span aria-hidden="true">↻</span> Boucle MIB : <?php echo esc_html( $mib_s['loop_note'] ); ?></figcaption>
	</figure>
</section>

<?php $mib_s = $mib_h['method']; ?>
<section id="methode" class="section wrap" aria-labelledby="titre-methode">
	<div class="section-head">
		<p class="label"><?php echo esc_html( $mib_s['label'] ); ?></p>
		<h2 id="titre-methode" class="section-title section-title--quote"><?php echo esc_html( $mib_s['title'] ); ?></h2>
	</div>
	<ol class="steps">
		<?php foreach ( $mib_s['steps'] as $mib_i => $mib_st ) : ?>
			<li class="step">
				<span class="step-num" aria-hidden="true"><?php echo esc_html( $mib_i + 1 ); ?></span>
				<h3 class="step-title"><?php echo esc_html( $mib_st['t'] ); ?></h3>
				<p><?php echo esc_html( $mib_st['d'] ); ?></p>
			</li>
		<?php endforeach; ?>
	</ol>
	<p class="section-note"><?php echo esc_html( $mib_s['demo'] ); ?></p>
</section>

<?php $mib_s = $mib_h['action']; ?>
<section class="section wrap" aria-labelledby="titre-action">
	<div class="section-head">
		<p class="label"><?php echo esc_html( $mib_s['label'] ); ?></p>
		<h2 id="titre-action" class="section-title"><?php echo esc_html( $mib_s['title'] ); ?></h2>
		<p class="section-text"><?php echo esc_html( $mib_s['text'] ); ?></p>
	</div>
	<div class="xp-groups">
		<?php foreach ( mib_cfg( 'groups' ) as $mib_gk => $mib_gl ) : ?>
			<div class="xp-group">
				<h3 class="xp-group-title"><?php echo esc_html( $mib_gl ); ?></h3>
				<ul class="xp-list">
					<?php foreach ( $mib_x as $mib_slug => $mib_e ) : ?>
						<?php
						if ( $mib_e['group'] !== $mib_gk ) {
							continue;
						}
						?>
						<li class="xp">
							<h4 class="xp-title"><a href="<?php echo esc_url( mib_expertise_url( $mib_slug ) ); ?>"><?php echo esc_html( $mib_e['title'] ); ?></a></h4>
							<p class="xp-desc"><?php echo esc_html( $mib_e['desc'] ); ?></p>
							<p class="xp-cta" aria-hidden="true">Découvrir <?php echo mib_icon( 'arrow' ); // phpcs:ignore ?></p>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<?php $mib_s = $mib_h['about']; ?>
<section id="qui-sommes-nous" class="section wrap about" aria-labelledby="titre-about">
	<div class="section-head">
		<p class="label"><?php echo esc_html( $mib_s['label'] ); ?></p>
		<h2 id="titre-about" class="section-title section-title--xl"><?php echo esc_html( $mib_s['title'] ); ?></h2>
	</div>
	<div class="about-body">
		<?php foreach ( $mib_s['text'] as $mib_i => $mib_t ) : ?>
			<p<?php echo count( $mib_s['text'] ) - 1 === $mib_i ? ' class="about-punch"' : ''; ?>><?php echo esc_html( $mib_t ); ?></p>
		<?php endforeach; ?>
		<?php echo mib_signature(); // phpcs:ignore ?>
	</div>
</section>

<?php $mib_s = $mib_h['trust']; ?>
<section class="section wrap" aria-labelledby="titre-confiance">
	<div class="section-head">
		<p class="label"><?php echo esc_html( $mib_s['label'] ); ?></p>
		<h2 id="titre-confiance" class="section-title"><?php echo esc_html( $mib_s['title'] ); ?></h2>
	</div>
	<ul class="trust">
		<?php foreach ( $mib_s['items'] as $mib_it ) : ?>
			<li>
				<h3 class="trust-title"><?php echo esc_html( $mib_it['t'] ); ?></h3>
				<p><?php echo esc_html( $mib_it['d'] ); ?></p>
			</li>
		<?php endforeach; ?>
	</ul>
</section>

<?php
get_footer();
