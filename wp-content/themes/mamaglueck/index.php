<?php
// Silence is golden. WordPress requires this file to exist.
get_header();
?>
<main id="content" class="container" style="padding-block: var(--section-y)">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article <?php post_class( 'card' ); ?> style="padding: var(--space-6); margin-bottom: var(--space-5)">
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <div class="post-card__excerpt"><?php the_excerpt(); ?></div>
    </article>
  <?php endwhile; else : ?>
    <p><?php esc_html_e( 'Kein Inhalt gefunden.', 'mamaglueck' ); ?></p>
  <?php endif; ?>
</main>
<?php
get_footer();
