<?php
defined( 'ABSPATH' ) || exit;

/* ============================================================
   Enqueue styles + scripts
   ============================================================ */
function culinary_enqueue_assets() {
	wp_enqueue_style(
		'astra-theme-css',
		get_template_directory_uri() . '/style.css',
		[],
		wp_get_theme( 'astra' )->get( 'Version' )
	);

	wp_enqueue_style(
		'culinary-tokens',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[ 'astra-theme-css' ],
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'culinary-theme',
		get_stylesheet_directory_uri() . '/assets/css/theme.css',
		[ 'culinary-tokens' ],
		wp_get_theme()->get( 'Version' )
	);

	culinary_output_custom_colors();

	wp_enqueue_script(
		'lucide',
		'https://unpkg.com/lucide@0.460.0/dist/umd/lucide.min.js',
		[],
		'0.460.0',
		true
	);

	wp_enqueue_script(
		'culinary-theme',
		get_stylesheet_directory_uri() . '/assets/js/theme.js',
		[ 'lucide' ],
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'culinary_enqueue_assets' );

/* ============================================================
   Theme supports
   ============================================================ */
function culinary_theme_setup() {
	load_theme_textdomain( 'culinary', get_stylesheet_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ] );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	add_theme_support( 'custom-logo', [
		'height'      => 60,
		'width'       => 220,
		'flex-height' => true,
		'flex-width'  => true,
	] );

	register_nav_menus( [
		'primary'    => __( 'Primary Navigation', 'culinary' ),
		'footer-1'   => __( 'Footer Browse', 'culinary' ),
		'footer-2'   => __( 'Footer About', 'culinary' ),
		'footer-3'   => __( 'Footer More', 'culinary' ),
	] );

	add_theme_support( 'editor-color-palette', [
		[ 'name' => __( 'Terracotta', 'culinary' ),  'slug' => 'terracotta', 'color' => '#C4622D' ],
		[ 'name' => __( 'Sage', 'culinary' ),         'slug' => 'sage',       'color' => '#7A8B6F' ],
		[ 'name' => __( 'Cream', 'culinary' ),        'slug' => 'cream',      'color' => '#FAF7F2' ],
		[ 'name' => __( 'Ink', 'culinary' ),          'slug' => 'ink',        'color' => '#2B2622' ],
		[ 'name' => __( 'White', 'culinary' ),        'slug' => 'white',      'color' => '#FFFFFF' ],
		[ 'name' => __( 'Gold', 'culinary' ),         'slug' => 'gold',       'color' => '#E0A33E' ],
	] );

	add_theme_support( 'editor-font-sizes', [
		[ 'name' => __( 'Small', 'culinary' ),   'slug' => 'small',   'size' => 14 ],
		[ 'name' => __( 'Normal', 'culinary' ),  'slug' => 'normal',  'size' => 17 ],
		[ 'name' => __( 'Large', 'culinary' ),   'slug' => 'large',   'size' => 22 ],
		[ 'name' => __( 'X-Large', 'culinary' ), 'slug' => 'x-large', 'size' => 28 ],
	] );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
}
add_action( 'after_setup_theme', 'culinary_theme_setup' );

/* ============================================================
   Inline colour overrides from Customizer
   ============================================================ */
function culinary_output_custom_colors() {
	$defaults = [
		'culinary_color_terracotta' => '#C4622D',
		'culinary_color_sage'       => '#7A8B6F',
		'culinary_color_cream'      => '#FAF7F2',
		'culinary_color_ink'        => '#2B2622',
	];

	$css = ':root{';
	foreach ( $defaults as $key => $default ) {
		$val  = get_theme_mod( $key, $default );
		$prop = '--' . str_replace( [ 'culinary_color_', '_' ], [ '', '-' ], $key );
		$css .= $prop . ':' . sanitize_hex_color( $val ) . ';';
	}
	$css .= '}';

	wp_add_inline_style( 'culinary-tokens', $css );
}

/* ============================================================
   Template helpers
   ============================================================ */

/**
 * Render an inline Lucide icon span.
 */
