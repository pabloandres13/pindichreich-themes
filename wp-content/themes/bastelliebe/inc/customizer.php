<?php
/**
 * Customizer — brand, colours, social & newsletter controls.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;

function bl_customizer_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_panel( 'bl_panel', [
		'title'    => __( 'Bastelliebe Design', 'bastelliebe' ),
		'priority' => 30,
	] );

	/* ---- Marken-Infos ---- */
	$wp_customize->add_section( 'bl_brand', [
		'title' => __( 'Marke & Infos', 'bastelliebe' ),
		'panel' => 'bl_panel',
	] );

	$brand_settings = [
		'bl_site_name'       => [ __( 'Markenname', 'bastelliebe' ),            'Bastelliebe' ],
		'bl_tagline'         => [ __( 'Tagline', 'bastelliebe' ),              'Selbstgemacht mit Herz' ],
		'bl_author_name'     => [ __( 'Name (Über mich)', 'bastelliebe' ),      'Lena' ],
		'bl_tagline_footer'  => [ __( 'Footer-Text', 'bastelliebe' ),          'Kreative DIY-Anleitungen zum Nachmachen – einfach erklärt, mit Liebe gemacht.' ],
		'bl_copyright'       => [ __( 'Copyright-Text', 'bastelliebe' ),        '© ' . gmdate( 'Y' ) . ' Bastelliebe · Mit ♥ in Deutschland gemacht' ],
		'bl_instagram'       => [ __( 'Instagram-URL', 'bastelliebe' ),         '#' ],
		'bl_instagram_handle'=> [ __( 'Instagram-Handle', 'bastelliebe' ),      '@bastelliebe' ],
		'bl_pinterest'       => [ __( 'Pinterest-URL', 'bastelliebe' ),         '#' ],
		'bl_email'           => [ __( 'E-Mail', 'bastelliebe' ),               'hallo@bastelliebe.de' ],
		'bl_newsletter_url'  => [ __( 'Newsletter-Formular-URL', 'bastelliebe' ), '#' ],
	];

	foreach ( $brand_settings as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );
		$wp_customize->add_control( $id, [
			'label'   => $label,
			'section' => 'bl_brand',
			'type'    => 'text',
		] );
	}

	/* ---- Farben ---- */
	$wp_customize->add_section( 'bl_colors', [
		'title' => __( 'Farben', 'bastelliebe' ),
		'panel' => 'bl_panel',
	] );

	$color_settings = [
		'bl_color_coral'   => [ __( 'Koralle (Akzent / CTA)', 'bastelliebe' ),     '#E8654A' ],
		'bl_color_mustard' => [ __( 'Senf (Heimwerken)', 'bastelliebe' ),          '#E0A82E' ],
		'bl_color_teal'    => [ __( 'Petrol (Wohndeko)', 'bastelliebe' ),          '#2FA6A0' ],
		'bl_color_berry'   => [ __( 'Beere (Kinder)', 'bastelliebe' ),             '#C75B9E' ],
		'bl_color_cream'   => [ __( 'Creme (Hintergrund)', 'bastelliebe' ),        '#FBF7F0' ],
		'bl_color_ink'     => [ __( 'Anthrazit (Text)', 'bastelliebe' ),           '#2C2A27' ],
	];

	foreach ( $color_settings as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, [
			'label'   => $label,
			'section' => 'bl_colors',
		] ) );
	}

	/* ---- Bilder ---- */
	$wp_customize->add_section( 'bl_images', [
		'title' => __( 'Bilder', 'bastelliebe' ),
		'panel' => 'bl_panel',
	] );
	foreach ( [
		'bl_hero_image'     => __( 'Hero-Bild (Projekt der Woche)', 'bastelliebe' ),
		'bl_portrait_image' => __( 'Porträt (Über mich)', 'bastelliebe' ),
	] as $id => $label ) {
		$wp_customize->add_setting( $id, [
			'default'           => '',
			'sanitize_callback' => 'absint',
		] );
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $id, [
			'label'     => $label,
			'section'   => 'bl_images',
			'mime_type' => 'image',
		] ) );
	}
}
add_action( 'customize_register', 'bl_customizer_register' );
