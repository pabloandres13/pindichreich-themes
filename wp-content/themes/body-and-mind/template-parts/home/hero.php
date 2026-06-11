<?php
defined( 'ABSPATH' ) || exit;

$headline    = get_theme_mod( 'bm_studio_headline', "Ankommen,\ndurchatmen,\nin Bewegung kommen." );
$tagline     = get_theme_mod( 'bm_studio_tagline', 'Atme. Du bist hier richtig.' );
$lead        = get_theme_mod( 'bm_studio_lead', 'Ein heller Ort für Yoga, Meditation und Personal Training. Komm vorbei und probiere eine Stunde ganz unverbindlich aus.' );
$hero_img_id = get_theme_mod( 'bm_hero_image', 0 );

if ( $hero_img_id ) {
	$hero_src = wp_get_attachment_image_url( $hero_img_id, 'large' );
	$hero_alt = get_post_meta( $hero_img_id, '_wp_attachment_image_alt', true );
} else {
	$hero_src = 'https://images.unsplash.com/photo-1545389336-cf090694435e?auto=format&fit=crop&w=1400&q=80';
	$hero_alt = __( 'Yoga im hellen Studio', 'body-and-mind' );
}
?>
<section class="bm-hero bm-section--cream" aria-label="<?php esc_attr_e( 'Willkommen', 'body-and-mind' ); ?>">
	<div class="bm-container">
		<div class="bm-hero__grid">

			<!-- Text column -->
			<div class="bm-reveal">
				<p class="bm-script bm-hero__tagline"><?php echo esc_html( $tagline ); ?></p>
				<h1 class="bm-hero__headline"><?php echo nl2br( esc_html( $headline ) ); ?></h1>
				<p class="bm-hero__lead"><?php echo esc_html( $lead ); ?></p>

				<div class="bm-hero__actions">
					<a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="bm-btn bm-btn--primary bm-btn--lg">
						<?php esc_html_e( 'Probestunde buchen', 'body-and-mind' ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/kurse/' ) ); ?>" class="bm-btn bm-btn--secondary bm-btn--lg">
						<?php esc_html_e( 'Kurse ansehen', 'body-and-mind' ); ?>
						<?php echo bm_icon( 'arrow-right', 18 ); // phpcs:ignore ?>
					</a>
				</div>

				<div class="bm-hero__stats">
					<div>
						<div class="bm-hero__stat-num">3</div>
						<div class="bm-hero__stat-label"><?php esc_html_e( 'Angebote', 'body-and-mind' ); ?></div>
					</div>
					<div>
						<div class="bm-hero__stat-num">12+</div>
						<div class="bm-hero__stat-label"><?php esc_html_e( 'Kurse / Woche', 'body-and-mind' ); ?></div>
					</div>
					<div>
						<div class="bm-hero__stat-num">9 <?php esc_html_e( 'Jahre', 'body-and-mind' ); ?></div>
						<div class="bm-hero__stat-label"><?php esc_html_e( 'Erfahrung', 'body-and-mind' ); ?></div>
					</div>
				</div>
			</div>

			<!-- Image column -->
			<div class="bm-hero__image-wrap bm-reveal">
				<div class="bm-hero__image">
					<img src="<?php echo esc_url( $hero_src ); ?>" alt="<?php echo esc_attr( $hero_alt ); ?>" loading="eager" decoding="async">
				</div>
				<div class="bm-hero__badge">
					<div class="bm-hero__badge-icon">
						<?php echo bm_icon( 'leaf', 20 ); // phpcs:ignore ?>
					</div>
					<div>
						<div class="bm-hero__badge-title"><?php esc_html_e( 'Kleine Gruppen', 'body-and-mind' ); ?></div>
						<div class="bm-hero__badge-sub"><?php esc_html_e( 'max. 10 Teilnehmerinnen', 'body-and-mind' ); ?></div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
