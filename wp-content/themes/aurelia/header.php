<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="au-header" id="au-header" role="banner">
	<div class="au-header__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="au-header__logo" aria-label="<?php bloginfo( 'name' ); ?> — Startseite">
			<?php aurelia_logo(); ?>
		</a>

		<nav class="au-header__nav" id="au-primary-nav" aria-label="<?php esc_attr_e( 'Hauptnavigation', 'aurelia' ); ?>">
			<?php
			wp_nav_menu( [
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'fallback_cb'    => 'aurelia_fallback_nav',
			] );
			?>
		</nav>

		<div class="au-header__actions">
			<a href="<?php echo esc_url( aurelia_booking_url() ); ?>" class="au-btn au-btn--primary au-header__cta-desktop">
				<?php echo aurelia_icon( 'calendar-check', 17 ); // phpcs:ignore ?>
				<?php esc_html_e( 'Termin buchen', 'aurelia' ); ?>
			</a>
			<button
				id="au-menu-toggle"
				class="au-header__menu-toggle"
				aria-controls="au-mobile-nav"
				aria-expanded="false"
				aria-label="<?php esc_attr_e( 'Menü öffnen', 'aurelia' ); ?>"
			>
				<span data-icon="open" aria-hidden="true"><?php echo aurelia_icon( 'menu', 20 ); // phpcs:ignore ?></span>
				<span data-icon="close" class="hidden" aria-hidden="true"><?php echo aurelia_icon( 'close', 20 ); // phpcs:ignore ?></span>
			</button>
		</div>
	</div>

	<nav class="au-header__mobile-nav" id="au-mobile-nav" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'aurelia' ); ?>">
		<?php
		wp_nav_menu( [
			'theme_location' => 'primary',
			'container'      => false,
			'items_wrap'     => '%3$s',
			'fallback_cb'    => 'aurelia_fallback_nav',
		] );
		?>
		<div class="au-header__mobile-cta">
			<a href="<?php echo esc_url( aurelia_booking_url() ); ?>" class="au-btn au-btn--primary au-btn--full">
				<?php esc_html_e( 'Termin buchen', 'aurelia' ); ?>
			</a>
		</div>
	</nav>
</header>

<?php
/**
 * Fallback nav — used when no menu is assigned yet.
 */
function aurelia_fallback_nav(): void {
	$pages = [
		home_url( '/' )             => __( 'Startseite', 'aurelia' ),
		home_url( '/leistungen/' )  => __( 'Leistungen', 'aurelia' ),
		home_url( '/ueber-uns/' )   => __( 'Über uns', 'aurelia' ),
		home_url( '/magazin/' )     => __( 'Magazin', 'aurelia' ),
		home_url( '/kontakt/' )     => __( 'Kontakt', 'aurelia' ),
	];
	foreach ( $pages as $url => $label ) {
		$current = trailingslashit( get_permalink() ) === trailingslashit( $url ) ? ' class="current"' : '';
		printf( '<a href="%s"%s>%s</a>', esc_url( $url ), $current, esc_html( $label ) );
	}
}
