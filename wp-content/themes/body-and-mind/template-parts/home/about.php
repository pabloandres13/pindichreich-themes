<?php
defined( 'ABSPATH' ) || exit;

$trainer_name    = get_theme_mod( 'bm_studio_about_name', 'Lena' );
$trainer_bio     = get_theme_mod( 'bm_studio_about_text', 'Seit neun Jahren begleite ich Menschen auf ihrem Weg zu mehr Ruhe und Beweglichkeit. In meinem Studio soll sich jede willkommen fühlen — ganz gleich, wo du gerade stehst.' );
$portrait_img_id = get_theme_mod( 'bm_portrait_image', 0 );

if ( $portrait_img_id ) {
	$portrait_src = wp_get_attachment_image_url( $portrait_img_id, 'large' );
	$portrait_alt = get_post_meta( $portrait_img_id, '_wp_attachment_image_alt', true );
} else {
	$portrait_src = 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=700&q=80';
	$portrait_alt = $trainer_name;
}

$certs = [
	__( '500h Yoga Alliance', 'body-and-mind' ),
	__( 'Meditationslehrerin', 'body-and-mind' ),
	__( 'B-Lizenz Fitness', 'body-and-mind' ),
];
?>
<section class="bm-section bm-section--sage bm-about">
	<div class="bm-container">
		<div class="bm-about__grid">

			<div class="bm-about__image bm-reveal">
				<img src="<?php echo esc_url( $portrait_src ); ?>" alt="<?php echo esc_attr( $portrait_alt ); ?>" loading="lazy" decoding="async">
			</div>

			<div class="bm-reveal">
				<span class="bm-eyebrow"><?php esc_html_e( 'Über mich', 'body-and-mind' ); ?></span>
				<h2 class="bm-section-title">
					<?php
					printf(
						/* translators: %s: trainer first name */
						esc_html__( 'Hallo, ich bin %s', 'body-and-mind' ),
						esc_html( $trainer_name )
					);
					?>
				</h2>
				<p style="margin:1.2rem 0 0;font-size:var(--text-md);line-height:1.7;color:var(--text-body);max-width:50ch">
					<?php echo esc_html( $trainer_bio ); ?>
				</p>
				<div class="bm-about__certs">
					<?php foreach ( $certs as $cert ) : ?>
						<span class="bm-about__cert"><?php echo esc_html( $cert ); ?></span>
					<?php endforeach; ?>
				</div>
				<a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="bm-btn bm-btn--secondary">
					<?php esc_html_e( 'Lerne mich kennen', 'body-and-mind' ); ?>
				</a>
			</div>

		</div>
	</div>
</section>
