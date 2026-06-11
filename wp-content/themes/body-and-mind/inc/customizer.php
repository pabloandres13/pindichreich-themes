<?php
defined( 'ABSPATH' ) || exit;

function bm_customizer_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_panel( 'bm_panel', [
		'title'    => __( 'Body & Mind Design', 'body-and-mind' ),
		'priority' => 30,
	] );

	/* ---- Studio info ---- */
	$wp_customize->add_section( 'bm_studio', [
		'title' => __( 'Studio-Infos', 'body-and-mind' ),
		'panel' => 'bm_panel',
	] );

	$studio_settings = [
		'bm_studio_name'    => [ __( 'Studioname', 'body-and-mind' ),              'Lichtraum' ],
		'bm_studio_tagline' => [ __( 'Tagline (Kursiv-Spruch)', 'body-and-mind' ), 'Atme. Du bist hier richtig.' ],
		'bm_studio_headline'=> [ __( 'Hero-Headline', 'body-and-mind' ),           "Ankommen,\ndurchatmen,\nin Bewegung kommen." ],
		'bm_studio_lead'    => [ __( 'Hero-Leadtext', 'body-and-mind' ),           'Ein heller Ort für Yoga, Meditation und Personal Training. Komm vorbei und probiere eine Stunde ganz unverbindlich aus.' ],
		'bm_studio_address' => [ __( 'Adresse', 'body-and-mind' ),                 'Lichtweg 12, 20253 Hamburg' ],
		'bm_studio_hours'   => [ __( 'Öffnungszeiten', 'body-and-mind' ),          'Mo–Fr 08–21 Uhr · Sa 09–14 Uhr' ],
		'bm_studio_phone'   => [ __( 'Telefon', 'body-and-mind' ),                 '040 123 456 78' ],
		'bm_studio_email'   => [ __( 'E-Mail', 'body-and-mind' ),                  'hallo@studio.de' ],
		'bm_studio_instagram' => [ __( 'Instagram-URL', 'body-and-mind' ),         '#' ],
		'bm_studio_about_name' => [ __( 'Trainer-Name', 'body-and-mind' ),         'Lena' ],
		'bm_studio_about_text' => [ __( 'Über-mich-Text', 'body-and-mind' ),       'Seit neun Jahren begleite ich Menschen auf ihrem Weg zu mehr Ruhe und Beweglichkeit. In meinem Studio soll sich jede willkommen fühlen — ganz gleich, wo du gerade stehst.' ],
		'bm_studio_copyright' => [ __( 'Copyright-Text', 'body-and-mind' ),        '© 2026 Lichtraum Studio' ],
		'bm_newsletter_url'   => [ __( 'Newsletter-Formular-URL', 'body-and-mind' ), '#' ],
	];

	foreach ( $studio_settings as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );
		$wp_customize->add_control( $id, [
			'label'   => $label,
			'section' => 'bm_studio',
			'type'    => 'text',
		] );
	}

	/* ---- Colors ---- */
	$wp_customize->add_section( 'bm_colors', [
		'title' => __( 'Farben', 'body-and-mind' ),
		'panel' => 'bm_panel',
	] );

	$color_settings = [
		'bm_color_lavender' => [ __( 'Lavendel (Primär-Akzent)', 'body-and-mind' ), '#c9b8e8' ],
		'bm_color_sage'     => [ __( 'Salbei (Sekundär-Akzent)', 'body-and-mind' ), '#a8c3a0' ],
		'bm_color_cream'    => [ __( 'Creme (Hintergrund)', 'body-and-mind' ),      '#fbf8f4' ],
		'bm_color_ink'      => [ __( 'Charcoal (Text + Buttons)', 'body-and-mind' ), '#2e2a28' ],
	];

	foreach ( $color_settings as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, [
			'label'   => $label,
			'section' => 'bm_colors',
		] ) );
	}

	/* ---- Hero image ---- */
	$wp_customize->add_section( 'bm_hero', [
		'title' => __( 'Hero-Bild', 'body-and-mind' ),
		'panel' => 'bm_panel',
	] );
	$wp_customize->add_setting( 'bm_hero_image', [
		'default'           => '',
		'sanitize_callback' => 'absint',
	] );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'bm_hero_image', [
		'label'     => __( 'Hero-Bild', 'body-and-mind' ),
		'section'   => 'bm_hero',
		'mime_type' => 'image',
	] ) );
	$wp_customize->add_setting( 'bm_portrait_image', [
		'default'           => '',
		'sanitize_callback' => 'absint',
	] );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'bm_portrait_image', [
		'label'     => __( 'Trainer-Porträt', 'body-and-mind' ),
		'section'   => 'bm_hero',
		'mime_type' => 'image',
	] ) );
}
add_action( 'customize_register', 'bm_customizer_register' );
