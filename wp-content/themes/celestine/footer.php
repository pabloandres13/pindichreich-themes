<?php defined( 'ABSPATH' ) || exit; ?>

<footer class="cel-footer" role="contentinfo">
	<div class="cel-footer__top">
		<div class="cel-footer__brand">
			<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/celestine-mark.svg' ); ?>" width="44" height="44" alt="<?php bloginfo( 'name' ); ?>" />
			<p class="cel-footer__tag"><?php echo esc_html( get_theme_mod( 'cel_tagline', __( 'Return to the stars within', 'celestine' ) ) ); ?></p>
		</div>

		<div class="cel-footer__col">
			<h4><?php esc_html_e( 'Offerings', 'celestine' ); ?></h4>
			<a href="<?php echo esc_url( cel_page_url( 'offerings' ) ); ?>"><?php esc_html_e( 'Astrology', 'celestine' ); ?></a>
			<a href="<?php echo esc_url( cel_page_url( 'offerings' ) ); ?>"><?php esc_html_e( 'Tarot', 'celestine' ); ?></a>
			<a href="<?php echo esc_url( cel_page_url( 'offerings' ) ); ?>"><?php esc_html_e( 'Meditation', 'celestine' ); ?></a>
			<a href="<?php echo esc_url( cel_page_url( 'offerings' ) ); ?>"><?php esc_html_e( 'Crystals &amp; ritual', 'celestine' ); ?></a>
		</div>

		<div class="cel-footer__col">
			<h4><?php esc_html_e( 'Explore', 'celestine' ); ?></h4>
			<a href="<?php echo esc_url( cel_page_url( 'journal' ) ); ?>"><?php esc_html_e( 'Journal', 'celestine' ); ?></a>
			<a href="<?php echo esc_url( cel_page_url( 'about' ) ); ?>"><?php esc_html_e( 'About', 'celestine' ); ?></a>
			<a href="<?php echo esc_url( cel_page_url( 'offerings' ) ); ?>"><?php esc_html_e( 'Book a reading', 'celestine' ); ?></a>
			<a href="<?php echo esc_url( cel_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact', 'celestine' ); ?></a>
		</div>

		<div class="cel-footer__col">
			<h4><?php esc_html_e( 'The Circle', 'celestine' ); ?></h4>
			<?php $ig = get_theme_mod( 'cel_instagram', '' ); ?>
			<?php if ( $ig ) : ?>
				<a href="<?php echo esc_url( $ig ); ?>" rel="noopener noreferrer"><?php esc_html_e( 'Instagram', 'celestine' ); ?></a>
			<?php endif; ?>
			<a href="<?php echo esc_url( cel_page_url( 'privacy' ) ); ?>"><?php esc_html_e( 'Privacy', 'celestine' ); ?></a>
			<a href="<?php echo esc_url( cel_page_url( 'imprint' ) ); ?>"><?php esc_html_e( 'Imprint', 'celestine' ); ?></a>
		</div>
	</div>

	<div class="cel-footer__rule" aria-hidden="true"></div>

	<div class="cel-footer__bottom">
		<span><?php echo esc_html( get_theme_mod( 'cel_copyright', '© ' . gmdate( 'Y' ) . ' ' . get_bloginfo( 'name' ) ) ); ?></span>
		<span class="cel-footer__social">
			<?php $email = get_theme_mod( 'cel_email', '' ); ?>
			<?php if ( $ig ) : ?>
				<a href="<?php echo esc_url( $ig ); ?>" aria-label="Instagram" rel="noopener noreferrer"><?php echo cel_icon( 'instagram', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
			<?php endif; ?>
			<?php if ( $email ) : ?>
				<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>" aria-label="<?php esc_attr_e( 'E-mail', 'celestine' ); ?>"><?php echo cel_icon( 'mail', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
			<?php endif; ?>
		</span>
	</div>
</footer>

<!-- Cookie banner (opt-in, consent stored locally) -->
<div id="cel-cookie-banner" class="cel-cookie" role="dialog" aria-modal="false" aria-labelledby="cel-cookie-title" hidden>
	<p class="cel-cookie__title" id="cel-cookie-title"><?php esc_html_e( 'A note on cookies', 'celestine' ); ?></p>
	<p class="cel-cookie__text">
		<?php
		printf(
			/* translators: %s: link to the privacy policy */
			esc_html__( 'We use essential cookies to keep this site working. See our %s for details.', 'celestine' ),
			'<a href="' . esc_url( cel_page_url( 'privacy' ) ) . '">' . esc_html__( 'privacy policy', 'celestine' ) . '</a>'
		);
		?>
	</p>
	<div class="cel-cookie__actions">
		<button class="cel-btn cel-btn--primary cel-btn--sm" data-action="accept"><?php esc_html_e( 'Accept', 'celestine' ); ?></button>
		<button class="cel-btn cel-btn--secondary cel-btn--sm" data-action="reject"><?php esc_html_e( 'Decline', 'celestine' ); ?></button>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
