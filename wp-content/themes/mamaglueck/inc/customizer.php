<?php
defined( 'ABSPATH' ) || exit;

function mamaglueck_customizer_register( WP_Customize_Manager $wp_customize ) {

	/* ---- Panel ---- */
	$wp_customize->add_panel( 'mamaglueck_design', [
		'title'    => __( 'Mamaglück Design', 'mamaglueck' ),
		'priority' => 30,
	] );

	/* ---- Section: Colors ---- */
	$wp_customize->add_section( 'mamaglueck_colors', [
		'title'    => __( 'Farben', 'mamaglueck' ),
		'panel'    => 'mamaglueck_design',
		'priority' => 10,
	] );

	$color_controls = [
		'mg_color_coral'  => [ __( 'Primärfarbe (Coral)', 'mamaglueck' ),  '#FF7A59' ],
		'mg_color_teal'   => [ __( 'Sekundärfarbe (Teal)', 'mamaglueck' ), '#54B7A6' ],
		'mg_color_yellow' => [ __( 'Akzentfarbe (Gelb)', 'mamaglueck' ),   '#FFC247' ],
		'mg_color_ink'    => [ __( 'Textfarbe (Dunkel)', 'mamaglueck' ),    '#2B2A3D' ],
		'mg_color_cream'  => [ __( 'Hintergrund (Creme)', 'mamaglueck' ),  '#F0F5FA' ],
		'mg_color_blush'  => [ __( 'Sanfter Ton (Blush)', 'mamaglueck' ),  '#FFE6DC' ],
	];

	foreach ( $color_controls as $setting_id => [ $label, $default ] ) {
		$wp_customize->add_setting( $setting_id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		] );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, [
			'label'   => $label,
			'section' => 'mamaglueck_colors',
		] ) );
	}

	/* ---- Section: Typography ---- */
	$wp_customize->add_section( 'mamaglueck_typography', [
		'title'    => __( 'Typografie', 'mamaglueck' ),
		'panel'    => 'mamaglueck_design',
		'priority' => 20,
	] );

	$wp_customize->add_setting( 'mg_font_display', [
		'default'           => 'Fredoka',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	] );
	$wp_customize->add_control( 'mg_font_display', [
		'label'   => __( 'Schrift: Überschriften', 'mamaglueck' ),
		'section' => 'mamaglueck_typography',
		'type'    => 'select',
		'choices' => [
			'Fredoka'   => 'Fredoka',
			'Baloo 2'   => 'Baloo 2',
			'Quicksand' => 'Quicksand',
		],
	] );

	$wp_customize->add_setting( 'mg_font_body', [
		'default'           => 'Nunito',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	] );
	$wp_customize->add_control( 'mg_font_body', [
		'label'   => __( 'Schrift: Fließtext', 'mamaglueck' ),
		'section' => 'mamaglueck_typography',
		'type'    => 'select',
		'choices' => [
			'Nunito' => 'Nunito',
			'Mulish' => 'Mulish',
			'Inter'  => 'Inter',
		],
	] );

	/* ---- Section: Blog info ---- */
	$wp_customize->add_section( 'mamaglueck_blog', [
		'title'    => __( 'Blog-Informationen', 'mamaglueck' ),
		'panel'    => 'mamaglueck_design',
		'priority' => 30,
	] );

	$blog_settings = [
		'mg_author_name'       => [ __( 'Name der Autorin', 'mamaglueck' ),          'Anna' ],
		'mg_author_location'   => [ __( 'Wohnort der Autorin', 'mamaglueck' ),       'Hamburg' ],
		'mg_author_bio'        => [ __( 'Kurz-Bio (Intro-Sektion)', 'mamaglueck' ),  'Zweifach-Mama, Kaffee-Liebhaberin und Chaos-Managerin. Hier teile ich, was bei uns wirklich passiert: die schönen Momente, die anstrengenden Tage und alles dazwischen.' ],
		'mg_instagram_handle'  => [ __( 'Instagram-Handle (ohne @)', 'mamaglueck' ), 'mamaglueck' ],
		'mg_newsletter_action' => [ __( 'Newsletter-Formular-URL', 'mamaglueck' ),   '#' ],
	];

	foreach ( $blog_settings as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, [
			'default'           => $default,
			'sanitize_callback' => 'sanitize_text_field',
		] );
		$wp_customize->add_control( $id, [
			'label'   => $label,
			'section' => 'mamaglueck_blog',
			'type'    => strlen( $default ) > 80 ? 'textarea' : 'text',
		] );
	}

	// Bio as textarea
	$wp_customize->get_control( 'mg_author_bio' )->type = 'textarea';
}
add_action( 'customize_register', 'mamaglueck_customizer_register' );

/* Live-preview JS for colour custom props */
function mamaglueck_customizer_preview_js() {
	?>
	<script>
	(function($){
		var props = {
			mg_color_coral:  '--coral',
			mg_color_teal:   '--teal',
			mg_color_yellow: '--yellow',
			mg_color_ink:    '--ink',
			mg_color_cream:  '--cream',
			mg_color_blush:  '--blush',
		};
		$.each(props, function(setting, prop){
			wp.customize(setting, function(value){
				value.bind(function(newval){
					document.documentElement.style.setProperty(prop, newval);
				});
			});
		});
	}(jQuery));
	</script>
	<?php
}
add_action( 'customize_preview_init', function () {
	add_action( 'wp_footer', 'mamaglueck_customizer_preview_js' );
} );
