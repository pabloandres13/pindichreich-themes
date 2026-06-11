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

<header class="bm-header" id="bm-header" role="banner">
	<div class="bm-header__inner bm-container--wide">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bm-header__logo" aria-label="<?php bloginfo( 'name' ); ?> — Startseite">
			<?php bm_logo(); ?>
		</a>

		<nav class="bm-header__nav" id="bm-primary-nav" aria-label="<?php esc_attr_e( 'Hauptnavigation', 'body-and-mind' ); ?>">
			<?php
			wp_nav_menu( [
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'fallback_cb'    => 'bm_fallback_nav',
			] );
			?>
		</nav>

		<div class="bm-header__cta">
			<a href="<?php echo esc_url( get_page_link( get_page_by_path( 'kontakt' ) ) ?: home_url( '/kontakt/' ) ); ?>" class="bm-btn bm-btn--primary">
				<?php esc_html_e( 'Probestunde buchen', 'body-and-mind' ); ?>
			</a>
		</div>

		<button
			id="bm-menu-toggle"
			class="bm-header__menu-toggle"
			aria-controls="bm-mobile-nav"
			aria-expanded="false"
			aria-label="<?php esc_attr_e( 'Menü öffnen', 'body-and-mind' ); ?>"
		>
			<span data-icon="open" aria-hidden="true"><?php echo bm_icon( 'menu', 22 ); // phpcs:ignore ?></span>
			<span data-icon="close" class="hidden" aria-hidden="true"><?php echo bm_icon( 'close', 22 ); // phpcs:ignore ?></span>
		</button>
	</div>

	<nav class="bm-header__mobile-nav" id="bm-mobile-nav" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'body-and-mind' ); ?>">
		<?php
		wp_nav_menu( [
			'theme_location' => 'primary',
			'container'      => false,
			'items_wrap'     => '%3$s',
			'fallback_cb'    => 'bm_fallback_nav',
		] );
		?>
		<div class="bm-header__mobile-cta">
			<a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="bm-btn bm-btn--primary bm-btn--full">
				<?php esc_html_e( 'Probestunde buchen', 'body-and-mind' ); ?>
			</a>
		</div>
	</nav>
</header>

<?php
/**
 * Fallback nav — used when no menu is assigned yet.
 */
function bm_fallback_nav(): void {
	$pages = [
		home_url( '/' )           => __( 'Startseite', 'body-and-mind' ),
		home_url( '/kurse/' )     => __( 'Kurse', 'body-and-mind' ),
		home_url( '/stundenplan/' ) => __( 'Stundenplan', 'body-and-mind' ),
		home_url( '/kontakt/' )   => __( 'Kontakt', 'body-and-mind' ),
	];
	foreach ( $pages as $url => $label ) {
		$current = trailingslashit( get_permalink() ) === trailingslashit( $url ) ? ' class="current"' : '';
		printf( '<a href="%s"%s>%s</a>', esc_url( $url ), $current, esc_html( $label ) );
	}
}
