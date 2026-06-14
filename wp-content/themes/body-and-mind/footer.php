<footer class="bm-footer" role="contentinfo">
	<div class="bm-footer__inner">
		<div class="bm-footer__grid">

			<!-- Brand column -->
			<div>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bm-header__logo" aria-label="<?php bloginfo( 'name' ); ?>" style="filter:brightness(10)">
					<?php bm_logo( true ); ?>
				</a>
				<p class="bm-footer__tagline">
					<?php echo esc_html( get_theme_mod( 'bm_studio_tagline_footer', __( 'Ein heller Ort für Yoga, Meditation und Personal Training.', 'body-and-mind' ) ) ); ?>
				</p>
				<div class="bm-footer__social">
					<?php $ig = get_theme_mod( 'bm_studio_instagram', '#' ); ?>
					<a href="<?php echo esc_url( $ig ); ?>" class="bm-footer__social-link" aria-label="Instagram" rel="noopener noreferrer">
						<?php echo bm_icon( 'instagram', 18 ); // phpcs:ignore ?>
					</a>
					<?php $email = get_theme_mod( 'bm_studio_email', '#' ); ?>
					<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>" class="bm-footer__social-link" aria-label="E-Mail">
						<?php echo bm_icon( 'mail', 18 ); // phpcs:ignore ?>
					</a>
				</div>
			</div>

			<!-- Kurse -->
			<div>
				<div class="bm-footer__col-title"><?php esc_html_e( 'Kurse', 'body-and-mind' ); ?></div>
				<a class="bm-footer__link" href="<?php echo esc_url( home_url( '/kurse/' ) ); ?>"><?php esc_html_e( 'Hatha Yoga', 'body-and-mind' ); ?></a>
				<a class="bm-footer__link" href="<?php echo esc_url( home_url( '/kurse/' ) ); ?>"><?php esc_html_e( 'Vinyasa Flow', 'body-and-mind' ); ?></a>
				<a class="bm-footer__link" href="<?php echo esc_url( home_url( '/kurse/' ) ); ?>"><?php esc_html_e( 'Meditation', 'body-and-mind' ); ?></a>
				<a class="bm-footer__link" href="<?php echo esc_url( home_url( '/kurse/' ) ); ?>"><?php esc_html_e( 'Personal Training', 'body-and-mind' ); ?></a>
			</div>

			<!-- Studio -->
			<div>
				<div class="bm-footer__col-title"><?php esc_html_e( 'Studio', 'body-and-mind' ); ?></div>
				<a class="bm-footer__link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Über mich', 'body-and-mind' ); ?></a>
				<a class="bm-footer__link" href="<?php echo esc_url( home_url( '/stundenplan/' ) ); ?>"><?php esc_html_e( 'Stundenplan', 'body-and-mind' ); ?></a>
				<a class="bm-footer__link" href="<?php echo esc_url( home_url( '/preise/' ) ); ?>"><?php esc_html_e( 'Preise', 'body-and-mind' ); ?></a>
				<a class="bm-footer__link" href="<?php echo esc_url( home_url( '/magazin/' ) ); ?>"><?php esc_html_e( 'Magazin', 'body-and-mind' ); ?></a>
			</div>

			<!-- Kontakt -->
			<div>
				<div class="bm-footer__col-title"><?php esc_html_e( 'Kontakt', 'body-and-mind' ); ?></div>
				<a class="bm-footer__link" href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Probestunde buchen', 'body-and-mind' ); ?></a>
				<a class="bm-footer__link" href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>"><?php esc_html_e( 'Termin vereinbaren', 'body-and-mind' ); ?></a>
			</div>

		</div><!-- .bm-footer__grid -->

		<div class="bm-footer__legal">
			<span class="bm-footer__copyright">
				<?php echo esc_html( get_theme_mod( 'bm_studio_copyright', '© ' . date( 'Y' ) . ' Lichtraum Studio' ) ); ?>
			</span>
			<div class="bm-footer__legal-links">
				<a class="bm-footer__legal-link" href="<?php echo esc_url( home_url( '/impressum/' ) ); ?>"><?php esc_html_e( 'Impressum', 'body-and-mind' ); ?></a>
				<a class="bm-footer__legal-link" href="<?php echo esc_url( home_url( '/datenschutz/' ) ); ?>"><?php esc_html_e( 'Datenschutzerklärung', 'body-and-mind' ); ?></a>
				<button class="bm-footer__legal-link" data-action="cookie-settings" style="background:none;border:none;padding:0;cursor:pointer;font-family:inherit;font-size:inherit;"><?php esc_html_e( 'Cookie-Einstellungen', 'body-and-mind' ); ?></button>
			</div>
		</div>
	</div>
