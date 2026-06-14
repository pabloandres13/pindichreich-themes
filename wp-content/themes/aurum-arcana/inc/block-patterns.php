<?php
/**
 * Aurum Arcana — Block Patterns
 *
 * The home page is page-driven and fully editable in the block editor: every
 * section below is registered as an insertable pattern so a non-technical site
 * owner can build and edit the front page without touching PHP. A combined
 * "Home Page (complete)" pattern assembles every section in order for one-click
 * setup.
 *
 * Editable copy uses native blocks (heading / paragraph / buttons / image) so it
 * can be changed in place. Data-driven grids use the shortcodes in
 * inc/shortcodes.php ([aurum_articles], [aurum_newsletter]). Fixed decorative
 * structure (the sigil emblem, four-door tile grid, the offering checklist)
 * uses wp:html. Native CTAs use the is-style-aa-* button styles registered in
 * inc/block-support.php.
 *
 * @package aurum-arcana
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', 'aurum_register_block_patterns' );
function aurum_register_block_patterns(): void {

	register_block_pattern_category( 'aurum', [
		'label' => __( 'Aurum Arcana', 'aurum-arcana' ),
	] );

	/* ---- Home sections -------------------------------------------------- */

	register_block_pattern( 'aurum/home-hero', [
		'title'      => __( 'Home · Hero', 'aurum-arcana' ),
		'categories' => [ 'aurum' ],
		'content'    => aurum_pattern_hero(),
	] );

	register_block_pattern( 'aurum/home-themes', [
		'title'      => __( 'Home · Four Doors (themes)', 'aurum-arcana' ),
		'categories' => [ 'aurum' ],
		'content'    => aurum_pattern_themes(),
	] );

	register_block_pattern( 'aurum/home-latest', [
		'title'      => __( 'Home · Latest Dispatches', 'aurum-arcana' ),
		'categories' => [ 'aurum' ],
		'content'    => aurum_pattern_latest(),
	] );

	register_block_pattern( 'aurum/home-offering', [
		'title'      => __( 'Home · Signature Reading', 'aurum-arcana' ),
		'categories' => [ 'aurum' ],
		'content'    => aurum_pattern_offering(),
	] );

	register_block_pattern( 'aurum/home-about', [
		'title'      => __( 'Home · The Practitioner', 'aurum-arcana' ),
		'categories' => [ 'aurum' ],
		'content'    => aurum_pattern_about(),
	] );

	register_block_pattern( 'aurum/home-newsletter', [
		'title'      => __( 'Home · Newsletter Band', 'aurum-arcana' ),
		'categories' => [ 'aurum' ],
		'content'    => aurum_pattern_newsletter(),
	] );

	/* ---- One-click full home page --------------------------------------- */

	register_block_pattern( 'aurum/home-complete', [
		'title'       => __( 'Home Page (complete)', 'aurum-arcana' ),
		'description' => __( 'The full Aurum Arcana home page: hero, the four doors, latest dispatches, the signature reading, the practitioner, and the newsletter band.', 'aurum-arcana' ),
		'categories'  => [ 'aurum' ],
		'content'     =>
			aurum_pattern_hero() .
			aurum_pattern_themes() .
			aurum_pattern_latest() .
			aurum_pattern_offering() .
			aurum_pattern_about() .
			aurum_pattern_newsletter(),
	] );

	/* ---- Reusable content patterns (posts & pages) ---------------------- */

	register_block_pattern( 'aurum/ritual-note', [
		'title'      => __( 'Ritual Note', 'aurum-arcana' ),
		'categories' => [ 'aurum' ],
		'content'    => '<!-- wp:paragraph {"className":"is-style-ritual-note"} --><p class="is-style-ritual-note">' . esc_html__( 'Write your ritual note here — a small instruction, an observance, a thing to try by candlelight.', 'aurum-arcana' ) . '</p><!-- /wp:paragraph -->',
	] );

	register_block_pattern( 'aurum/pull-quote', [
		'title'      => __( 'Pull Quote', 'aurum-arcana' ),
		'categories' => [ 'aurum' ],
		'content'    => '<!-- wp:quote {"className":"is-style-pull-quote"} --><blockquote class="wp-block-quote is-style-pull-quote"><!-- wp:paragraph --><p>' . esc_html__( 'The old arts ask for attention, not belief.', 'aurum-arcana' ) . '</p><!-- /wp:paragraph --></blockquote><!-- /wp:quote -->',
	] );

	register_block_pattern( 'aurum/article-grid', [
		'title'      => __( 'Article Grid (3 columns)', 'aurum-arcana' ),
		'categories' => [ 'aurum' ],
		'content'    => '<!-- wp:shortcode -->[aurum_articles count="3"]<!-- /wp:shortcode -->',
	] );
}

