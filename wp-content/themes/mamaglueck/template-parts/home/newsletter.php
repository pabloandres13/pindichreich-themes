<?php
$action = get_theme_mod( 'mg_newsletter_action', '#' );
?>
<section class="section newsletter" id="newsletter">
  <div class="container">
    <div class="newsletter__inner reveal">
      <span class="deco dot float" style="width:120px;height:120px;background:rgba(255,255,255,0.12);top:-30px;right:8%"></span>
      <span class="deco dot float float--rev" style="width:60px;height:60px;background:var(--yellow);opacity:0.85;bottom:-18px;right:22%"></span>
      <span class="eyebrow" style="color:var(--yellow)"><?php esc_html_e( 'Newsletter', 'mamaglueck' ); ?></span>
      <h2><?php esc_html_e( 'Verpass keinen Beitrag!', 'mamaglueck' ); ?></h2>
      <p><?php esc_html_e( 'Einmal pro Woche eine liebe Mail mit den neuesten Geschichten, Tipps und einer kleinen Portion Mama-Mut. Kein Spam, versprochen.', 'mamaglueck' ); ?></p>
      <form class="newsletter__form" action="<?php echo esc_url( $action ); ?>" method="post">
        <?php wp_nonce_field( 'mamaglueck_newsletter', 'mg_nonce' ); ?>
        <label for="nl-email" class="sr-only" style="position:absolute;left:-9999px"><?php esc_html_e( 'E-Mail-Adresse', 'mamaglueck' ); ?></label>
        <input id="nl-email" type="email" name="email" placeholder="<?php esc_attr_e( 'deine@email.de', 'mamaglueck' ); ?>" autocomplete="email" required />
        <button type="submit" class="btn btn--yellow"><?php esc_html_e( 'Jetzt anmelden', 'mamaglueck' ); ?></button>
      </form>
      <label class="newsletter__consent">
        <input type="checkbox" required />
        <span>
          <?php
          $datenschutz_url = get_permalink( get_page_by_path( 'datenschutz' ) ) ?: home_url( '/datenschutzerklaerung/' );
          printf(
            wp_kses( __( 'Ja, ich möchte den Newsletter erhalten und habe die <a href="%s">Datenschutzerklärung</a> gelesen. Abmeldung jederzeit möglich.', 'mamaglueck' ), [ 'a' => [ 'href' => [] ] ] ),
            esc_url( $datenschutz_url )
          );
          ?>
        </span>
      </label>
    </div>
  </div>
</section>
