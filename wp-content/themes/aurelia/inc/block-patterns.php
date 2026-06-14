<?php
defined( 'ABSPATH' ) || exit;

/**
 * Register Gutenberg block patterns for the Aurelia theme.
 * Patterns let non-technical users insert pre-built German sections
 * with one click and edit every text in the block editor.
 */
function aurelia_register_block_patterns(): void {
	register_block_pattern_category( 'aurelia', [
		'label' => __( 'Aurelia', 'aurelia' ),
	] );

	/* ============================================================
	   Startseite (home) sections — each registered as an insertable
	   pattern so a non-technical practice owner can build and edit the
	   front page entirely in the block editor. Editable copy uses native
	   blocks (heading / paragraph / buttons / image); data-driven grids use
	   the shortcodes in inc/shortcodes.php; fixed decorative structure
	   (hero blob, proof avatars, float card) uses wp:html.
	   ============================================================ */

	register_block_pattern( 'aurelia/home-hero', [
		'title'       => __( 'Startseite: Hero', 'aurelia' ),
		'description' => __( 'Heller Einstieg mit Badge, Headline, Buttons, Vertrauenszeile und Foto mit Info-Karte.', 'aurelia' ),
		'categories'  => [ 'aurelia' ],
		'content'     => aurelia_pattern_hero(),
	] );

	register_block_pattern( 'aurelia/home-services', [
		'title'       => __( 'Startseite: Leistungen', 'aurelia' ),
		'description' => __( 'Zentrierte Überschrift und vier Leistungs-Karten.', 'aurelia' ),
		'categories'  => [ 'aurelia' ],
		'content'     => aurelia_pattern_services(),
	] );

	register_block_pattern( 'aurelia/home-about', [
		'title'       => __( 'Startseite: Über uns (Teaser)', 'aurelia' ),
		'description' => __( 'Porträt-Bild, Überschrift, Text und Button „Mehr über uns“.', 'aurelia' ),
		'categories'  => [ 'aurelia' ],
		'content'     => aurelia_pattern_about(),
	] );

	register_block_pattern( 'aurelia/home-approach', [
		'title'       => __( 'Startseite: So arbeiten wir', 'aurelia' ),
		'description' => __( 'Drei ruhige Schritte mit Icon, Nummer und Beschreibung.', 'aurelia' ),
		'categories'  => [ 'aurelia' ],
		'content'     => aurelia_pattern_approach(),
	] );

	register_block_pattern( 'aurelia/home-testimonials', [
		'title'       => __( 'Startseite: Stimmen', 'aurelia' ),
		'description' => __( 'Zentrierte Überschrift und drei Klient:innen-Stimmen.', 'aurelia' ),
		'categories'  => [ 'aurelia' ],
		'content'     => aurelia_pattern_home_testimonials(),
	] );

	register_block_pattern( 'aurelia/home-magazine', [
		'title'       => __( 'Startseite: Magazin', 'aurelia' ),
		'description' => __( 'Überschrift, „Alle Artikel“-Button und drei neueste Beiträge (sonst Beispiele).', 'aurelia' ),
		'categories'  => [ 'aurelia' ],
		'content'     => aurelia_pattern_magazine(),
	] );

	register_block_pattern( 'aurelia/home-newsletter', [
		'title'       => __( 'Startseite: Newsletter-Band', 'aurelia' ),
		'description' => __( 'Newsletter-Band mit E-Mail-Feld in einem cremefarbenen Abschnitt.', 'aurelia' ),
		'categories'  => [ 'aurelia' ],
		'content'     => aurelia_pattern_home_newsletter(),
	] );

	// Combined full home page — every section in design order, one click.
	register_block_pattern( 'aurelia/home', [
		'title'       => __( 'Startseite (komplett)', 'aurelia' ),
		'description' => __( 'Die ganze Startseite auf einmal: Hero, Leistungen, Über uns, So arbeiten wir, Stimmen, Magazin und Newsletter.', 'aurelia' ),
		'categories'  => [ 'aurelia' ],
		'content'     =>
			aurelia_pattern_hero() .
			aurelia_pattern_services() .
			aurelia_pattern_about() .
			aurelia_pattern_approach() .
			aurelia_pattern_home_testimonials() .
			aurelia_pattern_magazine() .
			aurelia_pattern_home_newsletter(),
	] );

	// ---- Leistungen grid (4 service cards) ----
	register_block_pattern( 'aurelia/leistungen-grid', [
		'title'      => __( 'Leistungen — Karten-Raster', 'aurelia' ),
		'categories' => [ 'aurelia' ],
		'content'    => '<!-- wp:shortcode -->[au_services]
[au_service icon="salad" tone="green" title="Ernährungsberatung" url="/leistungen/"]Eine alltagstaugliche Ernährung, abgestimmt auf Ihre Ziele und Ihren Rhythmus.[/au_service]
[au_service icon="wind" tone="blue" title="Achtsamkeit &amp; Stress" url="/leistungen/"]Sanfte Übungen für mehr Ruhe, besseren Schlaf und einen klaren Kopf.[/au_service]
[au_service icon="sprout" tone="green" title="Naturheilkunde" url="/leistungen/"]Ganzheitliche Begleitung mit Methoden aus der Erfahrungsheilkunde.[/au_service]
[au_service icon="hand-heart" tone="blue" title="Gesundheitscoaching" url="/leistungen/"]Gemeinsam Gewohnheiten entwickeln, die im Alltag wirklich tragen.[/au_service]
[/au_services]<!-- /wp:shortcode -->',
	] );

	// ---- HWG Hinweis callout ----
	register_block_pattern( 'aurelia/hinweis', [
		'title'      => __( 'Hinweis (HWG-Disclaimer)', 'aurelia' ),
		'categories' => [ 'aurelia', 'text' ],
		'content'    => '<!-- wp:shortcode -->[au_hinweis title="Hinweis" tone="info"]Die Inhalte und Angebote dieser Seite dienen der Förderung des allgemeinen Wohlbefindens und ersetzen keine ärztliche Beratung, Diagnose oder Behandlung.[/au_hinweis]<!-- /wp:shortcode -->',
	] );

	// ---- FAQ accordion ----
	register_block_pattern( 'aurelia/faq', [
		'title'      => __( 'FAQ — Häufige Fragen', 'aurelia' ),
		'categories' => [ 'aurelia' ],
		'content'    => '<!-- wp:shortcode -->[au_faq]
[au_faq_item frage="Übernimmt die Krankenkasse die Kosten?"]Einige gesetzliche Kassen bezuschussen Ernährungsberatung. Wir informieren Sie gern über die Möglichkeiten — eine Garantie können wir nicht geben.[/au_faq_item]
[au_faq_item frage="Muss ich meine Ernährung komplett umstellen?"]Nein. Wir setzen auf kleine, alltagstaugliche Schritte, die sich gut in Ihr Leben einfügen.[/au_faq_item]
[au_faq_item frage="Findet die Beratung auch online statt?"]Ja, Termine sind sowohl vor Ort als auch per Videogespräch möglich.[/au_faq_item]
[/au_faq]<!-- /wp:shortcode -->',
	] );

	// ---- Trust / Qualifikationen ----
	register_block_pattern( 'aurelia/qualifikationen', [
		'title'      => __( 'Qualifikationen (Vertrauensblock)', 'aurelia' ),
		'categories' => [ 'aurelia' ],
		'content'    => '<!-- wp:shortcode -->[au_trust items="Heilpraktikerin;Staatlich geprüft, seit 2015|Ernährungsberaterin;Zertifiziert · VFED e.V.|Achtsamkeitstrainerin;MBSR-Ausbildung|500+ Klient:innen;Persönlich begleitet"]<!-- /wp:shortcode -->',
	] );

	// ---- Ablauf (Schritt-Liste) ----
	register_block_pattern( 'aurelia/ablauf', [
		'title'      => __( 'Ablauf — Schritt-Liste', 'aurelia' ),
		'categories' => [ 'aurelia' ],
		'content'    => '<!-- wp:shortcode -->[au_steps]
[au_step nummer="1" titel="Bestandsaufnahme"]Wir schauen gemeinsam auf Ihre Ernährung, Ihren Alltag und Ihre Ziele.[/au_step]
[au_step nummer="2" titel="Individueller Plan"]Sie erhalten konkrete, alltagstaugliche Empfehlungen — keine Verbotslisten.[/au_step]
[au_step nummer="3" titel="Begleitung"]In regelmäßigen Terminen passen wir an, was nicht passt.[/au_step]
[/au_steps]<!-- /wp:shortcode -->',
	] );

	// ---- Testimonials ----
	register_block_pattern( 'aurelia/testimonials', [
		'title'      => __( 'Stimmen (Testimonials)', 'aurelia' ),
		'categories' => [ 'aurelia' ],
		'content'    => '<!-- wp:shortcode -->[au_testimonials]
[au_testimonial name="Sabine R." role="Klientin seit 2023" initials="SR" tone="white"]Ich fühle mich endlich gehört und Schritt für Schritt gut begleitet. Kein Druck, nur echte Unterstützung.[/au_testimonial]
[au_testimonial name="Markus T." role="Ernährungsberatung" initials="MT" tone="white"]Die ruhige, fachliche Art hat mir geholfen, meine Ernährung dauerhaft umzustellen.[/au_testimonial]
[au_testimonial name="Lena B." role="Achtsamkeitskurs" initials="LB" tone="white"]Endlich ein Ort, an dem ich zur Ruhe komme. Die Atemübungen begleiten mich täglich.[/au_testimonial]
[/au_testimonials]<!-- /wp:shortcode -->',
	] );

	// ---- Newsletter band ----
	register_block_pattern( 'aurelia/newsletter', [
		'title'      => __( 'Newsletter-Band', 'aurelia' ),
		'categories' => [ 'aurelia' ],
		'content'    => '<!-- wp:shortcode -->[au_newsletter tone="green"]<!-- /wp:shortcode -->',
	] );

	// ---- Kontakt section (form + info + hours) ----
	register_block_pattern( 'aurelia/kontakt', [
		'title'      => __( 'Kontakt — Formular + Infos', 'aurelia' ),
		'categories' => [ 'aurelia' ],
		'content'    => '<!-- wp:columns {"className":"au-split au-split--start"} --><div class="wp-block-columns au-split au-split--start"><!-- wp:column {"width":"60%"} --><div class="wp-block-column" style="flex-basis:60%"><!-- wp:shortcode -->[au_kontakt_form]<!-- /wp:shortcode --></div><!-- /wp:column --><!-- wp:column {"width":"40%"} --><div class="wp-block-column" style="flex-basis:40%"><!-- wp:shortcode -->[au_kontakt_info]<!-- /wp:shortcode --><!-- wp:spacer {"height":"20px"} --><div style="height:20px" aria-hidden="true" class="wp-block-spacer"></div><!-- /wp:spacer --><!-- wp:shortcode -->[au_oeffnungszeiten]<!-- /wp:shortcode --></div><!-- /wp:column --></div><!-- /wp:columns -->',
	] );

	// ---- Leistung-Detail: "Auf einen Blick" + Ablauf + Hinweis ----
	register_block_pattern( 'aurelia/leistung-detail', [
		'title'      => __( 'Leistung — Detail (Ablauf + Auf einen Blick)', 'aurelia' ),
		'categories' => [ 'aurelia' ],
		'content'    => '<!-- wp:columns --><div class="wp-block-columns"><!-- wp:column {"width":"58%"} --><div class="wp-block-column" style="flex-basis:58%"><!-- wp:heading --><h2 class="wp-block-heading">Schritt für Schritt zu einer Ernährung, die trägt</h2><!-- /wp:heading --><!-- wp:shortcode -->[au_steps]
[au_step nummer="1" titel="Bestandsaufnahme"]Wir schauen gemeinsam auf Ihre Ernährung, Ihren Alltag und Ihre Ziele.[/au_step]
[au_step nummer="2" titel="Individueller Plan"]Sie erhalten konkrete, alltagstaugliche Empfehlungen — keine Verbotslisten.[/au_step]
[au_step nummer="3" titel="Begleitung"]In regelmäßigen Terminen passen wir an, was nicht passt.[/au_step]
[/au_steps]<!-- /wp:shortcode --><!-- wp:shortcode -->[au_hinweis title="Hinweis" tone="info"]Die Inhalte und Angebote dieser Seite dienen der Förderung des allgemeinen Wohlbefindens und ersetzen keine ärztliche Beratung, Diagnose oder Behandlung.[/au_hinweis]<!-- /wp:shortcode --></div><!-- /wp:column --><!-- wp:column {"width":"42%"} --><div class="wp-block-column" style="flex-basis:42%"><!-- wp:group {"className":"is-style-au-card"} --><div class="wp-block-group is-style-au-card"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Auf einen Blick</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Dauer: <strong>60 Min.</strong><br>Empfohlen: <strong>3–6 Termine</strong><br>Ab: <strong>80 € / Sitzung</strong><br>Ort: <strong>Vor Ort &amp; online</strong></p><!-- /wp:paragraph --><!-- wp:shortcode -->[au_button url="/kontakt/" label="Termin buchen" variante="primary" icon="calendar-check"]<!-- /wp:shortcode --></div><!-- /wp:group --></div><!-- /wp:column --></div><!-- /wp:columns -->',
	] );

	// ---- Erstgespräch cross-sell ----
	register_block_pattern( 'aurelia/erstgespraech', [
		'title'      => __( 'Erstgespräch — Einladung', 'aurelia' ),
		'categories' => [ 'aurelia' ],
		'content'    => '<!-- wp:group {"className":"au-newsletter"} --><div class="wp-block-group au-newsletter"><!-- wp:heading --><h2 class="wp-block-heading">Wir finden gemeinsam den richtigen Weg</h2><!-- /wp:heading --><!-- wp:paragraph --><p>In einem kostenlosen Erstgespräch klären wir in Ruhe, welches Angebot zu Ihnen passt — ganz ohne Verpflichtung.</p><!-- /wp:paragraph --><!-- wp:shortcode -->[au_button url="/kontakt/" label="Erstgespräch vereinbaren" variante="primary" groesse="lg"]<!-- /wp:shortcode --></div><!-- /wp:group -->',
	] );

	// ---- Impressum template ----
	register_block_pattern( 'aurelia/impressum', [
		'title'      => __( 'Impressum (Vorlage)', 'aurelia' ),
		'categories' => [ 'aurelia', 'text' ],
		'content'    => '<!-- wp:paragraph --><p>Angaben gemäß § 5 DDG (Digitale-Dienste-Gesetz).</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">Diensteanbieter</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Aurelia – Praxis für ganzheitliche Gesundheit<br>Dr. Lena Vogt<br>Lindenstraße 12<br>10115 Berlin</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">Kontakt</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Telefon: +49 30 1234 567<br>E-Mail: hallo@aurelia-praxis.de</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">Berufsbezeichnung &amp; berufsrechtliche Regelungen</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Berufsbezeichnung: Heilpraktikerin (verliehen in Deutschland)<br>Zuständige Aufsichtsbehörde: Gesundheitsamt Berlin-Mitte</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">Verantwortlich i. S. d. § 18 Abs. 2 MStV</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Dr. Lena Vogt, Anschrift wie oben.</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">Streitschlichtung</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.</p><!-- /wp:paragraph --><!-- wp:paragraph {"fontSize":"small"} --><p class="has-small-font-size">Platzhaltertext — vor Veröffentlichung rechtlich prüfen lassen.</p><!-- /wp:paragraph -->',
	] );

	// ---- Datenschutz template ----
	register_block_pattern( 'aurelia/datenschutz', [
		'title'      => __( 'Datenschutzerklärung (Vorlage)', 'aurelia' ),
		'categories' => [ 'aurelia', 'text' ],
		'content'    => '<!-- wp:paragraph --><p>Der Schutz Ihrer persönlichen Daten ist uns ein wichtiges Anliegen. Wir verarbeiten Ihre Daten ausschließlich auf Grundlage der gesetzlichen Bestimmungen (DSGVO, BDSG).</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">1. Verantwortliche Stelle</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Aurelia – Praxis für ganzheitliche Gesundheit, Dr. Lena Vogt, Lindenstraße 12, 10115 Berlin, hallo@aurelia-praxis.de.</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">2. Erhebung und Verarbeitung</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Wenn Sie uns über das Kontaktformular schreiben, verarbeiten wir die angegebenen Daten (Name, E-Mail, Nachricht) ausschließlich zur Bearbeitung Ihrer Anfrage (Art. 6 Abs. 1 lit. a und b DSGVO).</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">3. Cookies &amp; Einwilligung</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Nicht notwendige Cookies (Statistik, Marketing) setzen wir nur mit Ihrer ausdrücklichen Einwilligung. Diese können Sie jederzeit über die Cookie-Einstellungen widerrufen.</p><!-- /wp:paragraph --><!-- wp:shortcode -->[au_hinweis title="Ihre Rechte" tone="info"]Sie haben jederzeit das Recht auf Auskunft, Berichtigung, Löschung, Einschränkung, Datenübertragbarkeit und Widerspruch sowie ein Beschwerderecht bei der Aufsichtsbehörde.[/au_hinweis]<!-- /wp:shortcode --><!-- wp:heading --><h2 class="wp-block-heading">4. Speicherdauer</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Wir speichern personenbezogene Daten nur so lange, wie es für die genannten Zwecke erforderlich ist oder gesetzliche Aufbewahrungsfristen es vorsehen.</p><!-- /wp:paragraph --><!-- wp:paragraph {"fontSize":"small"} --><p class="has-small-font-size">Platzhaltertext — vor Veröffentlichung rechtlich prüfen lassen.</p><!-- /wp:paragraph -->',
	] );
}
add_action( 'init', 'aurelia_register_block_patterns' );

