# Product

## Register

brand

## Users

German-speaking people seeking a calm, trustworthy health & wellness practice — Naturheilkunde, Ernährungsberatung, Achtsamkeit. They are often dealing with a real concern and are wary of both cold clinical settings and woo-woo wellness hype. They want to understand what a treatment involves, who the practitioner is, what it costs, and how to book a first conversation (Erstgespräch) — with clear, reassuring, German-language copy and DSGVO-respectful data handling. They read on mobile and desktop and value evidence of qualifications over promises.

## Product Purpose

A bright, calm practice site built as a WordPress Astra child theme under the **Aurelia** design system. It presents services (Leistungen), the practitioner and approach (So arbeiten wir), trust/qualifications, member voices, a magazine, and contact/booking — converting visitors into a booked Erstgespräch. Success = a non-technical practice owner who builds and edits the **entire home page from Gutenberg block patterns**, manages services and contact info, and stays HWG/DSGVO-safe — all without touching PHP, HTML, or CSS.

## Brand Personality

Reassuring, professional, and human — a calm practitioner who explains clearly and never oversells. The voice speaks to the reader as *Sie* (professional German), is warm but precise, and avoids medical promises. Three words: trustworthy, gentle, clear. The tone is that of a thoughtful health professional: credible, unhurried, never fear-based.

## Anti-references

- Clinical/hospital aesthetic (cold blue-grey, sterile, intimidating)
- New-age wellness influencer (soft-pink, crystal energy, manifestation hype)
- Pharma/corporate health brand (stocky, glossy, impersonal)
- Fitness-bro energy (black + neon, "transform your body")
- Cluttered alternative-medicine site (rainbow palette, dense, unprofessional)

## Design Principles

1. **Calm, light, and green.** A lightly green-tinted cream ground (`--cream #f6faf7`) with generous space. Healing green (`--green-400 #6fb58e`) is the signature accent and soft blue (`--blue-300 #a9cbd8`) the secondary; deep forest (`--forest #243b30`) carries text and primary fills. Accents support, never flood. Organic SVG blobs (green/blue) add a soft, natural touch.
2. **Grotesk clarity.** Schibsted Grotesk for headings (modern, confident, calm) and Hanken Grotesk for body (highly readable, humanist). Both are **self-hosted** woff2 — no external font CDN. Section labels in letterspaced uppercase.
3. **Non-technical by design.** Practice name, hero copy, about copy, contact details, opening hours, social URLs, newsletter URL, and accent colors are all Customizer controls. Every section and content block embeds via Gutenberg patterns and shortcodes.
4. **Page-agnostic, fully editable home.** `front-page.php` renders the static front page's content when set; otherwise falls back to bundled demo sections (Hero, Leistungen, Über uns, So arbeiten wir, Stimmen, Magazin, Newsletter). Native blocks for copy; data-driven grids are shortcodes with demo fallback.
5. **HWG & DSGVO aware.** German-language UI; HWG-aware Hinweis disclaimer callouts (offerings support wellbeing, do not replace medical advice); opt-in cookie consent and newsletter consent linking to the Datenschutzerklärung. Respects `prefers-reduced-motion`.

## Accessibility & Inclusion

WCAG AA on the light ground; body copy never below 16px. Visible focus ring, semantic HTML (header, nav, main, article, footer), mobile menu with `aria-expanded`. `prefers-reduced-motion` disables transitions and entrance animation. Decorative blobs and icons are `aria-hidden`.

## Customizer Controls (Appearance → Customize → Aurelia Design)

- **Praxis-Infos**: Praxisname, Hero-Badge/Headline/Lead/Vertrauenszeile, Über-uns-Titel/Text, Telefon, E-Mail, Adresse, Öffnungszeiten, Instagram, Facebook, Footer-Tagline, Copyright, Newsletter-Formular-URL
- **Farben**: Heilgrün, Sanftblau, Waldgrün, Creme, Sand

## Block Patterns (category: Aurelia)

Startseite: Hero · Leistungen · Über uns (Teaser) · So arbeiten wir · Stimmen · Magazin · Newsletter-Band · **Startseite (komplett)** — plus building blocks: Leistungen-Raster, Hinweis (HWG-Disclaimer), FAQ, Qualifikationen (Vertrauensblock), Ablauf (Schritt-Liste), Kontakt (Formular + Infos), Leistung-Detail, Erstgespräch-Einladung, Impressum & Datenschutzerklärung (Vorlagen).

## Shortcodes

- `[au_services]` / `[au_service]` — service card grid / single service
- `[au_posts_grid]` — magazine post cards
- `[au_topics]` — topic chips
- `[au_testimonials]` / `[au_testimonial]` — member voices
- `[au_newsletter]` — newsletter band (consent, form URL from Customizer)
- `[au_hinweis]` — HWG-aware disclaimer callout
- `[au_faq]` / `[au_faq_item]` — FAQ accordion
- `[au_trust]` — qualifications/trust block
- `[au_steps]` / `[au_step]` — numbered process list
- `[au_kontakt_info]`, `[au_oeffnungszeiten]`, `[au_kontakt_form]` — contact details, hours, form
- `[au_button]` — styled button

## Iconography

Inline SVG icon helper plus organic decorative blobs (`assets/img/blob-green.svg`, `blob-blue.svg`). No emoji.
