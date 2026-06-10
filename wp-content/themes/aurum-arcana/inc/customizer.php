<?php
/**
 * Aurum Arcana — Customizer Controls
 * All brand/content settings surfaced here so non-technical users
 * never need to touch PHP or CSS.
 */

add_action( 'customize_register', 'aurum_customizer_register' );
function aurum_customizer_register( WP_Customize_Manager $wp_customize ): void {

	/* ---- Panel ------------------------------------------ */
	$wp_customize->add_panel( 'aurum_panel', [
		'title'    => __( 'Aurum Arcana Design', 'aurum-arcana' ),
		'priority' => 160,
	] );

	/* ============================================================
	   COLORS SECTION
	   ============================================================ */
	$wp_customize->add_section( 'aurum_colors', [
		'title' => __( 'Colors', 'aurum-arcana' ),
		'panel' => 'aurum_panel',
	] );

	$color_settings = [
		'aurum_color_accent'    => [ __( 'Accent gold',   'aurum-arcana' ), '#C8A24A' ],
		'aurum_color_bg'        => [ __( 'Background',     'aurum-arcana' ), '#0E0D0F' ],
		'aurum_color_surface'   => [ __( 'Card surface',   'aurum-arcana' ), '#1B1714' ],
		'aurum_color_parchment' => [ __( 'Body text',      'aurum-arcana' ), '#EDE6D6' ],
	];

	foreach ( $color_settings as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, [
			'label'   => $label,
			'section' => 'aurum_colors',
		] ) );
	}

	/* ============================================================
	   PUBLICATION INFO SECTION
	   ============================================================ */
	$wp_customize->add_section( 'aurum_info', [
		'title' => __( 'Publication Info', 'aurum-arcana' ),
		'panel' => 'aurum_panel',
	] );

	$text_settings = [
		'aurum_pub_name'      => [ __( 'Publication name',     'aurum-arcana' ), 'Aurum Arcana' ],
		'aurum_pub_tagline'   => [ __( 'Tagline / sub-title',  'aurum-arcana' ), 'A study of the old arts — tarot, the wheel of the stars, alchemy, and the quiet grammar of symbols.' ],
		'aurum_author_name'   => [ __( 'Practitioner name',    'aurum-arcana' ), 'Mara Voss' ],
		'aurum_author_bio'    => [ __( 'Practitioner bio',     'aurum-arcana' ), 'For twenty years I have read cards and charts for seekers across the world. Aurum Arcana is my study made public.' ],
		'aurum_footer_motto'  => [ __( 'Footer motto',         'aurum-arcana' ), 'Per Aspera Ad Astra' ],
		'aurum_social_instagram' => [ __( 'Instagram URL',     'aurum-arcana' ), '' ],
		'aurum_social_newsletter' => [ __( 'Newsletter sign-up URL', 'aurum-arcana' ), '' ],
	];

	foreach ( $text_settings as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( $id, [
			'label'   => $label,
			'section' => 'aurum_info',
			'type'    => 'text',
		] );
	}

	/* ============================================================
	   READINGS / OFFERINGS SECTION
	   ============================================================ */
	$wp_customize->add_section( 'aurum_readings', [
		'title' => __( 'Readings & Offerings', 'aurum-arcana' ),
		'panel' => 'aurum_panel',
	] );

	$reading_settings = [
		'aurum_reading_title'  => [ __( 'Signature reading title', 'aurum-arcana' ), 'An hour with the cards' ],
		'aurum_reading_desc'   => [ __( 'Signature reading description', 'aurum-arcana' ), 'A full Celtic-cross reading, recorded and transcribed, with a written letter of reflection sent within three days.' ],
		'aurum_reading_price'  => [ __( 'Price (e.g. $180)', 'aurum-arcana' ), '$180' ],
		'aurum_reading_url'    => [ __( 'Booking URL', 'aurum-arcana' ), '' ],
	];

	foreach ( $reading_settings as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( $id, [
			'label'   => $label,
			'section' => 'aurum_readings',
			'type'    => 'text',
		] );
	}

	/* ============================================================
	   NEWSLETTER SECTION
	   ============================================================ */
	$wp_customize->add_section( 'aurum_newsletter', [
		'title' => __( 'Newsletter', 'aurum-arcana' ),
		'panel' => 'aurum_panel',
	] );

	$nl_settings = [
		'aurum_nl_eyebrow' => [ __( 'Eyebrow label',  'aurum-arcana' ), 'Join the Circle' ],
		'aurum_nl_title'   => [ __( 'Heading',         'aurum-arcana' ), 'Receive the dispatches' ],
		'aurum_nl_sub'     => [ __( 'Sub-text',        'aurum-arcana' ), 'Monthly letters on tarot, the stars, and the old arts. No noise — only signal from the veil.' ],
		'aurum_nl_url'     => [ __( 'Form action URL', 'aurum-arcana' ), '' ],
	];

	foreach ( $nl_settings as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( $id, [
			'label'   => $label,
			'section' => 'aurum_newsletter',
			'type'    => 'text',
		] );
	}
}
