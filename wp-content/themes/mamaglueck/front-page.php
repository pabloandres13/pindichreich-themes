<?php
defined( 'ABSPATH' ) || exit;
get_header();

// Use block-editor content when the page has been set up,
// fall back to PHP template parts on a fresh install or empty page.
$queried = get_queried_object();
$has_block_content = $queried instanceof WP_Post && ! empty( trim( $queried->post_content ) );
?>
<main id="content" class="<?php echo $has_block_content ? 'homepage-blocks' : 'homepage-php'; ?>">
<?php if ( $has_block_content ) : ?>

  <?php
  // Block-editor content: hero + intro (native blocks) + section shortcodes.
  while ( have_posts() ) : the_post();
    the_content();
  endwhile;
  ?>

<?php else : ?>

  <?php // PHP-template fallback — used until the front page is configured. ?>
  <?php get_template_part( 'template-parts/home/hero' ); ?>
  <?php get_template_part( 'template-parts/home/intro' ); ?>
  <?php get_template_part( 'template-parts/home/topics' ); ?>
  <?php get_template_part( 'template-parts/home/posts' ); ?>
  <?php get_template_part( 'template-parts/home/popular' ); ?>
  <?php get_template_part( 'template-parts/home/testimonials' ); ?>
  <?php get_template_part( 'template-parts/home/newsletter' ); ?>
  <?php get_template_part( 'template-parts/home/instagram' ); ?>

<?php endif; ?>
</main>
<?php
get_footer();
