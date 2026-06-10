<?php get_header(); ?>

<main id="content">
<?php while ( have_posts() ) : the_post(); ?>

  <header class="post-header">
    <div class="post-header__inner">

      <?php $cats = get_the_category(); if ( $cats ) : ?>
        <a class="pill" href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>">
          <?php echo esc_html( $cats[0]->name ); ?>
        </a>
      <?php endif; ?>

      <h1 class="post-header__title"><?php the_title(); ?></h1>

      <p class="post-header__meta">
        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
          <?php echo esc_html( get_the_date() ); ?>
        </time>
        <?php
        $words   = str_word_count( wp_strip_all_tags( get_the_content() ) );
        $minutes = max( 1, (int) round( $words / 200 ) );
        echo ' &middot; ' . $minutes . ' ' . esc_html__( 'Min. Lesezeit', 'mamaglueck' );
        ?>
      </p>

    </div>
  </header>

  <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-thumbnail">
      <?php the_post_thumbnail( 'large', [ 'class' => 'post-thumbnail__img' ] ); ?>
    </div>
  <?php endif; ?>

  <div class="post-content">
    <div class="post-entry-content">
      <?php the_content(); ?>
    </div>
  </div>

<?php endwhile; ?>
</main>

<?php get_footer(); ?>
