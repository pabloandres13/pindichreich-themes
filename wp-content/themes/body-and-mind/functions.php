<?php
defined( 'ABSPATH' ) || exit;

/* ============================================================
   Enqueue styles + scripts
   ============================================================ */
function bm_enqueue_assets() {
	wp_enqueue_style(
		'astra-theme-css',
		get_template_directory_uri() . '/style.css',
		[],
		wp_get_theme( 'astra' )->get( 'Version' )
	);

	// Design tokens (CSS custom properties + self-hosted fonts)
	wp_enqueue_style(
		'bm-tokens',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[ 'astra-theme-css' ],
		wp_get_theme()->get( 'Version' )
	);

	// Component + layout styles
	wp_enqueue_style(
		'bm-theme',
		get_stylesheet_directory_uri() . '/assets/css/theme.css',
		[ 'bm-tokens' ],
		wp_get_theme()->get( 'Version' )
	);

	// Customizer color overrides (inline, after tokens)
	bm_output_custom_colors();

	// Theme JS
	wp_enqueue_script(
		'bm-theme',
		get_stylesheet_directory_uri() . '/assets/js/theme.js',
		[],
		wp_get_theme()->get( 'Version' ),
		true
	);

	// Pass localised strings + settings to JS
	wp_localize_script( 'bm-theme', 'bmSettings', [
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'bm_nonce' ),
	] );
}
add_action( 'wp_enqueue_scripts', 'bm_enqueue_assets' );

/* ---- Block editor styles ---- */
function bm_enqueue_editor_assets() {
	wp_enqueue_style(
		'bm-tokens-editor',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'enqueue_block_editor_assets', 'bm_enqueue_editor_assets' );

/* ============================================================
   Theme supports
   ============================================================ */
function bm_theme_setup() {
	load_theme_textdomain( 'body-and-mind', get_stylesheet_directory() . '/languages' );

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
		'primary' => __( 'Hauptnavigation', 'body-and-mind' ),
		'footer'  => __( 'Footer-Navigation', 'body-and-mind' ),
	] );

	add_theme_support( 'editor-color-palette', [
		[ 'name' => __( 'Lavendel', 'body-and-mind' ), 'slug' => 'lavender', 'color' => '#c9b8e8' ],
		[ 'name' => __( 'Salbei',   'body-and-mind' ), 'slug' => 'sage',     'color' => '#a8c3a0' ],
		[ 'name' => __( 'Creme',    'body-and-mind' ), 'slug' => 'cream',    'color' => '#fbf8f4' ],
		[ 'name' => __( 'Weiß',     'body-and-mind' ), 'slug' => 'white',    'color' => '#ffffff' ],
		[ 'name' => __( 'Charcoal', 'body-and-mind' ), 'slug' => 'ink',      'color' => '#2e2a28' ],
		[ 'name' => __( 'Akzent',   'body-and-mind' ), 'slug' => 'accent',   'color' => '#6a5097' ],
	] );

	add_theme_support( 'editor-font-sizes', [
		[ 'name' => __( 'Klein',  'body-and-mind' ), 'slug' => 'small',  'size' => 15 ],
		[ 'name' => __( 'Normal', 'body-and-mind' ), 'slug' => 'normal', 'size' => 18 ],
		[ 'name' => __( 'Groß',   'body-and-mind' ), 'slug' => 'large',  'size' => 22 ],
	] );

	add_theme_support( 'editor-styles' );
	// Load the real tokens + component styles into the editor canvas so block
	// patterns preview the way they render on the front end.
	add_editor_style( [
		'assets/css/tokens.css',
		'assets/css/theme.css',
		'assets/css/editor.css',
	] );
}
add_action( 'after_setup_theme', 'bm_theme_setup' );

/* ============================================================
   Inline colour overrides from Customizer
   ============================================================ */
