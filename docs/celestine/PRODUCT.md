# Product

## Register

brand

## Users

Seekers drawn to astrology, tarot, meditation, and ritual — people who want a reading that feels like being seen, not sold to. They are warm, intuitive, and a little tender; many arrive curious-but-skeptical. They browse on mobile late at night and book on desktop. They are turned off by fear-based occult kitsch and by glossy wellness-influencer hype in equal measure. A site that is calm, honest, and quietly luminous earns their trust.

## Product Purpose

An esoteric & spirituality site for a single practitioner: astrology & tarot readings paired with a small shop of crystals & ritual goods, plus a journal. Built as a WordPress Astra child theme under the **Celestine** design system (the name reads as both *celestial* and *celestite*, the pale crystal). Success = a non-technical owner who builds and edits the **entire home page from Gutenberg block patterns**, manages brand/contact/newsletter through the Customizer, and publishes journal entries — without touching PHP, HTML, or CSS.

## Brand Personality

Spiritual luxury, storybook-celestial. A calm, knowing guide — never a salesperson, never a fortune-teller caricature. Three words: warm, intuitive, unhurried. Poetry in the headline, clarity in the body; short breathing sentences with generous dark space. Tagline (script): *"Return to the stars within."* No absolute promises ("guaranteed", "instant"), no emoji — the celestial mood is carried by Unicode glyphs (☽ ✦ ✧ ⋆) and gold linework.

## Anti-references

- Horror-kitsch occult (skulls, neon purple, jump-scare aesthetic)
- Cheesy fortune-teller (crystal-ball clip-art, mystic-meg fonts)
- New-age wellness influencer (soft-pink, "high-vibe", manifestation-hype copy)
- Generic dark SaaS template (glassmorphism everywhere, neon glow, techy UI)
- Cluttered mass-market tarot app (gamified, disposable, busy)

## Design Principles

1. **Deep cosmos, never flat black.** The ground is cosmic indigo (`--cosmos-800 #0E1230`) over a fixed aura + cosmos gradient, with deep violet/aubergine (`--violet-800 #241640`) as the depth tone. A faint CSS starfield layers over dark sections — no image weight.
2. **Gold edges, never floods.** Luminous gold (`--gold-500 #D9B45B`) is an accent: headings, fine linework, dividers, CTAs, and the signature metallic inset hairline on glassy translucent cards (`--edge-gold`). Moonlight silver (`--silver-400 #C9D2E3`) is the rare jewel glow. Body text is moonlight off-white (`--moon-200 #EDEBF5`), which clears WCAG AA on the dark ground.
3. **Three voices of type.** Cormorant Garamond (calligraphic display serif) for headings & hero lines; Mulish (humanist sans) for body at 17px/1.7; Pinyon Script reserved for the logo and one tagline only. Section labels are letterspaced uppercase small-caps in gold. All three are **self-hosted** (woff2 in `/assets/fonts`) — no external font CDN is referenced.
4. **Page-agnostic, fully editable home.** The home is page-driven (`front-page.php` renders the static front page's content). Every section is a block pattern (Celestine → "Home page (complete)" or individual sections) built from native heading/paragraph/button blocks so copy is editable in place; the journal and newsletter are shortcodes with demo fallback. The same builders render the out-of-the-box demo, so the patterns are the single source of truth.
5. **Gentle, transcendent motion.** `--ease-celestial` curves, durations 140/240/420ms; hover brightens gold and lifts cards 2–4px with a soft glow. Reveal-on-scroll enhances already-visible content. All motion respects `prefers-reduced-motion`.

## Accessibility & Inclusion

WCAG AA minimum on the dark ground; body copy never below 16px (baseline 17px/1.7). Visible gold focus ring everywhere (`--focus-ring`). Skip link to `#cel-main`. Semantic HTML (header, nav, main, section, article, footer). `prefers-reduced-motion` disables transitions and the reveal animation. Glyphs are decorative (`aria-hidden`).

## Customizer Controls (Appearance → Customize → Celestine Design)

- **Brand & contact**: brand name, script tagline, contact e-mail, Instagram URL, copyright text
- **Newsletter**: "Join the Circle" form action URL
- **Colours**: cosmic indigo (background), deep violet (depth), luminous gold (accent), moonlight silver (jewel)

## Block Patterns (category: Celestine)

Cosmic hero · Pathways (offerings) · Featured reading · About the practitioner · Testimonials · Journal teaser · Join the Circle (newsletter) · **Home page (complete)**

## Shortcodes

- `[cel_journal count="4"]` — latest posts as article cards, with celestial demo fallback
- `[cel_newsletter]` — the "Join the Circle" band (form action from Customizer, consent checkbox)

## Iconography

Celestial Unicode glyphs as primary motif (moon ☽ ☾, stars ✦ ✧ ⋆, sun ☉, planets ♃ ♄, zodiac ♓ etc.) set in the display serif as gold/silver linework — used for tile badges, dividers, list markers, and ornament. Functional UI affordances (menu, close, arrows, search, mail, instagram) are inline SVG at stroke-width 1.5 via `cel_icon()`. No emoji anywhere. The one vendored vector is `assets/images/celestine-mark.svg` (crescent monogram).
