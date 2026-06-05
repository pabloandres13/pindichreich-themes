<?php
// Query most-commented posts as proxy for "popular"
$popular = new WP_Query( [
  'posts_per_page' => 3,
  'post_status'    => 'publish',
  'orderby'        => 'comment_count',
  'order'          => 'DESC',
  'ignore_sticky_posts' => true,
] );

$pills = [ 'pill--coral', 'pill--teal', 'pill--yellow' ];
?>

<section class="section">
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow"><?php esc_html_e( 'Von Leserinnen geliebt', 'mamaglueck' ); ?></span>
      <h2><?php esc_html_e( 'Beliebte Beiträge', 'mamaglueck' ); ?></h2>
    </div>

    <div class="popular reveal">
      <?php if ( $popular->have_posts() ) : $i = 1; while ( $popular->have_posts() ) : $popular->the_post();
        $cats = get_the_category();
        $cat_name = ! empty( $cats ) ? esc_html( $cats[0]->name ) : esc_html__( 'Blog', 'mamaglueck' );
        $pill = $pills[ $i - 1 ] ?? 'pill--coral';
      ?>
        <a href="<?php the_permalink(); ?>" class="popular__item">
          <span class="popular__num"><?php echo $i; ?></span>
          <div class="popular__txt">
            <span class="pill <?php echo esc_attr( $pill ); ?>"><?php echo $cat_name; ?></span>
            <h3><?php the_title(); ?></h3>
          </div>
        </a>
      <?php $i++; endwhile; wp_reset_postdata();
      else : ?>
        <?php
        $placeholders = [
          [ 'Schlaf',          'pill--coral',  'Schlaf, Baby, schlaf — was bei uns endlich funktioniert hat' ],
          [ 'Erstausstattung', 'pill--teal',   'Die ehrliche Liste: Was du fürs Baby wirklich brauchst' ],
          [ 'Selbstfürsorge',  'pill--yellow', 'Mama-Burnout: Wenn die Akkus einfach leer sind' ],
        ];
        foreach ( $placeholders as $i => [ $cat, $pill, $title ] ) :
        ?>
          <span class="popular__item">
            <span class="popular__num"><?php echo $i + 1; ?></span>
            <div class="popular__txt">
              <span class="pill <?php echo esc_attr( $pill ); ?>"><?php echo esc_html( $cat ); ?></span>
              <h3><?php echo esc_html( $title ); ?></h3>
            </div>
          </span>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>
