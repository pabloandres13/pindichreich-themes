<?php
/**
 * Core setup for the Travel and Adventure child theme.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers child theme supports and nav menus.
 *
 * @return void
 */
function taa_theme_setup() {
	add_theme_support(
		'custom-header',
		array(
			'width'              => 1920,
			'height'             => 720,
			'flex-width'         => true,
			'flex-height'        => true,
			'header-text'        => false,
			'default-text-color' => '0f3557',
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'travel-and-adventure' ),
			'footer'  => __( 'Footer Menu', 'travel-and-adventure' ),
		)
	);

	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'taa_theme_setup', 20 );

/**
 * Enqueues child theme assets after the Astra parent styles.
 *
 * @return void
 */
function taa_enqueue_assets() {
	wp_enqueue_style(
		'frk-child-theme',
		get_stylesheet_uri(),
		array( 'astra-theme-css' ),
		FLK_THEME_VERSION
	);

	wp_enqueue_style(
		'frk-editorial',
		FLK_THEME_URI . 'assets/css/editorial.css',
		array( 'frk-child-theme' ),
		FLK_THEME_VERSION
	);

	wp_enqueue_style(
		'frk-global',
		FLK_THEME_URI . 'assets/css/global.css',
		array( 'frk-editorial' ),
		FLK_THEME_VERSION
	);

	wp_enqueue_style(
		'frk-fonts',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);

	if ( is_front_page() ) {
		wp_enqueue_style(
			'frk-front-page',
			FLK_THEME_URI . 'assets/css/front-page.css',
			array( 'frk-editorial' ),
			FLK_THEME_VERSION
		);
	}

	wp_enqueue_script(
		'frk-navigation',
		FLK_THEME_URI . 'assets/js/navigation.js',
		array(),
		FLK_THEME_VERSION,
		true
	);

	wp_enqueue_script(
		'frk-carousel',
		FLK_THEME_URI . 'assets/js/carousel.js',
		array(),
		FLK_THEME_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'taa_enqueue_assets', 20 );

/**
 * Forces an editorial no-sidebar layout on the main site templates.
 *
 * @param string $layout Current Astra layout.
 * @return string
 */
function taa_force_editorial_layout( $layout ) {
	if ( is_front_page() || is_home() || is_archive() || is_search() || is_single() || is_page() ) {
		return 'no-sidebar';
	}

	return $layout;
}
add_filter( 'astra_page_layout', 'taa_force_editorial_layout' );

/**
 * Disables Astra flex-based dynamic CSS on normal pages so Gutenberg page
 * layouts are not wrapped in Astra's flex content container rules.
 *
 * @param bool $enabled Whether Astra flex-based CSS is enabled.
 * @return bool
 */
function taa_maybe_disable_astra_flex_css( $enabled ) {
	if ( is_page() ) {
		return false;
	}

	return $enabled;
}
add_filter( 'astra_apply_flex_based_css', 'taa_maybe_disable_astra_flex_css' );

/**
 * Registers footer widget areas.
 *
 * @return void
 */
function taa_register_sidebars() {
	$sidebars = array(
		'footer-1' => __( 'Footer Column 1', 'travel-and-adventure' ),
		'footer-2' => __( 'Footer Column 2', 'travel-and-adventure' ),
		'footer-3' => __( 'Footer Column 3', 'travel-and-adventure' ),
	);

	foreach ( $sidebars as $id => $name ) {
		register_sidebar(
			array(
				'name'          => $name,
				'id'            => $id,
				'before_widget' => '<section class="widget taa-footer-widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title taa-footer-widget__title">',
				'after_title'   => '</h3>',
			)
		);
	}
}
add_action( 'widgets_init', 'taa_register_sidebars' );

/**
 * Returns the latest published posts for the homepage feed.
 *
 * @return WP_Query
 */
function taa_get_front_page_posts() {
	return new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 3,
			'ignore_sticky_posts' => true,
		)
	);
}

/**
 * Registers block patterns used to build the homepage with core blocks.
 *
 * @return void
 */
