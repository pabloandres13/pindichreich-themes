<?php
/**
 * Bastelliebe — theme bootstrap.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   Enqueue styles + scripts
   ============================================================ */
function bl_enqueue_assets() {
	wp_enqueue_style(
		'astra-theme-css',
		get_template_directory_uri() . '/style.css',
		[],
		wp_get_theme( 'astra' )->get( 'Version' )
	);

	// Design tokens (CSS custom properties + self-hosted fonts).
	wp_enqueue_style(
		'bl-tokens',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[ 'astra-theme-css' ],
		wp_get_theme()->get( 'Version' )
	);

	// Component + layout styles.
	wp_enqueue_style(
		'bl-theme',
		get_stylesheet_directory_uri() . '/assets/css/theme.css',
		[ 'bl-tokens' ],
		wp_get_theme()->get( 'Version' )
	);

	// Customizer colour overrides (inline, after tokens).
	bl_output_custom_colors();

	// Theme JS.
	wp_enqueue_script(
		'bl-theme',
		get_stylesheet_directory_uri() . '/assets/js/theme.js',
		[],
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'bl_enqueue_assets' );

/* ---- Block editor styles ---- */
function bl_enqueue_editor_assets() {
	wp_enqueue_style(
		'bl-tokens-editor',
		get_stylesheet_directory_uri() . '/assets/css/tokens.css',
		[],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'enqueue_block_editor_assets', 'bl_enqueue_editor_assets' );

/* ============================================================
   Theme supports
   ============================================================ */
function bl_theme_setup() {
	load_theme_textdomain( 'bastelliebe', get_stylesheet_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ] );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	add_theme_support( 'custom-logo', [
		'height'      => 60,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	] );

	register_nav_menus( [
		'primary' => __( 'Hauptnavigation', 'bastelliebe' ),
		'footer'  => __( 'Footer-Navigation', 'bastelliebe' ),
	] );

	add_theme_support( 'editor-color-palette', [
		[ 'name' => __( 'Koralle', 'bastelliebe' ),    'slug' => 'coral',      'color' => '#E8654A' ],
		[ 'name' => __( 'Senf', 'bastelliebe' ),       'slug' => 'mustard',    'color' => '#E0A82E' ],
		[ 'name' => __( 'Petrol', 'bastelliebe' ),     'slug' => 'teal',       'color' => '#2FA6A0' ],
		[ 'name' => __( 'Beere', 'bastelliebe' ),      'slug' => 'berry',      'color' => '#C75B9E' ],
		[ 'name' => __( 'Creme', 'bastelliebe' ),      'slug' => 'cream',      'color' => '#FBF7F0' ],
		[ 'name' => __( 'Creme dunkel', 'bastelliebe' ), 'slug' => 'cream-alt', 'color' => '#F4ECDD' ],
		[ 'name' => __( 'Weiß', 'bastelliebe' ),       'slug' => 'white',      'color' => '#FFFFFF' ],
		[ 'name' => __( 'Anthrazit', 'bastelliebe' ),  'slug' => 'ink',        'color' => '#2C2A27' ],
	] );

	add_theme_support( 'editor-font-sizes', [
		[ 'name' => __( 'Klein', 'bastelliebe' ),  'slug' => 'small',  'size' => 14 ],
		[ 'name' => __( 'Normal', 'bastelliebe' ), 'slug' => 'normal', 'size' => 16 ],
		[ 'name' => __( 'Groß', 'bastelliebe' ),   'slug' => 'large',  'size' => 20 ],
		[ 'name' => __( 'Sehr groß', 'bastelliebe' ), 'slug' => 'huge', 'size' => 30 ],
	] );

	add_theme_support( 'editor-styles' );
	add_editor_style( [
		'assets/css/tokens.css',
		'assets/css/theme.css',
		'assets/css/editor.css',
	] );
}
add_action( 'after_setup_theme', 'bl_theme_setup' );

/* ============================================================
   Inline colour overrides from Customizer
   ============================================================ */
function bl_output_custom_colors() {
	$map = [
		'bl_color_coral'   => [ '--coral-500', '#E8654A' ],
		'bl_color_mustard' => [ '--cat-heimwerken', '#E0A82E' ],
		'bl_color_teal'    => [ '--cat-wohndeko', '#2FA6A0' ],
		'bl_color_berry'   => [ '--cat-kinder', '#C75B9E' ],
		'bl_color_cream'   => [ '--cream-100', '#FBF7F0' ],
		'bl_color_ink'     => [ '--ink-900', '#2C2A27' ],
	];

	$changed = false;
	$css     = ':root{';
	foreach ( $map as $key => [ $prop, $default ] ) {
		$val = get_theme_mod( $key, $default );
		if ( $val !== $default ) {
			$changed = true;
		}
		$css .= $prop . ':' . sanitize_hex_color( $val ) . ';';
	}
	$css .= '}';

	if ( $changed ) {
		wp_add_inline_style( 'bl-tokens', $css );
	}
}

/* ============================================================
   Template helpers (kept here — not in template-parts — to avoid
   "cannot redeclare" when parts are included multiple times)
   ============================================================ */

/**
 * Color-coded craft categories. Keys map to the --cat-* tokens.
 *
 * @return array<string,array<string,string>>
 */
function bl_categories(): array {
	return [
		'papier'     => [ 'label' => __( 'Basteln & Papier', 'bastelliebe' ), 'short' => __( 'Papier', 'bastelliebe' ),     'icon' => 'scissors' ],
		'heimwerken' => [ 'label' => __( 'Heimwerken & Upcycling', 'bastelliebe' ), 'short' => __( 'Heimwerken', 'bastelliebe' ), 'icon' => 'hammer' ],
		'wohndeko'   => [ 'label' => __( 'Wohndeko', 'bastelliebe' ),         'short' => __( 'Wohndeko', 'bastelliebe' ),   'icon' => 'sofa' ],
		'kinder'     => [ 'label' => __( 'Kinderbasteln', 'bastelliebe' ),    'short' => __( 'Kinder', 'bastelliebe' ),     'icon' => 'baby' ],
	];
}

/**
 * Render an inline SVG icon (Lucide line icons + Pinterest brand glyph).
 */
function bl_icon( string $name, int $size = 20, float $stroke = 2 ): string {
	$stroke_icons = [
		'menu'         => '<line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="18" y2="18"/>',
		'close'        => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
		'arrow-right'  => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
		'chevron-down' => '<path d="m6 9 6 6 6-6"/>',
		'search'       => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
		'mail'         => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
		'clock'        => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'gauge'        => '<path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/>',
		'scissors'     => '<circle cx="6" cy="6" r="3"/><path d="M8.12 8.12 12 12"/><path d="M20 4 8.12 15.88"/><circle cx="6" cy="18" r="3"/><path d="M14.8 14.8 20 20"/>',
		'hammer'       => '<path d="m15 12-8.5 8.5a2.12 2.12 0 1 1-3-3L12 9"/><path d="M17.64 15 22 10.64"/><path d="m20.91 11.7-1.25-1.25c-.6-.6-.93-1.4-.93-2.25v-.86L16.01 4.6a5.56 5.56 0 0 0-3.94-1.64H9l.92.82A6.18 6.18 0 0 1 12 8.4v1.56l2 2h2.47l2.26 2.26"/>',
		'sofa'         => '<path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3"/><path d="M2 11v5a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v2H6v-2a2 2 0 0 0-4 0Z"/><path d="M4 18v2"/><path d="M20 18v2"/>',
		'baby'         => '<path d="M9 12h.01"/><path d="M15 12h.01"/><path d="M10 16c.5.3 1.2.5 2 .5s1.5-.2 2-.5"/><path d="M17.5 8a8 8 0 0 1 1.5 4.5 7 7 0 0 1-14 0A8 8 0 0 1 6.5 8"/><path d="M12 4a2 2 0 0 0-2 2c0 1 .5 1.5 1 2"/>',
		'sparkles'     => '<path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/>',
		'star'         => '<path d="M11.5 2.5 14 7.6l5.6.8-4 3.9.9 5.6-5-2.6-5 2.6.9-5.6-4-3.9 5.6-.8Z"/>',
		'user'         => '<circle cx="12" cy="8" r="4"/><path d="M4 20c0-3.3 3.6-6 8-6s8 2.7 8 6"/>',
		'shopping-bag' => '<path d="M6 2 4 6v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6l-2-4Z"/><path d="M4 6h16"/><path d="M16 10a4 4 0 0 1-8 0"/>',
		'external-link'=> '<path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>',
		'info'         => '<circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/>',
		'check'        => '<path d="M20 6 9 17l-5-5"/>',
		'instagram'    => '<rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>',
		'heart'        => '<path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>',
	];

	// Filled brand glyph(s) use a 0 0 24 24 viewBox with fill.
	if ( 'pinterest' === $name ) {
		return sprintf(
			'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 0C5.373 0 0 5.372 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 0 1 .083.345c-.091.378-.293 1.194-.333 1.361-.052.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.632-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12C24 5.372 18.627 0 12 0z"/></svg>',
			$size
		);
	}

	$paths = $stroke_icons[ $name ] ?? '';
	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%2$s" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%3$s</svg>',
		$size,
		esc_attr( (string) $stroke ),
		$paths
	);
}

