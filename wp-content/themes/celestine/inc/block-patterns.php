<?php
/**
 * Block patterns for the Celestine home page.
 *
 * Every home section is an insertable pattern so a non-technical site owner can
 * build and edit the entire front page in the block editor. Editable copy uses
 * native blocks (heading / paragraph / buttons) so it can be changed without
 * touching code; data-driven grids (journal, newsletter) use the shortcodes in
 * inc/shortcodes.php; purely decorative structure (starfield, hero emblem,
 * media panels) uses small wp:html fragments.
 *
 * A combined "Home page (complete)" pattern assembles every section in order
 * for one-click setup, and front-page.php renders the same builders as the
 * out-of-the-box demo.
 *
 * @package celestine
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the pattern category.
 */
function cel_register_pattern_category(): void {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category( 'celestine', [
			'label' => __( 'Celestine', 'celestine' ),
		] );
	}
}
add_action( 'init', 'cel_register_pattern_category' );

/* ============================================================
   Section builders — each returns serialized block markup.
   ============================================================ */

/**
 * Hero: emblem + eyebrow + headline (with script accent) + subhead + CTAs.
 */
function cel_pattern_hero(): string {
	$offerings = esc_url( cel_page_url( 'offerings' ) );
	$mark      = esc_url( get_stylesheet_directory_uri() . '/assets/images/celestine-mark.svg' );

	$decor = <<<HTML
<div class="cel-starfield" aria-hidden="true"></div><div class="cel-hero__veil" aria-hidden="true"></div>
HTML;

	$emblem = <<<HTML
<img class="cel-hero__emblem" src="{$mark}" width="96" height="96" alt="" />
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"cel-hero cel-section","layout":{"type":"default"}} -->
<section class="wp-block-group cel-hero cel-section">
<!-- wp:html -->
{$decor}
<!-- /wp:html -->
<!-- wp:group {"className":"cel-hero__inner","layout":{"type":"default"}} -->
<div class="wp-block-group cel-hero__inner">
<!-- wp:html -->
{$emblem}
<!-- /wp:html -->
<!-- wp:paragraph {"align":"center","className":"cel-label cel-label--center"} -->
<p class="has-text-align-center cel-label cel-label--center">☽&nbsp;&nbsp;Begin Here</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1,"className":"cel-hero__title"} -->
<h1 class="wp-block-heading cel-hero__title">Return to the <em>stars</em> within</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"cel-hero__sub"} -->
<p class="has-text-align-center cel-hero__sub">A reading is a conversation with the sky on the night you arrived. Come as you are: curious, tender, ready to listen.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"className":"cel-hero__cta"} -->
<div class="wp-block-buttons cel-hero__cta">
<!-- wp:button {"className":"is-style-cel-primary"} -->
<div class="wp-block-button is-style-cel-primary"><a class="wp-block-button__link wp-element-button" href="{$offerings}">Book a Reading</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"is-style-cel-secondary"} -->
<div class="wp-block-button is-style-cel-secondary"><a class="wp-block-button__link wp-element-button" href="{$offerings}">Explore the Offerings</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * One offering / pathway tile (glyph badge + title + text).
 */
function cel_tile( string $glyph, string $title, string $text ): string {
	return <<<HTML
<!-- wp:group {"className":"cel-tile","layout":{"type":"default"}} -->
<div class="wp-block-group cel-tile">
<!-- wp:paragraph {"className":"cel-tile__badge"} -->
<p class="cel-tile__badge">{$glyph}</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":3,"className":"cel-tile__title"} -->
<h3 class="wp-block-heading cel-tile__title">{$title}</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"cel-tile__text"} -->
<p class="cel-tile__text">{$text}</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
HTML;
}

/**
 * Pathways / offerings: section head + four editable tiles.
 */
function cel_pattern_offerings(): string {
	$tiles =
		cel_tile( '♓', 'Astrology', 'Natal charts, transits, and the season ahead, read with care.' ) .
		cel_tile( '✦', 'Tarot', 'A spread for the question beneath the question you arrived with.' ) .
		cel_tile( '☽', 'Meditation', 'Guided practice to soften the noise and return to the body.' ) .
		cel_tile( '◇', 'Crystals &amp; ritual', 'Tools chosen by hand, for altars, intentions, and rest.' );

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"cel-section","layout":{"type":"default"}} -->
<section class="wp-block-group cel-section">
<!-- wp:group {"className":"cel-container","layout":{"type":"default"}} -->
<div class="wp-block-group cel-container">
<!-- wp:group {"className":"cel-section-head","layout":{"type":"default"}} -->
<div class="wp-block-group cel-section-head">
<!-- wp:paragraph {"align":"center","className":"cel-label cel-label--center"} -->
<p class="has-text-align-center cel-label cel-label--center">The Pathways</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","className":"cel-section-head__title"} -->
<h2 class="wp-block-heading has-text-align-center cel-section-head__title">Four ways to begin</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"cel-section-head__lede"} -->
<p class="has-text-align-center cel-section-head__lede">Whether you arrive through the chart, the cards, or the quiet, there is a door here for you.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:group {"className":"cel-grid cel-grid--4","layout":{"type":"default"}} -->
<div class="wp-block-group cel-grid cel-grid--4">
{$tiles}
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Featured reading: split media + editable body + price + CTA.
 */