function taa_register_block_patterns() {
	if ( ! function_exists( 'register_block_pattern_category' ) || ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	register_block_pattern_category(
		'frk-homepage',
		array(
			'label' => __( 'Franzi Homepage', 'travel-and-adventure' ),
		)
	);

	register_block_pattern(
		'travel-and-adventure/homepage-shell',
		array(
			'title'      => __( 'Homepage Shell', 'travel-and-adventure' ),
			'categories' => array( 'frk-homepage' ),
			'content'    => '
<!-- wp:group {"className":"taa-homepage taa-homepage-hero taa-surface-blue","layout":{"type":"constrained"}} -->
<div class="wp-block-group taa-homepage taa-homepage-hero taa-surface-blue"><!-- wp:paragraph {"align":"center","className":"taa-block-eyebrow"} -->
<p class="has-text-align-center taa-block-eyebrow">Kreta entdecken</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"className":"taa-homepage-hero__title"} -->
<h1 class="wp-block-heading has-text-align-center taa-homepage-hero__title">Persoenliche Tipps fuer deinen Urlaub auf Kreta</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"taa-homepage-hero__lead"} -->
<p class="has-text-align-center taa-homepage-hero__lead">Reiseideen, praktische Empfehlungen und Lieblingsorte fuer entspannte Ferien auf der Insel.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","className":"taa-homepage-hero__links"} -->
<p class="has-text-align-center taa-homepage-hero__links"><a href="#">Westkreta</a> • <a href="#">Suedkreta</a> • <a href="#">Straende</a> • <a href="#">Mietwagen</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->',
		)
	);

	register_block_pattern(
		'travel-and-adventure/welcome-split',
		array(
			'title'      => __( 'Welcome Split', 'travel-and-adventure' ),
			'categories' => array( 'frk-homepage' ),
			'content'    => '
<!-- wp:group {"className":"taa-homepage-section taa-surface-white"} -->
<div class="wp-block-group taa-homepage-section taa-surface-white">
<!-- wp:columns {"className":"taa-welcome-split"} -->
<div class="wp-block-columns taa-welcome-split">
<!-- wp:column {"width":"56%"} -->
<div class="wp-block-column" style="flex-basis:56%">
<!-- wp:paragraph {"className":"taa-block-eyebrow"} -->
<p class="taa-block-eyebrow">Willkommen</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":2} -->
<h2>Kalinixta und herzlich willkommen auf Kreta</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Hier findet ihr persoenliche Tipps, schoene Orte, Reiserouten und praktische Empfehlungen fuer eure Zeit auf Kreta. Diese Sektion bleibt voll im Gutenberg-Editor bearbeitbar.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" href="#">Mehr lesen</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:column -->
<!-- wp:column {"width":"44%"} -->
<div class="wp-block-column" style="flex-basis:44%">
<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"taa-editorial-image"} -->
<figure class="wp-block-image size-large taa-editorial-image"></figure>
<!-- /wp:image -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->',
		)
	);

	register_block_pattern(
		'travel-and-adventure/favorite-islands',
		array(
			'title'      => __( 'Favorite Islands Grid', 'travel-and-adventure' ),
			'categories' => array( 'frk-homepage' ),
			'content'    => '
<!-- wp:group {"className":"taa-homepage-section taa-surface-grey"} -->
<div class="wp-block-group taa-homepage-section taa-surface-grey">
<!-- wp:paragraph {"className":"taa-block-eyebrow"} -->
<p class="taa-block-eyebrow">Beliebte Inseln</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":2} -->
<h2>Die schoensten Inseln und Regionen fuer eure Reiseplanung</h2>
<!-- /wp:heading -->
<!-- wp:columns {"className":"taa-island-grid"} -->
<div class="wp-block-columns taa-island-grid">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"taa-editorial-image"} -->
<figure class="wp-block-image size-large taa-editorial-image"></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3} -->
<h3>Kreta</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Kurzbeschreibung fuer Highlights, Straende und Reisegefuehl.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"taa-editorial-image"} -->
<figure class="wp-block-image size-large taa-editorial-image"></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3} -->
<h3>Rhodos</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Kurzbeschreibung fuer Geschichte, Strassenleben und Badeorte.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"taa-editorial-image"} -->
<figure class="wp-block-image size-large taa-editorial-image"></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3} -->
<h3>Korfu</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Kurzbeschreibung fuer Gruen, venezianisch und entspannt.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"taa-editorial-image"} -->
<figure class="wp-block-image size-large taa-editorial-image"></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3} -->
<h3>Naxos</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Kurzbeschreibung fuer Familien, Tavernen und weite Straende.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->',
		)
	);

	register_block_pattern(
		'travel-and-adventure/travel-tips-round',
		array(
			'title'      => __( 'Travel Tips And Planning Circles', 'travel-and-adventure' ),
			'categories' => array( 'frk-homepage' ),
			'content'    => '
<!-- wp:group {"className":"taa-homepage-section taa-surface-blue"} -->
<div class="wp-block-group taa-homepage-section taa-surface-blue">
<!-- wp:paragraph {"className":"taa-block-eyebrow"} -->
<p class="taa-block-eyebrow">Reisetipps</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":2} -->
<h2>Praktische Tipps fuer eure Reise</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"taa-section-intro"} -->
<p class="taa-section-intro">Fuegt hier einen kurzen Einleitungstext ein und fuehrt dann in die fuenf wichtigsten Planungsthemen.</p>
<!-- /wp:paragraph -->
<!-- wp:columns {"className":"taa-circle-grid"} -->
<div class="wp-block-columns taa-circle-grid">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"className":"taa-circle-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group taa-circle-card">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Anreise</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Flug, Faehre, Transfer.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"className":"taa-circle-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group taa-circle-card">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Beste Reisezeit</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Monate, Temperaturen und Saison.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"className":"taa-circle-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group taa-circle-card">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Checkliste</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Vor der Abreise an alles denken.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"className":"taa-circle-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group taa-circle-card">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Mietwagen &amp; Uebernachtung</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Mobilitaet und die richtige Basis.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"className":"taa-circle-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group taa-circle-card">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Bars &amp; Restaurants</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Empfehlungen fuer Genuss und Abende.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->',
		)
	);

	register_block_pattern(
		'travel-and-adventure/hotel-tips-post-box',
		array(
			'title'      => __( 'Hotel Tips With Latest Posts Box', 'travel-and-adventure' ),
			'categories' => array( 'frk-homepage' ),
			'content'    => '
<!-- wp:group {"className":"taa-homepage-section taa-surface-white"} -->
<div class="wp-block-group taa-homepage-section taa-surface-white">
<!-- wp:columns {"className":"taa-hotel-layout"} -->
<div class="wp-block-columns taa-hotel-layout">
<!-- wp:column {"width":"64%"} -->
<div class="wp-block-column" style="flex-basis:64%">
<!-- wp:paragraph {"className":"taa-block-eyebrow"} -->
<p class="taa-block-eyebrow">Hotel Tipps</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":2} -->
<h2>Unterkuenfte, die als Ausgangspunkt fuer eure Reise taugen</h2>
<!-- /wp:heading -->
<!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"taa-editorial-image"} -->
<figure class="wp-block-image size-large taa-editorial-image"></figure>
<!-- /wp:image -->
<!-- wp:paragraph -->
<p>Beschreibt hier, fuer wen die Empfehlungen gedacht sind: Familien, Roadtrip, Strandurlaub oder charmante Boutique-Hotels.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column {"width":"36%"} -->
<div class="wp-block-column" style="flex-basis:36%">
<!-- wp:group {"className":"taa-post-box"} -->
<div class="wp-block-group taa-post-box">
<!-- wp:paragraph {"className":"taa-block-eyebrow"} -->
<p class="taa-block-eyebrow">Aktuelle Beitraege</p>
<!-- /wp:paragraph -->
<!-- wp:shortcode -->
[taa_latest_posts limit="6"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->',
		)
	);

	register_block_pattern(
		'travel-and-adventure/post-carousel',
		array(
			'title'      => __( 'Latest Posts Carousel', 'travel-and-adventure' ),
			'categories' => array( 'frk-homepage' ),
			'content'    => '
<!-- wp:group {"className":"taa-homepage-section taa-surface-grey"} -->
<div class="wp-block-group taa-homepage-section taa-surface-grey">
<!-- wp:paragraph {"className":"taa-block-eyebrow"} -->
<p class="taa-block-eyebrow">Mehr Inspiration</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":2} -->
<h2>Im Blog weiterlesen</h2>
<!-- /wp:heading -->
<!-- wp:shortcode -->
[taa_post_carousel limit="10"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->',
		)
	);
}
add_action( 'init', 'taa_register_block_patterns' );