/* ============================================================
   Section builders — each returns serialized block markup.
   Kept as functions so the combined pattern can reuse them and
   so real permalinks can be injected at registration time.
   ============================================================ */

/**
 * Resolve the journal/blog archive URL (posts page → CPT archive → home).
 */
function aurum_journal_url(): string {
	$posts_page = (int) get_option( 'page_for_posts' );
	$url = $posts_page ? get_permalink( $posts_page ) : '';
	if ( ! $url ) {
		$url = get_post_type_archive_link( 'post' );
	}
	return esc_url( $url ?: home_url( '/' ) );
}

/**
 * Resolve the booking/about URL.
 */
function aurum_booking_url(): string {
	$booking = get_theme_mod( 'aurum_reading_url', '' );
	if ( ! $booking ) {
		$about   = get_page_by_path( 'about' );
		$booking = $about ? get_permalink( $about ) : home_url( '/about/' );
	}
	return esc_url( $booking );
}

/**
 * Hero: sigil emblem + flanked label (wp:html), editable headline + lead
 * (native), two CTA buttons (native, is-style-aa-*).
 */
function aurum_pattern_hero(): string {
	$emblem  = aurum_hero_emblem( 96 );
	$reading = aurum_booking_url();
	$journal = aurum_journal_url();

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"aa-hero","layout":{"type":"default"}} -->
<section class="wp-block-group aa-hero">
<!-- wp:html -->
<span class="aa-hero__emblem">{$emblem}</span>
<!-- /wp:html -->
<!-- wp:html -->
<div><span class="aa-label aa-label--flanked">The Veil Grows Thin</span></div>
<!-- /wp:html -->
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Study the <em>old arts</em> by candlelight</h1>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>An esoteric journal and house of readings — tarot, astrology, and alchemy, kept with a scholar's care and a seeker's wonder.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"className":"aa-hero__cta","layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons aa-hero__cta">
<!-- wp:button {"className":"is-style-aa-primary aa-btn--lg"} -->
<div class="wp-block-button is-style-aa-primary aa-btn--lg"><a class="wp-block-button__link wp-element-button" href="{$reading}">Book a Reading</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"is-style-aa-secondary aa-btn--lg"} -->
<div class="wp-block-button is-style-aa-secondary aa-btn--lg"><a class="wp-block-button__link wp-element-button" href="{$journal}">Read the Journal</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Four Doors: editable section head (native) + four theme tiles (wp:html,
 * icon-driven fixed structure linking to the journal).
 */
function aurum_pattern_themes(): string {
	$journal = aurum_journal_url();
	$tiles   = [
		[ 'cards',      'Tarot',     'The seventy-eight keys' ],
		[ 'moon-stars', 'Astrology', 'The wheel of the stars' ],
		[ 'flask',      'Alchemy',   'The great work' ],
		[ 'scroll',     'Folklore',  'The old stories' ],
	];

	$grid = '<div class="aa-grid-4">';
	foreach ( $tiles as [ $icon, $title, $desc ] ) {
		$grid .= '<a href="' . $journal . '" class="aa-tile">'
			. '<span class="aa-tile__icon">' . aurum_icon( $icon, 38 ) . '</span>'
			. '<h3 class="aa-tile__title">' . esc_html( $title ) . '</h3>'
			. '<p class="aa-tile__desc">' . esc_html( $desc ) . '</p>'
			. '</a>';
	}
	$grid .= '</div>';

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"aa-sec aa-reveal","layout":{"type":"default"}} -->
<section class="wp-block-group aa-sec aa-reveal">
<!-- wp:group {"className":"aa-sec__head","layout":{"type":"default"}} -->
<div class="wp-block-group aa-sec__head">
<!-- wp:html -->
<span class="aa-label">Enter the Mysteries</span>
<!-- /wp:html -->
<!-- wp:heading -->
<h2 class="wp-block-heading">Four doors stand open</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:html -->
{$grid}
<!-- /wp:html -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Latest Dispatches: editable head (native) + live post grid ([aurum_articles])
 * + ghost "all dispatches" link (wp:html, keeps the arrow glyph).
 */