/**
 * Render the Bastelliebe logo lockup ("Bastel" + handwritten "liebe").
 */
function bl_logo( bool $light = false ): void {
	$name = get_theme_mod( 'bl_site_name', 'Bastelliebe' );
	// Split into the Fredoka part + the handwritten tail (last 5 chars by default "liebe").
	$word1 = $name;
	$word2 = '';
	if ( 'Bastelliebe' === $name ) {
		$word1 = 'Bastel';
		$word2 = 'liebe';
	}
	$light_class = $light ? ' bl-logo--light' : '';
	?>
	<span class="bl-logo<?php echo esc_attr( $light_class ); ?>">
		<span class="bl-logo__mark">
			<svg width="32" height="32" viewBox="0 0 100 100" aria-hidden="true">
				<path d="M50 87 C16 63 5 45 5 29 C5 15 16 5 29 5 C39 5 46 11 50 19 C54 11 61 5 71 5 C84 5 95 15 95 29 C95 45 84 63 50 87 Z" fill="var(--coral-500)"/>
				<path d="M50 78 C22 58 14 43 14 30 C14 19 22 12 31 12 C40 12 46 18 50 26 C54 18 60 12 69 12 C78 12 86 19 86 30 C86 43 78 58 50 78 Z" fill="none" stroke="var(--cream-100)" stroke-width="2.6" stroke-dasharray="5 5" stroke-linecap="round" opacity="0.92"/>
			</svg>
		</span>
		<span class="bl-logo__word">
			<span class="bl-logo__word-1"><?php echo esc_html( $word1 ); ?></span>
			<?php if ( $word2 ) : ?>
				<span class="bl-logo__word-2"><?php echo esc_html( $word2 ); ?></span>
			<?php endif; ?>
		</span>
	</span>
	<?php
}

