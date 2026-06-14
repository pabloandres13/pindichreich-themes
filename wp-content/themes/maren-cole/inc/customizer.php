<?php
/**
 * Customizer — brand info, booking, colors, imagery.
 * Everything a non-technical coach needs to rebrand the site lives here.
 *
 * @package maren-cole
 */

defined( 'ABSPATH' ) || exit;

function mc_customizer_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_panel( 'mc_panel', [
		'title'    => __( 'Maren Cole Design', 'maren-cole' ),
		'priority' => 30,
	] );

	/* ---- Brand info ---- */
	$wp_customize->add_section( 'mc_brand', [
		'title' => __( 'Brand & contact', 'maren-cole' ),
		'panel' => 'mc_panel',
	] );

	$text_settings = [
		'mc_brand_name'      => [ __( 'Brand name', 'maren-cole' ),            'Maren Cole' ],
		'mc_footer_tagline'  => [ __( 'Footer tagline', 'maren-cole' ),        'Executive & leadership coaching for people who carry a lot — and want to keep their edge.' ],
		'mc_copyright'       => [ __( 'Copyright line', 'maren-cole' ),        '© ' . gmdate( 'Y' ) . ' Maren Cole Coaching' ],
		'mc_email'           => [ __( 'Email', 'maren-cole' ),                 'hello@marencole.com' ],
		'mc_instagram'       => [ __( 'Instagram URL', 'maren-cole' ),         '' ],
		'mc_linkedin'        => [ __( 'LinkedIn URL', 'maren-cole' ),          '' ],
		'mc_youtube'         => [ __( 'YouTube URL', 'maren-cole' ),           '' ],
		'mc_announce_text'   => [ __( 'Announcement bar text', 'maren-cole' ), 'Free guide — The Calm Operator’s Playbook: 7 rituals for leading under pressure.' ],
		'mc_announce_url'    => [ __( 'Announcement bar link', 'maren-cole' ),  '' ],
	];
	foreach ( $text_settings as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		] );
		$wp_customize->add_control( $id, [
			'label'   => $label,
			'section' => 'mc_brand',
			'type'    => 'text',
		] );
	}

	/* ---- Booking ---- */
	$wp_customize->add_section( 'mc_booking', [
		'title'       => __( 'Booking', 'maren-cole' ),
		'description' => __( 'Paste your scheduler link (Calendly, TidyCal, Acuity, Amelia…). Every “Book a discovery call” button points here. Leave blank to use the Contact page.', 'maren-cole' ),
		'panel'       => 'mc_panel',
	] );
	$wp_customize->add_setting( 'mc_booking_url', [
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	] );
	$wp_customize->add_control( 'mc_booking_url', [
		'label'   => __( 'Scheduler / booking URL', 'maren-cole' ),
		'section' => 'mc_booking',
		'type'    => 'url',
	] );
	$wp_customize->add_setting( 'mc_newsletter_url', [
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	] );
	$wp_customize->add_control( 'mc_newsletter_url', [
		'label'       => __( 'Newsletter / opt-in form action URL', 'maren-cole' ),
		'description' => __( 'Where the lead-magnet form posts (Mailchimp, ConvertKit, Fluent Forms…). Leave blank for a demo success message.', 'maren-cole' ),
		'section'     => 'mc_booking',
		'type'        => 'url',
	] );

	/* ---- Colors ---- */
	$wp_customize->add_section( 'mc_colors', [
		'title' => __( 'Colors', 'maren-cole' ),
		'panel' => 'mc_panel',
	] );
	$color_settings = [
		'mc_color_clay'  => [ __( 'Clay (accent — buttons, links)', 'maren-cole' ), '#C0613D' ],
		'mc_color_cream' => [ __( 'Cream (page background)', 'maren-cole' ),         '#FBF8F4' ],
		'mc_color_ink'   => [ __( 'Ink (text, dark bands)', 'maren-cole' ),          '#1A1610' ],
	];
	foreach ( $color_settings as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
		] );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, [
			'label'   => $label,
			'section' => 'mc_colors',
		] ) );
	}
}
add_action( 'customize_register', 'mc_customizer_register' );
