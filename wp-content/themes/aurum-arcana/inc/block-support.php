<?php
/**
 * Aurum Arcana — Gutenberg / Block Editor Support
 */

/* Enqueue tokens in the block editor canvas */
add_action( 'enqueue_block_editor_assets', 'aurum_editor_assets' );
function aurum_editor_assets(): void {
	wp_enqueue_style(
		'aurum-editor-tokens',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[],
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style(
		'phosphor-editor',
		'https://unpkg.com/@phosphor-icons/web@2.1.1/src/thin/style.css',
		[],
		'2.1.1'
	);
}

/* Custom block styles */
add_action( 'init', 'aurum_register_block_styles' );
function aurum_register_block_styles(): void {

	/* Buttons — make native core/button render as the gold aa-btn family, so a
	   site owner builds CTAs with the normal Buttons block and editable labels.
	   The actual CSS lives in assets/css/theme.css + editor.css (loaded in both
	   contexts) so the rules apply on the front end and inside the editor. */
	register_block_style( 'core/button', [
		'name'  => 'aa-primary',
		'label' => __( 'Aurum Primary', 'aurum-arcana' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'aa-secondary',
		'label' => __( 'Aurum Secondary', 'aurum-arcana' ),
	] );
	register_block_style( 'core/button', [
		'name'  => 'aa-ghost',
		'label' => __( 'Aurum Ghost', 'aurum-arcana' ),
	] );

	register_block_style( 'core/quote', [
		'name'  => 'pull-quote',
		'label' => __( 'Pull Quote', 'aurum-arcana' ),
		'inline_style' => '
			.is-style-pull-quote {
				border-left: 2px solid var(--accent, #C8A24A);
				border-right: none;
				border-top: none;
				border-bottom: none;
				padding: 8px 0 8px 28px;
				font-family: var(--font-display, Cormorant, serif);
				font-style: italic;
				font-size: 30px;
				line-height: 1.3;
				color: var(--text-body, #EDE6D6);
			}
		',
	] );

	register_block_style( 'core/paragraph', [
		'name'  => 'ritual-note',
		'label' => __( 'Ritual Note', 'aurum-arcana' ),
		'inline_style' => '
			.is-style-ritual-note {
				padding: 20px 24px;
				background: rgba(200,162,74,.05);
				border: 1px solid rgba(200,162,74,.45);
				border-radius: 4px;
				font-family: var(--font-body, EB Garamond, serif);
				font-size: 18px;
				color: var(--text-secondary, #D9D2C5);
				line-height: 1.7;
			}
		',
	] );

	register_block_style( 'core/group', [
		'name'  => 'dark-card',
		'label' => __( 'Dark Card', 'aurum-arcana' ),
		'inline_style' => '
			.is-style-dark-card {
				background: var(--surface-card, #1B1714);
				border: 1px solid rgba(200,162,74,.22);
				border-radius: 8px;
				padding: 32px;
				box-shadow: 0 12px 34px rgba(0,0,0,.55);
			}
		',
	] );
}
