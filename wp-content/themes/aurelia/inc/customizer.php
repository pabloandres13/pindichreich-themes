<?php
defined( 'ABSPATH' ) || exit;

function aurelia_customizer_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_panel( 'aurelia_panel', [
		'title'    => __( 'Aurelia Design', 'aurelia' ),
		'priority' => 30,
	] );

	/* ---- Praxis-Infos ---- */
	$wp_customize->add_section( 'aurelia_practice', [
		'title' => __( 'Praxis-Infos', 'aurelia' ),
		'panel' => 'aurelia_panel',
	] );

	$practice_settings = [
		'aurelia_practice_name'   => [ __( 'Praxisname', 'aurelia' ),                'Aurelia', 'text' ],
		'aurelia_hero_badge'      => [ __( 'Hero-Badge', 'aurelia' ),                'Praxis für ganzheitliche Gesundheit', 'text' ],
		'aurelia_hero_headline'   => [ __( 'Hero-Headline (Zeilen mit | trennen)', 'aurelia' ), 'Zur Ruhe kommen.|Gesund leben.', 'text' ],
		'aurelia_hero_lead'       => [ __( 'Hero-Leadtext', 'aurelia' ),             'Ganzheitliche Begleitung für Ernährung, Achtsamkeit und ein ausgeglichenes Leben — fachkundig und in Ihrem Tempo.', 'textarea' ],
		'aurelia_hero_proof'      => [ __( 'Hero-Vertrauenszeile', 'aurelia' ),      'Über 500 Menschen begleitet · 4,9 ★ Bewertung', 'text' ],
		'aurelia_about_title'     => [ __( 'Über-uns-Titel (Startseite)', 'aurelia' ), 'Ein Ort, an dem Sie ankommen dürfen', 'text' ],
		'aurelia_about_text'      => [ __( 'Über-uns-Text (Startseite)', 'aurelia' ), 'Seit über zehn Jahren begleiten wir Menschen auf ihrem Weg zu mehr Gesundheit und innerer Ruhe. Wir nehmen uns Zeit, hören zu und gehen Schritt für Schritt — fachkundig, ehrlich und ohne Druck.', 'textarea' ],
		'aurelia_phone'           => [ __( 'Telefon', 'aurelia' ),                   '+49 30 1234 567', 'text' ],
		'aurelia_email'           => [ __( 'E-Mail', 'aurelia' ),                    'hallo@aurelia-praxis.de', 'text' ],
		'aurelia_address'         => [ __( 'Adresse', 'aurelia' ),                   'Lindenstraße 12, 10115 Berlin', 'text' ],
		'aurelia_hours'           => [ __( 'Öffnungszeiten (Zeilen mit | trennen)', 'aurelia' ), 'Mo – Do;09:00 – 18:00|Freitag;09:00 – 14:00|Sa – So;Geschlossen', 'text' ],
		'aurelia_instagram'       => [ __( 'Instagram-URL', 'aurelia' ),             '#', 'text' ],
		'aurelia_facebook'        => [ __( 'Facebook-URL', 'aurelia' ),              '#', 'text' ],
		'aurelia_footer_tagline'  => [ __( 'Footer-Tagline', 'aurelia' ),            'Ganzheitliche Begleitung für Ernährung, Achtsamkeit und ein ausgeglichenes Leben — fachkundig und in Ihrem Tempo.', 'textarea' ],
		'aurelia_copyright'       => [ __( 'Copyright-Text', 'aurelia' ),            '© ' . date( 'Y' ) . ' Aurelia. Alle Rechte vorbehalten.', 'text' ],
		'aurelia_newsletter_url'  => [ __( 'Newsletter-Formular-URL (Action)', 'aurelia' ), '#', 'text' ],
	];

	foreach ( $practice_settings as $id => [ $label, $default, $type ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'textarea' === $type ? 'sanitize_textarea_field' : 'sanitize_text_field',
			'transport'         => 'refresh',
		] );
		$wp_customize->add_control( $id, [
			'label'   => $label,
			'section' => 'aurelia_practice',
			'type'    => $type,
		] );
	}

	/* ---- Farben ---- */
	$wp_customize->add_section( 'aurelia_colors', [
		'title' => __( 'Farben', 'aurelia' ),
		'panel' => 'aurelia_panel',
	] );

	$color_settings = [
		'aurelia_color_green'  => [ __( 'Heilgrün (Primär-Akzent)', 'aurelia' ),     '#6fb58e' ],
		'aurelia_color_blue'   => [ __( 'Sanftblau (Sekundär-Akzent)', 'aurelia' ),  '#a9cbd8' ],
		'aurelia_color_forest' => [ __( 'Waldgrün (Text + Buttons)', 'aurelia' ),    '#243b30' ],
		'aurelia_color_cream'  => [ __( 'Creme (Hintergrund)', 'aurelia' ),          '#f6faf7' ],
		'aurelia_color_sand'   => [ __( 'Sand (warmer Akzent)', 'aurelia' ),         '#ede7dd' ],
	];

	foreach ( $color_settings as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, [
			'label'   => $label,
			'section' => 'aurelia_colors',
		] ) );
	}

	/* ---- Bilder ---- */
	$wp_customize->add_section( 'aurelia_images', [
		'title' => __( 'Bilder', 'aurelia' ),
		'panel' => 'aurelia_panel',
	] );

	$image_settings = [
		'aurelia_hero_image'     => __( 'Hero-Bild (Natur, 4:5)', 'aurelia' ),
		'aurelia_portrait_image' => __( 'Porträt (Über uns)', 'aurelia' ),
	];

	foreach ( $image_settings as $id => $label ) {
		$wp_customize->add_setting( $id, [
			'default'           => '',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $id, [
			'label'     => $label,
			'section'   => 'aurelia_images',
			'mime_type' => 'image',
		] ) );
	}
}
add_action( 'customize_register', 'aurelia_customizer_register' );
