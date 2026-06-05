<?php
$datenschutz_url = get_permalink( get_page_by_path( 'datenschutz' ) ) ?: home_url( '/datenschutzerklaerung/' );
?>
<aside class="cookie" id="cookie" role="dialog" aria-label="<?php esc_attr_e( 'Cookie-Hinweis', 'mamaglueck' ); ?>">
  <span class="cookie__icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"/><path d="M8.5 8.5v.01"/><path d="M16 15.5v.01"/><path d="M12 12v.01"/><path d="M11 17v.01"/><path d="M7 14v.01"/></svg>
  </span>
  <div class="cookie__txt">
    <strong><?php esc_html_e( 'Kekse? Ja, aber digital.', 'mamaglueck' ); ?></strong>
    <?php
    printf(
      wp_kses( __( 'Diese Website verwendet Cookies, um dir das beste Erlebnis zu bieten. Mehr dazu in der <a href="%s">Datenschutzerklärung</a>.', 'mamaglueck' ), [ 'a' => [ 'href' => [] ] ] ),
      esc_url( $datenschutz_url )
    );
    ?>
  </div>
  <div class="cookie__actions">
    <button class="btn btn--ghost btn--sm" id="cookieSettingsBtn"><?php esc_html_e( 'Einstellungen', 'mamaglueck' ); ?></button>
    <button class="btn btn--primary btn--sm" id="cookieAccept"><?php esc_html_e( 'Akzeptieren', 'mamaglueck' ); ?></button>
  </div>
</aside>
