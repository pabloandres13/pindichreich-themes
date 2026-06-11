<?php
defined( 'ABSPATH' ) || exit;

/* ---- Editor color palette + font sizes ---- */
function aurelia_block_supports(): void {
	add_theme_support( 'editor-color-palette', [
		[ 'name' => __( 'Heilgrün', 'aurelia' ),  'slug' => 'green',  'color' => '#6fb58e' ],
		[ 'name' => __( 'Sanftblau', 'aurelia' ), 'slug' => 'blue',   'color' => '#a9cbd8' ],
		[ 'name' => __( 'Waldgrün', 'aurelia' ),  'slug' => 'forest', 'color' => '#243b30' ],
		[ 'name' => __( 'Creme', 'aurelia' ),     'slug' => 'cream',  'color' => '#f6faf7' ],
		[ 'name' => __( 'Sand', 'aurelia' ),      'slug' => 'sand',   'color' => '#ede7dd' ],
		[ 'name' => __( 'Weiß', 'aurelia' ),      'slug' => 'white',  'color' => '#ffffff' ],
		[ 'name' => __( 'Grün hell', 'aurelia' ), 'slug' => 'green-light', 'color' => '#e3f0e9' ],
		[ 'name' => __( 'Blau hell', 'aurelia' ), 'slug' => 'blue-light',  'color' => '#e5eff3' ],
	] );

	add_theme_support( 'editor-font-sizes', [
		[ 'name' => __( 'Klein', 'aurelia' ),  'slug' => 'small',  'size' => 15 ],
		[ 'name' => __( 'Normal', 'aurelia' ), 'slug' => 'normal', 'size' => 17 ],
		[ 'name' => __( 'Groß', 'aurelia' ),   'slug' => 'large',  'size' => 20 ],
		[ 'name' => __( 'Titel', 'aurelia' ),  'slug' => 'title',  'size' => 30 ],
	] );
}
add_action( 'after_setup_theme', 'aurelia_block_supports' );

/* ---- Custom block styles ---- */
function aurelia_register_block_styles(): void {
	register_block_style( 'core/button', [
		'name'  => 'au-primary',
		'label' => __( 'Primär (Waldgrün)', 'aurelia' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'au-secondary',
		'label' => __( 'Sekundär (Umrandung)', 'aurelia' ),
	] );
	register_block_style( 'core/group', [
		'name'  => 'au-card',
		'label' => __( 'Karte (weich, abgerundet)', 'aurelia' ),
	] );
	register_block_style( 'core/quote', [
		'name'  => 'au-pullquote',
		'label' => __( 'Zitat (sanftblau)', 'aurelia' ),
	] );
}
add_action( 'init', 'aurelia_register_block_styles' );

/* ---- Front-end styles for the custom block styles ---- */
function aurelia_block_style_css(): void {
	$css = '
	.is-style-au-primary .wp-block-button__link{background:var(--primary);color:var(--primary-text);border-radius:var(--radius-pill);}
	.is-style-au-primary .wp-block-button__link:hover{background:var(--primary-hover);}
	.is-style-au-secondary .wp-block-button__link{background:var(--white);color:var(--forest);border:1px solid var(--green-300);border-radius:var(--radius-pill);}
	.is-style-au-secondary .wp-block-button__link:hover{background:var(--green-50);}
	.is-style-au-card{background:var(--white);border:1px solid var(--border-soft);border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);padding:var(--space-6);}
	.is-style-au-pullquote{background:var(--blue-50);border:none;border-radius:var(--radius-lg);padding:1.4rem 1.6rem;font-family:var(--font-heading);font-size:1.25rem;color:var(--text-strong);}
	.is-style-au-pullquote cite{font-family:var(--font-body);font-size:0.875rem;color:var(--text-muted);}
	';
	wp_add_inline_style( 'aurelia-theme', $css );
}
add_action( 'wp_enqueue_scripts', 'aurelia_block_style_css', 20 );
