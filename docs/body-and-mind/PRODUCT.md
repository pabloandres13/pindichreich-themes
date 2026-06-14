# Product

## Register

brand

## Users

German-speaking people looking for a calm, local studio for yoga, meditation, and personal training — many of them beginners or returning after a break, often women, who feel intimidated by high-intensity gym culture. They want to feel welcome before they ever walk in: to see the classes, the prices, and the person teaching, and to book a no-pressure trial. They browse on mobile, value warmth and clarity over hype, and expect German-language UI and DSGVO-respectful handling of their data.

## Product Purpose

A bright wellness-studio site for **Lichtraum**, built as a WordPress Astra child theme under the **Body & Mind** design system. It presents the studio's offerings (Kurse/Angebote), weekly schedule (Stundenplan), pricing & membership (Preise), the founder's story, member voices, and a gentle magazine — and converts visitors into a booked trial class (Probestunde). Success = a non-technical studio owner who builds and edits the **entire home page from Gutenberg block patterns**, manages classes via a `bm_class` CPT, and controls brand/contact through the Customizer — without touching PHP, HTML, or CSS.

## Brand Personality

Calm, warm, and unhurried — a light-filled room, not a performance gym. The voice speaks to the reader as *du*, is encouraging and plain-spoken, and never pressures. Three words: gentle, grounded, welcoming. *"Atme. Du bist hier richtig."* No fitness-bro hype, no before/after promises, no medical claims (HWG-aware Hinweis callouts make clear the offerings support wellbeing and do not replace medical advice).

## Anti-references

- High-intensity gym / fitness-bro brand (black + neon, shouting, "crush your goals")
- Clinical medical practice (cold blue, sterile, jargon-heavy)
- Luxury spa (gold-on-marble, exclusive, expensive-feeling)
- Generic wellness influencer (soft-pink, "high-vibe", manifestation hype)
- Busy corporate yoga-chain template (stock photos, dense, impersonal)

## Design Principles

1. **Light and airy carries the page.** A lightly green-tinted cream/white ground with generous negative space; lavender (`--lavender-300 #c9b8e8`) is the primary accent and sage (`--sage-300 #a8c3a0`) the secondary, used in soft section bands — never a heavy flood. Charcoal `--ink-900 #2e2a28` for text and primary fills.
2. **Soft, rounded, friendly geometry.** Large radii (cards 24px, buttons pill), diffuse low-contrast shadows, an organic overlapping photo-badge in the hero. Nothing sharp or clinical.
3. **Serif warmth + humanist clarity.** Cormorant Garamond for headings (gentle, editorial), Mulish for body, Caveat as a sparing handwritten script accent (tagline only). All three are **self-hosted** woff2 — no external font CDN.
4. **Page-agnostic, fully editable home.** `front-page.php` renders the static front page's content when set; otherwise falls back to bundled demo sections. Every section is a block pattern (Body & Mind → „Startseite (komplett)" or individual sections) using native heading/paragraph/button blocks for copy; data-driven grids (classes, schedule, magazine, newsletter) are shortcodes with demo fallback so a fresh install looks complete.
5. **German & DSGVO by default.** German-language UI throughout. An opt-in cookie banner (necessary / statistics / marketing toggles), HWG-aware Hinweis callout, and newsletter consent checkbox linking to the Datenschutzerklärung. Respects `prefers-reduced-motion`.

## Accessibility & Inclusion

WCAG AA on the light ground; body copy never below 16px. Focus ring uses `--focus-ring` (lavender). Semantic HTML (header, nav, main, article, footer), mobile menu with `aria-expanded`. `prefers-reduced-motion` disables transitions and the reveal animation. Inline SVG icons are `aria-hidden`.

## Customizer Controls (Appearance → Customize → Body & Mind Design)

- **Studio-Infos**: Studioname, Tagline, Hero-Headline/Lead, Adresse, Öffnungszeiten, Telefon, E-Mail, Instagram, Trainer-Name/Über-mich-Text, Copyright, Newsletter-Formular-URL
- **Farben**: Lavendel, Salbei, Creme, Charcoal
- **Hero-Bild**: Hero-Bild, Trainer-Porträt

## Block Patterns (category: Body & Mind)

Hero · Kurse & Angebote · Über mich · Stundenplan-Vorschau · Preise & Mitgliedschaft · Stimmen · Magazin · Newsletter · Hinweis (HWG-Callout) · **Startseite (komplett)**

## Shortcodes

- `[bm_classes count="4"]` — class/Angebot cards from the `bm_class` CPT, demo fallback
- `[bm_schedule count="3"]` — Stundenplan preview rows
- `[bm_magazine count="3"]` — latest posts as article cards, demo fallback
- `[bm_newsletter]` — newsletter band with DSGVO consent (form URL from Customizer)

## Iconography

Inline Lucide-style SVG via `bm_icon()` at stroke-width 1.75 (`menu`, `close`, `arrow-right`, `leaf`, `sun`, `wind`, `star`, `check`, `info`, `map-pin`, `clock`, `phone`, `mail`, `instagram`). The logo is an inline SVG crescent-leaf mark + wordmark via `bm_logo()`. No emoji.

## Page templates

`page-kurse.php`, `page-stundenplan.php`, `page-preise.php`, `page-kontakt.php` provide pre-styled landing pages for the core practice pages.
