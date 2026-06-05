<?php
$author   = get_theme_mod( 'mg_author_name', 'Anna' );
$insta    = get_theme_mod( 'mg_instagram_handle', 'mamaglueck' );
$year     = date( 'Y' );
$location = get_theme_mod( 'mg_author_location', 'Hamburg' );
?>

<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">

      <div>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand">
          <?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
            <span class="brand__mark"><span>m</span></span>
            <?php bloginfo( 'name' ); ?>
          <?php endif; ?>
        </a>
        <p class="footer-about"><?php bloginfo( 'description' ); ?></p>
        <span class="footer-sign">— <?php echo esc_html( $author ); ?> ♥</span>
      </div>

      <div class="footer-col">
        <h4><?php esc_html_e( 'Entdecken', 'mamaglueck' ); ?></h4>
        <?php
        wp_nav_menu( [
          'theme_location' => 'footer',
          'container'      => false,
          'fallback_cb'    => 'mamaglueck_footer_default_nav',
          'depth'          => 1,
        ] );
        ?>
      </div>

      <div class="footer-col">
        <h4><?php esc_html_e( 'Themen', 'mamaglueck' ); ?></h4>
        <ul>
          <?php
          $cats = get_categories( [ 'number' => 5, 'hide_empty' => false ] );
          foreach ( $cats as $cat ) {
            echo '<li><a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
          }
          if ( empty( $cats ) ) {
            $topics = [ 'Schwangerschaft', 'Erziehung', 'Familienalltag', 'Rezepte &amp; DIY' ];
            foreach ( $topics as $t ) {
              echo '<li><a href="' . esc_url( home_url( '/#themen' ) ) . '">' . $t . '</a></li>';
            }
          }
          ?>
        </ul>
      </div>

      <div class="footer-col">
        <h4><?php esc_html_e( 'Rechtliches', 'mamaglueck' ); ?></h4>
        <ul>
          <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'impressum' ) ) ?: home_url( '/impressum/' ) ); ?>"><?php esc_html_e( 'Impressum', 'mamaglueck' ); ?></a></li>
          <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'datenschutz' ) ) ?: home_url( '/datenschutzerklaerung/' ) ); ?>"><?php esc_html_e( 'Datenschutzerklärung', 'mamaglueck' ); ?></a></li>
          <li><a href="#" id="cookieSettings"><?php esc_html_e( 'Cookie-Einstellungen', 'mamaglueck' ); ?></a></li>
        </ul>
        <div class="footer-social">
          <a href="https://instagram.com/<?php echo esc_attr( $insta ); ?>" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
          </a>
          <a href="#newsletter" aria-label="Newsletter">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
          </a>
        </div>
      </div>

    </div>

    <div class="footer-bottom">
      <span>© <?php echo esc_html( $year ); ?> <?php bloginfo( 'name' ); ?> · <?php printf( esc_html__( 'Mit ♥ in %s gemacht', 'mamaglueck' ), esc_html( $location ) ); ?></span>
      <span>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'impressum' ) ) ?: home_url( '/impressum/' ) ); ?>"><?php esc_html_e( 'Impressum', 'mamaglueck' ); ?></a>
        &middot;
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'datenschutz' ) ) ?: home_url( '/datenschutzerklaerung/' ) ); ?>"><?php esc_html_e( 'Datenschutz', 'mamaglueck' ); ?></a>
      </span>
    </div>
  </div>
</footer>

<?php get_template_part( 'template-parts/cookie-banner' ); ?>

<?php wp_footer(); ?>
</body>
</html>

<?php
function mamaglueck_footer_default_nav() {
  $items = [
    home_url( '/' )         => 'Start',
    home_url( '/#intro' )   => 'Über mich',
    home_url( '/#blog' )    => 'Blog',
    home_url( '/#kontakt' ) => 'Kontakt',
  ];
  echo '<ul>';
  foreach ( $items as $url => $label ) {
    echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
  }
  echo '</ul>';
}
