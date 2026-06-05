# Travel and Adventure Child Theme

This theme is an Astra child theme for a WordPress-native travel editorial site.

## WordPress Setup

1. Activate `Travel and Adventure` in `Appearance > Themes`.
2. Go to `Settings > Reading`:
   - Set a static homepage.
   - Assign a page for posts.
3. Go to `Appearance > Menus`:
   - Assign the main menu to `Primary Menu`.
   - Assign legal or utility links such as `Impressum` and `Datenschutz` to `Footer Menu`.
4. Go to `Appearance > Customize`:
   - Upload the logo in `Site Identity`.
   - Upload the hero image in `Header Image`.
5. Go to `Appearance > Widgets`:
   - Fill `Footer Column 1`, `Footer Column 2`, and `Footer Column 3`.
6. Edit the homepage in Gutenberg:
   - Open the assigned homepage and use the `Franzi Homepage` pattern category.
   - Insert the patterns in this order:
     - `Homepage Shell`
     - `Welcome Split`
     - `Favorite Islands Grid`
     - `Travel Tips And Planning Circles`
     - `Hotel Tips With Latest Posts Box`
     - `Latest Posts Carousel`
   - Replace the placeholder text and images directly in the editor.
   - Keep the alternating section colors from the pattern classes.

## Content Model

- Use `Posts` for travel articles, guides, and inspiration.
- Use `Categories` for destinations and topic clusters.
- Use `Pages` for About, Contact, and legal content.
- Use `Featured Images` on posts for archive and homepage cards.
- Use `Excerpts` on posts and pages for hero and card summaries.

## Homepage Editing

The homepage is Gutenberg-first. The theme provides styling and reusable patterns; the page editor controls the visible content.

Dynamic editor blocks available through shortcode blocks:

- `[taa_latest_posts limit="6"]` for the rounded latest-posts box
- `[taa_post_carousel limit="10"]` for the horizontal 10-post carousel

## Included Templates

- `front-page.php`: renders Gutenberg homepage content
- `home.php`: blog index
- `archive.php`: category and archive listings
- `search.php`: search results
- `single.php`: editorial article layout
- `page.php`: simplified content page layout

## Notes

- No WooCommerce templates are included.
- The environment used for development did not include `php`, so no local PHP linting was run here.
