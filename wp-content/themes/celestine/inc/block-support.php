<?php
/**
 * Gutenberg block styles.
 *
 * @package celestine
 */

defined( 'ABSPATH' ) || exit;

function cel_register_block_styles(): void {
	register_block_style( 'core/button', [
		'name'  => 'cel-primary',
		'label' => __( 'Gold (primary)', 'celestine' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'cel-secondary',
		'label' => __( 'Outline (secondary)', 'celestine' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'cel-ghost',
		'label' => __( 'Ghost (text link)', 'celestine' ),
	] );
	register_block_style( 'core/separator', [
		'name'  => 'cel-gold-rule',
		'label' => __( 'Gold hairline', 'celestine' ),
	] );
}
add_action( 'init', 'cel_register_block_styles' );

/**
 * Gold hairline separator style.
 */
function cel_block_styles_inline(): void {
	wp_register_style( 'celestine-block-styles', false, [], wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'celestine-block-styles' );
	$css = '.wp-block-separator.is-style-cel-gold-rule{border:0;height:1px;max-width:var(--container-text);background:var(--rule-gold);}';
	wp_add_inline_style( 'celestine-block-styles', $css );
}
add_action( 'wp_enqueue_scripts', 'cel_block_styles_inline' );