/* ============================================================
   Home-section builders — each returns serialized block markup.
   Kept as functions so the combined "Startseite (komplett)" pattern
   can reuse them. Editable text is native blocks; decorative
   structure is wp:html; data grids are shortcodes.
   ============================================================ */

/**
 * Letterspaced eyebrow label as an editable, margin-free paragraph.
 */
function aurelia_pattern_label( string $text ): string {
	$text = esc_html( $text );
	return <<<HTML
<!-- wp:paragraph {"className":"au-label","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="au-label" style="margin-top:0;margin-bottom:0">{$text}</p>
<!-- /wp:paragraph -->
HTML;
}

/**
 * Hero: editable badge + headline + lead + CTAs + native photo,
 * decorative blob, proof avatars and floating info card (wp:html).
 */
function aurelia_pattern_hero(): string {
	$booking    = esc_url( aurelia_booking_url() );
	$leistungen = esc_url( home_url( '/leistungen/' ) );
	$blob       = esc_url( get_stylesheet_directory_uri() . '/assets/img/blob-blue.svg' );
	$heart      = aurelia_icon( 'hand-heart', 20 );
	$hero_img   = 'https://images.unsplash.com/photo-1545205597-3d9d02c29597?auto=format&fit=crop&w=1000&q=80';

	$blob_html = '<img class="au-hero__blob" src="' . $blob . '" alt="" aria-hidden="true">';

	$proof = <<<HTML
<div class="au-hero__proof">
	<span class="au-hero__proof-avatars"><span></span><span></span><span></span></span>
	Über 500 Menschen begleitet · 4,9 ★ Bewertung
</div>
HTML;

	$float = <<<HTML
<div class="au-hero__float-card">
	<span class="au-medallion au-medallion--blue">{$heart}</span>
	<span>
		<strong class="au-hero__float-title">Persönlich &amp; ruhig</strong>
		<span class="au-hero__float-sub">Zeit für Ihre Anliegen</span>
	</span>
</div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"au-hero","layout":{"type":"default"}} -->
<section class="wp-block-group au-hero">
<!-- wp:html -->
{$blob_html}
<!-- /wp:html -->
<!-- wp:group {"className":"au-container","layout":{"type":"default"}} -->
<div class="wp-block-group au-container">
<!-- wp:group {"className":"au-hero__grid","layout":{"type":"default"}} -->
<div class="wp-block-group au-hero__grid">
<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group">
<!-- wp:paragraph {"className":"au-badge","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="au-badge" style="margin-top:0;margin-bottom:0">Praxis für ganzheitliche Gesundheit</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Zur Ruhe kommen.<br>Gesund leben.</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"au-hero__lead"} -->
<p class="au-hero__lead">Ganzheitliche Begleitung für Ernährung, Achtsamkeit und ein ausgeglichenes Leben — fachkundig und in Ihrem Tempo.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"className":"au-hero__actions"} -->
<div class="wp-block-buttons au-hero__actions">
<!-- wp:button {"className":"is-style-au-primary"} -->
<div class="wp-block-button is-style-au-primary"><a class="wp-block-button__link wp-element-button" href="{$booking}">Termin buchen</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"is-style-au-secondary"} -->
<div class="wp-block-button is-style-au-secondary"><a class="wp-block-button__link wp-element-button" href="{$leistungen}">Leistungen entdecken</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
<!-- wp:html -->
{$proof}
<!-- /wp:html -->
</div>
<!-- /wp:group -->
<!-- wp:group {"className":"au-hero__media","layout":{"type":"default"}} -->
<div class="wp-block-group au-hero__media">
<!-- wp:group {"className":"au-image-frame","layout":{"type":"default"}} -->
<div class="wp-block-group au-image-frame">
<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="{$hero_img}" alt="Naturaufnahme"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->
<!-- wp:html -->
{$float}
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Leistungen overview: editable centered head + 4 service cards ([au_services]).
 */
