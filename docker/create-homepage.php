<?php
/**
 * WP-CLI eval-file script.
 * Creates the homepage page with pre-filled block content and sets it as the
 * static front page. Safe to re-run — skips if the page already exists.
 *
 * Usage (from inside wpcli container):
 *   wp eval-file /create-homepage.php
 */

if ( get_option( 'mg_homepage_created' ) ) {
	WP_CLI::log( 'Homepage already created. Skipping.' );
	return;
}

// Build the block content (mirrors mamaglueck_homepage_pattern_content()).
$author    = 'Anna';
$bio       = 'Zweifach-Mama, Kaffee-Liebhaberin und Chaos-Managerin. Hier teile ich, was bei uns wirklich passiert: die schönen Momente, die anstrengenden Tage und alles dazwischen. Mit einem Augenzwinkern und ohne erhobenen Zeigefinger.';
$site_name = get_bloginfo( 'name' );

$content = <<<BLOCKS
<!-- wp:group {"className":"hero","layout":{"type":"default"}} -->
<div class="wp-block-group hero is-layout-flow wp-block-group-is-layout-flow">

<!-- wp:columns {"className":"hero__grid","isStackedOnMobile":false} -->
<div class="wp-block-columns hero__grid is-not-stacked-on-mobile">

<!-- wp:column {"className":"hero__copy"} -->
<div class="wp-block-column hero__copy is-layout-flow wp-block-column-is-layout-flow">

<!-- wp:paragraph {"className":"eyebrow hero__eyebrow"} -->
<p class="eyebrow hero__eyebrow">Willkommen bei {$site_name}</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"hero__title"} -->
<h1 class="wp-block-heading hero__title">Echtes Mama-Leben &#8212; mit Herz, Chaos und einer <span class="accent">Prise Humor</span></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"lead hero__sub"} -->
<p class="lead hero__sub">Kein Hochglanz, keine Belehrungen. Nur ehrliche Geschichten, gute Tipps und das Gef&#252;hl, mit dem ganzen Mama-Wahnsinn nicht allein zu sein.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"hero__actions"} -->
<div class="wp-block-buttons hero__actions is-layout-flex wp-block-buttons-is-layout-flex">
<!-- wp:button {"className":"is-style-pill-primary"} -->
<div class="wp-block-button is-style-pill-primary"><a class="wp-block-button__link wp-element-button" href="#blog">Zum Blog</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"is-style-pill-ghost"} -->
<div class="wp-block-button is-style-pill-ghost"><a class="wp-block-button__link wp-element-button" href="#intro">&#220;ber mich</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

<!-- wp:columns {"className":"hero__stats","isStackedOnMobile":false} -->
<div class="wp-block-columns hero__stats is-not-stacked-on-mobile">
<!-- wp:column {"className":"hero__stat"} -->
<div class="wp-block-column hero__stat is-layout-flow wp-block-column-is-layout-flow">
<!-- wp:paragraph {"className":"hero__stat-num"} --><p class="hero__stat-num"><strong>240+</strong></p><!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"hero__stat-lbl"} --><p class="hero__stat-lbl">ehrliche Beitr&#228;ge</p><!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column {"className":"hero__stat"} -->
<div class="wp-block-column hero__stat is-layout-flow wp-block-column-is-layout-flow">
<!-- wp:paragraph {"className":"hero__stat-num"} --><p class="hero__stat-num"><strong>12.000</strong></p><!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"hero__stat-lbl"} --><p class="hero__stat-lbl">liebe Leserinnen</p><!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column {"className":"hero__stat"} -->
<div class="wp-block-column hero__stat is-layout-flow wp-block-column-is-layout-flow">
<!-- wp:paragraph {"className":"hero__stat-num"} --><p class="hero__stat-num"><strong>5 Jahre</strong></p><!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"hero__stat-lbl"} --><p class="hero__stat-lbl">Mama-Wahnsinn</p><!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->

</div>
<!-- /wp:column -->

<!-- wp:column {"className":"hero__media"} -->
<div class="wp-block-column hero__media is-layout-flow wp-block-column-is-layout-flow">
<!-- wp:html -->
<div class="hero__badges-overlay">
<div class="hero__badge hero__badge--tl float">
<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
Mit ganz viel Herz
</div>
<div class="hero__badge hero__badge--br float float--rev">
<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275 1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>
Frisch gebloggt
</div>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:column -->

</div>
<!-- /wp:columns -->

</div>
<!-- /wp:group -->

<!-- wp:group {"className":"section intro","layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group section intro" id="intro">

<!-- wp:paragraph {"className":"eyebrow"} -->
<p class="eyebrow">Hallo!</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Schön, dass du da bist — ich bin {$author}</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"muted"} -->
<p class="muted">{$bio}</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"intro__sign signature"} -->
<p class="intro__sign signature">— {$author} ♥</p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:group -->

<!-- wp:shortcode -->
[mg_topics]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[mg_posts_grid]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[mg_popular_posts]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[mg_testimonials]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[mg_newsletter]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[mg_instagram]
<!-- /wp:shortcode -->
BLOCKS;

$page_id = wp_insert_post( [
	'post_type'    => 'page',
	'post_title'   => 'Home',
	'post_status'  => 'publish',
	'post_content' => $content,
	'page_template'=> 'page-templates/homepage.php',
] );

if ( is_wp_error( $page_id ) ) {
	WP_CLI::error( 'Failed to create homepage: ' . $page_id->get_error_message() );
	return;
}

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $page_id );
update_option( 'mg_homepage_created', true );

WP_CLI::success( "Homepage created (ID: {$page_id}) and set as the static front page." );
