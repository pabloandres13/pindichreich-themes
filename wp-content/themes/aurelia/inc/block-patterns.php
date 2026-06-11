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