function aurelia_pattern_services(): string {
	$leistungen = esc_url( home_url( '/leistungen/' ) );
	$label      = aurelia_pattern_label( __( 'Unsere Leistungen', 'aurelia' ) );

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"au-section au-section--white","layout":{"type":"default"}} -->
<section class="wp-block-group au-section au-section--white">
<!-- wp:group {"className":"au-container","layout":{"type":"default"}} -->
<div class="wp-block-group au-container">
<!-- wp:group {"className":"au-section-head au-section-head--center","layout":{"type":"default"}} -->
<div class="wp-block-group au-section-head au-section-head--center">
{$label}
<!-- wp:heading -->
<h2 class="wp-block-heading">Sanfte Begleitung für Körper und Geist</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"au-section-head__intro"} -->
<p class="au-section-head__intro">Vier Wege zu mehr Wohlbefinden — einzeln oder kombiniert, immer abgestimmt auf Sie.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:shortcode -->
[au_services]
[au_service icon="salad" tone="green" title="Ernährungsberatung" url="{$leistungen}"]Eine alltagstaugliche Ernährung, abgestimmt auf Ihre Ziele und Ihren Rhythmus.[/au_service]
[au_service icon="wind" tone="blue" title="Achtsamkeit &amp; Stress" url="{$leistungen}"]Sanfte Übungen für mehr Ruhe, besseren Schlaf und einen klaren Kopf.[/au_service]
[au_service icon="sprout" tone="green" title="Naturheilkunde" url="{$leistungen}"]Ganzheitliche Begleitung mit Methoden aus der Erfahrungsheilkunde.[/au_service]
[au_service icon="hand-heart" tone="blue" title="Gesundheitscoaching" url="{$leistungen}"]Gemeinsam Gewohnheiten entwickeln, die im Alltag wirklich tragen.[/au_service]
[/au_services]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Über-uns teaser: editable portrait (native image) + copy + text link.
 */
