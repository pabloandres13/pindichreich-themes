# Product

## Register

brand

## Users

Seekers and readers drawn to esoteric study — tarot, astrology, alchemy, and folklore. They are curious, thoughtful, and serious; they want knowledge delivered with quiet authority, not hype. They read on desktop and mobile, often late at night. They are not looking for beginner listicles or fear-based content. A site that treats the old arts as a serious discipline earns their trust.

## Product Purpose

An esoteric blog, magazine, and house of readings. Built as a WordPress Astra child theme under the **Aurum Arcana** design system. The site serves two modes at once: a publicly readable journal of articles (tarot, astrology, alchemy, folklore) and a bookable reading service (one practitioner offering three session tiers). Success = a site owner who can publish articles through Gutenberg, manage their booking info and newsletter through the Customizer, and project a scholarly, refined persona — all without touching PHP or CSS.

## Brand Personality

Scholarly and refined, with a hush of mystery. The voice is that of a knowledgeable guide who is also a fellow seeker — never gatekeeping, never breathless, never salesy. Three words: precise, evocative, unhurried. The tone is that of a well-edited esoteric journal: confident but not arrogant, mysterious but never kitsch. *"The old arts ask for attention, not belief."*

## Anti-references

- Horror-kitsch occult (skull emojis, neon-purple, jump-scare aesthetic)
- New-age wellness brand (crystal energy, soft-pink palette, wellness-influencer copy)
- Generic dark SaaS template (glassmorphism, neon glows, techy dark UI)
- Mass-market tarot app (gamified, disposable, no scholarly depth)
- Luxury fashion dark mode (gold-on-black with no content substance)

## Design Principles

1. **Gold is a precise accent, never a flood.** The near-black charcoal ground (`--ink-900 #0E0D0F`) carries the page. Antique gold (`--gold-500 #C8A24A`) is used for headings, dividers, icons, CTAs, and hover states — never as a background wash. The contrast is intentional: the scarcity of gold makes it feel precious.
2. **Serif typography as atmosphere.** Cormorant (high-contrast, near-Didone) for display and headings creates the "rare esoteric book" feel. EB Garamond for body copy at 18–20px/1.7 is warm and highly readable on dark at comfortable sizes. Section labels use EB Garamond in letterspaced uppercase small-caps (`--tracking-label: 0.22em`).
3. **Non-technical by design.** Author name, bio, reading prices, newsletter copy, social URLs, and accent color are all Customizer controls. Articles and sections embed via Gutenberg blocks and shortcodes. No PHP editing required for the site owner.
4. **Ambient texture, not imagery.** The background texture is two CSS layers — a faint starfield (tiny gold/parchment radial specks) and a subtle vignette — keeping the page dark and focused without heavy background images. Photography is desaturated (`saturate(.85) contrast(1.02)`) and protected with gradient overlays.
5. **Small radii, refined motions.** Cards use `--radius-lg: 8px`, buttons `--radius-sm: 2px` — kept small and refined, never rounded UI. Card hover lifts 2–3px with brightened gold hairline border and soft gold glow (`--glow-soft`). All motion respects `prefers-reduced-motion`.

## Accessibility & Inclusion

WCAG AA minimum. Focus ring uses `--focus-ring: var(--gold-400)`. `prefers-reduced-motion` disables all transitions and entrance animations. Semantic HTML throughout (header, nav, main, article, footer). Font sizes never below 16px on body copy; article bodies use 20px/1.78. Two optional alternate ground themes available via `data-theme="indigo"` and `data-theme="aubergine"`.

## Customizer Controls (Appearance → Customize → Aurum Arcana Design)

- **Colors**: accent gold, background, card surface, body text
- **Publication info**: name, tagline, practitioner name/bio, footer motto, Instagram URL, newsletter signup URL
- **Readings & Offerings**: signature reading title, description, price, booking URL
- **Newsletter**: eyebrow label, heading, sub-text, form action URL

## Shortcodes

- `[aurum_articles count="6" category="" orderby="date"]` — article card grid
- `[aurum_newsletter]` — newsletter band

## Iconography

Phosphor Icons thin weight (`ph-thin ph-*`), loaded from CDN. Mystical glyphs in use: `moon-stars`, `star-four`, `sun`, `sparkle`, `cards`, `flask`, `scroll`, `compass`, `magnifying-glass`, `check`, `arrow-right`, `instagram-logo`, `envelope-simple`, `user`, `list`, `x`.
