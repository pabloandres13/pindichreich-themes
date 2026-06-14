<?php
defined( 'ABSPATH' ) || exit;

/**
 * Block patterns for the Culinary (Saffron & Salt) home page.
 *
 * Each home section is registered as an insertable pattern so a non-technical
 * site owner can build and edit the front page entirely in the block editor.
 * Editable copy uses native blocks (heading / paragraph / buttons / image);
 * data-driven grids use the shortcodes in inc/shortcodes.php (which fall back to
 * demo content); fixed decorative bits (hero badges, rating) use wp:html.
 *
 * A combined "Home page (complete)" pattern assembles every section in order
 * for one-click setup. The matching front-page.php renders this page content
 * when a static page is set as the front page, and otherwise falls back to the
 * bundled template parts.
 *
 * @package culinary
 */

/**
 * Register Gutenberg block patterns for the culinary theme.
 */
function culinary_register_block_patterns(): void {
	register_block_pattern_category( 'culinary', [
		'label' => __( 'Culinary', 'culinary' ),
	] );

	/* ---- Home sections ---- */
	$cat      = [ 'culinary' ];
	$sections = [
		'culinary/home-hero' => [
			'title'       => __( 'Home: Hero', 'culinary' ),
			'description' => __( 'Full-bleed featured recipe with overlaid title, description, rating and button. Swap the image and edit the text in place.', 'culinary' ),
			'content'     => culinary_pattern_hero(),
		],
		'culinary/home-featured' => [
			'title'       => __( 'Home: Featured recipes', 'culinary' ),
			'description' => __( 'Editable section heading plus a 3-card strip of recipes (uses your latest posts, or demo recipes until you publish).', 'culinary' ),
			'content'     => culinary_pattern_featured(),
		],
		'culinary/home-categories' => [
			'title'       => __( 'Home: Browse by category', 'culinary' ),
			'description' => __( 'Editable heading plus four visual category tiles (uses your categories, or demo tiles).', 'culinary' ),
			'content'     => culinary_pattern_categories(),
		],
		'culinary/home-latest' => [
			'title'       => __( 'Home: Latest recipes', 'culinary' ),
			'description' => __( 'Editable heading plus a 6-card recipe grid.', 'culinary' ),
			'content'     => culinary_pattern_latest(),
		],
		'culinary/home-meet' => [
			'title'       => __( 'Home: Meet the cook', 'culinary' ),
			'description' => __( 'Portrait photo beside an editable intro and a button to the about page.', 'culinary' ),
			'content'     => culinary_pattern_meet(),
		],
		'culinary/home-newsletter' => [
			'title'       => __( 'Home: Newsletter band', 'culinary' ),
			'description' => __( 'Warm newsletter sign-up band (email capture). Title and copy come from the Customizer.', 'culinary' ),
			'content'     => culinary_pattern_newsletter(),
		],
	];

	foreach ( $sections as $name => $args ) {
		register_block_pattern( $name, [
			'title'       => $args['title'],
			'description' => $args['description'],
			'categories'  => $cat,
			'content'     => $args['content'],
		] );
	}

	// Combined full home page — every section in design order.
	register_block_pattern( 'culinary/home', [
		'title'       => __( 'Home page (complete)', 'culinary' ),
		'description' => __( 'The whole home page at once: hero, featured recipes, categories, latest recipes, meet the cook and newsletter. Set this page as your front page under Settings → Reading.', 'culinary' ),
		'categories'  => $cat,
		'content'     =>
			culinary_pattern_hero() .
			culinary_pattern_featured() .
			culinary_pattern_categories() .
			culinary_pattern_latest() .
			culinary_pattern_meet() .
			culinary_pattern_newsletter(),
	] );

	/* ---- Content patterns (for inside recipe posts) ---- */

	// ---- Newsletter band (tint) ----
	register_block_pattern( 'culinary/newsletter-band', [
		'title'      => __( 'Newsletter band', 'culinary' ),
		'categories' => [ 'culinary' ],
		'content'    => '<!-- wp:html -->' . culinary_newsletter_band_html( 'tint' ) . '<!-- /wp:html -->',
	] );

	// ---- Newsletter band (dark) ----
	register_block_pattern( 'culinary/newsletter-band-dark', [
		'title'      => __( 'Newsletter band — dark', 'culinary' ),
		'categories' => [ 'culinary' ],
		'content'    => '<!-- wp:html -->' . culinary_newsletter_band_html( 'dark' ) . '<!-- /wp:html -->',
	] );

	// ---- Kitchen tip callout ----
	register_block_pattern( 'culinary/tip-callout', [
		'title'      => __( 'Kitchen tip callout', 'culinary' ),
		'categories' => [ 'culinary', 'text' ],
		'content'    => '<!-- wp:group {"className":"culinary-callout culinary-callout--tip"} --><div class="wp-block-group culinary-callout culinary-callout--tip"><div class="culinary-callout__label">Tip</div><!-- wp:paragraph {"className":"culinary-callout__body"} --><p class="culinary-callout__body">Add your kitchen tip here.</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
	] );

	// ---- Recipe note callout ----
	register_block_pattern( 'culinary/note-callout', [
		'title'      => __( 'Recipe note callout', 'culinary' ),
		'categories' => [ 'culinary', 'text' ],
		'content'    => '<!-- wp:group {"className":"culinary-callout culinary-callout--note"} --><div class="wp-block-group culinary-callout culinary-callout--note"><div class="culinary-callout__label">Note</div><!-- wp:paragraph {"className":"culinary-callout__body"} --><p class="culinary-callout__body">Add your recipe note here.</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
	] );

	// ---- Pull quote ----
	register_block_pattern( 'culinary/pull-quote', [
		'title'      => __( 'Pull quote', 'culinary' ),
		'categories' => [ 'culinary', 'text' ],
		'content'    => '<!-- wp:group {"className":"culinary-callout culinary-callout--quote"} --><div class="wp-block-group culinary-callout culinary-callout--quote"><!-- wp:paragraph --><p>Good food doesn\'t need to be complicated. It needs to be made.</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
	] );
}
add_action( 'init', 'culinary_register_block_patterns' );