function cel_pattern_featured(): string {
	$offerings = esc_url( cel_page_url( 'offerings' ) );

	$media = <<<HTML
<div class="cel-featured__media"><span class="cel-glyph" aria-hidden="true">♓</span></div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"cel-section cel-section--night","layout":{"type":"default"}} -->
<section class="wp-block-group cel-section cel-section--night">
<!-- wp:group {"className":"cel-container","layout":{"type":"default"}} -->
<div class="wp-block-group cel-container">
<!-- wp:columns {"verticalAlignment":"center","className":"cel-featured"} -->
<div class="wp-block-columns are-vertically-aligned-center cel-featured">
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:html -->
{$media}
<!-- /wp:html -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:group {"className":"cel-featured__body","layout":{"type":"default"}} -->
<div class="wp-block-group cel-featured__body">
<!-- wp:paragraph {"className":"cel-label"} -->
<p class="cel-label">Featured Reading</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"cel-featured__title"} -->
<h2 class="wp-block-heading cel-featured__title">The Natal Chart Reading</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"cel-featured__text"} -->
<p class="cel-featured__text">The map you were born under, read in full. Ninety unhurried minutes on your placements, your patterns, and the season the sky is moving you toward. You leave with a recording and a single thing to tend.</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"cel-featured__meta","layout":{"type":"default"}} -->
<div class="wp-block-group cel-featured__meta">
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-cel-primary"} -->
<div class="wp-block-button is-style-cel-primary"><a class="wp-block-button__link wp-element-button" href="{$offerings}">Book this reading</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
<!-- wp:paragraph {"className":"cel-featured__price"} -->
<p class="cel-featured__price">$180 / 90 min</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * About teaser: portrait + editable pull-quote + bio + link.
 */
function cel_pattern_about(): string {
	$about = esc_url( cel_page_url( 'about' ) );

	$portrait = <<<HTML
<div class="cel-about__portrait"><span class="cel-glyph" aria-hidden="true">☽</span></div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"cel-section","layout":{"type":"default"}} -->
<section class="wp-block-group cel-section">
<!-- wp:group {"className":"cel-container","layout":{"type":"default"}} -->
<div class="wp-block-group cel-container">
<!-- wp:columns {"verticalAlignment":"center","className":"cel-about"} -->
<div class="wp-block-columns are-vertically-aligned-center cel-about">
<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%">
<!-- wp:html -->
{$portrait}
<!-- /wp:html -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center","width":"60%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%">
<!-- wp:group {"className":"cel-about__body","layout":{"type":"default"}} -->
<div class="wp-block-group cel-about__body">
<!-- wp:paragraph {"className":"cel-label"} -->
<p class="cel-label">The Practitioner</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"cel-about__quote"} -->
<p class="cel-about__quote">“I read the sky the way I wish someone had read it to me at twenty: plainly, warmly, without fear.”</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"cel-about__text"} -->
<p class="cel-about__text">Celeste has practiced astrology and tarot for fifteen years, trained in the Hellenistic tradition, and keeps a small shop of crystals and ritual goods gathered with intention.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-cel-ghost"} -->
<div class="wp-block-button is-style-cel-ghost"><a class="wp-block-button__link wp-element-button" href="{$about}">Read her story →</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * One testimonial card (stars + editable quote + name + role).
 */
function cel_quote( string $quote, string $name, string $role ): string {
	return <<<HTML
<!-- wp:group {"className":"cel-quote","layout":{"type":"default"}} -->
<div class="wp-block-group cel-quote">
<!-- wp:paragraph {"className":"cel-quote__stars"} -->
<p class="cel-quote__stars">✦✦✦✦✦</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"cel-quote__body"} -->
<p class="cel-quote__body">{$quote}</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"cel-quote__foot","layout":{"type":"default"}} -->
<div class="wp-block-group cel-quote__foot">
<!-- wp:paragraph {"className":"cel-quote__name"} -->
<p class="cel-quote__name">{$name}</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"cel-quote__role"} -->
<p class="cel-quote__role">{$role}</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
HTML;
}

/**
 * Testimonials: section head + three editable cards.
 */
function cel_pattern_testimonials(): string {
	$cards =
		cel_quote( 'I came in skeptical and left with language for things I had felt for years. Grounded, kind, never woo for its own sake.', 'Mara L.', 'Natal chart reading' ) .
		cel_quote( 'The most honest reading I have had. No vague promises, just real attention and a few things I am still thinking about months later.', 'Devin R.', 'Tarot session' ) .
		cel_quote( 'It felt less like a service and more like being seen. I book the new-moon session every month now.', 'Priya S.', 'New-moon intention' );

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"cel-section cel-section--night","layout":{"type":"default"}} -->
<section class="wp-block-group cel-section cel-section--night">
<!-- wp:group {"className":"cel-container","layout":{"type":"default"}} -->
<div class="wp-block-group cel-container">
<!-- wp:group {"className":"cel-section-head","layout":{"type":"default"}} -->
<div class="wp-block-group cel-section-head">
<!-- wp:paragraph {"align":"center","className":"cel-label cel-label--center"} -->
<p class="has-text-align-center cel-label cel-label--center">In Their Words</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","className":"cel-section-head__title"} -->
<h2 class="wp-block-heading has-text-align-center cel-section-head__title">Honest, every time</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:group {"className":"cel-grid cel-grid--3","layout":{"type":"default"}} -->
<div class="wp-block-group cel-grid cel-grid--3">
{$cards}
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Journal teaser: flex head + ghost link + live posts via [cel_journal].
 */
