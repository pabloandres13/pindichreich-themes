<?php
defined( 'ABSPATH' ) || exit;

/**
 * Register Gutenberg block patterns for the culinary theme.
 */
function culinary_register_block_patterns(): void {
	register_block_pattern_category( 'culinary', [
		'label' => __( 'Culinary', 'culinary' ),
	] );

	// ---- Newsletter band (tint) ----
	register_block_pattern( 'culinary/newsletter-band', [
		'title'      => __( 'Newsletter band', 'culinary' ),
		'categories' => [ 'culinary' ],
		'content'    => '<!-- wp:html -->' . culinary_newsletter_band_html( 'tint' ) . '<!-- /wp:html -->',
	] );

	// ---- Newsletter band (dark) ----
	register_block_pattern( 'culinary/newsletter-band-dark', [
		'title'      => __( 'Newsletter band — dark', 'culinary' ),
		'categories' => [ 'culinary' ],
		'content'    => '<!-- wp:html -->' . culinary_newsletter_band_html( 'dark' ) . '<!-- /wp:html -->',
	] );

	// ---- Kitchen tip callout ----
	register_block_pattern( 'culinary/tip-callout', [
		'title'      => __( 'Kitchen tip callout', 'culinary' ),
		'categories' => [ 'culinary', 'text' ],
		'content'    => '<!-- wp:group {"className":"culinary-callout culinary-callout--tip"} --><div class="wp-block-group culinary-callout culinary-callout--tip"><div class="culinary-callout__label">Tip</div><!-- wp:paragraph {"className":"culinary-callout__body"} --><p class="culinary-callout__body">Add your kitchen tip here.</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
	] );

	// ---- Recipe note callout ----
	register_block_pattern( 'culinary/note-callout', [
		'title'      => __( 'Recipe note callout', 'culinary' ),
		'categories' => [ 'culinary', 'text' ],
		'content'    => '<!-- wp:group {"className":"culinary-callout culinary-callout--note"} --><div class="wp-block-group culinary-callout culinary-callout--note"><div class="culinary-callout__label">Note</div><!-- wp:paragraph {"className":"culinary-callout__body"} --><p class="culinary-callout__body">Add your recipe note here.</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
	] );

	// ---- Pull quote ----
	register_block_pattern( 'culinary/pull-quote', [
		'title'      => __( 'Pull quote', 'culinary' ),
		'categories' => [ 'culinary', 'text' ],
		'content'    => '<!-- wp:group {"className":"culinary-callout culinary-callout--quote"} --><div class="wp-block-group culinary-callout culinary-callout--quote"><!-- wp:paragraph --><p>Good food doesn\'t need to be complicated. It needs to be made.</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
	] );
}
add_action( 'init', 'culinary_register_block_patterns' );

/**
 * Render newsletter band HTML for block patterns.
 */
function culinary_newsletter_band_html( string $tone = 'tint' ): string {
	$action = esc_url( get_theme_mod( 'culinary_newsletter_url', '#' ) );
	$title  = esc_html( get_theme_mod( 'culinary_newsletter_title', __( 'New recipes in your inbox', 'culinary' ) ) );
	$body   = esc_html( get_theme_mod( 'culinary_newsletter_body', __( 'One warm, seasonal recipe each week. No spam, unsubscribe anytime.', 'culinary' ) ) );

	ob_start();
	get_template_part( 'template-parts/home/newsletter', null, [ 'tone' => $tone ] );
	return ob_get_clean() ?: '';
}
