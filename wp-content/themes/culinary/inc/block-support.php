<?php
defined( 'ABSPATH' ) || exit;

/**
 * Gutenberg / block editor enhancements.
 */

/**
 * Enqueue block editor assets for the culinary theme.
 */
function culinary_block_editor_assets(): void {
	wp_enqueue_style(
		'culinary-tokens',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'enqueue_block_editor_assets', 'culinary_block_editor_assets' );

/**
 * Register custom block styles.
 */
function culinary_register_block_styles(): void {
	// Pill buttons
	register_block_style( 'core/button', [
		'name'  => 'pill',
		'label' => __( 'Pill', 'culinary' ),
	] );

	// Recipe callout (tip)
	register_block_style( 'core/quote', [
		'name'  => 'tip',
		'label' => __( 'Kitchen tip', 'culinary' ),
	] );

	// Photo card
	register_block_style( 'core/image', [
		'name'  => 'rounded',
		'label' => __( 'Rounded', 'culinary' ),
	] );

	// Brand button variants (used by the home block patterns; styled in theme.css)
	register_block_style( 'core/button', [
		'name'  => 'culinary-primary',
		'label' => __( 'Culinary primary', 'culinary' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'culinary-secondary',
		'label' => __( 'Culinary secondary', 'culinary' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'culinary-ghost',
		'label' => __( 'Culinary ghost link', 'culinary' ),
	] );
}
add_action( 'init', 'culinary_register_block_styles' );

/**
 * Map block style names to CSS classes — defined in theme.css.
 */
add_action( 'wp_head', function () {
	echo '<style>
		.wp-block-button__link.is-style-pill { border-radius: var(--radius-pill); }
		.wp-block-quote.is-style-tip {
			background: var(--accent-2-tint);
			border-left: 3px solid var(--accent-2);
			border-radius: var(--radius-md);
			padding: var(--space-5) var(--space-6);
			font-style: normal;
		}
		.wp-block-image.is-style-rounded img { border-radius: var(--radius-lg); }
	</style>';
} );
