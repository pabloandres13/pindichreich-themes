<?php
/**
 * Template Name: Kontakt / Buchung
 *
 * Auto-applies to a page with the slug "kontakt"; also selectable via
 * Page Attributes → Template. Studio details come from the Customizer
 * (Body & Mind Design → Studio-Infos). The form is progressively enhanced by
 * assets/js/theme.js (consent gating + success state). For real submissions,
 * replace the <form> body with a Contact Form 7 / WPForms shortcode.
 *
 * @package body-and-mind
 */

defined( 'ABSPATH' ) || exit;

get_header();

$privacy = get_page_by_path( 'datenschutz' );
$privacy = $privacy ? get_permalink( $privacy ) : home_url( '/datenschutz/' );

$info = [
	[ 'map-pin', __( 'Studio', 'body-and-mind' ),         get_theme_mod( 'bm_studio_address', 'Lichtweg 12, 20253 Hamburg' ) ],
	[ 'clock',   __( 'Öffnungszeiten', 'body-and-mind' ), get_theme_mod( 'bm_studio_hours', 'Mo–Fr 08–21 Uhr · Sa 09–14 Uhr' ) ],
	[ 'phone',   __( 'Telefon', 'body-and-mind' ),        get_theme_mod( 'bm_studio_phone', '040 123 456 78' ) ],
	[ 'mail',    __( 'E-Mail', 'body-and-mind' ),         get_theme_mod( 'bm_studio_email', 'hallo@studio.de' ) ],
];

$interests = [
	__( 'Hatha Yoga', 'body-and-mind' ),
	__( 'Vinyasa Flow', 'body-and-mind' ),
	__( 'Meditation', 'body-and-mind' ),
	__( 'Personal Training', 'body-and-mind' ),
	__( 'Noch unsicher', 'body-and-mind' ),
];
?>

