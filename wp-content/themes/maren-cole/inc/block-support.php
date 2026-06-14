<?php
/**
 * Gutenberg block styles.
 *
 * @package maren-cole
 */

defined( 'ABSPATH' ) || exit;

function mc_register_block_styles(): void {
	register_block_style( 'core/button', [
		'name'         => 'mc-primary',
		'label'        => __( 'Primary (Clay)', 'maren-cole' ),
		'is_default'   => true,
	] );
	register_block_style( 'core/button', [
		'name'  => 'mc-secondary',
		'label' => __( 'Secondary (Outline)', 'maren-cole' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'mc-ghost',
		'label' => __( 'Ghost (Quiet)', 'maren-cole' ),
	] );
}
add_action( 'init', 'mc_register_block_styles' );
