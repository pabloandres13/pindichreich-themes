<?php
/**
 * Custom header for the Travel and Adventure child theme.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?><!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php astra_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<?php astra_head_bottom(); ?>
</head>

<body <?php astra_schema_body(); ?> <?php body_class(); ?>>
<?php astra_body_top(); ?>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#content">
	<?php esc_html_e( 'Zum Inhalt springen', 'travel-and-adventure' ); ?>
</a>

<div id="page" class="hfeed site">
	<?php astra_header_before(); ?>
	<header class="taa-site-header" aria-label="<?php esc_attr_e( 'Header', 'travel-and-adventure' ); ?>">
		<div class="taa-site-header__bar">
			<div class="taa-site-header__inner">
				<div class="taa-site-header__brand">
					<?php
					if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
						the_custom_logo();
					} else {
						?>
						<a class="taa-site-header__title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>
						<?php
					}
					?>
					<div class="taa-site-header__identity">
						<a class="taa-site-header__title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>
						<p class="taa-site-header__tagline"><?php bloginfo( 'description' ); ?></p>
					</div>
				</div>

				<nav class="taa-site-header__nav" aria-label="<?php esc_attr_e( 'Primary Menu', 'travel-and-adventure' ); ?>">
					<button class="taa-menu-toggle" type="button" aria-expanded="false" aria-controls="taa-primary-menu">
						<span class="screen-reader-text"><?php esc_html_e( 'Menue oeffnen', 'travel-and-adventure' ); ?></span>
						<span class="taa-menu-toggle__bar"></span>
						<span class="taa-menu-toggle__bar"></span>
						<span class="taa-menu-toggle__bar"></span>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'menu_class'     => 'taa-primary-menu',
							'menu_id'        => 'taa-primary-menu',
							'fallback_cb'    => false,
							'depth'          => 2,
						)
					);
					?>
				</nav>
			</div>
		</div>
	</header>
	<?php astra_header_after(); ?>
	<?php astra_content_before(); ?>
	<main id="content" class="site-content">
		<div class="taa-site-shell">
		<?php astra_content_top(); ?>
