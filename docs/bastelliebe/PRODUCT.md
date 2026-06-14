# Product

## Register

brand

## Users

One real maker (the demo brand is **Bastelliebe**, the maker is **Lena**) sharing step-by-step DIY tutorials (*Anleitungen*), and her readers: German-speaking hobby crafters looking for cheerful, doable projects to make at home. Visitors want to browse by craft type, find beginner-friendly ideas with clear material lists and lots of photos, and save/pin favourites. The site owner is non-technical: she must build, edit, rebrand, and publish tutorials without touching PHP, HTML, or CSS.

## Product Purpose

A warm, personal, hands-on DIY & crafts blog built as a WordPress Astra child theme under the **Bastelliebe** design system (tagline *Selbstgemacht mit Herz*). It presents a welcoming hero with the "Projekt der Woche", colour-coded craft categories, beginner projects, the latest and most popular Anleitungen, an "Über mich" teaser, affiliate material favourites, a newsletter band, and an Instagram strip. Success = a non-technical maker who builds and edits the **entire home page from Gutenberg block patterns**, manages tutorials as ordinary posts in colour-coded categories, and controls brand/colours/social/newsletter in the Customizer.

## Brand Personality

A warm, encouraging friend talking maker-to-maker. First-person singular, informal **„du"** (never „Sie"), confident and reassuring (*"das gelingt auch Anfängern"*, *"in unter einer Stunde"*). Friendly and tidy — never salesy or corporate. Hand-lettered accents (*„Willkommen bei Bastelliebe"*, *„Hallo, ich bin Lena"*) carry the warmth, used sparingly as eyebrows. Essentially no emoji in UI; only ♥ (logo/footer flourish) and ★ (ratings). Affiliate links are openly, plainly disclosed.

## Anti-references

- Cold corporate / SaaS template (grey cards, stocky icon grids, buzzwords)
- Loud Pinterest-bait DIY farm (cluttered, ad-stuffed, shouting CTAs, clickbait)
- Dark/moody editorial affectation (this is bright, cheerful, hands-on)
- Pastel manifestation-wellness softness
- All-colour-at-once chaos — the cream canvas keeps the colourful project photos the star

## Design Principles

1. **Warm cream canvas, confident colour blocks.** Soft cream page (`--cream-100 #FBF7F0`) + white surfaces with warm charcoal ink (`--ink-900 #2C2A27`) so colourful project photos pop. Coral (`--coral-500 #E8654A`) is the brand/CTA accent. Colour appears in confident blocks (category tiles, newsletter band) but never all at once. Subtle `.bl-paper` grain on select cream sections; soft, warm, ink-tinted shadows; no heavy gradients.
2. **Four colour-coded craft categories.** Papier = coral, Heimwerken = mustard `#E0A82E`, Wohndeko = teal `#2FA6A0`, Kinder = berry `#C75B9E`. Each ships `-soft` (chips/sections) and `-ink` (text-on-light) variants. Category colour codes tags, tiles, and project-card placeholders consistently.
3. **Friendly rounded type, one handwritten accent.** **Fredoka** (rounded display) for headings, **Nunito Sans** (highly legible) for body (never below 16px), **Caveat** (handwritten) for the logo "liebe" tail and section eyebrows ONLY. All three are **self-hosted** variable woff2 (latin + latin-ext) — no external font CDN, zero Google requests.
4. **Rounded, tactile geometry.** Cards 20px radius, hero/feature panels 28px, chips & primary buttons full pills; soft hover lift (cards `-4px`, image `scale(1.05)`). Pinnable 3:4 project cards, 4:3 hero, 1:1 shop tiles.
5. **Page-agnostic, fully editable home.** `front-page.php` renders the static front page's blocks when set; otherwise falls back to bundled demo sections (`template-parts/home/*.php`) so a fresh install looks complete. Every section is a block pattern (category **Bastelliebe**) using native heading/paragraph/button/image blocks for copy; data grids are shortcodes with demo fallback; the hero's floating "Projekt der Woche" badge is `wp:html`.

## Accessibility & Inclusion

WCAG-aware: each category ships an `-ink` variant dark enough for text/icons on light. Body 16px minimum, line-height 1.5–1.7 for long tutorials. Always-visible coral focus ring (`--focus-ring`). Semantic HTML, mobile menu with `aria-expanded`, inline SVG icons `aria-hidden`. The reveal animation enhances already-visible content and is disabled under `prefers-reduced-motion` (content stays visible without JS by default). DSGVO cookie banner (opt-in) and openly disclosed affiliate "Anzeige" labels.

## Customizer Controls (Appearance → Customize → Bastelliebe Design)

- **Marke & Infos**: brand name, tagline, author name (Über mich), footer text, copyright, Instagram URL + handle, Pinterest URL, e-mail, newsletter form URL
- **Farben**: Koralle (accent/CTA), Senf (Heimwerken), Petrol (Wohndeko), Beere (Kinder), Creme (background), Anthrazit (text)
- **Bilder**: Hero image (Projekt der Woche), portrait (Über mich)

## Block Patterns (category: Bastelliebe)

Hero · Kategorien · Für Einsteiger · Neueste Anleitungen · Beliebte Projekte · Über mich · Material-Favoriten (Affiliate) · Newsletter · Instagram · **Startseite (komplett)**

## Shortcodes

- `[bl_categories]` — the four colour-coded craft category tiles with live post counts (demo counts fallback)
- `[bl_projects count="6" beginner="0" columns="3" compact="0"]` — project (Anleitung) cards from latest posts, with demo fallback; derives craft category from the post's category slug
- `[bl_affiliate count="4"]` — "Shop the Post" affiliate cards with the required disclosure + "Anzeige" labels
- `[bl_newsletter]` — coral newsletter band with DSGVO consent (action URL from Customizer)
- `[bl_social count="6"]` — Instagram handle + photo strip (category-tinted placeholders)

## Iconography

Inline Lucide-style SVG via `bl_icon()` at stroke-width 2 (`arrow-right`, `chevron-down`, `menu`, `close`, `search`, `mail`, `clock`, `gauge`, `sparkles`, `star`, `user`, `shopping-bag`, `external-link`, `info`, `check`, `instagram`, `heart`) plus category glyphs `scissors` / `hammer` / `sofa` / `baby` and the Pinterest brand fill. The logo is the stitched-heart mark + "Bastel" (Fredoka) + handwritten "liebe" (Caveat) via `bl_logo()`. No emoji.

## Notes

Brand name, copy, palette hues, category set, and Unsplash imagery are placeholders from the Claude Design handoff (`bastelliebe-design-system`) — strong starting points to replace with the maker's real details, photography, and tutorials. Tutorials are ordinary posts; assign each to a `papier` / `heimwerken` / `wohndeko` / `kinder` category slug to get the colour-coded tag and accurate category counts.
