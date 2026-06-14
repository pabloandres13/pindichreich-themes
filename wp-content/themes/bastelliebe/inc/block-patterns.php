<?php
/**
 * Block patterns for the Bastelliebe home page.
 *
 * Every home section is an insertable pattern, so a non-technical site owner can
 * build and edit the whole front page in the block editor — no PHP/HTML needed.
 * Editable copy uses native blocks (heading / paragraph / buttons / image);
 * data-driven grids use the shortcodes in inc/shortcodes.php; fixed decorative
 * structure (hero floating badge) uses wp:html.
 *
 * A combined "Startseite (komplett)" pattern assembles every section in order
 * for one-click setup.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the pattern category.
 */
function bl_register_pattern_category(): void {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category( 'bastelliebe', [
			'label' => __( 'Bastelliebe', 'bastelliebe' ),
		] );
	}
}
add_action( 'init', 'bl_register_pattern_category' );

/* ============================================================
   Section builders — each returns serialized block markup.
   ============================================================ */

/**
 * Hero: editable tagline + headline + lead + CTAs (native blocks);
 * decorative image with floating "Projekt der Woche" badge (wp:html).
 */
function bl_pattern_hero(): string {
	$anleitungen = esc_url( home_url( '/anleitungen/' ) );
	$arrow       = bl_icon( 'arrow-right', 18 );
	$sparkles    = bl_icon( 'sparkles', 18 );
	$clock       = bl_icon( 'clock', 15 );
	$gauge       = bl_icon( 'gauge', 15 );
	$tag         = bl_tag( 'wohndeko', 'sm' );
	$sofa        = bl_icon( 'sofa', 84, 1.4 );

	$media = <<<HTML
<div class="bl-hero__media">
	<div class="bl-hero__image">
		<span class="bl-hero__image-icon">{$sofa}</span>
		<span class="bl-hero__image-tag">{$tag}</span>
	</div>
	<div class="bl-hero__badge">
		<div>
			<div class="bl-hero__badge-eyebrow">Projekt der Woche</div>
			<div class="bl-hero__badge-title">Makramee-Wandbehang</div>
		</div>
		<div class="bl-hero__badge-meta">
			<span>{$clock}45 Min.</span>
			<span>{$gauge}Mittel</span>
		</div>
	</div>
</div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bl-hero bl-paper","layout":{"type":"constrained"}} -->
<section class="wp-block-group bl-hero bl-paper">
<!-- wp:group {"className":"bl-container bl-hero__inner","layout":{"type":"default"}} -->
<div class="wp-block-group bl-container bl-hero__inner">
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
<!-- wp:paragraph {"className":"bl-hero__tagline"} -->
<p class="bl-hero__tagline">Willkommen bei Bastelliebe</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1,"className":"bl-hero__headline"} -->
<h1 class="wp-block-heading bl-hero__headline">Kreative Ideen zum Nachmachen</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"bl-hero__lead"} -->
<p class="bl-hero__lead">Einfache DIY-Anleitungen für Papier, Wohndeko, Upcycling und Kinder – Schritt für Schritt erklärt, mit Materiallisten und vielen Fotos.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"className":"bl-hero__actions"} -->
<div class="wp-block-buttons bl-hero__actions">
<!-- wp:button {"className":"is-style-bl-primary bl-btn--lg"} -->
<div class="wp-block-button is-style-bl-primary bl-btn--lg"><a class="wp-block-button__link wp-element-button" href="{$anleitungen}">Projekt der Woche {$arrow}</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"is-style-bl-secondary bl-btn--lg"} -->
<div class="wp-block-button is-style-bl-secondary bl-btn--lg"><a class="wp-block-button__link wp-element-button" href="{$anleitungen}">{$sparkles} Für Einsteiger</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
<!-- wp:html -->
{$media}
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Kategorien: editable section head + category tiles ([bl_categories]).
 */
