<footer class="au-footer" role="contentinfo">
	<div class="au-footer__inner">
		<div class="au-footer__grid">

			<!-- Brand column -->
			<div>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="au-header__logo" aria-label="<?php bloginfo( 'name' ); ?>">
					<?php aurelia_logo( true ); ?>
				</a>
				<p class="au-footer__tagline">
					<?php echo esc_html( get_theme_mod( 'aurelia_footer_tagline', __( 'Ganzheitliche Begleitung für Ernährung, Achtsamkeit und ein ausgeglichenes Leben — fachkundig und in Ihrem Tempo.', 'aurelia' ) ) ); ?>
				</p>
				<div class="au-footer__social">
					<?php $instagram = get_theme_mod( 'aurelia_instagram', '#' ); ?>
					<a href="<?php echo esc_url( $instagram ); ?>" class="au-footer__social-link" aria-label="Instagram" rel="noopener noreferrer">
						<?php echo aurelia_icon( 'instagram', 18 ); // phpcs:ignore ?>
					</a>
					<?php $facebook = get_theme_mod( 'aurelia_facebook', '#' ); ?>
					<a href="<?php echo esc_url( $facebook ); ?>" class="au-footer__social-link" aria-label="Facebook" rel="noopener noreferrer">
						<?php echo aurelia_icon( 'facebook', 18 ); // phpcs:ignore ?>
					</a>
					<?php $email = get_theme_mod( 'aurelia_email', 'hallo@aurelia-praxis.de' ); ?>
					<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>" class="au-footer__social-link" aria-label="E-Mail">
						<?php echo aurelia_icon( 'mail', 18 ); // phpcs:ignore ?>
					</a>
				</div>
			</div>

			<!-- Leistungen -->
			<div>
				<div class="au-footer__col-title"><?php esc_html_e( 'Leistungen', 'aurelia' ); ?></div>
				<a class="au-footer__link" href="<?php echo esc_url( home_url( '/leistungen/' ) ); ?>"><?php esc_html_e( 'Ernährungsberatung', 'aurelia' ); ?></a>
				<a class="au-footer__link" href="<?php echo esc_url( home_url( '/leistungen/' ) ); ?>"><?php esc_html_e( 'Achtsamkeit & Stress', 'aurelia' ); ?></a>
				<a class="au-footer__link" href="<?php echo esc_url( home_url( '/leistungen/' ) ); ?>"><?php esc_html_e( 'Naturheilkunde', 'aurelia' ); ?></a>
				<a class="au-footer__link" href="<?php echo esc_url( home_url( '/leistungen/' ) ); ?>"><?php esc_html_e( 'Gesundheitscoaching', 'aurelia' ); ?></a>
			</div>

			<!-- Praxis -->
			<div>
				<div class="au-footer__col-title"><?php echo esc_html( get_theme_mod( 'aurelia_practice_name', 'Aurelia' ) ); ?></div>
				<a class="au-footer__link" href="<?php echo esc_url( home_url( '/ueber-uns/' ) ); ?>"><?php esc_html_e( 'Über uns', 'aurelia' ); ?></a>
				<a class="au-footer__link" href="<?php echo esc_url( home_url( '/magazin/' ) ); ?>"><?php esc_html_e( 'Magazin', 'aurelia' ); ?></a>
				<a class="au-footer__link" href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Kontakt', 'aurelia' ); ?></a>
			</div>

			<!-- Service -->
			<div>
				<div class="au-footer__col-title"><?php esc_html_e( 'Service', 'aurelia' ); ?></div>
				<a class="au-footer__link" href="<?php echo esc_url( aurelia_booking_url() ); ?>"><?php esc_html_e( 'Termin buchen', 'aurelia' ); ?></a>
				<a class="au-footer__link" href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Anfahrt', 'aurelia' ); ?></a>
				<a class="au-footer__link" href="<?php echo esc_url( home_url( '/magazin/' ) ); ?>"><?php esc_html_e( 'Newsletter', 'aurelia' ); ?></a>
			</div>

		</div><!-- .au-footer__grid -->

		<div class="au-footer__legal">
			<span class="au-footer__copyright">
				<?php echo esc_html( get_theme_mod( 'aurelia_copyright', '© ' . date( 'Y' ) . ' Aurelia. Alle Rechte vorbehalten.' ) ); ?>
			</span>
			<div class="au-footer__legal-links">
				<a class="au-footer__legal-link" href="<?php echo esc_url( home_url( '/impressum/' ) ); ?>"><?php esc_html_e( 'Impressum', 'aurelia' ); ?></a>
				<a class="au-footer__legal-link" href="<?php echo esc_url( home_url( '/datenschutz/' ) ); ?>"><?php esc_html_e( 'Datenschutz', 'aurelia' ); ?></a>
				<button class="au-footer__legal-link" data-action="cookie-settings"><?php esc_html_e( 'Cookie-Einstellungen', 'aurelia' ); ?></button>
			</div>
		</div>
	</div>
