<?php
defined( 'ABSPATH' ) || exit;

/* ============================================================
   Enqueue styles + scripts
   ============================================================ */
function mamaglueck_enqueue_assets() {
	// Parent theme (Astra)
	wp_enqueue_style(
		'astra-theme-css',
		get_template_directory_uri() . '/style.css',
		[],
		wp_get_theme( 'astra' )->get( 'Version' )
	);

	// Design tokens (CSS custom properties + Google Fonts)
	wp_enqueue_style(
		'mamaglueck-tokens',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[ 'astra-theme-css' ],
		wp_get_theme()->get( 'Version' )
	);

	// Component + layout styles
	wp_enqueue_style(
		'mamaglueck-theme',
		get_stylesheet_directory_uri() . '/assets/css/theme.css',
		[ 'mamaglueck-tokens' ],
		wp_get_theme()->get( 'Version' )
	);

	// Customizer color overrides (inline, after tokens)
	mamaglueck_output_custom_colors();

	// Lucide icons (CDN)
	wp_enqueue_script(
		'lucide',
		'https://unpkg.com/lucide@0.460.0/dist/umd/lucide.min.js',
		[],
		'0.460.0',
		true
	);

	// Theme JS
	wp_enqueue_script(
		'mamaglueck-theme',
		get_stylesheet_directory_uri() . '/assets/js/theme.js',
		[ 'lucide' ],
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'mamaglueck_enqueue_assets' );

/* ============================================================
   Theme supports
   ============================================================ */
function mamaglueck_theme_setup() {
	load_theme_textdomain( 'mamaglueck', get_stylesheet_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ] );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	// Custom logo
	add_theme_support( 'custom-logo', [
		'height'      => 60,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	] );

	// Navigation menus
	register_nav_menus( [
		'primary' => __( 'Hauptnavigation', 'mamaglueck' ),
		'footer'  => __( 'Footer-Navigation', 'mamaglueck' ),
	] );

	// Gutenberg colour palette
	add_theme_support( 'editor-color-palette', [
		[ 'name' => __( 'Coral', 'mamaglueck' ),  'slug' => 'coral',  'color' => '#FF7A59' ],
		[ 'name' => __( 'Teal', 'mamaglueck' ),   'slug' => 'teal',   'color' => '#54B7A6' ],
		[ 'name' => __( 'Gelb', 'mamaglueck' ),   'slug' => 'yellow', 'color' => '#FFC247' ],
		[ 'name' => __( 'Dunkel', 'mamaglueck' ), 'slug' => 'ink',    'color' => '#2B2A3D' ],
		[ 'name' => __( 'Creme', 'mamaglueck' ),  'slug' => 'cream',  'color' => '#F0F5FA' ],
		[ 'name' => __( 'Blush', 'mamaglueck' ),  'slug' => 'blush',  'color' => '#FFE6DC' ],
		[ 'name' => __( 'Weiß', 'mamaglueck' ),   'slug' => 'white',  'color' => '#FFFFFF' ],
	] );

	add_theme_support( 'editor-font-sizes', [
		[ 'name' => __( 'Klein', 'mamaglueck' ),   'slug' => 'small',  'size' => 15 ],
		[ 'name' => __( 'Normal', 'mamaglueck' ),  'slug' => 'normal', 'size' => 17 ],
		[ 'name' => __( 'Groß', 'mamaglueck' ),    'slug' => 'large',  'size' => 22 ],
	] );

	// Editor styles
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
}
add_action( 'after_setup_theme', 'mamaglueck_theme_setup' );

/* ============================================================
   Inline colour overrides from Customizer
   ============================================================ */
function mamaglueck_output_custom_colors() {
	$defaults = [
		'mg_color_coral'  => '#FF7A59',
		'mg_color_teal'   => '#54B7A6',
		'mg_color_yellow' => '#FFC247',
		'mg_color_ink'    => '#2B2A3D',
		'mg_color_cream'  => '#F0F5FA',
		'mg_color_blush'  => '#FFE6DC',
	];

	$changed = false;
	$css     = ':root{';
	foreach ( $defaults as $key => $default ) {
		$val = get_theme_mod( $key, $default );
		if ( $val !== $default ) {
			$changed = true;
		}
		$prop = str_replace( [ 'mg_color_', '_' ], [ '--', '-' ], $key );
		$css .= $prop . ':' . sanitize_hex_color( $val ) . ';';
	}
	$css .= '}';

	if ( $changed ) {
		wp_add_inline_style( 'mamaglueck-tokens', $css );
	}
}

/* ============================================================
   Template helpers (defined here so template-parts can be
   included multiple times without "cannot redeclare" errors)
   ============================================================ */
function mamaglueck_post_thumbnail( $post, $tint, $linked = true ) {
	$url   = get_permalink( $post );
	$thumb = get_the_post_thumbnail( $post->ID, 'large', [ 'class' => '' ] );
	if ( $thumb ) {
		if ( $linked ) {
			echo '<a href="' . esc_url( $url ) . '" class="photo" aria-label="' . esc_attr( get_the_title( $post ) ) . '">' . $thumb . '</a>';
		} else {
			echo '<div class="photo">' . $thumb . '</div>';
		}
	} else {
		echo '<a href="' . esc_url( $url ) . '" class="photo" data-tint="' . esc_attr( $tint ) . '" aria-label="' . esc_attr__( 'Beitrag lesen', 'mamaglueck' ) . '">
			<span class="photo__label">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
				' . esc_html__( 'Beitragsbild', 'mamaglueck' ) . '
			</span>
		</a>';
	}
}

/* ============================================================
   Include modules
   ============================================================ */
require get_stylesheet_directory() . '/inc/customizer.php';
require get_stylesheet_directory() . '/inc/block-support.php';
require get_stylesheet_directory() . '/inc/block-patterns.php';
require get_stylesheet_directory() . '/inc/shortcodes.php';
