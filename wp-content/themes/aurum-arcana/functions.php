<?php
/**
 * Aurum Arcana — Theme Functions
 * Dark-gold mysticism editorial theme, Astra child.
 */

/* ============================================================
   ENQUEUE ASSETS
   ============================================================ */
add_action( 'wp_enqueue_scripts', 'aurum_enqueue_assets' );
function aurum_enqueue_assets() {
	// Parent (Astra) stylesheet
	wp_enqueue_style( 'astra-parent-style', get_template_directory_uri() . '/style.css' );

	// Tokens + theme CSS
	wp_enqueue_style(
		'aurum-tokens',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[],
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style(
		'aurum-theme',
		get_stylesheet_directory_uri() . '/assets/css/theme.css',
		[ 'aurum-tokens' ],
		wp_get_theme()->get( 'Version' )
	);

	// Phosphor Icons (thin weight) — mystical line icons
	wp_enqueue_style(
		'phosphor-icons',
		'https://unpkg.com/@phosphor-icons/web@2.1.1/src/thin/style.css',
		[],
		'2.1.1'
	);

	// Theme JS
	wp_enqueue_script(
		'aurum-theme',
		get_stylesheet_directory_uri() . '/assets/js/theme.js',
		[],
		wp_get_theme()->get( 'Version' ),
		true
	);

	// Customizer-driven CSS variables
	wp_add_inline_style( 'aurum-theme', aurum_output_custom_colors() );
}

/* ============================================================
   THEME SETUP
   ============================================================ */
add_action( 'after_setup_theme', 'aurum_theme_setup' );
function aurum_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'custom-logo', [
		'height'      => 60,
		'width'       => 200,
		'flex-width'  => true,
		'flex-height' => true,
	] );

	register_nav_menus( [
		'primary'   => __( 'Primary Navigation', 'aurum-arcana' ),
		'footer-1'  => __( 'Footer: Explore', 'aurum-arcana' ),
		'footer-2'  => __( 'Footer: The Order', 'aurum-arcana' ),
	] );
}

/* ============================================================
   BLOCK EDITOR COLOR PALETTE
   ============================================================ */
add_action( 'after_setup_theme', 'aurum_block_palette' );
function aurum_block_palette() {
	add_theme_support( 'editor-color-palette', [
		[ 'name' => __( 'Ink 900', 'aurum-arcana' ),    'slug' => 'ink-900',    'color' => '#0E0D0F' ],
		[ 'name' => __( 'Ink 700', 'aurum-arcana' ),    'slug' => 'ink-700',    'color' => '#1B1714' ],
		[ 'name' => __( 'Gold 500', 'aurum-arcana' ),   'slug' => 'gold-500',   'color' => '#C8A24A' ],
		[ 'name' => __( 'Gold 400', 'aurum-arcana' ),   'slug' => 'gold-400',   'color' => '#E4C76B' ],
		[ 'name' => __( 'Parchment', 'aurum-arcana' ),  'slug' => 'parchment',  'color' => '#EDE6D6' ],
		[ 'name' => __( 'Oxblood', 'aurum-arcana' ),    'slug' => 'oxblood',    'color' => '#5A2A2A' ],
	] );
}

/* ============================================================
   HELPERS
   ============================================================ */

/**
 * Render a Phosphor thin icon.
 *
 * @param string $name  Icon name without 'ph-thin ph-' prefix (e.g. 'moon-stars').
 * @param int    $size  Font-size in px. 0 = inherit.
 * @return string HTML span.
 */
function aurum_icon( string $name, int $size = 0 ): string {
	$style = $size ? ' style="font-size:' . esc_attr( $size ) . 'px"' : '';
	return '<i class="ph-thin ph-' . esc_attr( $name ) . '"' . $style . ' aria-hidden="true"></i>';
}

/**
 * Render the sacred-geometry sigil SVG.
 *
 * @param int $size Width/height in px.
 * @return string HTML.
 */
function aurum_sigil( int $size = 40 ): string {
	$s = esc_attr( $size );
	return '<svg width="' . $s . '" height="' . $s . '" viewBox="0 0 120 120" fill="none"
		stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"
		aria-hidden="true" style="flex:0 0 auto;">
		<circle cx="60" cy="60" r="55" opacity="0.9"/>
		<circle cx="60" cy="60" r="43" opacity="0.4"/>
		<path d="M60 14 L101.6 84 L18.4 84 Z" opacity="0.85"/>
		<path d="M60 106 L18.4 36 L101.6 36 Z" opacity="0.85"/>
		<circle cx="60" cy="60" r="9"/>
		<circle cx="60" cy="60" r="1.8" fill="currentColor" stroke="none"/>
		<path d="M60 5 V0.5 M60 119.5 V115 M5 60 H0.5 M119.5 60 H115" opacity="0.7"/>
	</svg>';
}

