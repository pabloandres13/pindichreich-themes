<?php
defined( 'ABSPATH' ) || exit;

/**
 * Culinary Customizer settings.
 */
function culinary_customizer( WP_Customize_Manager $wp_customize ): void {

	// ============================================================
	// Panel: Culinary Design
	// ============================================================
	$wp_customize->add_panel( 'culinary_design', [
		'title'    => __( 'Culinary Design', 'culinary' ),
		'priority' => 30,
	] );

	// ---- Section: Colors ----
	$wp_customize->add_section( 'culinary_colors', [
		'title'    => __( 'Colors', 'culinary' ),
		'panel'    => 'culinary_design',
		'priority' => 10,
	] );

	$colors = [
		'culinary_color_terracotta' => [ __( 'Primary accent (Terracotta)', 'culinary' ), '#C4622D' ],
		'culinary_color_sage'       => [ __( 'Secondary accent (Sage)', 'culinary' ),      '#7A8B6F' ],
		'culinary_color_cream'      => [ __( 'Background (Cream)', 'culinary' ),           '#FAF7F2' ],
		'culinary_color_ink'        => [ __( 'Text / Ink', 'culinary' ),                   '#2B2622' ],
	];

	foreach ( $colors as $key => [$label, $default] ) {
		$wp_customize->add_setting( $key, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, [
			'label'   => $label,
			'section' => 'culinary_colors',
		] ) );
	}

	// ---- Section: Blog info ----
	$wp_customize->add_section( 'culinary_blog_info', [
		'title'    => __( 'Blog info', 'culinary' ),
		'panel'    => 'culinary_design',
		'priority' => 20,
	] );

	$blog_fields = [
		'culinary_author_name' => [ __( 'Author name', 'culinary' ),          'text',  '' ],
		'culinary_author_bio'  => [ __( 'Author bio (short)', 'culinary' ),   'textarea', '' ],
		'culinary_author_photo'=> [ __( 'Author photo URL', 'culinary' ),     'url',   '' ],
		'culinary_instagram'   => [ __( 'Instagram URL', 'culinary' ),        'url',   '' ],
		'culinary_facebook'    => [ __( 'Facebook URL', 'culinary' ),         'url',   '' ],
		'culinary_youtube'     => [ __( 'YouTube URL', 'culinary' ),          'url',   '' ],
		'culinary_footer_note' => [ __( 'Footer tagline', 'culinary' ),       'text',  __( 'Made with care, in a small kitchen.', 'culinary' ) ],
	];

	foreach ( $blog_fields as $key => [$label, $type, $default] ) {
		$wp_customize->add_setting( $key, [
			'default'           => $default,
			'sanitize_callback' => $type === 'url' ? 'esc_url_raw' : 'sanitize_text_field',
		] );
		$wp_customize->add_control( $key, [
			'label'   => $label,
			'section' => 'culinary_blog_info',
			'type'    => $type === 'textarea' ? 'textarea' : 'text',
		] );
	}

	// ---- Section: Newsletter ----
	$wp_customize->add_section( 'culinary_newsletter', [
		'title'    => __( 'Newsletter', 'culinary' ),
		'panel'    => 'culinary_design',
		'priority' => 30,
	] );

	$nl_fields = [
		'culinary_newsletter_url'   => [ __( 'Form action URL', 'culinary' ),  'url',      '#' ],
		'culinary_newsletter_title' => [ __( 'Newsletter headline', 'culinary' ), 'text', __( 'New recipes in your inbox', 'culinary' ) ],
		'culinary_newsletter_body'  => [ __( 'Newsletter copy', 'culinary' ),  'textarea', __( 'One warm, seasonal recipe each week — plus the odd kitchen note. No spam, unsubscribe anytime.', 'culinary' ) ],
	];

	foreach ( $nl_fields as $key => [$label, $type, $default] ) {
		$wp_customize->add_setting( $key, [
			'default'           => $default,
			'sanitize_callback' => $type === 'url' ? 'esc_url_raw' : 'sanitize_text_field',
		] );
		$wp_customize->add_control( $key, [
			'label'   => $label,
			'section' => 'culinary_newsletter',
			'type'    => $type === 'textarea' ? 'textarea' : 'text',
		] );
	}
}
add_action( 'customize_register', 'culinary_customizer' );
