<?php
defined( 'ABSPATH' ) || exit;

/* ============================================================
   Enqueue styles + scripts
   ============================================================ */
function aurelia_enqueue_assets() {
	wp_enqueue_style(
		'astra-theme-css',
		get_template_directory_uri() . '/style.css',
		[],
		wp_get_theme( 'astra' )->get( 'Version' )
	);

	// Design tokens (CSS custom properties + self-hosted fonts)
	wp_enqueue_style(
		'aurelia-tokens',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[ 'astra-theme-css' ],
		wp_get_theme()->get( 'Version' )
	);

	// Component + layout styles
	wp_enqueue_style(
		'aurelia-theme',
		get_stylesheet_directory_uri() . '/assets/css/theme.css',
		[ 'aurelia-tokens' ],
		wp_get_theme()->get( 'Version' )
	);

	// Customizer color overrides (inline, after tokens)
	aurelia_output_custom_colors();

	// Theme JS
	wp_enqueue_script(
		'aurelia-theme',
		get_stylesheet_directory_uri() . '/assets/js/theme.js',
		[],
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'aurelia_enqueue_assets' );

/* ---- Block editor styles ---- */
function aurelia_enqueue_editor_assets() {
	wp_enqueue_style(
		'aurelia-tokens-editor',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'enqueue_block_editor_assets', 'aurelia_enqueue_editor_assets' );

/* ============================================================
   Theme supports
   ============================================================ */
function aurelia_theme_setup() {
	load_theme_textdomain( 'aurelia', get_stylesheet_directory() . '/languages' );

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
		'primary' => __( 'Hauptnavigation', 'aurelia' ),
		'footer'  => __( 'Footer-Navigation', 'aurelia' ),
	] );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
}
add_action( 'after_setup_theme', 'aurelia_theme_setup' );

/* ============================================================
   Inline colour overrides from Customizer
   ============================================================ */
function aurelia_output_custom_colors() {
	$defaults = [
		'aurelia_color_green'  => '#6fb58e',
		'aurelia_color_blue'   => '#a9cbd8',
		'aurelia_color_forest' => '#243b30',
		'aurelia_color_cream'  => '#f6faf7',
		'aurelia_color_sand'   => '#ede7dd',
	];

	$map = [
		'aurelia_color_green'  => '--green-400',
		'aurelia_color_blue'   => '--blue-300',
		'aurelia_color_forest' => '--forest',
		'aurelia_color_cream'  => '--cream',
		'aurelia_color_sand'   => '--sand-200',
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
		wp_add_inline_style( 'aurelia-tokens', $css );
	}
}

/* ============================================================
   Template helpers (defined here — not in template-parts — to
   prevent "cannot redeclare" when parts are included multiple times)
   ============================================================ */

/**
 * Render an SVG icon by name (inline Lucide-style, 2px even stroke).
 */
