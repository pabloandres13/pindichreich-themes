<?php
$query = new WP_Query( [
  'posts_per_page' => 5,
  'post_status'    => 'publish',
  'ignore_sticky_posts' => true,
] );

$tints         = [ 'coral', 'teal', 'yellow', 'coral', 'teal' ];
$pill_variants = [ 'pill--coral', 'pill--teal', 'pill--yellow', 'pill--coral', 'pill--teal' ];
?>

<section class="section section--blush" id="blog">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow"><?php esc_html_e( 'Frisch aus der Feder', 'mamaglueck' ); ?></span>
      <h2><?php esc_html_e( 'Neueste Beiträge', 'mamaglueck' ); ?></h2>
    </div>

    <?php if ( $query->have_posts() ) : ?>
      <div class="posts-grid">

        <?php
        $index = 0;
        while ( $query->have_posts() ) :
          $query->the_post();
          $tint = $tints[ $index ] ?? 'coral';
          $pill = $pill_variants[ $index ] ?? 'pill--coral';
          $cats = get_the_category();
          $cat_name = ! empty( $cats ) ? esc_html( $cats[0]->name ) : '';
        ?>

          <?php if ( $index === 0 ) : // Featured post ?>
            <article class="card lift post-feature post-card reveal">
              <?php mamaglueck_post_thumbnail( get_post(), $tint ); ?>
              <div class="post-card__body">
                <div class="post-card__meta">
                  <?php if ( $cat_name ) : ?><span class="pill <?php echo esc_attr( $pill ); ?>"><?php echo $cat_name; ?></span><?php endif; ?>
                  <span class="post-card__date">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                    <?php echo get_the_date( 'j. F Y' ); ?>
                  </span>
                </div>
                <h3><?php the_title(); ?></h3>
                <p class="post-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 30 ); ?></p>
                <a href="<?php the_permalink(); ?>" class="read-more">
                  <?php esc_html_e( 'Mehr lesen', 'mamaglueck' ); ?>
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
              </div>
            </article>

            <div class="post-grid-2">
            <?php elseif ( $index >= 1 && $index <= 4 ) : // Grid posts ?>
              <article class="card lift post-card reveal">
                <?php mamaglueck_post_thumbnail( get_post(), $tint ); ?>
                <div class="post-card__body">
                  <?php if ( $cat_name ) : ?><span class="pill <?php echo esc_attr( $pill ); ?>"><?php echo $cat_name; ?></span><?php endif; ?>
                  <h3><?php the_title(); ?></h3>
                  <a href="<?php the_permalink(); ?>" class="read-more">
                    <?php esc_html_e( 'Mehr lesen', 'mamaglueck' ); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                  </a>
                </div>
              </article>
            <?php endif; ?>

        <?php
          if ( $index === 4 ) echo '</div>'; // close post-grid-2
          $index++;
        endwhile;
        wp_reset_postdata();
        if ( $index === 1 ) echo '</div>'; // close post-grid-2 if only 1 post
        ?>

      </div><!-- .posts-grid -->

    <?php else : ?>
      <p class="muted" style="text-align:center;padding:var(--space-7) 0">
        <?php esc_html_e( 'Noch keine Beiträge vorhanden. Schreib deinen ersten Beitrag!', 'mamaglueck' ); ?>
      </p>
    <?php endif; ?>

  </div>
</section>