function bm_output_custom_colors() {
	$defaults = [
		'bm_color_lavender' => '#c9b8e8',
		'bm_color_sage'     => '#a8c3a0',
		'bm_color_cream'    => '#fbf8f4',
		'bm_color_ink'      => '#2e2a28',
	];

	$changed = false;
	$css     = ':root{';
	foreach ( $defaults as $key => $default ) {
		$val = get_theme_mod( $key, $default );
		if ( $val !== $default ) {
			$changed = true;
		}
		$prop = '--' . str_replace( [ 'bm_color_', '_' ], [ '', '-' ], $key );
		$css .= $prop . ':' . sanitize_hex_color( $val ) . ';';
	}
	$css .= '}';

	if ( $changed ) {
		wp_add_inline_style( 'bm-tokens', $css );
	}
}

/* ============================================================
   Template helpers (defined here — not in template-parts — to
   prevent "cannot redeclare" when parts are included multiple times)
   ============================================================ */

/**
 * Render an SVG icon by name (inline Lucide-style).
 */
function bm_icon( string $name, int $size = 20, string $class = '' ): string {
	$icons = [
		'menu'       => '<path d="M3 6h18M3 12h18M3 18h18"/>',
		'close'      => '<path d="M18 6 6 18M6 6l12 12"/>',
		'arrow-right'=> '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'chevron-down'=> '<path d="m6 9 6 6 6-6"/>',
		'leaf'       => '<path d="M11 20A7 7 0 0 1 4 13c0-5 4-9 11-9 1 0 5 0 5 4 0 7-5 12-9 12Z"/><path d="M9 16c2-3 4-5 7-6"/>',
		'sun'        => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
		'wind'       => '<path d="M3 8h10a3 3 0 1 0-3-4M3 12h15a3 3 0 1 1-3 4M3 16h7a3 3 0 1 1-3 4"/>',
		'star'       => '<path d="m12 2 3 6.5 7 .6-5.2 4.6 1.6 6.9L12 17.5 5 20.6l1.6-6.9L1.4 9.1l7-.6Z"/>',
		'check'      => '<path d="M20 6 9 17l-5-5"/>',
		'info'       => '<circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/>',
		'map-pin'    => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
		'clock'      => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'phone'      => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2 4.2 2 2 0 0 1 4 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.6a2 2 0 0 1-.5 2.1L8 9.6a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.4c.8.3 1.7.5 2.6.6a2 2 0 0 1 1.7 2Z"/>',
		'mail'       => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>',
		'instagram'  => '<rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.6" fill="currentColor"/>',
	];

	$paths = $icons[ $name ] ?? '';
	$c = $class ? ' class="' . esc_attr( $class ) . '"' : '';
	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"%2$s>%3$s</svg>',
		$size,
		$c,
		$paths
	);
}

/**
 * Render the site logo (SVG mark + wordmark).
 */
function bm_logo( bool $light = false ): void {
	$name  = get_theme_mod( 'bm_studio_name', 'Lichtraum' );
	$stroke = $light ? '#c9b8e8' : '#8265b5';
	$fill   = '#a8c3a0';
	$color  = $light ? 'var(--ivory)' : 'var(--ink-900)';
	?>
	<span class="bm-header__logo-mark">
		<svg width="36" height="36" viewBox="0 0 48 48" fill="none" aria-hidden="true">
			<circle cx="24" cy="25" r="16.5" fill="none" stroke="<?php echo esc_attr( $stroke ); ?>" stroke-width="2.4" stroke-linecap="round" stroke-dasharray="78 26" transform="rotate(-58 24 25)" />
			<circle cx="24" cy="9.5" r="5" fill="<?php echo esc_attr( $fill ); ?>" />
		</svg>
	</span>
	<span class="bm-header__logo-wordmark" style="color:<?php echo esc_attr( $color ); ?>"><?php echo esc_html( $name ); ?></span>
	<?php
}

/**
 * Render a level badge.
 *
 * @param string $level     The level label.
 * @param string $tone      sage | lavender | honey
 */
function bm_badge( string $level, string $tone = 'sage' ): void {
	printf(
		'<span class="bm-badge bm-badge--%s">%s</span>',
		esc_attr( $tone ),
		esc_html( $level )
	);
}

/* ============================================================
   Include modules
   ============================================================ */
require get_stylesheet_directory() . '/inc/customizer.php';
require get_stylesheet_directory() . '/inc/block-support.php';
require get_stylesheet_directory() . '/inc/shortcodes.php';
require get_stylesheet_directory() . '/inc/block-patterns.php';
