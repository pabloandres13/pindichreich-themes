<?php
defined( 'ABSPATH' ) || exit;

$portrait_id = (int) get_theme_mod( 'aurelia_portrait_image', 0 );
?>
<section class="au-section au-section--cream">
	<div class="au-container">
		<div class="au-split au-split--media-narrow">
			<div class="au-image-frame au-image-frame--sand au-reveal" style="aspect-ratio:1/1">
				<?php
				if ( $portrait_id ) {
					echo wp_get_attachment_image( $portrait_id, 'large' );
				} else {
					echo aurelia_icon( 'user', 40 ); // phpcs:ignore
				}
				?>
			</div>
			<div class="au-reveal">
				<?php aurelia_label( __( 'Über uns', 'aurelia' ) ); ?>
				<h2 style="margin:0.9rem 0 1rem">
					<?php echo esc_html( get_theme_mod( 'aurelia_about_title', __( 'Ein Ort, an dem Sie ankommen dürfen', 'aurelia' ) ) ); ?>
				</h2>
				<p style="font-size:1.0625rem;line-height:1.7">
					<?php echo esc_html( get_theme_mod( 'aurelia_about_text', __( 'Seit über zehn Jahren begleiten wir Menschen auf ihrem Weg zu mehr Gesundheit und innerer Ruhe. Wir nehmen uns Zeit, hören zu und gehen Schritt für Schritt — fachkundig, ehrlich und ohne Druck.', 'aurelia' ) ) ); ?>
				</p>
				<div style="margin-top:1.5rem">
					<a class="au-btn au-btn--text" href="<?php echo esc_url( home_url( '/ueber-uns/' ) ); ?>">
						<?php esc_html_e( 'Mehr über uns', 'aurelia' ); ?>
						<?php echo aurelia_icon( 'arrow-right', 17 ); // phpcs:ignore ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
