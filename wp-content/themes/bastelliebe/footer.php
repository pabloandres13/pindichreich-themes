<footer class="bl-footer" role="contentinfo">
	<div class="bl-footer__inner">
		<div class="bl-footer__grid">

			<!-- Brand column -->
			<div>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bl-header__logo" aria-label="<?php bloginfo( 'name' ); ?>">
					<?php bl_logo( true ); ?>
				</a>
				<p class="bl-footer__tagline">
					<?php echo esc_html( get_theme_mod( 'bl_tagline_footer', __( 'Kreative DIY-Anleitungen zum Nachmachen – einfach erklärt, mit Liebe gemacht.', 'bastelliebe' ) ) ); ?>
				</p>
				<div class="bl-footer__social">
					<?php $pin = get_theme_mod( 'bl_pinterest', '#' ); ?>
					<a href="<?php echo esc_url( $pin ); ?>" class="bl-iconbtn" aria-label="Pinterest" rel="noopener noreferrer"><?php echo bl_icon( 'pinterest', 18 ); // phpcs:ignore ?></a>
					<?php $ig = get_theme_mod( 'bl_instagram', '#' ); ?>
					<a href="<?php echo esc_url( $ig ); ?>" class="bl-iconbtn" aria-label="Instagram" rel="noopener noreferrer"><?php echo bl_icon( 'instagram', 18 ); // phpcs:ignore ?></a>
					<?php $email = get_theme_mod( 'bl_email', '#' ); ?>
					<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>" class="bl-iconbtn" aria-label="E-Mail"><?php echo bl_icon( 'mail', 18 ); // phpcs:ignore ?></a>
				</div>
			</div>

			<!-- Kategorien -->
			<div>
				<div class="bl-footer__col-title"><?php esc_html_e( 'Kategorien', 'bastelliebe' ); ?></div>
				<?php foreach ( bl_categories() as $key => $meta ) : ?>
					<a class="bl-footer__link" href="<?php echo esc_url( home_url( '/anleitungen/' ) ); ?>"><?php echo esc_html( $meta['label'] ); ?></a>
				<?php endforeach; ?>
			</div>

			<!-- Entdecken -->
			<div>
				<div class="bl-footer__col-title"><?php esc_html_e( 'Entdecken', 'bastelliebe' ); ?></div>
				<a class="bl-footer__link" href="<?php echo esc_url( home_url( '/anleitungen/' ) ); ?>"><?php esc_html_e( 'Alle Anleitungen', 'bastelliebe' ); ?></a>
				<a class="bl-footer__link" href="<?php echo esc_url( home_url( '/anleitungen/' ) ); ?>"><?php esc_html_e( 'Für Einsteiger', 'bastelliebe' ); ?></a>
				<a class="bl-footer__link" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><?php esc_html_e( 'Shop', 'bastelliebe' ); ?></a>
				<a class="bl-footer__link" href="<?php echo esc_url( home_url( '/ueber-mich/' ) ); ?>"><?php esc_html_e( 'Über mich', 'bastelliebe' ); ?></a>
				<a class="bl-footer__link" href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Kontakt', 'bastelliebe' ); ?></a>
			</div>

			<!-- Rechtliches -->
			<div>
				<div class="bl-footer__col-title"><?php esc_html_e( 'Rechtliches', 'bastelliebe' ); ?></div>
				<a class="bl-footer__link" href="<?php echo esc_url( home_url( '/impressum/' ) ); ?>"><?php esc_html_e( 'Impressum', 'bastelliebe' ); ?></a>
				<a class="bl-footer__link" href="<?php echo esc_url( home_url( '/datenschutz/' ) ); ?>"><?php esc_html_e( 'Datenschutzerklärung', 'bastelliebe' ); ?></a>
				<button class="bl-footer__link" data-action="cookie-settings" style="text-align:left"><?php esc_html_e( 'Cookie-Einstellungen', 'bastelliebe' ); ?></button>
			</div>

		</div><!-- .bl-footer__grid -->

		<div class="bl-footer__legal">
			<span class="bl-footer__copyright">
				<?php echo esc_html( get_theme_mod( 'bl_copyright', '© ' . gmdate( 'Y' ) . ' Bastelliebe · Mit ♥ in Deutschland gemacht' ) ); ?>
			</span>
			<div class="bl-footer__legal-links">
				<a class="bl-footer__legal-link" href="<?php echo esc_url( home_url( '/impressum/' ) ); ?>"><?php esc_html_e( 'Impressum', 'bastelliebe' ); ?></a>
				<a class="bl-footer__legal-link" href="<?php echo esc_url( home_url( '/datenschutz/' ) ); ?>"><?php esc_html_e( 'Datenschutz', 'bastelliebe' ); ?></a>
				<button class="bl-footer__legal-link" data-action="cookie-settings"><?php esc_html_e( 'Cookie-Einstellungen', 'bastelliebe' ); ?></button>
			</div>
		</div>
	</div>
