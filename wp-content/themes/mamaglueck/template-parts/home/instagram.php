<?php
$handle = get_theme_mod( 'mg_instagram_handle', 'mamaglueck' );
$tints  = [ 'coral', 'teal', 'yellow', 'coral', 'teal', 'yellow' ];
?>
<section class="section">
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow"><?php esc_html_e( 'Mehr Mama-Momente', 'mamaglueck' ); ?></span>
      <h2><?php esc_html_e( 'Folge mir auf Instagram', 'mamaglueck' ); ?></h2>
      <p>
        <a class="insta-handle" href="https://instagram.com/<?php echo esc_attr( $handle ); ?>" target="_blank" rel="noopener noreferrer">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
          @<?php echo esc_html( $handle ); ?>
        </a>
      </p>
    </div>
    <div class="insta-grid reveal">
      <?php foreach ( $tints as $tint ) : ?>
        <a href="https://instagram.com/<?php echo esc_attr( $handle ); ?>" class="insta-tile" target="_blank" rel="noopener noreferrer">
          <span class="photo" data-tint="<?php echo esc_attr( $tint ); ?>"></span>
          <span class="insta-tile__overlay">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