function bl_pattern_categories(): string {
	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bl-section bl-section--cream","layout":{"type":"constrained"}} -->
<section class="wp-block-group bl-section bl-section--cream">
<!-- wp:group {"className":"bl-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-container">
<!-- wp:group {"className":"bl-section-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-section-head">
<!-- wp:paragraph {"className":"bl-section-head__eyebrow"} -->
<p class="bl-section-head__eyebrow">Stöbern nach Thema</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"bl-section-title"} -->
<h2 class="wp-block-heading bl-section-title">Kategorien</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:spacer {"height":"28px"} -->
<div style="height:28px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:shortcode -->
[bl_categories]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Für Einsteiger: editable head + ghost link + beginner project cards.
 */
function bl_pattern_beginners(): string {
	$anleitungen = esc_url( home_url( '/anleitungen/' ) );
	$arrow       = bl_icon( 'arrow-right', 16 );

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bl-section bl-section--white","layout":{"type":"constrained"}} -->
<section class="wp-block-group bl-section bl-section--white">
<!-- wp:group {"className":"bl-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-container">
<!-- wp:group {"className":"bl-section-flex-head","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group bl-section-flex-head">
<!-- wp:group {"className":"bl-section-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-section-head">
<!-- wp:paragraph {"className":"bl-section-head__eyebrow"} -->
<p class="bl-section-head__eyebrow">Neu beim Basteln?</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"bl-section-title"} -->
<h2 class="wp-block-heading bl-section-title">Für Einsteiger</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"bl-section-head__text"} -->
<p class="bl-section-head__text">Schnell gemacht, wenig Material, garantierter Erfolg – ideal für deine ersten Projekte.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:paragraph -->
<p><a class="bl-textlink" href="{$anleitungen}">Alle Einsteiger-Projekte {$arrow}</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:spacer {"height":"28px"} -->
<div style="height:28px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:shortcode -->
[bl_projects count="3" beginner="1"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Neueste Anleitungen: editable head + latest project cards.
 */
function bl_pattern_latest(): string {
	$anleitungen = esc_url( home_url( '/anleitungen/' ) );
	$arrow       = bl_icon( 'arrow-right', 16 );

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bl-section bl-section--cream","layout":{"type":"constrained"}} -->
<section class="wp-block-group bl-section bl-section--cream">
<!-- wp:group {"className":"bl-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-container">
<!-- wp:group {"className":"bl-section-flex-head","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group bl-section-flex-head">
<!-- wp:group {"className":"bl-section-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-section-head">
<!-- wp:paragraph {"className":"bl-section-head__eyebrow"} -->
<p class="bl-section-head__eyebrow">Frisch aus der Werkstatt</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"bl-section-title"} -->
<h2 class="wp-block-heading bl-section-title">Neueste Anleitungen</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:paragraph -->
<p><a class="bl-textlink" href="{$anleitungen}">Alle Anleitungen {$arrow}</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:spacer {"height":"28px"} -->
<div style="height:28px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:shortcode -->
[bl_projects count="6"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Beliebte Projekte: editable head + 4-up compact project cards.
 */
function bl_pattern_popular(): string {
	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bl-section bl-section--white","layout":{"type":"constrained"}} -->
<section class="wp-block-group bl-section bl-section--white">
<!-- wp:group {"className":"bl-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-container">
<!-- wp:group {"className":"bl-section-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-section-head">
<!-- wp:paragraph {"className":"bl-section-head__eyebrow"} -->
<p class="bl-section-head__eyebrow">Reader Favorites</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"bl-section-title"} -->
<h2 class="wp-block-heading bl-section-title">Beliebte Projekte</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:spacer {"height":"28px"} -->
<div style="height:28px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:shortcode -->
[bl_projects count="4" columns="4" compact="1"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Über mich teaser: editable portrait + handwritten eyebrow + story + CTA.
 */
function bl_pattern_about(): string {
	$about       = esc_url( home_url( '/ueber-mich/' ) );
	$portrait    = 'https://images.unsplash.com/photo-1556760544-74068565f05c?auto=format&fit=crop&w=700&q=80';

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bl-section bl-section--cream","layout":{"type":"constrained"}} -->
<section class="wp-block-group bl-section bl-section--cream">
<!-- wp:group {"className":"bl-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-container">
<!-- wp:columns {"verticalAlignment":"center","className":"bl-about"} -->
<div class="wp-block-columns are-vertically-aligned-center bl-about">
<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%">
<!-- wp:image {"className":"bl-about__media","sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large bl-about__media"><img src="{$portrait}" alt="Lena, Gründerin von Bastelliebe"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:group {"className":"bl-about__body","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-about__body">
<!-- wp:paragraph {"className":"bl-about__eyebrow"} -->
<p class="bl-about__eyebrow">Hallo, ich bin Lena</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"bl-about__title"} -->
<h2 class="wp-block-heading bl-about__title">Bastelliebe ist mein Herzensprojekt</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"bl-about__text"} -->
<p class="bl-about__text">Seit über zehn Jahren bastle, nähe und werkle ich für mein Leben gern. Hier teile ich meine liebsten Projekte – ehrlich, einfach erklärt und immer zum Selbermachen.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-bl-secondary"} -->
<div class="wp-block-button is-style-bl-secondary"><a class="wp-block-button__link wp-element-button" href="{$about}">Mehr über mich</a></div>
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
 * Material-Favoriten: editable head + affiliate cards ([bl_affiliate]).
 */
function bl_pattern_affiliate(): string {
	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bl-section bl-section--white","layout":{"type":"constrained"}} -->
<section class="wp-block-group bl-section bl-section--white">
<!-- wp:group {"className":"bl-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-container">
<!-- wp:group {"className":"bl-section-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-section-head">
<!-- wp:paragraph {"className":"bl-section-head__eyebrow"} -->
<p class="bl-section-head__eyebrow">Shop the Post</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"bl-section-title"} -->
<h2 class="wp-block-heading bl-section-title">Meine Material-Favoriten</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:spacer {"height":"28px"} -->
<div style="height:28px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:shortcode -->
[bl_affiliate]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Newsletter band ([bl_newsletter]) inside a constrained container.
 */
function bl_pattern_newsletter(): string {
	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bl-section bl-section--cream","layout":{"type":"constrained"}} -->
<section class="wp-block-group bl-section bl-section--cream">
<!-- wp:group {"className":"bl-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-container">
<!-- wp:shortcode -->
[bl_newsletter]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Instagram strip ([bl_social]).
 */
function bl_pattern_social(): string {
	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bl-section bl-section--white","layout":{"type":"constrained"}} -->
<section class="wp-block-group bl-section bl-section--white">
<!-- wp:group {"className":"bl-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bl-container">
<!-- wp:shortcode -->
[bl_social count="6"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/* ============================================================
   Registration
   ============================================================ */

function bl_register_block_patterns(): void {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	$cat      = [ 'bastelliebe' ];
	$patterns = [
		'bastelliebe/hero' => [
			'title'       => __( 'Startseite: Hero', 'bastelliebe' ),
			'description' => __( 'Heller Einstieg mit Handschrift-Eyebrow, Headline, Buttons und „Projekt der Woche"-Bild mit Badge.', 'bastelliebe' ),
			'content'     => bl_pattern_hero(),
		],
		'bastelliebe/categories' => [
			'title'       => __( 'Startseite: Kategorien', 'bastelliebe' ),
			'description' => __( 'Vier farbcodierte Kategorie-Kacheln (Papier, Heimwerken, Wohndeko, Kinder).', 'bastelliebe' ),
			'content'     => bl_pattern_categories(),
		],
		'bastelliebe/beginners' => [
			'title'       => __( 'Startseite: Für Einsteiger', 'bastelliebe' ),
			'description' => __( 'Überschrift und drei einsteigerfreundliche Projekt-Karten (lädt automatisch deine Beiträge).', 'bastelliebe' ),
			'content'     => bl_pattern_beginners(),
		],
		'bastelliebe/latest' => [
			'title'       => __( 'Startseite: Neueste Anleitungen', 'bastelliebe' ),
			'description' => __( 'Überschrift und sechs neueste Anleitungen (lädt automatisch deine Beiträge, sonst Beispiele).', 'bastelliebe' ),
			'content'     => bl_pattern_latest(),
		],
		'bastelliebe/popular' => [
			'title'       => __( 'Startseite: Beliebte Projekte', 'bastelliebe' ),
			'description' => __( 'Vier kompakte Projekt-Karten als „Reader Favorites".', 'bastelliebe' ),
			'content'     => bl_pattern_popular(),
		],
		'bastelliebe/about' => [
			'title'       => __( 'Startseite: Über mich', 'bastelliebe' ),
			'description' => __( 'Porträt, Handschrift-Begrüßung, persönliche Geschichte und Button.', 'bastelliebe' ),
			'content'     => bl_pattern_about(),
		],
		'bastelliebe/affiliate' => [
			'title'       => __( 'Startseite: Material-Favoriten', 'bastelliebe' ),
			'description' => __( 'Affiliate-Karten mit „Anzeige"-Kennzeichnung und Offenlegung.', 'bastelliebe' ),
			'content'     => bl_pattern_affiliate(),
		],
		'bastelliebe/newsletter' => [
			'title'       => __( 'Startseite: Newsletter', 'bastelliebe' ),
			'description' => __( 'Koralle-Newsletter-Band mit E-Mail-Feld und DSGVO-Einwilligung.', 'bastelliebe' ),
			'content'     => bl_pattern_newsletter(),
		],
		'bastelliebe/social' => [
			'title'       => __( 'Startseite: Instagram', 'bastelliebe' ),
			'description' => __( 'Instagram-Handle und Foto-Raster.', 'bastelliebe' ),
			'content'     => bl_pattern_social(),
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

	// Combined full home page — every section in design order.
	register_block_pattern( 'bastelliebe/home', [
		'title'       => __( 'Startseite (komplett)', 'bastelliebe' ),
		'description' => __( 'Die ganze Startseite auf einmal: Hero, Kategorien, Für Einsteiger, Neueste Anleitungen, Beliebte Projekte, Über mich, Material-Favoriten, Newsletter und Instagram.', 'bastelliebe' ),
		'categories'  => $cat,
		'content'     =>
			bl_pattern_hero() .
			bl_pattern_categories() .
			bl_pattern_beginners() .
			bl_pattern_latest() .
			bl_pattern_popular() .
			bl_pattern_about() .
			bl_pattern_affiliate() .
			bl_pattern_newsletter() .
			bl_pattern_social(),
	] );
}
add_action( 'init', 'bl_register_block_patterns' );