function aurum_pattern_latest(): string {
	$journal = aurum_journal_url();
	$arrow   = aurum_icon( 'arrow-right', 16 );

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"aa-sec aa-sec--flush aa-reveal","layout":{"type":"default"}} -->
<section class="wp-block-group aa-sec aa-sec--flush aa-reveal">
<!-- wp:group {"className":"aa-sec__head","layout":{"type":"default"}} -->
<div class="wp-block-group aa-sec__head">
<!-- wp:html -->
<span class="aa-label">Latest Dispatches</span>
<!-- /wp:html -->
<!-- wp:heading -->
<h2 class="wp-block-heading">From the Journal</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:shortcode -->
[aurum_articles count="3"]
<!-- /wp:shortcode -->
<!-- wp:html -->
<div style="text-align:center;margin-top:40px;"><a href="{$journal}" class="aa-btn aa-btn--ghost">All dispatches {$arrow}</a></div>
<!-- /wp:html -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Signature Reading: media frame (native image) + editable copy (native) +
 * fixed checklist (wp:html) + booking CTA (native, is-style-aa-primary).
 */
function aurum_pattern_offering(): string {
	$booking = aurum_booking_url();
	$img     = 'https://images.unsplash.com/photo-1532693322450-2cb5c511067d?w=800&q=80&auto=format&fit=crop';
	$check   = aurum_icon( 'check', 20 );

	$list = '<ul>'
		. '<li>' . $check . '60 minutes, in person or by veil-call</li>'
		. '<li>' . $check . 'A recording and full transcript</li>'
		. '<li>' . $check . 'A follow-up letter of reflection</li>'
		. '</ul>';

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"aa-offering aa-reveal","layout":{"type":"default"}} -->
<section class="wp-block-group aa-offering aa-reveal">
<!-- wp:columns {"verticalAlignment":"center","className":"aa-offering__inner"} -->
<div class="wp-block-columns are-vertically-aligned-center aa-offering__inner">
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:group {"className":"aa-offering__media","layout":{"type":"default"}} -->
<div class="wp-block-group aa-offering__media">
<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="{$img}" alt="A full moon rising over a darkened sky"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:html -->
<span class="aa-label">The Signature Reading</span>
<!-- /wp:html -->
<!-- wp:heading -->
<h2 class="wp-block-heading">An hour with the cards</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>A full Celtic-cross reading, recorded and transcribed, with a written letter of reflection sent within three days.</p>
<!-- /wp:paragraph -->
<!-- wp:html -->
{$list}
<!-- /wp:html -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-aa-primary aa-btn--lg"} -->
<div class="wp-block-button is-style-aa-primary aa-btn--lg"><a class="wp-block-button__link wp-element-button" href="{$booking}">Book the Reading · \$180</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * The Practitioner: portrait (native image) + editable story (native) + CTA.
 */
function aurum_pattern_about(): string {
	$about = aurum_booking_url();
	$img   = 'https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=800&q=80&auto=format&fit=crop';

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"aa-sec aa-reveal","layout":{"type":"default"}} -->
<section class="wp-block-group aa-sec aa-reveal">
<!-- wp:columns {"verticalAlignment":"center","className":"aa-about"} -->
<div class="wp-block-columns are-vertically-aligned-center aa-about">
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:group {"className":"aa-about__media","layout":{"type":"default"}} -->
<div class="wp-block-group aa-about__media">
<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="{$img}" alt="Portrait of the practitioner"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:html -->
<span class="aa-label">The Practitioner</span>
<!-- /wp:html -->
<!-- wp:heading -->
<h2 class="wp-block-heading">Kept by a single careful hand</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>For twenty years I have read cards and charts for seekers across the world. Aurum Arcana is my study made public — a place to learn the old arts slowly, and well.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-aa-secondary"} -->
<div class="wp-block-button is-style-aa-secondary"><a class="wp-block-button__link wp-element-button" href="{$about}">Read my story</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Newsletter band — Customizer-driven form via [aurum_newsletter] shortcode,
 * wrapped in a flush section so spacing matches the home rhythm.
 */
function aurum_pattern_newsletter(): string {
	return <<<HTML
<!-- wp:group {"tagName":"section","className":"aa-sec aa-sec--flush","layout":{"type":"default"}} -->
<section class="wp-block-group aa-sec aa-sec--flush">
<!-- wp:shortcode -->
[aurum_newsletter]
<!-- /wp:shortcode -->
</section>
<!-- /wp:group -->
HTML;
}