<section class="bm-section bm-section--cream">
	<div class="bm-container">
		<div class="bm-contact__grid">

			<!-- Info column -->
			<div>
				<span class="bm-eyebrow"><?php esc_html_e( 'Kontakt & Buchung', 'body-and-mind' ); ?></span>
				<h1 class="bm-section-title"><?php esc_html_e( 'Komm vorbei zur Probestunde', 'body-and-mind' ); ?></h1>
				<p style="margin:1.1rem 0 2rem;font-size:var(--text-md);line-height:1.65;color:var(--text-body);max-width:44ch">
					<?php esc_html_e( 'Schreib uns kurz, worauf du Lust hast — wir melden uns mit einem passenden Termin. Unverbindlich und in Ruhe.', 'body-and-mind' ); ?>
				</p>

				<div style="display:flex;flex-direction:column;gap:1rem">
					<?php foreach ( $info as $item ) :
						list( $icon, $label, $value ) = $item;
						if ( '' === trim( (string) $value ) ) {
							continue;
						}
						?>
						<div class="bm-contact__info-item">
							<span class="bm-contact__info-icon"><?php echo bm_icon( $icon, 19 ); // phpcs:ignore ?></span>
							<div>
								<div class="bm-contact__info-label"><?php echo esc_html( $label ); ?></div>
								<?php if ( 'mail' === $icon ) : ?>
									<div class="bm-contact__info-value"><a href="mailto:<?php echo esc_attr( antispambot( $value ) ); ?>" style="color:inherit"><?php echo esc_html( antispambot( $value ) ); ?></a></div>
								<?php elseif ( 'phone' === $icon ) : ?>
									<div class="bm-contact__info-value"><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $value ) ); ?>" style="color:inherit"><?php echo esc_html( $value ); ?></a></div>
								<?php else : ?>
									<div class="bm-contact__info-value"><?php echo esc_html( $value ); ?></div>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="bm-contact__map-placeholder">
					<?php echo bm_icon( 'map-pin', 28 ); // phpcs:ignore ?>
					<span class="bm-contact__map-label"><?php esc_html_e( 'Karte (Platzhalter)', 'body-and-mind' ); ?></span>
				</div>
			</div>

			<!-- Form column -->
			<div class="bm-contact__form-card">
				<div class="bm-contact__success" id="bm-contact-success" hidden>
					<span class="bm-contact__success-icon"><?php echo bm_icon( 'check', 30 ); // phpcs:ignore ?></span>
					<h2 style="margin:0;font-size:var(--text-2xl)"><?php esc_html_e( 'Danke dir!', 'body-and-mind' ); ?></h2>
					<p style="margin:0;color:var(--text-body)"><?php esc_html_e( 'Wir haben deine Anfrage erhalten und melden uns bald.', 'body-and-mind' ); ?></p>
				</div>

				<form id="bm-contact-form" class="bm-contact__form" action="<?php echo esc_url( get_permalink() ); ?>" method="post" novalidate>
					<div class="bm-contact__form-row">
						<div class="bm-field">
							<label class="bm-label" for="bm-vorname"><?php esc_html_e( 'Vorname', 'body-and-mind' ); ?></label>
							<input class="bm-input" type="text" id="bm-vorname" name="vorname" placeholder="<?php esc_attr_e( 'Marie', 'body-and-mind' ); ?>" required>
						</div>
						<div class="bm-field">
							<label class="bm-label" for="bm-nachname"><?php esc_html_e( 'Nachname', 'body-and-mind' ); ?></label>
							<input class="bm-input" type="text" id="bm-nachname" name="nachname" placeholder="<?php esc_attr_e( 'Becker', 'body-and-mind' ); ?>" required>
						</div>
					</div>

					<div class="bm-field">
						<label class="bm-label" for="bm-email"><?php esc_html_e( 'E-Mail', 'body-and-mind' ); ?></label>
						<input class="bm-input" type="email" id="bm-email" name="email" placeholder="<?php esc_attr_e( 'marie@email.de', 'body-and-mind' ); ?>" required>
					</div>

					<div class="bm-field">
						<label class="bm-label" for="bm-interesse"><?php esc_html_e( 'Interesse', 'body-and-mind' ); ?></label>
						<select class="bm-select" id="bm-interesse" name="interesse">
							<option value="" disabled selected><?php esc_html_e( 'Bitte wählen', 'body-and-mind' ); ?></option>
							<?php foreach ( $interests as $opt ) : ?>
								<option value="<?php echo esc_attr( $opt ); ?>"><?php echo esc_html( $opt ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="bm-field">
						<label class="bm-label" for="bm-nachricht"><?php esc_html_e( 'Nachricht', 'body-and-mind' ); ?></label>
						<textarea class="bm-textarea" id="bm-nachricht" name="nachricht" rows="4" placeholder="<?php esc_attr_e( 'Worauf freust du dich? Gibt es etwas, das wir wissen sollten?', 'body-and-mind' ); ?>"></textarea>
					</div>

					<label class="bm-checkbox-wrap">
						<input type="checkbox" id="bm-consent" name="consent" required>
						<span class="bm-checkbox-label">
							<?php
							printf(
								/* translators: %s: link to Datenschutzerklärung */
								esc_html__( 'Ich habe die %s gelesen und stimme der Verarbeitung meiner Daten zu.', 'body-and-mind' ),
								'<a href="' . esc_url( $privacy ) . '" style="color:var(--text-link)">' . esc_html__( 'Datenschutzerklärung', 'body-and-mind' ) . '</a>'
							);
							?>
						</span>
					</label>

					<button type="submit" class="bm-btn bm-btn--primary bm-btn--lg bm-btn--full"><?php esc_html_e( 'Anfrage senden', 'body-and-mind' ); ?></button>

					<div class="bm-disclaimer bm-disclaimer--neutral">
						<span class="bm-disclaimer__icon"><?php echo bm_icon( 'info', 16 ); // phpcs:ignore ?></span>
						<p class="bm-disclaimer__text"><?php esc_html_e( 'Deine Daten werden ausschließlich zur Bearbeitung deiner Anfrage verwendet und nicht weitergegeben.', 'body-and-mind' ); ?></p>
					</div>
				</form>
			</div>

		</div>
	</div>
</section>

<?php
get_footer();
