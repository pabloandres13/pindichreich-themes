<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'culinary' ); ?></a>

<header class="culinary-header" id="masthead" role="banner">
	<div class="culinary-header__inner">

		<!-- Logo -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="culinary-logo" rel="home">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<span class="culinary-logo__wordmark"><?php bloginfo( 'name' ); ?></span>
				<span class="culinary-logo__tagline"><?php bloginfo( 'description' ); ?></span>
			<?php endif; ?>
		</a>

		<!-- Primary nav -->
		<nav id="site-navigation" class="culinary-nav" aria-label="<?php esc_attr_e( 'Primary', 'culinary' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( [
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '%3$s',
					'fallback_cb'    => false,
					'walker'         => new Culinary_Nav_Walker(),
				] );
			} else {
				// Fallback links
				$pages = [
					home_url( '/' )           => __( 'Home', 'culinary' ),
					get_post_type_archive_link( 'post' ) => __( 'Recipes', 'culinary' ),
					get_page_link( get_page_by_path( 'about' ) ) => __( 'About', 'culinary' ),
				];
				foreach ( $pages as $url => $label ) {
					if ( $url ) {
						printf(
							'<li class="culinary-nav__item"><a href="%s" class="culinary-nav__link">%s</a></li>',
							esc_url( $url ),
							esc_html( $label )
						);
					}
				}
			}
			?>
		</nav>

		<!-- Header actions -->
		<div class="culinary-header__actions">

			<!-- Search -->
			<div class="culinary-search-wrap">
				<button class="culinary-search-toggle btn btn--icon-only btn--utility" aria-label="<?php esc_attr_e( 'Search', 'culinary' ); ?>">
					<?php echo culinary_icon( 'search', 19 ); ?>
				</button>
				<?php get_search_form(); ?>
			</div>

			<!-- Subscribe CTA -->
			<a href="<?php echo esc_url( get_theme_mod( 'culinary_newsletter_url', '#newsletter' ) ); ?>" class="btn btn--primary btn--sm">
				<?php esc_html_e( 'Subscribe', 'culinary' ); ?>
			</a>

			<!-- Mobile menu toggle -->
			<button class="culinary-menu-toggle btn btn--icon-only btn--utility" aria-expanded="false" aria-controls="site-navigation" aria-label="<?php esc_attr_e( 'Toggle menu', 'culinary' ); ?>">
				<?php echo culinary_icon( 'menu', 22 ); ?>
			</button>
		</div>

	</div>
</header>

<div id="content" class="site-content">
<?php
/**
 * Simple nav walker that adds the culinary CSS classes.
 */
if ( ! class_exists( 'Culinary_Nav_Walker' ) ) {
	class Culinary_Nav_Walker extends Walker_Nav_Menu {
		public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
			$item    = $data_object;
			$classes = empty( $item->classes ) ? [] : (array) $item->classes;
			$is_cur  = in_array( 'current-menu-item', $classes, true );
			$has_sub = in_array( 'menu-item-has-children', $classes, true );

			$link_class = 'culinary-nav__link' . ( $is_cur ? ' active' : '' );
			$href       = ! empty( $item->url ) ? esc_url( $item->url ) : '#';
			$title      = apply_filters( 'the_title', $item->title, $item->ID );

			if ( $depth === 0 ) {
				$output .= '<li class="culinary-nav__item">';
				$output .= '<a href="' . $href . '" class="' . esc_attr( $link_class ) . '">' . esc_html( $title );
				if ( $has_sub ) {
					$output .= '<i data-lucide="chevron-down" width="15" height="15"></i>';
				}
				$output .= '</a>';
				if ( $has_sub ) {
					$output .= '<ul class="culinary-nav__dropdown">';
				}
			} else {
				$output .= '<li>';
				$output .= '<a href="' . $href . '" class="culinary-nav__dropdown-link">' . esc_html( $title ) . '</a>';
			}
		}

		public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
			$item    = $data_object;
			$classes = empty( $item->classes ) ? [] : (array) $item->classes;
			$has_sub = in_array( 'menu-item-has-children', $classes, true );

			if ( $depth === 0 && $has_sub ) {
				$output .= '</ul>';
			}
			$output .= '</li>';
		}

		public function start_lvl( &$output, $depth = 0, $args = null ) {}
		public function end_lvl( &$output, $depth = 0, $args = null ) {}
	}
}
