<?php
/**
 * Customizer — brand colours, brand info, newsletter URL, imagery.
 * Everything a non-technical owner changes about brand/identity lives here;
 * everything they change about content lives in the block editor.
 *
 * @package celestine
 */

defined( 'ABSPATH' ) || exit;

function cel_customizer_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_panel( 'cel_panel', [
		'title'    => __( 'Celestine Design', 'celestine' ),
		'priority' => 30,
	] );

	/* ---- Brand info ---- */
	$wp_customize->add_section( 'cel_brand', [
		'title' => __( 'Brand & contact', 'celestine' ),
		'panel' => 'cel_panel',
	] );

	$brand_settings = [
		'cel_brand_name' => [ __( 'Brand name', 'celestine' ),       'Celestine' ],
		'cel_tagline'    => [ __( 'Tagline (script)', 'celestine' ), 'Return to the stars within' ],
		'cel_email'      => [ __( 'Contact e-mail', 'celestine' ),   '' ],
		'cel_instagram'  => [ __( 'Instagram URL', 'celestine' ),    '' ],
		'cel_copyright'  => [ __( 'Copyright text', 'celestine' ),   '© ' . gmdate( 'Y' ) . ' Celestine' ],
	];

	foreach ( $brand_settings as $id => [ $label, $default ] ) {
		$is_url = in_array( $id, [ 'cel_instagram' ], true );
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => $is_url ? 'esc_url_raw' : 'sanitize_text_field',
			'transport'         => 'refresh',
		] );
		$wp_customize->add_control( $id, [
			'label'   => $label,
			'section' => 'cel_brand',
			'type'    => $is_url ? 'url' : 'text',
		] );
	}

	/* ---- Newsletter ---- */
	$wp_customize->add_section( 'cel_newsletter', [
		'title' => __( 'Newsletter', 'celestine' ),
		'panel' => 'cel_panel',
	] );
	$wp_customize->add_setting( 'cel_newsletter_url', [
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	] );
	$wp_customize->add_control( 'cel_newsletter_url', [
		'label'       => __( 'Newsletter form action URL', 'celestine' ),
		'description' => __( 'Where the “Join the Circle” form submits (e.g. your Mailchimp / Buttondown endpoint).', 'celestine' ),
		'section'     => 'cel_newsletter',
		'type'        => 'url',
	] );

	/* ---- Colours ---- */
	$wp_customize->add_section( 'cel_colors', [
		'title' => __( 'Colours', 'celestine' ),
		'panel' => 'cel_panel',
	] );

	$color_settings = [
		'cel_color_cosmos' => [ __( 'Cosmic indigo (background)', 'celestine' ), '#0E1230' ],
		'cel_color_violet' => [ __( 'Deep violet (depth tone)', 'celestine' ),   '#241640' ],
		'cel_color_gold'   => [ __( 'Luminous gold (accent)', 'celestine' ),     '#D9B45B' ],
		'cel_color_silver' => [ __( 'Moonlight silver (jewel)', 'celestine' ),   '#C9D2E3' ],
	];

	foreach ( $color_settings as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, [
			'label'   => $label,
			'section' => 'cel_colors',
		] ) );
	}
}
add_action( 'customize_register', 'cel_customizer_register' );
