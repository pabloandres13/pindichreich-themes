<?php
defined( 'ABSPATH' ) || exit;

/* ---- Pattern category ---- */
function mamaglueck_register_pattern_category() {
	register_block_pattern_category(
		'mamaglueck',
		[ 'label' => __( 'Mamaglück', 'mamaglueck' ) ]
	);
}
add_action( 'init', 'mamaglueck_register_pattern_category' );

/* ---- Patterns ---- */
function mamaglueck_register_block_patterns() {

	/* ------------------------------------------------------------------
	 * Full homepage
	 * Hero + intro as native editable blocks.
	 * All other sections via shortcodes so they stay dynamic.
	 * ------------------------------------------------------------------ */
	register_block_pattern(
		'mamaglueck/homepage-full',
		[
			'title'       => __( 'Vollständige Startseite', 'mamaglueck' ),
			'description' => __( 'Hero, Intro, Themen, Beiträge, Leserinnen-Stimmen, Newsletter und Instagram — komplett.', 'mamaglueck' ),
			'categories'  => [ 'mamaglueck' ],
			'content'     => mamaglueck_homepage_pattern_content(),
		]
	);

	/* ---- Hero only ---- */
	register_block_pattern(
		'mamaglueck/hero',
		[
			'title'      => __( 'Hero-Bereich', 'mamaglueck' ),
			'categories' => [ 'mamaglueck' ],
			'content'    => mamaglueck_hero_pattern_content(),
		]
	);

	/* ---- Intro only ---- */
	register_block_pattern(
		'mamaglueck/intro',
		[
			'title'      => __( 'Hallo-Streifen (Autorin)', 'mamaglueck' ),
			'categories' => [ 'mamaglueck' ],
			'content'    => mamaglueck_intro_pattern_content(),
		]
	);

	/* ---- Testimonials ---- */
	register_block_pattern(
		'mamaglueck/testimonials',
		[
			'title'      => __( 'Leserinnen-Stimmen', 'mamaglueck' ),
			'categories' => [ 'mamaglueck' ],
			'content'    => mamaglueck_testimonials_pattern_content(),
		]
	);

	/* ---- Newsletter ---- */
	register_block_pattern(
		'mamaglueck/newsletter',
		[
			'title'      => __( 'Newsletter-Band', 'mamaglueck' ),
			'categories' => [ 'mamaglueck' ],
			'content'    => mamaglueck_newsletter_pattern_content(),
		]
	);

	/* ---- Instagram ---- */
	register_block_pattern(
		'mamaglueck/instagram',
		[
			'title'      => __( 'Instagram-Streifen', 'mamaglueck' ),
			'categories' => [ 'mamaglueck' ],
			'content'    => mamaglueck_instagram_pattern_content(),
		]
	);
}
add_action( 'init', 'mamaglueck_register_block_patterns' );


/* ==============================================================
   Pattern content builders
   ============================================================== */

function mamaglueck_hero_pattern_content() {
	$site_name = get_bloginfo( 'name' );

	// Fully native Gutenberg hero:
	//   wp:group.hero  (background + padding via CSS)
	//   └── wp:columns.hero__grid  (2-column grid — CSS overrides Gutenberg flex)
	//       ├── wp:column.hero__copy  (left: eyebrow › H1 › subline › buttons › stats)
	//       └── wp:column.hero__media (right: image — blob shape + halo via CSS)
	//
	// The organic blob border-radius and the yellow halo behind the image
	// are applied purely with CSS so the user only needs to upload a photo.

	// WordPress adds layout classes to block HTML when it saves.
	// These must be present in the pattern HTML or Gutenberg shows
	// "Block contains unexpected or invalid content" on load.
	return '<!-- wp:group {"className":"hero","layout":{"type":"default"}} -->
<div class="wp-block-group hero is-layout-flow wp-block-group-is-layout-flow">

<!-- wp:columns {"className":"hero__grid","isStackedOnMobile":false} -->
<div class="wp-block-columns hero__grid is-not-stacked-on-mobile">

<!-- wp:column {"className":"hero__copy"} -->
<div class="wp-block-column hero__copy is-layout-flow wp-block-column-is-layout-flow">

<!-- wp:paragraph {"className":"eyebrow hero__eyebrow"} -->
<p class="eyebrow hero__eyebrow">Willkommen bei ' . esc_html( $site_name ) . '</p>
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
<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>
Frisch gebloggt
</div>
</div>
<!-- /wp:html -->
</div>
<!-- /wp:column -->

</div>
<!-- /wp:columns -->

</div>
<!-- /wp:group -->';
}


function mamaglueck_intro_pattern_content() {
	$author = get_theme_mod( 'mg_author_name', 'Anna' );
	$bio    = get_theme_mod(
		'mg_author_bio',
		'Zweifach-Mama, Kaffee-Liebhaberin und Chaos-Managerin. Hier teile ich, was bei uns wirklich passiert: die schönen Momente, die anstrengenden Tage und alles dazwischen. Mit einem Augenzwinkern und ohne erhobenen Zeigefinger.'
	);

	return '<!-- wp:group {"className":"section intro","layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group section intro" id="intro">

<!-- wp:paragraph {"className":"eyebrow"} -->
<p class="eyebrow">Hallo!</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Schön, dass du da bist — ich bin ' . esc_html( $author ) . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"muted"} -->
<p class="muted">' . esc_html( $bio ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"intro__sign signature"} -->
<p class="intro__sign signature">— ' . esc_html( $author ) . ' ♥</p>
<!-- /wp:paragraph -->

</div>
<!-- /wp:group -->';
}


