<?php
/**
 * Footer + DSGVO-style cookie banner.
 *
 * @package maren-cole
 */

defined( 'ABSPATH' ) || exit;

$mc_brand   = get_theme_mod( 'mc_brand_name', get_bloginfo( 'name' ) ?: 'Maren Cole' );
$mc_tagline = get_theme_mod( 'mc_footer_tagline', __( 'Executive & leadership coaching for people who carry a lot — and want to keep their edge.', 'maren-cole' ) );
$mc_ig      = get_theme_mod( 'mc_instagram', '' );
$mc_li      = get_theme_mod( 'mc_linkedin', '' );
$mc_yt      = get_theme_mod( 'mc_youtube', '' );
$mc_copy    = get_theme_mod( 'mc_copyright', '© ' . gmdate( 'Y' ) . ' ' . $mc_brand );
?>

<footer class="mc-footer" role="contentinfo">
	<div class="mc-container mc-footer__inner">
		<div class="mc-footer__grid">

			<div>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mc-footer__brand-logo">
					<?php echo mc_mark( 26 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span class="mc-footer__wordmark"><?php echo esc_html( $mc_brand ); ?></span>
				</a>
				<p class="mc-footer__tagline"><?php echo esc_html( $mc_tagline ); ?></p>
				<div class="mc-footer__social">
					<?php if ( $mc_ig ) : ?>
						<a href="<?php echo esc_url( $mc_ig ); ?>" aria-label="Instagram" rel="noopener noreferrer"><?php echo mc_icon( 'instagram', 18 ); // phpcs:ignore ?></a>
					<?php endif; ?>
					<?php if ( $mc_li ) : ?>
						<a href="<?php echo esc_url( $mc_li ); ?>" aria-label="LinkedIn" rel="noopener noreferrer"><?php echo mc_icon( 'linkedin', 18 ); // phpcs:ignore ?></a>
					<?php endif; ?>
					<?php if ( $mc_yt ) : ?>
						<a href="<?php echo esc_url( $mc_yt ); ?>" aria-label="YouTube" rel="noopener noreferrer"><?php echo mc_icon( 'youtube', 18 ); // phpcs:ignore ?></a>
					<?php endif; ?>
				</div>
			</div>

			<div>
				<div class="mc-footer__col-title"><?php esc_html_e( 'Explore', 'maren-cole' ); ?></div>
				<ul class="mc-footer__links">
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'maren-cole' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Work With Me', 'maren-cole' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/success-stories/' ) ); ?>"><?php esc_html_e( 'Success Stories', 'maren-cole' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/resources/' ) ); ?>"><?php esc_html_e( 'Resources', 'maren-cole' ); ?></a></li>
				</ul>
			</div>

			<div>
				<div class="mc-footer__col-title"><?php esc_html_e( 'Programs', 'maren-cole' ); ?></div>
				<ul class="mc-footer__links">
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( '1:1 Coaching', 'maren-cole' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Leadership Intensive', 'maren-cole' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'The Course', 'maren-cole' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'For Teams', 'maren-cole' ); ?></a></li>
				</ul>
			</div>

			<div>
				<div class="mc-footer__col-title"><?php esc_html_e( 'Connect', 'maren-cole' ); ?></div>
				<ul class="mc-footer__links">
					<li><a href="<?php echo mc_booking_url(); // phpcs:ignore ?>"><?php esc_html_e( 'Book a call', 'maren-cole' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'maren-cole' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/speaking/' ) ); ?>"><?php esc_html_e( 'Speaking', 'maren-cole' ); ?></a></li>
				</ul>
			</div>

		</div>

		<div class="mc-footer__rule"></div>

		<div class="mc-footer__legal">
			<span><?php echo esc_html( $mc_copy ); ?></span>
			<div class="mc-footer__legal-links">
				<a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>"><?php esc_html_e( 'Privacy', 'maren-cole' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms', 'maren-cole' ); ?></a>
				<button type="button" data-action="cookie-settings"><?php esc_html_e( 'Cookie settings', 'maren-cole' ); ?></button>
			</div>
		</div>
	</div>
</footer>

<!-- Cookie banner (opt-in) -->
<div id="mc-cookie-banner" class="mc-cookie" role="dialog" aria-modal="true" aria-labelledby="mc-cookie-title" hidden>
	<p class="mc-cookie__title" id="mc-cookie-title"><?php esc_html_e( 'Cookies & privacy', 'maren-cole' ); ?></p>
	<p class="mc-cookie__text">
		<?php
		printf(
			/* translators: %s: link to the privacy policy */
			esc_html__( 'We use cookies to give you the best experience. Read more in our %s.', 'maren-cole' ),
			'<a href="' . esc_url( home_url( '/privacy/' ) ) . '">' . esc_html__( 'privacy policy', 'maren-cole' ) . '</a>'
		);
		?>
	</p>

	<div class="mc-cookie__settings">
		<div class="mc-cookie__setting">
			<div>
				<div class="mc-cookie__setting-label"><?php esc_html_e( 'Necessary', 'maren-cole' ); ?></div>
				<div class="mc-cookie__setting-desc"><?php esc_html_e( 'Required for the site to work — always on.', 'maren-cole' ); ?></div>
			</div>
			<button type="button" class="mc-cookie__toggle is-on" disabled aria-label="<?php esc_attr_e( 'Necessary (always on)', 'maren-cole' ); ?>"></button>
		</div>
		<div class="mc-cookie__setting">
			<div>
				<div class="mc-cookie__setting-label"><?php esc_html_e( 'Analytics', 'maren-cole' ); ?></div>
				<div class="mc-cookie__setting-desc"><?php esc_html_e( 'Anonymous usage statistics.', 'maren-cole' ); ?></div>
			</div>
			<button type="button" class="mc-cookie__toggle" data-category="statistics" aria-label="<?php esc_attr_e( 'Analytics cookies', 'maren-cole' ); ?>"></button>
		</div>
		<div class="mc-cookie__setting">
			<div>
				<div class="mc-cookie__setting-label"><?php esc_html_e( 'Marketing', 'maren-cole' ); ?></div>
				<div class="mc-cookie__setting-desc"><?php esc_html_e( 'Personalised content and ads.', 'maren-cole' ); ?></div>
			</div>
			<button type="button" class="mc-cookie__toggle" data-category="marketing" aria-label="<?php esc_attr_e( 'Marketing cookies', 'maren-cole' ); ?>"></button>
		</div>
	</div>

	<div class="mc-cookie__actions">
		<button type="button" class="mc-btn mc-btn--primary mc-btn--sm" data-action="accept"><?php esc_html_e( 'Accept', 'maren-cole' ); ?></button>
		<button type="button" class="mc-btn mc-btn--secondary mc-btn--sm" data-action="reject"><?php esc_html_e( 'Reject', 'maren-cole' ); ?></button>
		<button type="button" class="mc-btn mc-btn--ghost mc-btn--sm" data-action="save" style="display:none"><?php esc_html_e( 'Save choices', 'maren-cole' ); ?></button>
		<button type="button" class="mc-cookie__settings-toggle" data-action="settings"><?php esc_html_e( 'Settings', 'maren-cole' ); ?></button>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
