<?php
defined( 'ABSPATH' ) || exit;

$form_url = get_theme_mod( 'bm_newsletter_url', '#' );
?>
<section class="bm-section bm-section--white">
	<div class="bm-container bm-container--narrow">
		<div class="bm-newsletter bm-reveal">
			<div>
				<div class="bm-newsletter__eyebrow"><?php esc_html_e( 'Newsletter', 'body-and-mind' ); ?></div>
				<h2 class="bm-newsletter__title"><?php esc_html_e( 'Bleib in Verbindung', 'body-and-mind' ); ?></h2>
				<p class="bm-newsletter__text">
					<?php esc_html_e( 'Sanfte Impulse, neue Kurse und Termine — etwa einmal im Monat in dein Postfach.', 'body-and-mind' ); ?>
				</p>
			</div>
			<form action="<?php echo esc_url( $form_url ); ?>" method="post" class="bm-newsletter__form" id="bm-newsletter-form">
				<div class="bm-newsletter__row">
					<input
						type="email"
						name="email"
						required
						placeholder="<?php esc_attr_e( 'deine@email.de', 'body-and-mind' ); ?>"
						class="bm-newsletter__input"
						aria-label="<?php esc_attr_e( 'E-Mail-Adresse', 'body-and-mind' ); ?>"
					>
					<button type="submit" class="bm-btn bm-btn--primary">
						<?php esc_html_e( 'Abonnieren', 'body-and-mind' ); ?>
					</button>
				</div>
				<div style="text-align:left">
					<label class="bm-checkbox-wrap">
						<input type="checkbox" name="consent" required>
						<span class="bm-checkbox-label">
							<?php
							printf(
								/* translators: %s: link to Datenschutzerklärung */
								esc_html__( 'Ich möchte den Newsletter erhalten und stimme der %s zu. Abmeldung jederzeit möglich.', 'body-and-mind' ),
								'<a href="' . esc_url( home_url( '/datenschutz/' ) ) . '" style="color:var(--accent-text)">' . esc_html__( 'Datenschutzerklärung', 'body-and-mind' ) . '</a>'
							);
							?>
						</span>
					</label>
				</div>
			</form>
		</div>
	</div>
</section>