/**
 * Render the ornamental divider SVG.
 *
 * @param string $width CSS width value, e.g. '220px'.
 * @return string HTML.
 */
function aurum_divider( string $width = '220px' ): string {
	return '<div class="aa-divider">
		<svg width="' . esc_attr( $width ) . '" height="22" viewBox="0 0 320 22" fill="none"
			stroke="currentColor" stroke-width="1" stroke-linecap="round" aria-hidden="true"
			style="max-width:100%;">
			<line x1="8" y1="11" x2="132" y2="11" opacity="0.45"/>
			<line x1="188" y1="11" x2="312" y2="11" opacity="0.45"/>
			<path d="M160 2 L165 11 L160 20 L155 11 Z" opacity="0.95"/>
			<path d="M148 11 L172 11" opacity="0.95"/>
			<circle cx="138" cy="11" r="1.6" fill="currentColor" stroke="none"/>
			<circle cx="182" cy="11" r="1.6" fill="currentColor" stroke="none"/>
		</svg>
	</div>';
}

/**
 * Render a gold section label (letterspaced small-caps eyebrow).
 *
 * @param string $text    Label text.
 * @param bool   $flanked Add hairlines on both sides.
 * @return string HTML.
 */
function aurum_label( string $text, bool $flanked = false ): string {
	$cls = 'aa-label' . ( $flanked ? ' aa-label--flanked' : '' );
	return '<span class="' . esc_attr( $cls ) . '">' . esc_html( $text ) . '</span>';
}

/**
 * Render a gold hero emblem SVG.
 *
 * @param int $size Width/height in px.
 * @return string HTML.
 */
function aurum_hero_emblem( int $size = 96 ): string {
	$s = esc_attr( $size );
	return '<svg width="' . $s . '" height="' . $s . '" viewBox="0 0 120 120" fill="none"
		stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"
		aria-hidden="true">
		<circle cx="60" cy="60" r="55" opacity="0.9"/>
		<circle cx="60" cy="60" r="43" opacity="0.4"/>
		<path d="M60 14 L101.6 84 L18.4 84 Z" opacity="0.85"/>
		<path d="M60 106 L18.4 36 L101.6 36 Z" opacity="0.85"/>
		<circle cx="60" cy="60" r="9"/>
		<circle cx="60" cy="60" r="1.8" fill="currentColor" stroke="none"/>
		<path d="M60 5 V0.5 M60 119.5 V115 M5 60 H0.5 M119.5 60 H115" opacity="0.7"/>
	</svg>';
}

/**
 * Render the post thumbnail, optionally linked.
 */
function aurum_post_thumbnail( WP_Post $post, bool $linked = true, string $size = 'large' ): void {
	if ( ! has_post_thumbnail( $post ) ) {
		echo '<div class="aa-article__media" style="background:var(--ink-600);min-height:200px;"></div>';
		return;
	}

	if ( $linked ) {
		echo '<a href="' . esc_url( get_permalink( $post ) ) . '" tabindex="-1" aria-hidden="true">';
	}

	the_post_thumbnail( $size, [
		'class' => '',
		'alt'   => get_the_title( $post ),
	] );

	if ( $linked ) {
		echo '</a>';
	}
}

/**
 * Output Customizer-driven CSS override variables.
 */
function aurum_output_custom_colors(): string {
	$accent     = get_theme_mod( 'aurum_color_accent',  '#C8A24A' );
	$bg         = get_theme_mod( 'aurum_color_bg',      '#0E0D0F' );
	$surface    = get_theme_mod( 'aurum_color_surface',  '#1B1714' );
	$parchment  = get_theme_mod( 'aurum_color_parchment', '#EDE6D6' );

	$out = ":root{\n";
	$out .= '--accent:' . sanitize_hex_color( $accent ) . ";\n";
	$out .= '--bg-base:' . sanitize_hex_color( $bg ) . ";\n";
	$out .= '--surface-card:' . sanitize_hex_color( $surface ) . ";\n";
	$out .= '--text-body:' . sanitize_hex_color( $parchment ) . ";\n";
	$out .= "}\n";

	return $out;
}

/* ============================================================
   INCLUDES
   ============================================================ */
require_once get_stylesheet_directory() . '/inc/customizer.php';
require_once get_stylesheet_directory() . '/inc/block-support.php';
require_once get_stylesheet_directory() . '/inc/block-patterns.php';
require_once get_stylesheet_directory() . '/inc/shortcodes.php';