/**
 * Render a category chip/tag.
 */
function bl_tag( string $category, string $size = 'md' ): string {
	$cats  = bl_categories();
	$meta  = $cats[ $category ] ?? null;
	$label = $meta ? $meta['label'] : ucfirst( $category );
	$icon  = $meta ? bl_icon( $meta['icon'], 'sm' === $size ? 12 : 14, 2.4 ) : '';
	$sz    = 'sm' === $size ? ' bl-tag--sm' : '';
	return sprintf(
		'<span class="bl-tag bl-tag--%1$s%2$s">%3$s%4$s</span>',
		esc_attr( $category ),
		$sz,
		$icon,
		esc_html( $label )
	);
}

/**
 * Render a single project (Anleitung) card.
 *
 * @param array<string,string> $p Card data: title, category, image, time, difficulty, href.
 */
function bl_project_card( array $p ): string {
	$cats     = bl_categories();
	$category = $p['category'] ?? 'papier';
	$meta     = $cats[ $category ] ?? $cats['papier'];
	$href     = $p['href'] ?? '#';
	$compact  = ! empty( $p['compact'] ) ? ' bl-project-card--compact' : '';

	ob_start();
	?>
	<a href="<?php echo esc_url( $href ); ?>" class="bl-project-card bl-reveal<?php echo esc_attr( $compact ); ?>">
		<div class="bl-project-card__media">
			<?php if ( ! empty( $p['image'] ) ) : ?>
				<img src="<?php echo esc_url( $p['image'] ); ?>" alt="<?php echo esc_attr( $p['title'] ?? '' ); ?>" loading="lazy" decoding="async">
			<?php else : ?>
				<span class="bl-project-card__placeholder bl-project-card__placeholder--<?php echo esc_attr( $category ); ?>">
					<?php echo bl_icon( $meta['icon'], 46, 1.6 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</span>
			<?php endif; ?>
			<span class="bl-project-card__tag"><?php echo bl_tag( $category, 'sm' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		</div>
		<div class="bl-project-card__body">
			<h3 class="bl-project-card__title"><?php echo esc_html( $p['title'] ?? '' ); ?></h3>
			<div class="bl-project-card__meta">
				<?php if ( ! empty( $p['time'] ) ) : ?>
					<span><?php echo bl_icon( 'clock', 15 ); // phpcs:ignore ?><?php echo esc_html( $p['time'] ); ?></span>
				<?php endif; ?>
				<?php if ( ! empty( $p['difficulty'] ) ) : ?>
					<span><?php echo bl_icon( 'gauge', 15 ); // phpcs:ignore ?><?php echo esc_html( $p['difficulty'] ); ?></span>
				<?php endif; ?>
			</div>
		</div>
	</a>
	<?php
	return (string) ob_get_clean();
}

/* ============================================================
   Include modules
   ============================================================ */
require get_stylesheet_directory() . '/inc/customizer.php';
require get_stylesheet_directory() . '/inc/block-support.php';
require get_stylesheet_directory() . '/inc/shortcodes.php';
require get_stylesheet_directory() . '/inc/block-patterns.php';
