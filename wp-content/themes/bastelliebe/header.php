<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="bl-header" id="bl-header" role="banner">
	<div class="bl-header__inner bl-container">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bl-header__logo" aria-label="<?php bloginfo( 'name' ); ?> — Startseite">
			<?php bl_logo(); ?>
		</a>

		<nav class="bl-header__nav" aria-label="<?php esc_attr_e( 'Hauptnavigation', 'bastelliebe' ); ?>">
			<?php
			wp_nav_menu( [
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'fallback_cb'    => 'bl_fallback_nav',
			] );
			?>
		</nav>

		<div class="bl-header__actions">
			<?php $ig = get_theme_mod( 'bl_instagram', '#' ); ?>
			<?php $pin = get_theme_mod( 'bl_pinterest', '#' ); ?>
			<a href="<?php echo esc_url( $pin ); ?>" class="bl-iconbtn" aria-label="Pinterest" rel="noopener noreferrer"><?php echo bl_icon( 'pinterest', 20 ); // phpcs:ignore ?></a>
			<a href="<?php echo esc_url( $ig ); ?>" class="bl-iconbtn" aria-label="Instagram" rel="noopener noreferrer"><?php echo bl_icon( 'instagram', 20 ); // phpcs:ignore ?></a>
			<a href="<?php echo esc_url( bl_newsletter_anchor() ); ?>" class="bl-btn bl-btn--primary bl-btn--sm"><?php echo bl_icon( 'mail', 18 ); // phpcs:ignore ?><?php esc_html_e( 'Newsletter', 'bastelliebe' ); ?></a>
		</div>

		<button id="bl-menu-toggle" class="bl-header__menu-toggle" aria-controls="bl-mobile-nav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Menü öffnen', 'bastelliebe' ); ?>">
			<span data-icon="open" aria-hidden="true"><?php echo bl_icon( 'menu', 24 ); // phpcs:ignore ?></span>
			<span data-icon="close" class="hidden" aria-hidden="true"><?php echo bl_icon( 'close', 24 ); // phpcs:ignore ?></span>
		</button>
	</div>

	<nav class="bl-header__mobile-nav" id="bl-mobile-nav" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'bastelliebe' ); ?>">
		<?php
		wp_nav_menu( [
			'theme_location' => 'primary',
			'container'      => false,
			'items_wrap'     => '%3$s',
			'fallback_cb'    => 'bl_fallback_nav',
		] );
		?>
		<div class="bl-header__mobile-cta">
			<a href="<?php echo esc_url( bl_newsletter_anchor() ); ?>" class="bl-btn bl-btn--primary bl-btn--full"><?php esc_html_e( 'Newsletter abonnieren', 'bastelliebe' ); ?></a>
		</div>
	</nav>
</header>

<?php
/**
 * Newsletter anchor target — Customizer URL or the homepage #newsletter section.
 */
function bl_newsletter_anchor(): string {
	$url = get_theme_mod( 'bl_newsletter_url', '' );
	return $url && '#' !== $url ? $url : home_url( '/#newsletter' );
}

/**
 * Fallback nav — used when no menu is assigned yet.
 */
function bl_fallback_nav(): void {
	$items = [
		home_url( '/' )            => __( 'Startseite', 'bastelliebe' ),
		home_url( '/anleitungen/' ) => __( 'Anleitungen', 'bastelliebe' ),
		home_url( '/shop/' )       => __( 'Shop', 'bastelliebe' ),
		home_url( '/ueber-mich/' ) => __( 'Über mich', 'bastelliebe' ),
		home_url( '/kontakt/' )    => __( 'Kontakt', 'bastelliebe' ),
	];
	foreach ( $items as $url => $label ) {
		$current = trailingslashit( get_permalink() ) === trailingslashit( $url ) ? ' class="current"' : '';
		printf( '<a href="%s"%s>%s</a>', esc_url( $url ), $current, esc_html( $label ) );
	}
}