function aurelia_pattern_about(): string {
	$ueber       = esc_url( home_url( '/ueber-uns/' ) );
	$arrow       = aurelia_icon( 'arrow-right', 17 );
	$label       = aurelia_pattern_label( __( 'Über uns', 'aurelia' ) );
	$portrait    = 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=800&q=80';
	$link        = '<a class="au-btn au-btn--text" href="' . $ueber . '">Mehr über uns ' . $arrow . '</a>';

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"au-section au-section--cream","layout":{"type":"default"}} -->
<section class="wp-block-group au-section au-section--cream">
<!-- wp:group {"className":"au-container","layout":{"type":"default"}} -->
<div class="wp-block-group au-container">
<!-- wp:group {"className":"au-split au-split--media-narrow","layout":{"type":"default"}} -->
<div class="wp-block-group au-split au-split--media-narrow">
<!-- wp:group {"className":"au-image-frame au-image-frame--sand au-image-frame--square","layout":{"type":"default"}} -->
<div class="wp-block-group au-image-frame au-image-frame--sand au-image-frame--square">
<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="{$portrait}" alt="Portrait"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:group -->
<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group">
{$label}
<!-- wp:heading -->
<h2 class="wp-block-heading">Ein Ort, an dem Sie ankommen dürfen</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Seit über zehn Jahren begleiten wir Menschen auf ihrem Weg zu mehr Gesundheit und innerer Ruhe. Wir nehmen uns Zeit, hören zu und gehen Schritt für Schritt — fachkundig, ehrlich und ohne Druck.</p>
<!-- /wp:paragraph -->
<!-- wp:html -->
{$link}
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * "So arbeiten wir": editable centered head + three steps (icon/number fixed,
 * title + text editable).
 */
