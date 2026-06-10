<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="aa-hdr" id="aa-hdr">
	<!-- Logo / wordmark -->
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="aa-hdr__logo" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		<span class="aa-hdr__sigil" aria-hidden="true"><?php echo aurum_sigil( 32 ); ?></span>
		<span class="aa-hdr__word"><?php echo esc_html( get_theme_mod( 'aurum_pub_name', get_bloginfo( 'name' ) ) ); ?></span>
	</a>

	<!-- Primary navigation (desktop) -->
	<nav class="aa-hdr__nav" aria-label="<?php esc_attr_e( 'Primary', 'aurum-arcana' ); ?>">
		<?php
		wp_nav_menu( [
			'theme_location' => 'primary',
			'container'      => false,
			'items_wrap'     => '%3$s',
			'walker'         => new Aurum_Nav_Walker(),
			'fallback_cb'    => 'aurum_nav_fallback',
		] );
		?>
	</nav>

	<!-- Right side: search + CTA + mobile toggle -->
	<div class="aa-hdr__right">
		<button class="aa-hdr__icon aa-hdr__search-toggle" aria-label="<?php esc_attr_e( 'Search', 'aurum-arcana' ); ?>" aria-expanded="false">
			<?php echo aurum_icon( 'magnifying-glass', 22 ); ?>
		</button>
		<?php
		$booking_url = get_theme_mod( 'aurum_reading_url', '' );
		$booking_page = get_page_by_path( 'about' );
		if ( ! $booking_url && $booking_page ) {
			$booking_url = get_permalink( $booking_page );
		}
		if ( $booking_url ) : ?>
			<a href="<?php echo esc_url( $booking_url ); ?>" class="aa-btn aa-btn--primary aa-btn--sm">
				<?php esc_html_e( 'Book a Reading', 'aurum-arcana' ); ?>
			</a>
		<?php endif; ?>

		<button class="aa-hdr__mobile-toggle" aria-label="<?php esc_attr_e( 'Open navigation', 'aurum-arcana' ); ?>" aria-expanded="false">
			<?php echo aurum_icon( 'list', 24 ); ?>
		</button>
	</div>
</header>

<!-- Search overlay -->
<div class="aa-search-overlay" role="search" aria-hidden="true" style="
	display:none;position:fixed;top:0;left:0;right:0;bottom:0;
	background:rgba(14,13,15,.94);z-index:999;align-items:center;justify-content:center;">
	<div style="width:100%;max-width:600px;padding:0 24px;">
		<?php get_search_form(); ?>
	</div>
</div>
<style>
.aa-search-overlay.is-open { display:flex !important; }
.aa-search-overlay input[type="search"] {
	width:100%;padding:1em 1.4em;
	font-family:var(--font-body);font-size:var(--text-lg);
	background:var(--ink-700);border:1px solid var(--hairline-strong);
	border-radius:var(--radius-md);color:var(--text-body);
}
.aa-search-overlay input[type="search"]::placeholder { color:var(--text-faint); }
.aa-search-overlay input[type="search"]:focus { outline:2px solid var(--accent); }
.search-submit { display:none; }
</style>

<!-- Mobile nav overlay -->
<nav class="aa-mobile-nav" id="aa-mobile-nav" aria-label="<?php esc_attr_e( 'Mobile navigation', 'aurum-arcana' ); ?>">
	<button class="aa-mobile-nav__close" aria-label="<?php esc_attr_e( 'Close navigation', 'aurum-arcana' ); ?>">
		<?php echo aurum_icon( 'x', 28 ); ?>
	</button>
	<?php
	wp_nav_menu( [
		'theme_location' => 'primary',
		'container'      => false,
		'items_wrap'     => '%3$s',
		'fallback_cb'    => 'aurum_mobile_nav_fallback',
	] );
	?>
</nav>

<?php
/**
 * Fallback nav when no menu is assigned.
 */
function aurum_nav_fallback(): void {
	$pages = get_pages( [ 'sort_column' => 'menu_order' ] );
	foreach ( $pages as $page ) {
		$active = is_page( $page->ID ) ? ' current-menu-item' : '';
		printf(
			'<a href="%s" class="aa-hdr__link%s">%s</a>',
			esc_url( get_permalink( $page ) ),
			esc_attr( $active ),
			esc_html( $page->post_title )
		);
	}
}

function aurum_mobile_nav_fallback(): void {
	$pages = get_pages( [ 'sort_column' => 'menu_order' ] );
	foreach ( $pages as $page ) {
		printf(
			'<li><a href="%s">%s</a></li>',
			esc_url( get_permalink( $page ) ),
			esc_html( $page->post_title )
		);
	}
}

/**
 * Custom Walker: adds .aa-hdr__link class to nav items.
 */
class Aurum_Nav_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item = $data_object;
		$classes = empty( $item->classes ) ? [] : (array) $item->classes;
		$active = ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true ) ) ? ' current-menu-item' : '';
		$output .= sprintf(
			'<a href="%s" class="aa-hdr__link%s"%s>%s</a>',
			esc_url( $item->url ),
			esc_attr( $active ),
			$active ? ' aria-current="page"' : '',
			esc_html( $item->title )
		);
	}
	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {}
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}
}
?>

<div id="page">