</footer>

<!-- Cookie Banner (DSGVO, opt-in) -->
<div id="bl-cookie-banner" class="bl-cookie" role="dialog" aria-modal="true" aria-labelledby="bl-cookie-title" hidden>
	<p class="bl-cookie__title" id="bl-cookie-title"><?php esc_html_e( 'Cookies & Datenschutz', 'bastelliebe' ); ?></p>
	<p class="bl-cookie__text">
		<?php
		printf(
			/* translators: %s: link to Datenschutzerklärung */
			esc_html__( 'Ich nutze Cookies, um dir das beste Erlebnis zu bieten. Mehr dazu in meiner %s.', 'bastelliebe' ),
			'<a href="' . esc_url( home_url( '/datenschutz/' ) ) . '">' . esc_html__( 'Datenschutzerklärung', 'bastelliebe' ) . '</a>'
		);
		?>
	</p>

	<div class="bl-cookie__settings">
		<div class="bl-cookie__setting">
			<div>
				<div class="bl-cookie__setting-label"><?php esc_html_e( 'Notwendig', 'bastelliebe' ); ?></div>
				<div class="bl-cookie__setting-desc"><?php esc_html_e( 'Technisch erforderlich — immer aktiv.', 'bastelliebe' ); ?></div>
			</div>
			<button class="bl-cookie__toggle is-on" disabled aria-label="<?php esc_attr_e( 'Notwendig (immer aktiv)', 'bastelliebe' ); ?>"></button>
		</div>
		<div class="bl-cookie__setting">
			<div>
				<div class="bl-cookie__setting-label"><?php esc_html_e( 'Statistik', 'bastelliebe' ); ?></div>
				<div class="bl-cookie__setting-desc"><?php esc_html_e( 'Anonyme Nutzungsanalyse.', 'bastelliebe' ); ?></div>
			</div>
			<button class="bl-cookie__toggle" data-category="statistics" aria-label="<?php esc_attr_e( 'Statistik-Cookies', 'bastelliebe' ); ?>"></button>
		</div>
		<div class="bl-cookie__setting">
			<div>
				<div class="bl-cookie__setting-label"><?php esc_html_e( 'Marketing', 'bastelliebe' ); ?></div>
				<div class="bl-cookie__setting-desc"><?php esc_html_e( 'Personalisierte Inhalte und Werbung.', 'bastelliebe' ); ?></div>
			</div>
			<button class="bl-cookie__toggle" data-category="marketing" aria-label="<?php esc_attr_e( 'Marketing-Cookies', 'bastelliebe' ); ?>"></button>
		</div>
	</div>

	<div class="bl-cookie__actions">
		<button class="bl-btn bl-btn--primary bl-btn--sm" data-action="accept"><?php esc_html_e( 'Akzeptieren', 'bastelliebe' ); ?></button>
		<button class="bl-btn bl-btn--secondary bl-btn--sm" data-action="reject"><?php esc_html_e( 'Ablehnen', 'bastelliebe' ); ?></button>
		<button class="bl-btn bl-btn--ghost bl-btn--sm" data-action="save" style="display:none"><?php esc_html_e( 'Auswahl speichern', 'bastelliebe' ); ?></button>
		<button class="bl-cookie__toggle-settings" data-action="settings"><?php esc_html_e( 'Einstellungen', 'bastelliebe' ); ?></button>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