function aurelia_pattern_approach(): string {
	$label = aurelia_pattern_label( __( 'So arbeiten wir', 'aurelia' ) );

	$steps = [
		[ 'num' => '01', 'icon' => 'messages-square', 'title' => 'Kennenlernen', 'text' => 'Ein erstes, unverbindliches Gespräch — wir hören zu und verstehen Ihr Anliegen.' ],
		[ 'num' => '02', 'icon' => 'route',           'title' => 'Ihr Weg',       'text' => 'Gemeinsam entwickeln wir einen Plan, der zu Ihrem Alltag und Ihren Zielen passt.' ],
		[ 'num' => '03', 'icon' => 'sprout',          'title' => 'Begleitung',    'text' => 'Wir gehen den Weg mit Ihnen — in Ihrem Tempo, mit Raum für Anpassungen.' ],
	];

	$cards = '';
	foreach ( $steps as $s ) {
		$icon  = aurelia_icon( $s['icon'], 22 );
		$num   = esc_html( $s['num'] );
		$title = esc_html( $s['title'] );
		$text  = esc_html( $s['text'] );
		$head  = '<div class="au-step__head"><span class="au-step__icon">' . $icon . '</span><span class="au-step__num">' . $num . '</span></div>';
		$cards .= <<<HTML
<!-- wp:group {"className":"au-step","layout":{"type":"default"}} -->
<div class="wp-block-group au-step">
<!-- wp:html -->
{$head}
<!-- /wp:html -->
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">{$title}</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>{$text}</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
HTML;
	}

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"au-section au-section--white","layout":{"type":"default"}} -->
<section class="wp-block-group au-section au-section--white">
<!-- wp:group {"className":"au-container","layout":{"type":"default"}} -->
<div class="wp-block-group au-container">
<!-- wp:group {"className":"au-section-head au-section-head--center","layout":{"type":"default"}} -->
<div class="wp-block-group au-section-head au-section-head--center">
{$label}
<!-- wp:heading -->
<h2 class="wp-block-heading">In drei ruhigen Schritten</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:group {"className":"au-grid au-grid--steps","layout":{"type":"default"}} -->
<div class="wp-block-group au-grid au-grid--steps">
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
 * Stimmen: editable centered head + three testimonials ([au_testimonials]).
 */
