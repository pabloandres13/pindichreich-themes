<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="screen-reader-text" href="#cel-main"><?php esc_html_e( 'Skip to content', 'celestine' ); ?></a>

<header class="cel-header" id="cel-header" role="banner">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cel-header__brand" aria-label="<?php bloginfo( 'name' ); ?>">
		<?php cel_logo(); ?>
	</a>

	<nav class="cel-header__nav" aria-label="<?php esc_attr_e( 'Primary navigation', 'celestine' ); ?>">
		<?php
		wp_nav_menu( [
			'theme_location' => 'primary',
			'container'      => false,
			'menu_class'     => 'cel-header__menu',
			'fallback_cb'    => 'cel_fallback_nav',
			'depth'          => 1,
		] );
		?>
	</nav>

	<div class="cel-header__actions">
		<a href="<?php echo esc_url( cel_page_url( 'offerings' ) ); ?>" class="cel-btn cel-btn--primary cel-btn--sm">
			<?php esc_html_e( 'Book a Reading', 'celestine' ); ?>
			<span class="cel-glyph" aria-hidden="true">&#10022;</span>
		</a>
		<button
			id="cel-menu-toggle"
			class="cel-header__toggle"
			aria-controls="cel-mobile-nav"
			aria-expanded="false"
			aria-label="<?php esc_attr_e( 'Open menu', 'celestine' ); ?>"
		>
			<span data-icon="open" aria-hidden="true"><?php echo cel_icon( 'menu', 24 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<span data-icon="close" class="hidden" aria-hidden="true"><?php echo cel_icon( 'close', 24 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		</button>
	</div>
</header>

<nav class="cel-header__mobile" id="cel-mobile-nav" aria-label="<?php esc_attr_e( 'Mobile navigation', 'celestine' ); ?>">
	<?php
	wp_nav_menu( [
		'theme_location' => 'primary',
		'container'      => false,
		'menu_class'     => 'cel-header__mobile-menu',
		'fallback_cb'    => 'cel_fallback_nav',
		'depth'          => 1,
	] );
	?>
	<div class="cel-header__mobile-cta">
		<a href="<?php echo esc_url( cel_page_url( 'offerings' ) ); ?>" class="cel-btn cel-btn--primary cel-btn--full">
			<?php esc_html_e( 'Book a Reading', 'celestine' ); ?>
		</a>
	</div>
</nav>

<?php
/**
 * Fallback navigation when no menu is assigned yet.
 */
function cel_fallback_nav(): void {
	$pages = [
		home_url( '/' )      => __( 'Home', 'celestine' ),
		cel_page_url( 'offerings' ) => __( 'Offerings', 'celestine' ),
		cel_page_url( 'journal' )   => __( 'Journal', 'celestine' ),
		cel_page_url( 'about' )     => __( 'About', 'celestine' ),
	];
	echo '<ul class="cel-header__menu">';
	foreach ( $pages as $url => $label ) {
		$current = trailingslashit( (string) get_permalink() ) === trailingslashit( $url ) ? ' class="current"' : '';
		printf( '<li%s><a href="%s">%s</a></li>', $current, esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}
