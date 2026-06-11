<?php
defined( 'ABSPATH' ) || exit;

/* ---- Custom block styles ---- */
function bm_register_block_styles(): void {
	register_block_style( 'core/button', [
		'name'  => 'bm-primary',
		'label' => __( 'Primär (Charcoal)', 'body-and-mind' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'bm-accent',
		'label' => __( 'Akzent (Lavendel)', 'body-and-mind' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'bm-secondary',
		'label' => __( 'Sekundär (Outline)', 'body-and-mind' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'bm-ghost',
		'label' => __( 'Ghost (Textlink)', 'body-and-mind' ),
	] );
	register_block_style( 'core/separator', [
		'name'  => 'bm-ornament',
		'label' => __( 'Ornament', 'body-and-mind' ),
	] );
}
add_action( 'init', 'bm_register_block_styles' );