function aurelia_pattern_home_testimonials(): string {
	$label = aurelia_pattern_label( __( 'Stimmen', 'aurelia' ) );

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"au-section au-section--blue","layout":{"type":"default"}} -->
<section class="wp-block-group au-section au-section--blue">
<!-- wp:group {"className":"au-container","layout":{"type":"default"}} -->
<div class="wp-block-group au-container">
<!-- wp:group {"className":"au-section-head au-section-head--center","layout":{"type":"default"}} -->
<div class="wp-block-group au-section-head au-section-head--center">
{$label}
<!-- wp:heading -->
<h2 class="wp-block-heading">Was unsere Klient:innen erleben</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:shortcode -->
[au_testimonials]
[au_testimonial name="Sabine R." role="Klientin seit 2023" initials="SR" tone="white"]Ich fühle mich endlich gehört und Schritt für Schritt gut begleitet. Kein Druck, nur echte Unterstützung.[/au_testimonial]
[au_testimonial name="Markus T." role="Ernährungsberatung" initials="MT" tone="white"]Die ruhige, fachliche Art hat mir geholfen, meine Ernährung dauerhaft umzustellen.[/au_testimonial]
[au_testimonial name="Lena B." role="Achtsamkeitskurs" initials="LB" tone="white"]Endlich ein Ort, an dem ich zur Ruhe komme. Die Atemübungen begleiten mich täglich.[/au_testimonial]
[/au_testimonials]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Magazin teaser: editable head + "Alle Artikel" link + latest posts grid.
 */
