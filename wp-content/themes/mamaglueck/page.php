<?php get_header(); ?>

<main id="content">
<?php while ( have_posts() ) : the_post(); ?>

  <header class="post-header">
    <div class="post-header__inner">
      <h1 class="post-header__title"><?php the_title(); ?></h1>
    </div>
  </header>

  <div class="page-content">
    <div class="page-entry-content">
      <?php the_content(); ?>
    </div>
  </div>

<?php endwhile; ?>
</main>

<?php get_footer(); ?>
