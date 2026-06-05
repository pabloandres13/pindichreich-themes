<?php
/*
 * Template Name: Mamaglück Homepage
 * Template Post Type: page
 *
 * Select this template on any page to use the homepage layout.
 * Edit the page content in the block editor to customise the hero,
 * intro text, and section order. Dynamic sections (blog posts, popular
 * posts, newsletter, Instagram) are injected via shortcodes.
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="content" class="homepage-blocks">
  <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
</main>
<?php
get_footer();
