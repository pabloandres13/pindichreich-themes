<?php
defined( 'ABSPATH' ) || exit;

/* Register custom block styles */
function mamaglueck_register_block_styles() {
	register_block_style( 'core/button', [
		'name'  => 'pill-primary',
		'label' => __( 'Pill (Coral)', 'mamaglueck' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'pill-ghost',
		'label' => __( 'Pill (Ghost)', 'mamaglueck' ),
	] );
	register_block_style( 'core/group', [
		'name'  => 'card',
		'label' => __( 'Karte', 'mamaglueck' ),
	] );
	register_block_style( 'core/quote', [
		'name'  => 'speech-bubble',
		'label' => __( 'Sprechblase', 'mamaglueck' ),
	] );
}
add_action( 'init', 'mamaglueck_register_block_styles' );

/* Inline CSS for custom block styles in the editor */
function mamaglueck_block_editor_assets() {
	$css = '
		.is-style-pill-primary .wp-block-button__link {
			background: #FF7A59; color: #fff; border-radius: 999px;
			box-shadow: 0 14px 28px rgba(255,122,89,0.28); border: none;
		}
		.is-style-pill-ghost .wp-block-button__link {
			background: transparent; color: #2B2A3D;
			border-radius: 999px; border: 2px solid #FFD3C4;
		}
		.is-style-card {
			background: #fff; border-radius: 22px;
			box-shadow: 0 4px 14px rgba(43,42,61,0.06);
			padding: 2rem !important;
		}
		.is-style-speech-bubble {
			background: #fff; border-radius: 32px;
			box-shadow: 0 4px 14px rgba(43,42,61,0.06);
			border-left: none; padding: 2rem;
		}
	';
	wp_add_inline_style( 'wp-block-library', $css );
}
add_action( 'enqueue_block_editor_assets', 'mamaglueck_block_editor_assets' );
