<?php
/**
 * Maren Cole — theme bootstrap.
 *
 * @package maren-cole
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   Enqueue styles + scripts
   ============================================================ */
function mc_enqueue_assets(): void {
	wp_enqueue_style(
		'astra-theme-css',
		get_template_directory_uri() . '/style.css',
		[],
		wp_get_theme( 'astra' )->get( 'Version' )
	);

	// Design tokens (CSS custom properties + self-hosted fonts).
	wp_enqueue_style(
		'mc-tokens',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[ 'astra-theme-css' ],
		wp_get_theme()->get( 'Version' )
	);

	// Component + layout styles.
	wp_enqueue_style(
		'mc-theme',
		get_stylesheet_directory_uri() . '/assets/css/theme.css',
		[ 'mc-tokens' ],
		wp_get_theme()->get( 'Version' )
	);

	// Customizer colour overrides (inline, after tokens).
	mc_output_custom_colors();

	// Theme JS.
	wp_enqueue_script(
		'mc-theme',
		get_stylesheet_directory_uri() . '/assets/js/theme.js',
		[],
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'mc_enqueue_assets' );

/* ---- Block editor styles ---- */
function mc_enqueue_editor_assets(): void {
	wp_enqueue_style(
		'mc-tokens-editor',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'enqueue_block_editor_assets', 'mc_enqueue_editor_assets' );

/* ============================================================
   Theme supports
   ============================================================ */
function mc_theme_setup(): void {
	load_theme_textdomain( 'maren-cole', get_stylesheet_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ] );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	add_theme_support( 'custom-logo', [
		'height'      => 60,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	] );

	register_nav_menus( [
		'primary' => __( 'Primary Menu', 'maren-cole' ),
		'footer'  => __( 'Footer Menu', 'maren-cole' ),
	] );

	add_theme_support( 'editor-color-palette', [
		[ 'name' => __( 'Clay', 'maren-cole' ),       'slug' => 'clay',   'color' => '#C0613D' ],
		[ 'name' => __( 'Clay soft', 'maren-cole' ),  'slug' => 'clay-soft', 'color' => '#FBEEE6' ],
		[ 'name' => __( 'Cream', 'maren-cole' ),      'slug' => 'cream',  'color' => '#FBF8F4' ],
		[ 'name' => __( 'Sunken', 'maren-cole' ),     'slug' => 'sunken', 'color' => '#F5EFE7' ],
		[ 'name' => __( 'White', 'maren-cole' ),      'slug' => 'white',  'color' => '#FFFFFF' ],
		[ 'name' => __( 'Ink', 'maren-cole' ),        'slug' => 'ink',    'color' => '#1A1610' ],
		[ 'name' => __( 'Forest', 'maren-cole' ),     'slug' => 'forest', 'color' => '#25302A' ],
	] );

	add_theme_support( 'editor-font-sizes', [
		[ 'name' => __( 'Small', 'maren-cole' ),  'slug' => 'small',  'size' => 15 ],
		[ 'name' => __( 'Normal', 'maren-cole' ), 'slug' => 'normal', 'size' => 17 ],
		[ 'name' => __( 'Large', 'maren-cole' ),  'slug' => 'large',  'size' => 22 ],
		[ 'name' => __( 'XL', 'maren-cole' ),     'slug' => 'xl',     'size' => 35 ],
	] );

	add_theme_support( 'editor-styles' );
	add_editor_style( [
		'assets/css/tokens.css',
		'assets/css/theme.css',
		'assets/css/editor.css',
	] );
}
add_action( 'after_setup_theme', 'mc_theme_setup' );

/* ============================================================
   Inline colour overrides from Customizer
   ============================================================ */
function mc_output_custom_colors(): void {
	$defaults = [
		'mc_color_clay'  => '#C0613D',
		'mc_color_cream' => '#FBF8F4',
		'mc_color_ink'   => '#1A1610',
	];

	$map = [
		'mc_color_clay'  => '--clay-500',
		'mc_color_cream' => '--cream-50',
		'mc_color_ink'   => '--ink-900',
	];

	$changed = false;
	$css     = ':root{';
	foreach ( $defaults as $key => $default ) {
		$val = get_theme_mod( $key, $default );
		if ( $val !== $default ) {
			$changed = true;
		}
		$css .= $map[ $key ] . ':' . sanitize_hex_color( $val ) . ';';
	}
	$css .= '}';

	if ( $changed ) {
		wp_add_inline_style( 'mc-tokens', $css );
	}
}

/* ============================================================
   Template helpers — declared here (not in template parts /
   shortcode callbacks) so repeated includes never redeclare.
   ============================================================ */

/**
 * Booking destination for every "Book a discovery call" CTA.
 * Set a scheduler URL (Calendly, TidyCal, Amelia…) in the Customizer;
 * falls back to the Contact page.
 */
function mc_booking_url(): string {
	$url = get_theme_mod( 'mc_booking_url', '' );
	if ( $url ) {
		return esc_url( $url );
	}
	return esc_url( home_url( '/contact/' ) );
}

/**
 * Render an inline Lucide-style stroke icon.
 */
function mc_icon( string $name, int $size = 20, string $class = '' ): string {
	$filled = [ 'star', 'play' ];
	$icons  = [
		'arrow-right'  => '<path d="M5 12h14"/><path d="m13 6 6 6-6 6"/>',
		'arrow-up-right' => '<path d="M7 17 17 7"/><path d="M7 7h10v10"/>',
		'check'        => '<path d="M20 6 9 17l-5-5"/>',
		'menu'         => '<path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h16"/>',
		'close'        => '<path d="M18 6 6 18"/><path d="M6 6l12 12"/>',
		'calendar'     => '<rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18M8 2v4M16 2v4"/>',
		'play'         => '<path d="m6 3 14 9-14 9V3z"/>',
		'star'         => '<path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14l-5-4.87 6.91-1.01L12 2z"/>',
		'chevron-left' => '<path d="m15 18-6-6 6-6"/>',
		'chevron-right'=> '<path d="m9 18 6-6-6-6"/>',
		'plus'         => '<path d="M12 5v14M5 12h14"/>',
		'mail'         => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-10 5L2 7"/>',
		'phone'        => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2 4.2 2 2 0 0 1 4 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.6a2 2 0 0 1-.5 2.1L8 9.6a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.4c.8.3 1.7.5 2.6.6a2 2 0 0 1 1.7 2Z"/>',
		'map-pin'      => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
		'sparkle'      => '<path d="M12 3l1.9 5.1L19 10l-5.1 1.9L12 17l-1.9-5.1L5 10l5.1-1.9L12 3z"/>',
		'target'       => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1"/>',
		'compass'      => '<circle cx="12" cy="12" r="10"/><path d="m16.24 7.76-2.12 6.36-6.36 2.12 2.12-6.36 6.36-2.12z"/>',
		'leaf'         => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6"/>',
		'instagram'    => '<rect width="20" height="20" x="2" y="2" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37zM17.5 6.5h.01"/>',
		'linkedin'     => '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/>',
		'youtube'      => '<path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/><path d="m9.75 15.02 5.75-3.27-5.75-3.27v6.54z"/>',
	];

	$paths = $icons[ $name ] ?? '';
	$fill  = in_array( $name, $filled, true ) ? 'currentColor' : 'none';
	$c     = $class ? ' class="' . esc_attr( $class ) . '"' : '';

	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="%2$s" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"%3$s>%4$s</svg>',
		$size,
		esc_attr( $fill ),
		$c,
		$paths
	);
}

