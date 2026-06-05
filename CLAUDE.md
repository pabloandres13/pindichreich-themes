# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project overview

A collection of WordPress themes for **pindichreich**, covering topics like travel, sport, health, esoteric, and mystic. Licensed under MPL-2.0.

## Target audience — non-technical users

**All themes in this repository are built for non-technical end users.** This is the single most important constraint shaping every implementation decision:

- **Content changes must be possible through the Gutenberg block editor.** Never hardcode content that a site owner would want to change (headlines, bios, button labels, section copy). Surface it as a block, a block pattern, a Customizer setting, or a shortcode — not as PHP strings in template files.
- **Visual/brand changes must be possible through the Customizer** (Appearance → Customize). Colors, fonts, author info, social handles, and newsletter URLs all have Customizer controls. Add new controls rather than expecting users to edit CSS or PHP.
- **Do not require users to touch code.** If implementing a feature would require a non-technical user to edit a `.php`, `.css`, or `.js` file, redesign the approach so it works through the block editor or Customizer instead.
- **Blocks over PHP templates for editable content.** Use `<!-- wp:html -->` blocks for complex layouts that need fixed structure (e.g. the hero grid + blob), and native blocks (heading, paragraph, buttons) for text the user should edit regularly. Register block patterns (in `inc/block-patterns.php`) so users can insert pre-built sections with one click.
- **Shortcodes for dynamic sections.** Sections that query WordPress data (posts, categories) are exposed as shortcodes (`[mg_posts_grid]`, `[mg_topics]`, etc.) so they can be embedded anywhere in page content without touching PHP.
- **Helper functions belong in `functions.php`, not in template parts.** Template parts can be included multiple times (e.g. once by `front-page.php` and again by a shortcode callback), so declaring functions inside them causes fatal "cannot redeclare" errors.

## Local development (Docker)

```bash
cp .env.example .env          # first time only — set DB + WP admin credentials
docker compose up -d          # start WordPress + MySQL + phpMyAdmin + auto-install
docker compose down           # stop (data kept)
docker compose down -v        # stop + wipe all data (full reset)
```

- WordPress: http://localhost:8080 (ready to log in, no install wizard)
- phpMyAdmin: http://localhost:8082

WordPress installs itself via a `wpcli` one-shot container that runs after the DB and WordPress are healthy. It is idempotent — `wp core is-installed` is checked first, so re-running `docker compose up` is safe.

Theme files in `wp-content/themes/` are bind-mounted into both the `wordpress` and `wpcli` containers — edits take effect immediately.

## Repository structure

WordPress core is excluded from git (see `.gitignore`). Only `wp-content/themes/` is tracked. Each theme directory follows standard WordPress theme structure with `style.css` (theme header), `functions.php`, and `index.php` as the minimum required files.

The `.env` file (DB credentials) is gitignored; `.env.example` is committed as a template.

## Themes

### `wp-content/themes/mamaglueck/`

Astra child theme for the **Mamaglück** German mom-blog. Design source: Claude Design export (coral/teal/cream palette, Fredoka display font, Nunito body).

**Key files:**
- `style.css` — theme header; declares `Template: astra`
- `functions.php` — enqueues assets, registers menus + theme supports, includes `inc/`
- `inc/customizer.php` — "Mamaglück Design" Customizer panel with 6 color pickers, 2 font selectors, blog info (author name, bio, Instagram handle, newsletter URL)
- `inc/block-support.php` — Gutenberg color palette, font sizes, block styles (pill buttons, card, speech bubble)
- `assets/css/tokens.css` — all CSS custom properties (`--coral`, `--teal`, etc.) + Google Fonts import
- `assets/css/theme.css` — all component + layout styles (buttons, cards, nav, hero, sections)
- `assets/css/editor.css` — block editor canvas styles (mirrors front-end tokens)
- `assets/js/theme.js` — header scroll shadow, mobile menu, entrance animation, cookie banner
- `front-page.php` → loads 8 template parts from `template-parts/home/`
- `header.php` / `footer.php` — fully custom, override Astra's header/footer

**Customizer controls** (Appearance → Customize → Mamaglück Design):
- Colors: coral, teal, yellow, ink, cream, blush
- Typography: display font, body font
- Blog info: author name/bio, Instagram handle, newsletter form URL

**Gutenberg features:** brand color palette, font sizes, wide alignment, editor styles, custom block styles (pill buttons, card groups, speech-bubble quotes).

**Brand name / author are placeholders** ("Mamaglück" / "Anna") — find-replace in template parts to customize.

## WordPress theme conventions

- Theme metadata (name, description, version, author) goes in the `style.css` header comment block.
- `functions.php` is the entry point for enqueuing assets, registering menus/sidebars, and adding theme support features.
- WordPress follows a [template hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/) — the most specific matching template file wins (e.g. `single-post.php` beats `single.php` beats `index.php`).