/* ============================================================
   Home section builders — each returns serialized block markup.
   Kept as functions so the combined pattern can reuse them.
   ============================================================ */

/**
 * Reusable editable section heading: eyebrow + title, optional ghost action.
 */
function culinary_pattern_section_head( string $eyebrow, string $title, string $action_label = '', string $action_url = '' ): string {
	$eyebrow = esc_html( $eyebrow );
	$title   = esc_html( $title );

	$action = '';
	if ( '' !== $action_label ) {
		$arrow        = culinary_icon( 'arrow-right', 17 );
		$action_label = esc_html( $action_label );
		$action_url   = esc_url( $action_url ?: home_url( '/' ) );
		$action       = <<<HTML
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-culinary-ghost"} -->
<div class="wp-block-button is-style-culinary-ghost"><a class="wp-block-button__link wp-element-button" href="{$action_url}">{$action_label} {$arrow}</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
HTML;
	}

	return <<<HTML
<!-- wp:group {"className":"section-head"} -->
<div class="wp-block-group section-head">
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
<!-- wp:paragraph {"className":"section-head__eyebrow"} -->
<p class="section-head__eyebrow">{$eyebrow}</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"section-head__title"} -->
<h2 class="wp-block-heading section-head__title">{$title}</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
{$action}
</div>
<!-- /wp:group -->
HTML;
}

/**
 * Hero: editable group with a swappable background image, badges, title,
 * lead, rating and a primary button. Built from plain blocks (group, image,
 * heading, paragraph, buttons) so it never trips block validation; the scrim
 * overlay lives in theme.css (.culinary-hero).
 */
function culinary_pattern_hero(): string {
	$img    = 'https://images.unsplash.com/photo-1598103442097-8b74394b95c6?w=1600&q=80&auto=format&fit=crop';
	$arrow  = culinary_icon( 'arrow-right', 18 );
	$stars  = culinary_star_rating( 5.0, 18 );
	$recipe = esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/' ) );

	$badges = '<div class="hero-block__badges"><span class="culinary-badge culinary-badge--solid">Recipe of the week</span><span class="culinary-badge culinary-badge--dark">1 hr 20 min</span></div>';
	$rating = '<div class="hero-block__rating">' . $stars . '<span>5.0 &middot; 312 reviews</span></div>';

	return <<<HTML
<!-- wp:group {"className":"culinary-container","layout":{"type":"default"}} -->
<div class="wp-block-group culinary-container">
<!-- wp:group {"className":"culinary-hero","layout":{"type":"default"}} -->
<div class="wp-block-group culinary-hero">
<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"culinary-hero__bg"} -->
<figure class="wp-block-image size-full culinary-hero__bg"><img src="{$img}" alt="Saffron and lemon roast chicken in a cast-iron pan"/></figure>
<!-- /wp:image -->
<!-- wp:group {"className":"culinary-hero__inner","layout":{"type":"default"}} -->
<div class="wp-block-group culinary-hero__inner">
<!-- wp:html -->
{$badges}
<!-- /wp:html -->
<!-- wp:heading {"level":1,"className":"hero-block__title"} -->
<h1 class="wp-block-heading hero-block__title">Saffron &amp; lemon roast chicken</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"hero-block__description"} -->
<p class="hero-block__description">Golden, fragrant and built for a slow Sunday — saffron and preserved lemon do the heavy lifting while the oven does the rest.</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"hero-block__actions","layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group hero-block__actions">
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-culinary-primary culinary-btn--lg"} -->
<div class="wp-block-button is-style-culinary-primary culinary-btn--lg"><a class="wp-block-button__link wp-element-button" href="{$recipe}">{$arrow} View recipe</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
<!-- wp:html -->
{$rating}
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
HTML;
}