</footer>

<!-- Cookie Banner (DSGVO-compliant, opt-in) -->
<div id="au-cookie-banner" class="au-cookie" role="dialog" aria-modal="true" aria-labelledby="au-cookie-title" hidden>
	<div class="au-cookie__card">
		<div class="au-cookie__main">
			<div class="au-cookie__copy">
				<h3 class="au-cookie__title" id="au-cookie-title"><?php esc_html_e( 'Wir respektieren Ihre Privatsphäre', 'aurelia' ); ?></h3>
				<p class="au-cookie__text">
					<?php
					printf(
						/* translators: %s: link to Datenschutzerklärung */
						esc_html__( 'Wir verwenden Cookies, um diese Website bereitzustellen und zu verbessern. Nicht notwendige Cookies setzen wir nur mit Ihrer Einwilligung. Mehr in unserer %s.', 'aurelia' ),
						'<a href="' . esc_url( home_url( '/datenschutz/' ) ) . '">' . esc_html__( 'Datenschutzerklärung', 'aurelia' ) . '</a>'
					);
					?>
				</p>
			</div>
			<div class="au-cookie__actions">
				<button class="au-btn au-btn--ghost" data-action="settings"><?php esc_html_e( 'Einstellungen', 'aurelia' ); ?></button>
				<button class="au-btn au-btn--secondary" data-action="reject"><?php esc_html_e( 'Ablehnen', 'aurelia' ); ?></button>
				<button class="au-btn au-btn--primary" data-action="accept"><?php esc_html_e( 'Akzeptieren', 'aurelia' ); ?></button>
			</div>
		</div>

		<div class="au-cookie__settings">
			<div class="au-cookie__setting">
				<div>
					<span class="au-cookie__setting-label"><?php esc_html_e( 'Notwendig', 'aurelia' ); ?></span>
					<p class="au-cookie__setting-desc"><?php esc_html_e( 'Für den Betrieb der Website erforderlich. Immer aktiv.', 'aurelia' ); ?></p>
				</div>
				<span class="au-cookie__always"><?php esc_html_e( 'Immer aktiv', 'aurelia' ); ?></span>
			</div>
			<div class="au-cookie__setting">
				<div>
					<span class="au-cookie__setting-label"><?php esc_html_e( 'Statistik', 'aurelia' ); ?></span>
					<p class="au-cookie__setting-desc"><?php esc_html_e( 'Hilft uns zu verstehen, wie die Website genutzt wird.', 'aurelia' ); ?></p>
				</div>
				<label class="au-check" aria-label="<?php esc_attr_e( 'Statistik-Cookies', 'aurelia' ); ?>">
					<input type="checkbox" data-category="statistics">
				</label>
			</div>
			<div class="au-cookie__setting">
				<div>
					<span class="au-cookie__setting-label"><?php esc_html_e( 'Marketing', 'aurelia' ); ?></span>
					<p class="au-cookie__setting-desc"><?php esc_html_e( 'Wird für personalisierte Inhalte und Anzeigen verwendet.', 'aurelia' ); ?></p>
				</div>
				<label class="au-check" aria-label="<?php esc_attr_e( 'Marketing-Cookies', 'aurelia' ); ?>">
					<input type="checkbox" data-category="marketing">
				</label>
			</div>
		</div>

		<div class="au-cookie__actions" style="justify-content:flex-end;margin-top:0.4rem">
			<button class="au-btn au-btn--secondary au-btn--sm" data-action="save" style="display:none"><?php esc_html_e( 'Auswahl speichern', 'aurelia' ); ?></button>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
