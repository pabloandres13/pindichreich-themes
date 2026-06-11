<?php
/**
 * Block patterns for the Body & Mind home page.
 *
 * Each home section is registered as an insertable pattern so a non-technical
 * studio owner can build and edit the front page entirely in the block editor
 * (Appearance is for brand, the editor is for content). Editable copy uses
 * native blocks (heading / paragraph / buttons / image); data-driven grids use
 * the shortcodes in inc/shortcodes.php; fixed decorative structure (hero badge,
 * pricing & testimonial cards, HWG disclaimer) uses wp:html.
 *
 * A combined "Startseite (komplett)" pattern assembles every section in order
 * for one-click setup.
 *
 * @package body-and-mind
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the pattern category.
 */
function bm_register_pattern_category(): void {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category( 'body-and-mind', [
			'label' => __( 'Body & Mind', 'body-and-mind' ),
		] );
	}
}
add_action( 'init', 'bm_register_pattern_category' );

/* ============================================================
   Section builders — each returns serialized block markup.
   Kept as functions so the combined pattern can reuse them.
   ============================================================ */

/**
 * Hero: editable tagline + headline + lead + CTAs (native blocks),
 * decorative stats + overlapping photo badge (wp:html).
 */
function bm_pattern_hero(): string {
	$kontakt  = esc_url( home_url( '/kontakt/' ) );
	$kurse    = esc_url( home_url( '/kurse/' ) );
	$arrow    = bm_icon( 'arrow-right', 18 );
	$leaf     = bm_icon( 'leaf', 20 );
	$hero_img = 'https://images.unsplash.com/photo-1545389336-cf090694435e?auto=format&fit=crop&w=1100&q=80';

	$stats = <<<HTML
<div class="bm-hero__stats">
	<div><div class="bm-hero__stat-num">3</div><div class="bm-hero__stat-label">Angebote</div></div>
	<div><div class="bm-hero__stat-num">12+</div><div class="bm-hero__stat-label">Kurse / Woche</div></div>
	<div><div class="bm-hero__stat-num">9 Jahre</div><div class="bm-hero__stat-label">Erfahrung</div></div>
</div>
HTML;

	$badge = <<<HTML
<div class="bm-hero__badge">
	<div class="bm-hero__badge-icon">{$leaf}</div>
	<div>
		<div class="bm-hero__badge-title">Kleine Gruppen</div>
		<div class="bm-hero__badge-sub">max. 10 Teilnehmerinnen</div>
	</div>
</div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bm-hero bm-section--cream","layout":{"type":"constrained"}} -->
<section class="wp-block-group bm-hero bm-section--cream">
<!-- wp:group {"className":"bm-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-container">
<!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center">
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:paragraph {"className":"bm-script bm-hero__tagline"} -->
<p class="bm-script bm-hero__tagline">Atme. Du bist hier richtig.</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1,"className":"bm-hero__headline"} -->
<h1 class="wp-block-heading bm-hero__headline">Ankommen,<br>durchatmen,<br>in Bewegung kommen.</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"bm-hero__lead"} -->
<p class="bm-hero__lead">Ein heller Ort für Yoga, Meditation und Personal Training. Komm vorbei und probiere eine Stunde ganz unverbindlich aus.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"className":"bm-hero__actions"} -->
<div class="wp-block-buttons bm-hero__actions">
<!-- wp:button {"className":"is-style-bm-primary bm-btn--lg"} -->
<div class="wp-block-button is-style-bm-primary bm-btn--lg"><a class="wp-block-button__link wp-element-button" href="{$kontakt}">Probestunde buchen</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"is-style-bm-secondary bm-btn--lg"} -->
<div class="wp-block-button is-style-bm-secondary bm-btn--lg"><a class="wp-block-button__link wp-element-button" href="{$kurse}">Kurse ansehen {$arrow}</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
<!-- wp:html -->
{$stats}
<!-- /wp:html -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:group {"className":"bm-hero__image-wrap","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-hero__image-wrap">
<!-- wp:image {"className":"bm-hero__image","sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large bm-hero__image"><img src="{$hero_img}" alt="Yoga im hellen Studio"/></figure>
<!-- /wp:image -->
<!-- wp:html -->
{$badge}
<!-- /wp:html -->
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
 * Kurse & Angebote: editable section head + ghost link (native),
 * class grid via [bm_classes] shortcode (live CPT data, demo fallback).
 */
function bm_pattern_classes(): string {
	$kurse = esc_url( home_url( '/kurse/' ) );
	$arrow = bm_icon( 'arrow-right', 18 );

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bm-section bm-section--white","layout":{"type":"constrained"}} -->
<section class="wp-block-group bm-section bm-section--white">
<!-- wp:group {"className":"bm-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-container">
<!-- wp:group {"className":"bm-section-flex-head","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group bm-section-flex-head">
<!-- wp:group {"className":"bm-section-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-section-head">
<!-- wp:paragraph {"className":"bm-eyebrow"} -->
<p class="bm-eyebrow">Kurse &amp; Angebote</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"bm-section-title"} -->
<h2 class="wp-block-heading bm-section-title">Finde, was dir guttut</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"bm-section-head__text"} -->
<p class="bm-section-head__text">Drei Wege, bei dir anzukommen — einzeln buchbar oder kombiniert.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-bm-ghost"} -->
<div class="wp-block-button is-style-bm-ghost"><a class="wp-block-button__link wp-element-button" href="{$kurse}">Alle Angebote {$arrow}</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
<!-- wp:shortcode -->
[bm_classes count="4"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Über mich: editable portrait (native image) + story copy + certs + CTA.
 */
function bm_pattern_about(): string {
	$kontakt      = esc_url( home_url( '/kontakt/' ) );
	$portrait_img = 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=700&q=80';

	$certs = <<<HTML
<div class="bm-about__certs">
	<span class="bm-about__cert">500h Yoga Alliance</span>
	<span class="bm-about__cert">Meditationslehrerin</span>
	<span class="bm-about__cert">B-Lizenz Fitness</span>
</div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bm-section bm-section--sage","layout":{"type":"constrained"}} -->
<section class="wp-block-group bm-section bm-section--sage">
<!-- wp:group {"className":"bm-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-container">
<!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center">
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:image {"className":"bm-about__image","sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large bm-about__image"><img src="{$portrait_img}" alt="Lena, Gründerin"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:paragraph {"className":"bm-eyebrow"} -->
<p class="bm-eyebrow">Über mich</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"bm-section-title"} -->
<h2 class="wp-block-heading bm-section-title">Hallo, ich bin Lena</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Seit neun Jahren begleite ich Menschen auf ihrem Weg zu mehr Ruhe und Beweglichkeit. In meinem Studio soll sich jede willkommen fühlen — ganz gleich, wo du gerade stehst.</p>
<!-- /wp:paragraph -->
<!-- wp:html -->
{$certs}
<!-- /wp:html -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-bm-secondary"} -->
<div class="wp-block-button is-style-bm-secondary"><a class="wp-block-button__link wp-element-button" href="{$kontakt}">Lerne mich kennen</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
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
 * Stundenplan preview: editable head + ghost link, rows via [bm_schedule].
 */
function bm_pattern_schedule(): string {
	$plan  = esc_url( home_url( '/stundenplan/' ) );
	$arrow = bm_icon( 'arrow-right', 18 );

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bm-section bm-section--white","layout":{"type":"constrained"}} -->
<section class="wp-block-group bm-section bm-section--white">
<!-- wp:group {"className":"bm-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-container">
<!-- wp:group {"className":"bm-section-flex-head","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group bm-section-flex-head">
<!-- wp:group {"className":"bm-section-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-section-head">
<!-- wp:paragraph {"className":"bm-eyebrow"} -->
<p class="bm-eyebrow">Stundenplan</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"bm-section-title"} -->
<h2 class="wp-block-heading bm-section-title">Diese Woche im Studio</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-bm-ghost"} -->
<div class="wp-block-button is-style-bm-ghost"><a class="wp-block-button__link wp-element-button" href="{$plan}">Ganzer Stundenplan {$arrow}</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
<!-- wp:shortcode -->
[bm_schedule count="3"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Preise & Mitgliedschaft: editable centered head (native) + 3 pricing cards
 * (wp:html, fixed structure) + HWG disclaimer.
 */
function bm_pattern_pricing(): string {
	$kontakt = esc_url( home_url( '/kontakt/' ) );
	$check   = bm_icon( 'check', 12 );
	$info    = bm_icon( 'info', 16 );

	$cards = <<<HTML
<div class="bm-pricing-grid">
	<div class="bm-pricing-card">
		<div class="bm-pricing-card__top"><span class="bm-pricing-card__name">Probestunde</span></div>
		<div class="bm-pricing-card__price-wrap"><span class="bm-pricing-card__price">15 €</span></div>
		<p class="bm-pricing-card__desc">Einmalig, unverbindlich</p>
		<ul class="bm-pricing-card__features">
			<li class="bm-pricing-card__feature"><span class="bm-pricing-card__check">{$check}</span>Eine Kursstunde nach Wahl</li>
			<li class="bm-pricing-card__feature"><span class="bm-pricing-card__check">{$check}</span>Persönliches Kennenlernen</li>
		</ul>
		<a href="{$kontakt}" class="bm-btn bm-btn--secondary bm-btn--full">Buchen</a>
	</div>
	<div class="bm-pricing-card bm-pricing-card--featured">
		<div class="bm-pricing-card__top"><span class="bm-pricing-card__name">Flat Monat</span><span class="bm-pricing-card__badge">Beliebt</span></div>
		<div class="bm-pricing-card__price-wrap"><span class="bm-pricing-card__price">89 €</span><span class="bm-pricing-card__period">/ Monat</span></div>
		<p class="bm-pricing-card__desc">Unbegrenzt alle Kurse</p>
		<ul class="bm-pricing-card__features">
			<li class="bm-pricing-card__feature"><span class="bm-pricing-card__check">{$check}</span>Alle Yoga- &amp; Meditationskurse</li>
			<li class="bm-pricing-card__feature"><span class="bm-pricing-card__check">{$check}</span>Personal-Training-Rabatt</li>
			<li class="bm-pricing-card__feature"><span class="bm-pricing-card__check">{$check}</span>Monatlich kündbar</li>
		</ul>
		<a href="{$kontakt}" class="bm-btn bm-btn--primary bm-btn--full">Mitglied werden</a>
	</div>
	<div class="bm-pricing-card">
		<div class="bm-pricing-card__top"><span class="bm-pricing-card__name">10er-Karte</span></div>
		<div class="bm-pricing-card__price-wrap"><span class="bm-pricing-card__price">135 €</span></div>
		<p class="bm-pricing-card__desc">12 Monate gültig</p>
		<ul class="bm-pricing-card__features">
			<li class="bm-pricing-card__feature"><span class="bm-pricing-card__check">{$check}</span>10 Kursstunden frei wählbar</li>
			<li class="bm-pricing-card__feature"><span class="bm-pricing-card__check">{$check}</span>Übertragbar auf Freunde</li>
		</ul>
		<a href="{$kontakt}" class="bm-btn bm-btn--secondary bm-btn--full">Auswählen</a>
	</div>
</div>
HTML;

	$disclaimer = <<<HTML
<div style="max-width:720px;margin:2rem auto 0">
	<div class="bm-disclaimer">
		<span class="bm-disclaimer__icon">{$info}</span>
		<div>
			<div class="bm-disclaimer__title">Hinweis</div>
			<p class="bm-disclaimer__text">Unsere Angebote dienen dem Wohlbefinden und ersetzen keine ärztliche Beratung oder Behandlung. Bei gesundheitlichen Beschwerden sprich bitte vorab mit deiner Ärztin oder deinem Arzt.</p>
		</div>
	</div>
</div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bm-section bm-section--cream","layout":{"type":"constrained"}} -->
<section class="wp-block-group bm-section bm-section--cream">
<!-- wp:group {"className":"bm-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-container">
<!-- wp:group {"className":"bm-section-head bm-section-head--center","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-section-head bm-section-head--center">
<!-- wp:paragraph {"align":"center","className":"bm-eyebrow"} -->
<p class="has-text-align-center bm-eyebrow">Preise &amp; Mitgliedschaft</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","className":"bm-section-title"} -->
<h2 class="wp-block-heading has-text-align-center bm-section-title">Flexibel starten</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"bm-section-head__text"} -->
<p class="has-text-align-center bm-section-head__text">Unverbindlich ausprobieren oder dauerhaft dabei sein — du entscheidest.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:spacer {"height":"3rem"} -->
<div style="height:3rem" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:html -->
{$cards}
<!-- /wp:html -->
<!-- wp:html -->
{$disclaimer}
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Stimmen / Testimonials: editable centered head + 3 cards (wp:html).
 */
function bm_pattern_testimonials(): string {
	$star  = bm_icon( 'star', 16 );
	$stars = str_repeat( $star, 5 );
	$a1    = 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=160&q=80';
	$a2    = 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=160&q=80';
	$a3    = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=160&q=80';

	$cards = <<<HTML
<div class="bm-testimonials-grid">
	<div class="bm-testimonial-card">
		<div class="bm-testimonial-card__stars" aria-label="5 von 5 Sternen">{$stars}</div>
		<p class="bm-testimonial-card__quote">&ldquo;Ich komme jede Woche gern — das Studio ist hell und die Stunden tun einfach gut.&rdquo;</p>
		<div class="bm-testimonial-card__footer">
			<img class="bm-testimonial-card__avatar" src="{$a1}" alt="Marie K." loading="lazy" decoding="async">
			<div><div class="bm-testimonial-card__author">Marie K.</div><div class="bm-testimonial-card__meta">Mitglied seit 2023</div></div>
		</div>
	</div>
	<div class="bm-testimonial-card">
		<div class="bm-testimonial-card__stars" aria-label="5 von 5 Sternen">{$stars}</div>
		<p class="bm-testimonial-card__quote">&ldquo;Lena nimmt sich Zeit und erklärt ruhig. Ich habe mich vom ersten Tag an willkommen gefühlt.&rdquo;</p>
		<div class="bm-testimonial-card__footer">
			<img class="bm-testimonial-card__avatar" src="{$a2}" alt="Sophie B." loading="lazy" decoding="async">
			<div><div class="bm-testimonial-card__author">Sophie B.</div><div class="bm-testimonial-card__meta">Vinyasa &amp; Meditation</div></div>
		</div>
	</div>
	<div class="bm-testimonial-card">
		<div class="bm-testimonial-card__stars" aria-label="5 von 5 Sternen">{$stars}</div>
		<p class="bm-testimonial-card__quote">&ldquo;Das Personal Training ist genau auf mich abgestimmt. Endlich Bewegung, die sich leicht anfühlt.&rdquo;</p>
		<div class="bm-testimonial-card__footer">
			<img class="bm-testimonial-card__avatar" src="{$a3}" alt="Johanna R." loading="lazy" decoding="async">
			<div><div class="bm-testimonial-card__author">Johanna R.</div><div class="bm-testimonial-card__meta">Personal Training</div></div>
		</div>
	</div>
</div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bm-section bm-section--white","layout":{"type":"constrained"}} -->
<section class="wp-block-group bm-section bm-section--white">
<!-- wp:group {"className":"bm-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-container">
<!-- wp:group {"className":"bm-section-head bm-section-head--center","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-section-head bm-section-head--center">
<!-- wp:paragraph {"align":"center","className":"bm-eyebrow"} -->
<p class="has-text-align-center bm-eyebrow">Stimmen</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","className":"bm-section-title"} -->
<h2 class="wp-block-heading has-text-align-center bm-section-title">Was unsere Mitglieder sagen</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:spacer {"height":"3rem"} -->
<div style="height:3rem" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:html -->
{$cards}
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Magazin teaser: editable head + filter chips (wp:html) + [bm_magazine].
 */
function bm_pattern_magazine(): string {
	$magazin = esc_url( home_url( '/magazin/' ) );

	$chips = <<<HTML
<div style="display:flex;gap:0.5rem;flex-wrap:wrap">
	<span class="bm-badge bm-badge--lavender">Alle</span>
	<span class="bm-badge bm-badge--sage">Yoga</span>
	<span class="bm-badge bm-badge--sage">Achtsamkeit</span>
</div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bm-section bm-section--lavender","layout":{"type":"constrained"}} -->
<section class="wp-block-group bm-section bm-section--lavender">
<!-- wp:group {"className":"bm-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-container">
<!-- wp:group {"className":"bm-section-flex-head","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group bm-section-flex-head">
<!-- wp:group {"className":"bm-section-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-section-head">
<!-- wp:paragraph {"className":"bm-eyebrow"} -->
<p class="bm-eyebrow">Magazin</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"bm-section-title"} -->
<h2 class="wp-block-heading bm-section-title">Sanfte Impulse zum Lesen</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:html -->
{$chips}
<!-- /wp:html -->
</div>
<!-- /wp:group -->
<!-- wp:shortcode -->
[bm_magazine count="3"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Newsletter band via [bm_newsletter] inside a narrow container.
 */
function bm_pattern_newsletter(): string {
	return <<<HTML
<!-- wp:group {"tagName":"section","className":"bm-section bm-section--white","layout":{"type":"constrained"}} -->
<section class="wp-block-group bm-section bm-section--white">
<!-- wp:group {"className":"bm-container bm-container--narrow","layout":{"type":"constrained"}} -->
<div class="wp-block-group bm-container bm-container--narrow">
<!-- wp:shortcode -->
[bm_newsletter]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Standalone reusable HWG disclaimer callout (for Kurse / Preise / health copy).
 */
function bm_pattern_disclaimer(): string {
	$info = bm_icon( 'info', 16 );

	return <<<HTML
<!-- wp:html -->
<div class="bm-disclaimer">
	<span class="bm-disclaimer__icon">{$info}</span>
	<div>
		<div class="bm-disclaimer__title">Hinweis</div>
		<p class="bm-disclaimer__text">Unsere Angebote dienen dem Wohlbefinden und ersetzen keine ärztliche Beratung oder Behandlung. Bei gesundheitlichen Beschwerden sprich bitte vorab mit deiner Ärztin oder deinem Arzt.</p>
	</div>
</div>
<!-- /wp:html -->
HTML;
}

/* ============================================================
   Registration
   ============================================================ */

/**
 * Register every home-section pattern plus the combined page.
 */
function bm_register_block_patterns(): void {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	$cat      = [ 'body-and-mind' ];
	$patterns = [
		'body-and-mind/hero' => [
			'title'       => __( 'Startseite: Hero', 'body-and-mind' ),
			'description' => __( 'Heller Einstieg mit Tagline, Headline, Buttons, Kennzahlen und Foto mit Badge.', 'body-and-mind' ),
			'content'     => bm_pattern_hero(),
		],
		'body-and-mind/classes' => [
			'title'       => __( 'Startseite: Kurse & Angebote', 'body-and-mind' ),
			'description' => __( 'Überschrift und Kurs-Karten (lädt automatisch deine „Kurse“, sonst Beispiele).', 'body-and-mind' ),
			'content'     => bm_pattern_classes(),
		],
		'body-and-mind/about' => [
			'title'       => __( 'Startseite: Über mich', 'body-and-mind' ),
			'description' => __( 'Porträt, persönliche Geschichte, Qualifikationen und Button.', 'body-and-mind' ),
			'content'     => bm_pattern_about(),
		],
		'body-and-mind/schedule' => [
			'title'       => __( 'Startseite: Stundenplan-Vorschau', 'body-and-mind' ),
			'description' => __( 'Drei kommende Kurse mit Zeit, Level und Buchen-Button.', 'body-and-mind' ),
			'content'     => bm_pattern_schedule(),
		],
		'body-and-mind/pricing' => [
			'title'       => __( 'Startseite: Preise & Mitgliedschaft', 'body-and-mind' ),
			'description' => __( 'Drei Preis-Karten (mittlere hervorgehoben) plus HWG-Hinweis.', 'body-and-mind' ),
			'content'     => bm_pattern_pricing(),
		],
		'body-and-mind/testimonials' => [
			'title'       => __( 'Startseite: Stimmen', 'body-and-mind' ),
			'description' => __( 'Drei Mitglieder-Stimmen mit Sternen und Avatar.', 'body-and-mind' ),
			'content'     => bm_pattern_testimonials(),
		],
		'body-and-mind/magazine' => [
			'title'       => __( 'Startseite: Magazin', 'body-and-mind' ),
			'description' => __( 'Überschrift, Themen-Chips und drei neueste Beiträge (sonst Beispiele).', 'body-and-mind' ),
			'content'     => bm_pattern_magazine(),
		],
		'body-and-mind/newsletter' => [
			'title'       => __( 'Startseite: Newsletter', 'body-and-mind' ),
			'description' => __( 'Newsletter-Band mit E-Mail-Feld und DSGVO-Einwilligung.', 'body-and-mind' ),
			'content'     => bm_pattern_newsletter(),
		],
		'body-and-mind/disclaimer' => [
			'title'       => __( 'Hinweis (HWG-Callout)', 'body-and-mind' ),
			'description' => __( 'Sanfter Hinweis „ersetzt keine ärztliche Beratung“ für gesundheitsnahe Inhalte.', 'body-and-mind' ),
			'content'     => bm_pattern_disclaimer(),
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
	register_block_pattern( 'body-and-mind/home', [
		'title'       => __( 'Startseite (komplett)', 'body-and-mind' ),
		'description' => __( 'Die ganze Startseite auf einmal: Hero, Kurse, Über mich, Stundenplan, Preise, Stimmen, Magazin und Newsletter.', 'body-and-mind' ),
		'categories'  => $cat,
		'content'     =>
			bm_pattern_hero() .
			bm_pattern_classes() .
			bm_pattern_about() .
			bm_pattern_schedule() .
			bm_pattern_pricing() .
			bm_pattern_testimonials() .
			bm_pattern_magazine() .
			bm_pattern_newsletter(),
	] );
}
add_action( 'init', 'bm_register_block_patterns' );
