<?php
/**
 * Gutenberg block styles.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;

function bl_register_block_styles(): void {
	register_block_style( 'core/button', [
		'name'  => 'bl-primary',
		'label' => __( 'Primär (Koralle)', 'bastelliebe' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'bl-secondary',
		'label' => __( 'Sekundär (Outline)', 'bastelliebe' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'bl-ghost',
		'label' => __( 'Ghost (Soft)', 'bastelliebe' ),
	] );
}
add_action( 'init', 'bl_register_block_styles' );