</footer>

<!-- Cookie Banner (DSGVO-compliant, opt-in) -->
<div id="bm-cookie-banner" class="bm-cookie" role="dialog" aria-modal="true" aria-labelledby="bm-cookie-title" hidden>
	<p class="bm-cookie__title" id="bm-cookie-title"><?php esc_html_e( 'Cookies & Datenschutz', 'body-and-mind' ); ?></p>
	<p class="bm-cookie__text">
		<?php
		printf(
			/* translators: %s: link to Datenschutzerklärung */
			esc_html__( 'Wir nutzen Cookies, um dir das beste Erlebnis zu bieten. Mehr dazu in unserer %s.', 'body-and-mind' ),
			'<a href="' . esc_url( home_url( '/datenschutz/' ) ) . '" style="color:var(--accent-text)">' . esc_html__( 'Datenschutzerklärung', 'body-and-mind' ) . '</a>'
		);
		?>
	</p>

	<div class="bm-cookie__settings">
		<div class="bm-cookie__setting">
			<div class="bm-cookie__setting-info">
				<div class="bm-cookie__setting-label"><?php esc_html_e( 'Notwendig', 'body-and-mind' ); ?></div>
				<div class="bm-cookie__setting-desc"><?php esc_html_e( 'Technisch erforderlich — immer aktiv.', 'body-and-mind' ); ?></div>
			</div>
			<button class="bm-cookie__toggle is-on" disabled aria-label="<?php esc_attr_e( 'Notwendig (immer aktiv)', 'body-and-mind' ); ?>"></button>
		</div>
		<div class="bm-cookie__setting">
			<div class="bm-cookie__setting-info">
				<div class="bm-cookie__setting-label"><?php esc_html_e( 'Statistik', 'body-and-mind' ); ?></div>
				<div class="bm-cookie__setting-desc"><?php esc_html_e( 'Anonyme Nutzungsanalyse (z.B. Matomo).', 'body-and-mind' ); ?></div>
			</div>
			<button class="bm-cookie__toggle" data-category="statistics" aria-label="<?php esc_attr_e( 'Statistik-Cookies', 'body-and-mind' ); ?>"></button>
		</div>
		<div class="bm-cookie__setting">
			<div class="bm-cookie__setting-info">
				<div class="bm-cookie__setting-label"><?php esc_html_e( 'Marketing', 'body-and-mind' ); ?></div>
				<div class="bm-cookie__setting-desc"><?php esc_html_e( 'Personalisierte Inhalte und Werbung.', 'body-and-mind' ); ?></div>
			</div>
			<button class="bm-cookie__toggle" data-category="marketing" aria-label="<?php esc_attr_e( 'Marketing-Cookies', 'body-and-mind' ); ?>"></button>
		</div>
	</div>

	<div class="bm-cookie__actions">
		<button class="bm-btn bm-btn--primary bm-btn--sm" data-action="accept"><?php esc_html_e( 'Akzeptieren', 'body-and-mind' ); ?></button>
		<button class="bm-btn bm-btn--secondary bm-btn--sm" data-action="reject"><?php esc_html_e( 'Ablehnen', 'body-and-mind' ); ?></button>
		<button class="bm-btn bm-btn--ghost bm-btn--sm" data-action="save" style="display:none"><?php esc_html_e( 'Auswahl speichern', 'body-and-mind' ); ?></button>
		<button class="bm-cookie__toggle-settings" data-action="settings"><?php esc_html_e( 'Einstellungen', 'body-and-mind' ); ?></button>
	</div>

	<script>
	(function(){
		var s = document.querySelector('[data-action="settings"]');
		var p = document.querySelector('.bm-cookie__settings');
		var save = document.querySelector('[data-action="save"]');
		if(s && p && save) {
			s.addEventListener('click', function(){
				var open = p.classList.toggle('is-open');
				save.style.display = open ? '' : 'none';
			});
		}
	})();
	</script>
</div>

<?php wp_footer(); ?>
</body>
</html>
