<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/favicon.svg' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="mc-header" id="mc-header" role="banner">

	<?php
	$mc_announce = get_theme_mod( 'mc_announce_text', __( 'Free guide — The Calm Operator’s Playbook: 7 rituals for leading under pressure.', 'maren-cole' ) );
	if ( $mc_announce ) :
		$mc_announce_url = get_theme_mod( 'mc_announce_url', '' );
		?>
		<div class="mc-announce">
			<div class="mc-announce__inner mc-container--wide">
				<?php echo mc_icon( 'sparkle', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span><?php echo wp_kses_post( $mc_announce ); ?></span>
				<?php if ( $mc_announce_url ) : ?>
					<a class="mc-announce__cta" href="<?php echo esc_url( $mc_announce_url ); ?>">
						<?php esc_html_e( 'Get it free', 'maren-cole' ); ?> <?php echo mc_icon( 'arrow-right', 15 ); // phpcs:ignore ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="mc-header__bar">
		<div class="mc-header__inner mc-container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mc-header__logo" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> — <?php esc_attr_e( 'Home', 'maren-cole' ); ?>">
				<?php mc_logo(); ?>
			</a>

			<nav class="mc-header__nav" aria-label="<?php esc_attr_e( 'Primary', 'maren-cole' ); ?>">
				<?php
				wp_nav_menu( [
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '%3$s',
					'fallback_cb'    => 'mc_fallback_nav',
				] );
				?>
			</nav>

			<div class="mc-header__cta">
				<a href="<?php echo mc_booking_url(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" class="mc-btn mc-btn--primary mc-btn--md">
					<?php esc_html_e( 'Book a call', 'maren-cole' ); ?> <?php echo mc_icon( 'arrow-right', 17 ); // phpcs:ignore ?>
				</a>
			</div>

			<button id="mc-menu-toggle" class="mc-header__toggle" aria-controls="mc-mobile-nav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open menu', 'maren-cole' ); ?>">
				<span data-icon="open" aria-hidden="true"><?php echo mc_icon( 'menu', 26 ); // phpcs:ignore ?></span>
				<span data-icon="close" class="hidden" aria-hidden="true"><?php echo mc_icon( 'close', 26 ); // phpcs:ignore ?></span>
			</button>
		</div>

		<nav class="mc-header__mobile" id="mc-mobile-nav" aria-label="<?php esc_attr_e( 'Mobile', 'maren-cole' ); ?>">
			<?php
			wp_nav_menu( [
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'fallback_cb'    => 'mc_fallback_nav',
			] );
			?>
			<div class="mc-header__mobile-cta">
				<a href="<?php echo mc_booking_url(); // phpcs:ignore ?>" class="mc-btn mc-btn--primary mc-btn--full">
					<?php esc_html_e( 'Book a discovery call', 'maren-cole' ); ?>
				</a>
			</div>
		</nav>
	</div>
</header>
