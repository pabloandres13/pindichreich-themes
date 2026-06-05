<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="siteHeader">
  <div class="container">
    <nav class="nav" id="nav" aria-label="<?php esc_attr_e( 'Hauptnavigation', 'mamaglueck' ); ?>">

      <?php if ( has_custom_logo() ) : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand" aria-label="<?php bloginfo( 'name' ); ?>">
          <?php the_custom_logo(); ?>
        </a>
      <?php else : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand" aria-label="<?php bloginfo( 'name' ); ?>">
          <span class="brand__mark"><span>m</span></span>
          <?php bloginfo( 'name' ); ?>
        </a>
      <?php endif; ?>

      <?php
      wp_nav_menu( [
        'theme_location'  => 'primary',
        'container'       => false,
        'menu_class'      => 'nav__links',
        'fallback_cb'     => 'mamaglueck_default_nav',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 1,
      ] );
      ?>

      <div class="nav__cta">
        <a href="#newsletter" class="btn btn--primary btn--sm">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
          Newsletter
        </a>
      </div>

      <button class="nav__toggle" id="navToggle" aria-label="<?php esc_attr_e( 'Menü öffnen', 'mamaglueck' ); ?>" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
      </button>

    </nav>
  </div>
</header>

<?php
function mamaglueck_default_nav() {
  echo '<ul class="nav__links">';
  $items = [
    home_url( '/' )        => 'Start',
    home_url( '/#intro' )  => 'Über mich',
    home_url( '/#themen' ) => 'Themen',
    home_url( '/#blog' )   => 'Blog',
    home_url( '/#kontakt' )=> 'Kontakt',
  ];
  foreach ( $items as $url => $label ) {
    $current = ( $url === home_url( '/' ) && is_front_page() ) ? ' aria-current="page"' : '';
    echo '<li><a href="' . esc_url( $url ) . '"' . $current . '>' . esc_html( $label ) . '</a></li>';
  }
  echo '</ul>';
}
