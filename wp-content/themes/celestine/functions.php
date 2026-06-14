<?php
/**
 * Celestine theme functions.
 *
 * @package celestine
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   Enqueue styles + scripts
   ============================================================ */
function cel_enqueue_assets(): void {
	wp_enqueue_style(
		'astra-theme-css',
		get_template_directory_uri() . '/style.css',
		[],
		wp_get_theme( 'astra' )->get( 'Version' )
	);

	// Design tokens (CSS custom properties + self-hosted fonts).
	wp_enqueue_style(
		'celestine-tokens',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[ 'astra-theme-css' ],
		wp_get_theme()->get( 'Version' )
	);

	// Component + layout styles.
	wp_enqueue_style(
		'celestine-theme',
		get_stylesheet_directory_uri() . '/assets/css/theme.css',
		[ 'celestine-tokens' ],
		wp_get_theme()->get( 'Version' )
	);

	// Customizer colour overrides (inline, after tokens).
	cel_output_custom_colors();

	wp_enqueue_script(
		'celestine-theme',
		get_stylesheet_directory_uri() . '/assets/js/theme.js',
		[],
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'cel_enqueue_assets' );

/* ---- Block editor styles ---- */
function cel_enqueue_editor_assets(): void {
	wp_enqueue_style(
		'celestine-tokens-editor',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'enqueue_block_editor_assets', 'cel_enqueue_editor_assets' );

/* ============================================================
   Theme supports
   ============================================================ */
function cel_theme_setup(): void {
	load_theme_textdomain( 'celestine', get_stylesheet_directory() . '/languages' );

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
		'primary' => __( 'Primary navigation', 'celestine' ),
		'footer'  => __( 'Footer navigation', 'celestine' ),
	] );

	// Brand colour palette (Gutenberg).
	add_theme_support( 'editor-color-palette', [
		[ 'name' => __( 'Cosmic indigo', 'celestine' ), 'slug' => 'cosmos',   'color' => '#0E1230' ],
		[ 'name' => __( 'Midnight navy', 'celestine' ), 'slug' => 'midnight', 'color' => '#11132E' ],
		[ 'name' => __( 'Deep violet', 'celestine' ),   'slug' => 'violet',   'color' => '#241640' ],
		[ 'name' => __( 'Luminous gold', 'celestine' ), 'slug' => 'gold',     'color' => '#D9B45B' ],
		[ 'name' => __( 'Bright gold', 'celestine' ),   'slug' => 'gold-bright', 'color' => '#E8C97A' ],
		[ 'name' => __( 'Moonlight silver', 'celestine' ), 'slug' => 'silver', 'color' => '#C9D2E3' ],
		[ 'name' => __( 'Moonlight', 'celestine' ),     'slug' => 'moon',     'color' => '#EDEBF5' ],
	] );

	add_theme_support( 'editor-gradient-presets', [
		[ 'name' => __( 'Cosmos', 'celestine' ), 'slug' => 'cosmos', 'gradient' => 'linear-gradient(180deg, #0E1230 0%, #190F33 60%, #241640 100%)' ],
		[ 'name' => __( 'Night', 'celestine' ),  'slug' => 'night',  'gradient' => 'linear-gradient(160deg, #11132E 0%, #0A0D24 100%)' ],
		[ 'name' => __( 'Gold', 'celestine' ),   'slug' => 'gold',   'gradient' => 'linear-gradient(120deg, #E8C97A 0%, #D9B45B 45%, #A87F33 100%)' ],
	] );

	add_theme_support( 'editor-font-sizes', [
		[ 'name' => __( 'Small', 'celestine' ),  'slug' => 'small',  'size' => 15 ],
		[ 'name' => __( 'Normal', 'celestine' ), 'slug' => 'normal', 'size' => 17 ],
		[ 'name' => __( 'Large', 'celestine' ),  'slug' => 'large',  'size' => 22 ],
		[ 'name' => __( 'Display', 'celestine' ),'slug' => 'display','size' => 40 ],
	] );

	add_theme_support( 'editor-styles' );
	add_editor_style( [
		'assets/css/tokens.css',
		'assets/css/theme.css',
		'assets/css/editor.css',
	] );
}
add_action( 'after_setup_theme', 'cel_theme_setup' );

/* ============================================================
   Inline colour overrides from Customizer
   ============================================================ */
function cel_output_custom_colors(): void {
	$defaults = [
		'cel_color_cosmos' => '#0E1230',
		'cel_color_violet' => '#241640',
		'cel_color_gold'   => '#D9B45B',
		'cel_color_silver' => '#C9D2E3',
	];

	$map = [
		'cel_color_cosmos' => '--cosmos-800',
		'cel_color_violet' => '--violet-800',
		'cel_color_gold'   => '--gold-500',
		'cel_color_silver' => '--silver-400',
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
		wp_add_inline_style( 'celestine-tokens', $css );
	}
}

/* ============================================================
   Template helpers (declared here, not in template-parts, so
   re-including a part never triggers "cannot redeclare")
   ============================================================ */

/**
 * Inline Lucide-style UI icon (stroke 1.5 to match the delicate linework).
 */
function cel_icon( string $name, int $size = 20, string $class = '' ): string {
	$icons = [
		'menu'        => '<path d="M3 6h18M3 12h18M3 18h18"/>',
		'close'       => '<path d="M18 6 6 18M6 6l12 12"/>',
		'arrow-right' => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'arrow-left'  => '<path d="M19 12H5M11 18l-6-6 6-6"/>',
		'search'      => '<circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/>',
		'mail'        => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>',
		'instagram'   => '<rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.6" fill="currentColor"/>',
	];

	$paths = $icons[ $name ] ?? '';
	$c     = $class ? ' class="' . esc_attr( $class ) . '"' : '';
	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"%2$s>%3$s</svg>',
		$size,
		$c,
		$paths
	);
}

/**
 * Render the Celestine brand lockup (crescent mark + wordmark).
 */
function cel_logo(): void {
	$name = get_theme_mod( 'cel_brand_name', 'Celestine' );
	$mark = get_stylesheet_directory_uri() . '/assets/images/celestine-mark.svg';
	?>
	<img class="cel-header__mark" src="<?php echo esc_url( $mark ); ?>" width="38" height="38" alt="" />
	<span class="cel-header__word"><?php echo esc_html( $name ); ?></span>
	<?php
}

/**
 * Resolve a page permalink by slug, falling back to a home-relative URL.
 */
function cel_page_url( string $slug ): string {
	$page = get_page_by_path( $slug );
	if ( $page instanceof WP_Post ) {
		return (string) get_permalink( $page );
	}
	return home_url( '/' . $slug . '/' );
}

/* ============================================================
   Include modules
   ============================================================ */
require get_stylesheet_directory() . '/inc/customizer.php';
require get_stylesheet_directory() . '/inc/block-support.php';
require get_stylesheet_directory() . '/inc/shortcodes.php';
require get_stylesheet_directory() . '/inc/block-patterns.php';
