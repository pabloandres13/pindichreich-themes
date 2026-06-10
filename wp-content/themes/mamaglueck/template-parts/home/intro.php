<?php
$author = get_theme_mod( 'mg_author_name', 'Anna' );
$bio    = get_theme_mod( 'mg_author_bio', 'Zweifach-Mama, Kaffee-Liebhaberin und Chaos-Managerin. Hier teile ich, was bei uns wirklich passiert: die schönen Momente, die anstrengenden Tage und alles dazwischen. Mit einem Augenzwinkern und ohne erhobenen Zeigefinger.' );
?>
<section class="section section--home intro" id="intro">
  <div class="container">
    <div class="intro__grid reveal">
      <div class="intro__portrait">
        <span class="photo" data-tint="teal" role="img" aria-label="<?php echo esc_attr( sprintf( __( 'Portrait von %s', 'mamaglueck' ), $author ) ); ?>">
          <span class="photo__label">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
            <?php esc_html_e( 'Portrait', 'mamaglueck' ); ?>
          </span>
        </span>
      </div>
      <div class="intro__body">
        <span class="eyebrow" style="color:var(--teal-deep)"><?php esc_html_e( 'Hallo!', 'mamaglueck' ); ?></span>
        <h2><?php printf( esc_html__( 'Schön, dass du da bist — ich bin %s', 'mamaglueck' ), esc_html( $author ) ); ?></h2>
        <p><?php echo esc_html( $bio ); ?></p>
        <span class="intro__sign">— <?php echo esc_html( $author ); ?> &hearts;</span>
      </div>
    </div>
  </div>
</section>