/**
 * The brand "edge / summit" mark (ascending stroke cresting to a point).
 */
function mc_mark( int $size = 30 ): string {
	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 48 48" fill="none" aria-hidden="true"><path d="M5 37 L20 16 L28 26 L37 11" stroke="currentColor" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="37" cy="11" r="4.2" fill="currentColor"/></svg>',
		$size
	);
}

/**
 * Render the header/footer logo (custom logo if set, else mark + wordmark).
 */
function mc_logo(): void {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}
	$name = get_theme_mod( 'mc_brand_name', get_bloginfo( 'name' ) ?: 'Maren Cole' );
	echo mc_mark( 28 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	printf( '<span class="mc-header__wordmark">%s</span>', esc_html( $name ) );
}

/**
 * Fallback primary nav when no menu is assigned yet.
 */
function mc_fallback_nav(): void {
	$pages = [
		'/about/'    => __( 'About', 'maren-cole' ),
		'/services/' => __( 'Work With Me', 'maren-cole' ),
		'/resources/'=> __( 'Resources', 'maren-cole' ),
		'/contact/'  => __( 'Contact', 'maren-cole' ),
	];
	foreach ( $pages as $path => $label ) {
		$url     = home_url( $path );
		$current = trailingslashit( get_permalink() ) === trailingslashit( $url ) ? ' class="current"' : '';
		printf( '<a href="%s"%s>%s</a>', esc_url( $url ), $current, esc_html( $label ) );
	}
}

/* ============================================================
   Include modules
   ============================================================ */
require get_stylesheet_directory() . '/inc/customizer.php';
require get_stylesheet_directory() . '/inc/block-support.php';
require get_stylesheet_directory() . '/inc/shortcodes.php';
require get_stylesheet_directory() . '/inc/block-patterns.php';