function cel_pattern_journal(): string {
	$journal = esc_url( cel_page_url( 'journal' ) );

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"cel-section","layout":{"type":"default"}} -->
<section class="wp-block-group cel-section">
<!-- wp:group {"className":"cel-container","layout":{"type":"default"}} -->
<div class="wp-block-group cel-container">
<!-- wp:group {"className":"cel-flex-head","layout":{"type":"default"}} -->
<div class="wp-block-group cel-flex-head">
<!-- wp:group {"className":"cel-section-head","layout":{"type":"default"}} -->
<div class="wp-block-group cel-section-head">
<!-- wp:paragraph {"className":"cel-label"} -->
<p class="cel-label">From the Journal</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"cel-section-head__title"} -->
<h2 class="wp-block-heading cel-section-head__title">Notes from the practice</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-cel-secondary"} -->
<div class="wp-block-button is-style-cel-secondary"><a class="wp-block-button__link wp-element-button" href="{$journal}">Read the journal</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
<!-- wp:shortcode -->
[cel_journal count="4"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Newsletter band via [cel_newsletter] inside a narrow container.
 */
function cel_pattern_newsletter(): string {
	return <<<HTML
<!-- wp:group {"tagName":"section","className":"cel-section","layout":{"type":"default"}} -->
<section class="wp-block-group cel-section">
<!-- wp:group {"className":"cel-container--text","layout":{"type":"default"}} -->
<div class="wp-block-group cel-container--text">
<!-- wp:shortcode -->
[cel_newsletter]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * The full home page, in design order (used by the combined pattern and as the
 * front-page.php demo fallback).
 */
function cel_home_demo(): string {
	return
		cel_pattern_hero() .
		cel_pattern_offerings() .
		cel_pattern_featured() .
		cel_pattern_about() .
		cel_pattern_testimonials() .
		cel_pattern_journal() .
		cel_pattern_newsletter();
}

/* ============================================================
   Registration
   ============================================================ */
function cel_register_block_patterns(): void {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	$cat      = [ 'celestine' ];
	$patterns = [
		'celestine/hero' => [
			'title'       => __( 'Home: Cosmic hero', 'celestine' ),
			'description' => __( 'Emblem, eyebrow, serif headline with script accent, subhead and two CTAs.', 'celestine' ),
			'content'     => cel_pattern_hero(),
		],
		'celestine/offerings' => [
			'title'       => __( 'Home: Pathways (offerings)', 'celestine' ),
			'description' => __( 'Section heading and four editable offering tiles with gold glyph badges.', 'celestine' ),
			'content'     => cel_pattern_offerings(),
		],
		'celestine/featured' => [
			'title'       => __( 'Home: Featured reading', 'celestine' ),
			'description' => __( 'Split media panel with an editable description, price and booking button.', 'celestine' ),
			'content'     => cel_pattern_featured(),
		],
		'celestine/about' => [
			'title'       => __( 'Home: About the practitioner', 'celestine' ),
			'description' => __( 'Portrait, pull-quote, short bio and a link to the full story.', 'celestine' ),
			'content'     => cel_pattern_about(),
		],
		'celestine/testimonials' => [
			'title'       => __( 'Home: Testimonials', 'celestine' ),
			'description' => __( 'Three editable testimonial cards with star ratings.', 'celestine' ),
			'content'     => cel_pattern_testimonials(),
		],
		'celestine/journal' => [
			'title'       => __( 'Home: Journal teaser', 'celestine' ),
			'description' => __( 'Heading, link and the latest journal entries (falls back to samples).', 'celestine' ),
			'content'     => cel_pattern_journal(),
		],
		'celestine/newsletter' => [
			'title'       => __( 'Home: Join the Circle (newsletter)', 'celestine' ),
			'description' => __( 'New-moon newsletter band with email field and consent.', 'celestine' ),
			'content'     => cel_pattern_newsletter(),
		],
	];

	foreach ( $patterns as $name => $args ) {
		register_block_pattern( $name, [
			'title'       => $args['title'],
			'description' => $args['description'],
			'categories'  => $cat,
			'content'     => $args['content'],
		] );
	}

	register_block_pattern( 'celestine/home', [
		'title'       => __( 'Home page (complete)', 'celestine' ),
		'description' => __( 'The whole home page at once: hero, pathways, featured reading, about, testimonials, journal and newsletter.', 'celestine' ),
		'categories'  => $cat,
		'content'     => cel_home_demo(),
	] );
}
add_action( 'init', 'cel_register_block_patterns' );