/**
 * Featured strip: editable head + [culinary_recipes_grid count="3"].
 */
function culinary_pattern_featured(): string {
	$recipes = get_post_type_archive_link( 'post' ) ?: home_url( '/' );
	$head    = culinary_pattern_section_head( 'Reader favourites', 'Popular this season', 'All recipes', $recipes );

	return <<<HTML
<!-- wp:group {"className":"culinary-container culinary-home-section","layout":{"type":"default"}} -->
<div class="wp-block-group culinary-container culinary-home-section">
{$head}
<!-- wp:shortcode -->
[culinary_recipes_grid count="3"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
HTML;
}

/**
 * Categories: editable head + [culinary_categories count="4"].
 */
function culinary_pattern_categories(): string {
	$head = culinary_pattern_section_head( 'Browse by category', 'What are you cooking?' );

	return <<<HTML
<!-- wp:group {"className":"culinary-container culinary-home-section","layout":{"type":"default"}} -->
<div class="wp-block-group culinary-container culinary-home-section">
{$head}
<!-- wp:shortcode -->
[culinary_categories count="4"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
HTML;
}

/**
 * Latest grid: editable head + [culinary_recipes_grid count="6"].
 */
function culinary_pattern_latest(): string {
	$recipes = get_post_type_archive_link( 'post' ) ?: home_url( '/' );
	$head    = culinary_pattern_section_head( 'Fresh from the kitchen', 'Latest recipes', 'See more', $recipes );

	return <<<HTML
<!-- wp:group {"className":"culinary-container culinary-home-section","layout":{"type":"default"}} -->
<div class="wp-block-group culinary-container culinary-home-section">
{$head}
<!-- wp:shortcode -->
[culinary_recipes_grid count="6"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
HTML;
}

/**
 * Meet the cook: editable portrait + intro copy + button (core/columns).
 */
function culinary_pattern_meet(): string {
	$about = esc_url( ( $p = get_page_by_path( 'about' ) ) ? get_permalink( $p ) : home_url( '/about/' ) );
	$arrow = culinary_icon( 'arrow-right', 17 );
	$img   = 'https://images.unsplash.com/photo-1556911220-bff31c812dba?w=800&q=80&auto=format&fit=crop';

	return <<<HTML
<!-- wp:group {"className":"culinary-container culinary-home-section","layout":{"type":"default"}} -->
<div class="wp-block-group culinary-container culinary-home-section">
<!-- wp:columns {"className":"culinary-meet"} -->
<div class="wp-block-columns culinary-meet">
<!-- wp:column {"width":"45%","className":"culinary-meet__media"} -->
<div class="wp-block-column culinary-meet__media" style="flex-basis:45%">
<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="{$img}" alt="The cook in her kitchen"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center","className":"culinary-meet__body"} -->
<div class="wp-block-column is-vertically-aligned-center culinary-meet__body">
<!-- wp:paragraph {"className":"about-teaser__eyebrow"} -->
<p class="about-teaser__eyebrow">Meet the cook</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"about-teaser__title"} -->
<h2 class="wp-block-heading about-teaser__title">Hi, I'm the cook behind the mess</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"about-teaser__body"} -->
<p class="about-teaser__body">I cook the way most of us actually live — quickly, on a weeknight, with whatever's in the fridge. Every recipe here is tested in my own small kitchen until it's reliable enough to share.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-culinary-secondary"} -->
<div class="wp-block-button is-style-culinary-secondary"><a class="wp-block-button__link wp-element-button" href="{$about}">Read the story {$arrow}</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
HTML;
}

/**
 * Newsletter band via the [culinary_newsletter] shortcode (brings own container).
 */
function culinary_pattern_newsletter(): string {
	return <<<HTML
<!-- wp:shortcode -->
[culinary_newsletter tone="tint"]
<!-- /wp:shortcode -->
HTML;
}

/**
 * Render newsletter band HTML for the wp:html content patterns.
 */
function culinary_newsletter_band_html( string $tone = 'tint' ): string {
	ob_start();
	get_template_part( 'template-parts/home/newsletter', null, [ 'tone' => $tone ] );
	return ob_get_clean() ?: '';
}
