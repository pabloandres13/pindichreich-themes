# Product

## Register

brand

## Users

Executive & leadership coaches running a personal-brand business (the demo brand is **Maren Cole**), and their prospective clients: founders and senior leaders who are capable but stretched thin — "the one everyone depends on." Visitors arrive tired, not broken; they want a credible thinking-partner, proof that is concrete (a result chip with a number, not vague praise), and a low-friction way to book a discovery call. The site owner is non-technical: they must build, edit, rebrand, and wire up booking without touching PHP, HTML, or CSS.

## Product Purpose

A warm, premium, conversion-focused coaching site built as a WordPress Astra child theme under the **Maren Cole** design system. It presents the promise (who I help), services/packages, the coach's story, success stories, a lead-magnet opt-in, resources, and an FAQ — and converts visitors into a booked discovery call. Success = a non-technical coach who builds and edits the **entire home page from Gutenberg block patterns**, points every "Book a discovery call" CTA at their own scheduler via one Customizer field, and controls brand/colors/contact in the Customizer.

## Brand Personality

A calm, credible thinking-partner. Warm but never soft; direct but never corporate. Three words: composed, authoritative, human. The signature device is a serif **italic-accent on one word per headline** (*edge*, *your*, *clarity*, *compound*) in clay. Sentence-case copy, UPPERCASE eyebrow labels only. No emoji, no hype, no jargon ("synergy", "10x", "unlock"). Trust is built with specificity and restraint.

## Anti-references

- Cold corporate-consulting brand (navy + grey, stock handshake photos, buzzwords)
- Hustle / "10x your revenue" coach (neon gradients, countdown timers, shouting)
- Clinical SaaS template (hero-metric block, identical icon-card grids)
- Generic wellness-influencer softness (pastel, manifestation hype)
- Editorial-magazine affectation applied without reason (this is a coaching brand, not a literary journal)

## Design Principles

1. **Warm-premium, single confident accent.** A warm off-white canvas (`--cream-50 #FBF8F4`) with white cards and warm near-black ink (`--ink-900 #1A1610`); **one** accent — terracotta/clay (`--clay-500 #C0613D`) — carries CTAs, links, eyebrows, and the italic emphasis. Two dark bands (ink + evergreen) give rhythm. No gradients, no textures.
2. **Editorial serif + humanist sans.** **Newsreader** (display serif, medium weight, tight tracking, italic accent device) for headlines; **Hanken Grotesk** for body/UI/eyebrows. Both are **self-hosted** variable woff2 (latin + latin-ext, normal + italic) — no external font CDN, zero Google requests. (Newsreader is on the skill's reflex-reject list, but it is the design system's committed identity, so identity-preservation wins.)
3. **Soft, generous geometry.** Cards 18px radius, feature panels 28px, all buttons full pills; warm-tinted diffuse shadows; an offset accent shape behind the hero portrait and a floating credential badge.
4. **Page-agnostic, fully editable home.** `front-page.php` renders the static front page's blocks when set; otherwise falls back to the same patterns via `do_blocks()` so a fresh install looks complete. Every section is a block pattern (category **Maren Cole**) using native heading/paragraph/button/image blocks for copy; slider/data sections are shortcodes with demo fallback; fixed decorative structure (hero portrait, offer & promise cards, stats) is `wp:html`.
5. **Booking wired in one place.** `mc_booking_url()` returns the Customizer scheduler URL (Calendly/TidyCal/Acuity/Amelia…) or falls back to the Contact page. Every CTA — header, hero, featured service card, final band — uses it.

## Accessibility & Inclusion

WCAG AA on the warm ground; body 17px, never below 16px. Clay-on-cream and light-on-dark pairings meet contrast; placeholder/muted text bumped toward ink. Focus ring uses `--focus-ring` (clay). Semantic HTML, mobile menu with `aria-expanded`, slider buttons labelled. Reveal animation enhances already-visible content and is disabled under `prefers-reduced-motion`. Inline SVG icons are `aria-hidden`.

## Customizer Controls (Appearance → Customize → Maren Cole Design)

- **Brand & contact**: brand name, footer tagline, copyright, email, Instagram/LinkedIn/YouTube, announcement-bar text + link
- **Booking**: scheduler/booking URL, newsletter/opt-in form action URL
- **Colors**: Clay (accent), Cream (page background), Ink (text/dark bands)

## Block Patterns (category: Maren Cole)

Hero · Trust strip · Who I help · Work with me · About teaser · Success stories · Free-guide opt-in · Resources · FAQ · Final CTA band · **Full home page**

## Shortcodes

- `[mc_trust label="…" logos="A, B, C"]` — "as featured in" logo row
- `[mc_testimonials]` — dark-band testimonial slider (3-up desktop / 1-up mobile, demo data)
- `[mc_optin]` — lead-magnet form card with success state (action URL from Customizer)
- `[mc_resources count="3"]` — latest posts as cards, demo fallback
- `[mc_faq]` — expanding FAQ accordion

## Iconography

Inline Lucide-style SVG via `mc_icon()` at stroke-width 2 (`arrow-right`, `check`, `menu`, `close`, `calendar`, `play`, `star`, `chevron-left/right`, `plus`, `mail`, `compass`, `target`, `leaf`, `sparkle`, `instagram`, `linkedin`, `youtube`…). The logo is the custom "edge/summit" mark via `mc_mark()` + wordmark via `mc_logo()` (honours a custom logo if set). Brand assets: `assets/mark.svg`, `logo-wordmark.svg`, `favicon.svg`. No emoji.

## Notes

Brand name, copy, palette hues, and Unsplash imagery are invented placeholders from the Claude Design handoff — strong starting points to replace with the real coach's details, photography, and brand fonts.