function mamaglueck_testimonials_pattern_content() {
	return '<!-- wp:group {"className":"section section--teal","layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group section section--teal is-layout-constrained wp-block-group-is-layout-constrained" id="kontakt">

<!-- wp:group {"className":"section-head center reveal","layout":{"type":"default"}} -->
<div class="wp-block-group section-head center reveal is-layout-flow wp-block-group-is-layout-flow">

<!-- wp:paragraph {"className":"eyebrow"} -->
<p class="eyebrow">Aus der Community</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Das sagen meine Leserinnen</h2>
<!-- /wp:heading -->

</div>
<!-- /wp:group -->

<!-- wp:html -->
<div class="quotes reveal">
  <figure class="quote">
    <span class="quote__mark">&ldquo;</span>
    <p>Endlich ein Blog, der nicht belehrt, sondern einfach versteht. Ich f&#252;hl mich hier gesehen &#8212; und muss oft herzhaft lachen.</p>
    <figcaption class="quote__author">
      <span class="quote__avatar"><span class="photo" data-tint="coral"></span></span>
      <span><b>Lena</b><span>Mama von zwei, K&#246;ln</span></span>
    </figcaption>
  </figure>
  <figure class="quote">
    <span class="quote__mark">&ldquo;</span>
    <p>Deine Texte sind wie ein Kaffee mit der besten Freundin. Ehrlich, warm und genau zur richtigen Zeit. Danke daf&#252;r!</p>
    <figcaption class="quote__author">
      <span class="quote__avatar"><span class="photo" data-tint="teal"></span></span>
      <span><b>Sophie</b><span>frischgebackene Mama, Wien</span></span>
    </figcaption>
  </figure>
  <figure class="quote">
    <span class="quote__mark">&ldquo;</span>
    <p>So ehrlich, so warm, so witzig. F&#252;r mich Pflichtlekt&#252;re in den ersten Monaten &#8212; und weit dar&#252;ber hinaus.</p>
    <figcaption class="quote__author">
      <span class="quote__avatar"><span class="photo" data-tint="yellow"></span></span>
      <span><b>Mira</b><span>Mama von drei, Z&#252;rich</span></span>
    </figcaption>
  </figure>
</div>
<!-- /wp:html -->

</div>
<!-- /wp:group -->';
}


function mamaglueck_newsletter_pattern_content() {
	return '<!-- wp:group {"className":"section newsletter","layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group section newsletter is-layout-constrained wp-block-group-is-layout-constrained" id="newsletter">

<!-- wp:group {"className":"newsletter__inner reveal","layout":{"type":"default"}} -->
<div class="wp-block-group newsletter__inner reveal is-layout-flow wp-block-group-is-layout-flow">

<!-- wp:html -->
<span class="deco dot float" style="width:120px;height:120px;background:rgba(255,255,255,0.12);top:-30px;right:8%"></span>
<span class="deco dot float float--rev" style="width:60px;height:60px;background:var(--yellow);opacity:0.85;bottom:-18px;right:22%"></span>
<!-- /wp:html -->

<!-- wp:paragraph {"className":"eyebrow"} -->
<p class="eyebrow">Newsletter</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Verpass keinen Beitrag!</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Einmal pro Woche eine liebe Mail mit den neuesten Geschichten, Tipps und einer kleinen Portion Mama-Mut. Kein Spam, versprochen.</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[mg_newsletter_form]
<!-- /wp:shortcode -->

</div>
<!-- /wp:group -->

</div>
<!-- /wp:group -->';
}


function mamaglueck_instagram_pattern_content() {
	$handle      = get_theme_mod( 'mg_instagram_handle', 'mamaglueck' );
	$insta_svg   = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>';
	$overlay_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>';

	$tiles = '';
	foreach ( [ 'coral', 'teal', 'yellow', 'coral', 'teal', 'yellow' ] as $tint ) {
		$tiles .= "\n  " . '<a href="https://instagram.com/' . esc_attr( $handle ) . '" class="insta-tile" target="_blank" rel="noopener noreferrer"><span class="photo" data-tint="' . esc_attr( $tint ) . '"></span><span class="insta-tile__overlay">' . $overlay_svg . '</span></a>';
	}

	return '<!-- wp:group {"className":"section","layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group section is-layout-constrained wp-block-group-is-layout-constrained">

<!-- wp:group {"className":"section-head center reveal","layout":{"type":"default"}} -->
<div class="wp-block-group section-head center reveal is-layout-flow wp-block-group-is-layout-flow">

<!-- wp:paragraph {"className":"eyebrow"} -->
<p class="eyebrow">Mehr Mama-Momente</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Folge mir auf Instagram</h2>
<!-- /wp:heading -->

<!-- wp:html -->
<p><a class="insta-handle" href="https://instagram.com/' . esc_attr( $handle ) . '" target="_blank" rel="noopener noreferrer">' . $insta_svg . ' @' . esc_html( $handle ) . '</a></p>
<!-- /wp:html -->

</div>
<!-- /wp:group -->

<!-- wp:html -->
<div class="insta-grid reveal">' . $tiles . '
</div>
<!-- /wp:html -->

</div>
<!-- /wp:group -->';
}


function mamaglueck_homepage_pattern_content() {
	return mamaglueck_hero_pattern_content() . '

' . mamaglueck_intro_pattern_content() . '

<!-- wp:shortcode -->
[mg_topics]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[mg_posts_grid]
<!-- /wp:shortcode -->

<!-- wp:shortcode -->
[mg_popular_posts]
<!-- /wp:shortcode -->

' . mamaglueck_testimonials_pattern_content() . '

' . mamaglueck_newsletter_pattern_content() . '

' . mamaglueck_instagram_pattern_content();
}