function aurelia_icon( string $name, int $size = 20, string $class = '' ): string {
	$icons = [
		'menu'            => '<path d="M3 6h18M3 12h18M3 18h18"/>',
		'close'           => '<path d="M18 6 6 18M6 6l12 12"/>',
		'arrow-right'     => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'arrow-left'      => '<path d="M19 12H5M11 18l-6-6 6-6"/>',
		'chevron-down'    => '<path d="m6 9 6 6 6-6"/>',
		'plus'            => '<path d="M12 5v14M5 12h14"/>',
		'check'           => '<path d="M20 6 9 17l-5-5"/>',
		'info'            => '<circle cx="12" cy="12" r="9"/><path d="M12 16v-4M12 8h.01"/>',
		'leaf'            => '<path d="M11 20A7 7 0 0 1 4 13c0-5 4-9 11-9 1 0 5 0 5 4 0 7-5 12-9 12Z"/><path d="M9 16c2-3 4-5 7-6"/>',
		'sprout'          => '<path d="M7 20h10"/><path d="M12 20v-9"/><path d="M12 11c0-3.5 2.5-6 6-6 0 3.5-2.5 6-6 6Z"/><path d="M12 13c0-3-2-5-5-5 0 3 2 5 5 5Z"/>',
		'salad'           => '<path d="M7 21h10"/><path d="M12 21a9 9 0 0 0 9-9H3a9 9 0 0 0 9 9Z"/><path d="M11 12 7 4M13 12l2.5-5.5"/><circle cx="16.5" cy="5" r="1.5"/>',
		'wind'            => '<path d="M3 8h10a3 3 0 1 0-3-4M3 12h15a3 3 0 1 1-3 4M3 16h7a3 3 0 1 1-3 4"/>',
		'hand-heart'      => '<path d="M11 14h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 16"/><path d="m7 20 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9"/><path d="m2 15 6 6"/><path d="M19.5 8.5c.7-.7 1.5-1.6 1.5-2.7A2.73 2.73 0 0 0 16 4a2.78 2.78 0 0 0-5 1.8c0 1.2.8 2 1.5 2.8L16 12Z"/>',
		'heart-handshake' => '<path d="M19 14c1.5-1.5 3-3.2 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.8 0-3 .5-4.5 2-1.5-1.5-2.7-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4 3 5.5l7 7Z"/><path d="M12 5 9.04 7.96a2.17 2.17 0 0 0 0 3.08c.82.82 2.13.85 3 .07l2.07-1.9a2.82 2.82 0 0 1 3.79 0l2.96 2.66"/>',
		'shield-check'    => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1Z"/><path d="m9 12 2 2 4-4"/>',
		'sun'             => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
		'moon'            => '<path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>',
		'flower'          => '<circle cx="12" cy="12" r="3"/><path d="M12 16.5A4.5 4.5 0 1 1 7.5 12 4.5 4.5 0 1 1 12 7.5a4.5 4.5 0 1 1 4.5 4.5 4.5 4.5 0 1 1-4.5 4.5"/><path d="M12 7.5V9M7.5 12H9M16.5 12H15M12 16.5V15"/>',
		'messages-square' => '<path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2Z"/><path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1"/>',
		'route'           => '<circle cx="6" cy="19" r="3"/><path d="M9 19h8.5a3.5 3.5 0 0 0 0-7h-11a3.5 3.5 0 0 1 0-7H15"/><circle cx="18" cy="5" r="3"/>',
		'calendar-check'  => '<path d="M8 2v4M16 2v4"/><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M3 10h18"/><path d="m9 16 2 2 4-4"/>',
		'clock'           => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'repeat'          => '<path d="m17 2 4 4-4 4"/><path d="M3 11v-1a4 4 0 0 1 4-4h14"/><path d="m7 22-4-4 4-4"/><path d="M21 13v1a4 4 0 0 1-4 4H3"/>',
		'wallet'          => '<path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"/><path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"/>',
		'map-pin'         => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
		'phone'           => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2 4.2 2 2 0 0 1 4 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.6a2 2 0 0 1-.5 2.1L8 9.6a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.4c.8.3 1.7.5 2.6.6a2 2 0 0 1 1.7 2Z"/>',
		'mail'            => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>',
		'lock'            => '<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
		'instagram'       => '<rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.6" fill="currentColor"/>',
		'facebook'        => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3Z"/>',
		'user'            => '<circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/>',
		'image'           => '<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.1-3.1a2 2 0 0 0-2.8 0L6 21"/>',
	];

	$paths = $icons[ $name ] ?? '';
	$c = $class ? ' class="' . esc_attr( $class ) . '"' : '';
	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"%2$s>%3$s</svg>',
		$size,
		$c,
		$paths
	);
}

/**
 * Render the site logo (sprout mark + wordmark).
 */
function aurelia_logo( bool $light = false ): void {
	$name      = get_theme_mod( 'aurelia_practice_name', 'Aurelia' );
	$ring      = $light ? 'rgba(255,255,255,0.16)' : '#e3f0e9';
	$leaf_dark = $light ? '#ffffff' : '#243b30';
	?>
	<svg width="32" height="32" viewBox="0 0 44 44" fill="none" aria-hidden="true">
		<circle cx="22" cy="22" r="22" fill="<?php echo esc_attr( $ring ); ?>" />
		<path d="M22 33c0-7.2 4.2-12.6 10.5-14.7C31.2 26.4 27.4 31 22 33Z" fill="#6fb58e" />
		<path d="M22 33c0-7.2-4.2-12.6-10.5-14.7C12.8 26.4 16.6 31 22 33Z" fill="<?php echo esc_attr( $leaf_dark ); ?>" />
		<path d="M22 33V15" stroke="<?php echo esc_attr( $leaf_dark ); ?>" stroke-width="2.4" stroke-linecap="round" />
		<circle cx="22" cy="12.5" r="3.2" fill="#9fc0d1" />
	</svg>
	<span class="au-header__wordmark<?php echo $light ? ' au-header__wordmark--light' : ''; ?>"><?php echo esc_html( $name ); ?></span>
	<?php
}

/**
 * Render a section label (letterspaced small-caps eyebrow).
 */
function aurelia_label( string $text, bool $with_rule = true ): void {
	printf(
		'<span class="au-label%s">%s</span>',
		$with_rule ? '' : ' au-label--plain',
		esc_html( $text )
	);
}

/**
 * URL of the booking/contact page ("Termin buchen" CTA target).
 */
function aurelia_booking_url(): string {
	$page = get_page_by_path( 'kontakt' );
	return $page ? get_page_link( $page ) : home_url( '/kontakt/' );
}

/* ============================================================
   Include modules
   ============================================================ */
require get_stylesheet_directory() . '/inc/customizer.php';
require get_stylesheet_directory() . '/inc/block-support.php';
require get_stylesheet_directory() . '/inc/block-patterns.php';
require get_stylesheet_directory() . '/inc/shortcodes.php';