function culinary_icon( string $name, int $size = 18 ): string {
	return '<span class="culinary-icon" aria-hidden="true"><i data-lucide="' . esc_attr( $name ) . '" width="' . esc_attr( $size ) . '" height="' . esc_attr( $size ) . '"></i></span>';
}

/**
 * Render star rating HTML.
 */
function culinary_star_rating( float $value = 5.0, int $size = 18, bool $show_value = false, ?int $count = null ): string {
	$path = 'M12 2.5l2.95 5.98 6.6.96-4.77 4.65 1.13 6.57L12 17.6l-5.9 3.1 1.13-6.57L2.45 9.44l6.6-.96L12 2.5z';
	$html = '<span class="star-rating"><span class="star-rating__stars">';
	for ( $i = 0; $i < 5; $i++ ) {
		$fill = max( 0, min( 1, $value - $i ) );
		$gid  = 'sr-' . $size . '-' . $i . '-' . round( $fill * 100 );
		if ( $fill >= 1 ) {
			$fill_attr = 'var(--rating)';
		} elseif ( $fill <= 0 ) {
			$fill_attr = 'var(--border-strong)';
		} else {
			$pct       = round( $fill * 100 );
			$fill_attr = 'url(#' . esc_attr( $gid ) . ')';
			$html     .= '<svg width="0" height="0" style="position:absolute"><defs><linearGradient id="' . esc_attr( $gid ) . '" x1="0" x2="1"><stop offset="' . esc_attr( $pct ) . '%" stop-color="var(--rating)"/><stop offset="' . esc_attr( $pct ) . '%" stop-color="var(--border-strong)"/></linearGradient></defs></svg>';
		}
		$html .= '<svg width="' . esc_attr( $size ) . '" height="' . esc_attr( $size ) . '" viewBox="0 0 24 24" style="display:block"><path d="' . esc_attr( $path ) . '" fill="' . esc_attr( $fill_attr ) . '"/></svg>';
	}
	$html .= '</span>';
	if ( $show_value ) {
		$html .= '<span class="star-rating__value">' . esc_html( number_format( $value, 1 ) ) . '</span>';
	}
	if ( $count !== null ) {
		$html .= '<span class="star-rating__count">(' . esc_html( $count ) . ')</span>';
	}
	$html .= '</span>';
	return $html;
}

/**
 * Render post thumbnail for recipe cards.
 */
function culinary_post_thumbnail( WP_Post $post, bool $linked = true, string $size = 'large' ): void {
	$url   = get_permalink( $post );
	$title = get_the_title( $post );
	$thumb = get_the_post_thumbnail( $post->ID, $size, [ 'alt' => esc_attr( $title ) ] );

	if ( $thumb ) {
		if ( $linked ) {
			echo '<a href="' . esc_url( $url ) . '" class="recipe-card__image-wrap" tabindex="-1" aria-label="' . esc_attr( $title ) . '">' . $thumb . '</a>';
		} else {
			echo '<div class="recipe-card__image-wrap">' . $thumb . '</div>';
		}
	} else {
		echo '<a href="' . esc_url( $url ) . '" class="recipe-card__image-wrap recipe-card__image-wrap--placeholder" aria-label="' . esc_attr( $title ) . '">
			<span class="recipe-card__no-image">' . culinary_icon( 'image', 32 ) . '</span>
		</a>';
	}
}

/**
 * Get recipe meta (time, difficulty) from post meta or tags.
 */
function culinary_get_recipe_time( int $post_id ): string {
	$time = get_post_meta( $post_id, '_recipe_time', true );
	if ( ! $time ) {
		$tags = get_the_tags( $post_id );
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				if ( preg_match( '/(\d+\s*(min|hr|hour|hours|minutes))/i', $tag->name, $m ) ) {
					return $m[1];
				}
			}
		}
	}
	return $time ?: '';
}

/* ============================================================
   Include modules
   ============================================================ */
require get_stylesheet_directory() . '/inc/customizer.php';
require get_stylesheet_directory() . '/inc/block-support.php';
require get_stylesheet_directory() . '/inc/block-patterns.php';
require get_stylesheet_directory() . '/inc/shortcodes.php';