function aurelia_pattern_magazine(): string {
	$magazin = esc_url( home_url( '/magazin/' ) );
	$label   = aurelia_pattern_label( __( 'Magazin', 'aurelia' ) );

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"au-section au-section--white","layout":{"type":"default"}} -->
<section class="wp-block-group au-section au-section--white">
<!-- wp:group {"className":"au-container","layout":{"type":"default"}} -->
<div class="wp-block-group au-container">
<!-- wp:group {"style":{"spacing":{"margin":{"bottom":"2.5rem"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-bottom:2.5rem">
<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group">
{$label}
<!-- wp:heading -->
<h2 class="wp-block-heading">Impulse für ein gesundes Leben</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-au-secondary"} -->
<div class="wp-block-button is-style-au-secondary"><a class="wp-block-button__link wp-element-button" href="{$magazin}">Alle Artikel</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
<!-- wp:shortcode -->
[au_posts_grid count="3"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Newsletter band ([au_newsletter]) inside a cream section + container.
 */
function aurelia_pattern_home_newsletter(): string {
	return <<<HTML
<!-- wp:group {"tagName":"section","className":"au-section au-section--cream","layout":{"type":"default"}} -->
<section class="wp-block-group au-section au-section--cream">
<!-- wp:group {"className":"au-container","layout":{"type":"default"}} -->
<div class="wp-block-group au-container">
<!-- wp:shortcode -->
[au_newsletter tone="green"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}
