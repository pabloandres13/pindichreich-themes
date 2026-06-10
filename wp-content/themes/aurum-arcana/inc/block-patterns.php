<?php
/**
 * Aurum Arcana — Block Patterns
 */

add_action( 'init', 'aurum_register_block_patterns' );
function aurum_register_block_patterns(): void {

	register_block_pattern_category( 'aurum', [ 'label' => __( 'Aurum Arcana', 'aurum-arcana' ) ] );

	/* Newsletter band */
	register_block_pattern( 'aurum/newsletter-band', [
		'title'      => __( 'Newsletter Band', 'aurum-arcana' ),
		'categories' => [ 'aurum' ],
		'content'    => '<!-- wp:shortcode -->[aurum_newsletter]<!-- /wp:shortcode -->',
	] );

	/* Ritual note callout */
	register_block_pattern( 'aurum/ritual-note', [
		'title'      => __( 'Ritual Note', 'aurum-arcana' ),
		'categories' => [ 'aurum' ],
		'content'    => '<!-- wp:group {"className":"aa-callout"} --><div class="wp-block-group aa-callout"><p class="aa-callout__label">Ritual Note</p><!-- wp:paragraph --><p>Write your ritual note here.</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
	] );

	/* Pull quote */
	register_block_pattern( 'aurum/pull-quote', [
		'title'      => __( 'Pull Quote', 'aurum-arcana' ),
		'categories' => [ 'aurum' ],
		'content'    => '<!-- wp:quote {"className":"aa-pull","style":{"border":{"left":{"color":"#C8A24A","width":"2px"}}}} --><blockquote class="wp-block-quote aa-pull"><p>The old arts ask for attention, not belief.</p></blockquote><!-- /wp:quote -->',
	] );

	/* Article card grid (shortcode) */
	register_block_pattern( 'aurum/article-grid', [
		'title'      => __( 'Article Grid (3 columns)', 'aurum-arcana' ),
		'categories' => [ 'aurum' ],
		'content'    => '<!-- wp:shortcode -->[aurum_articles count="3"]<!-- /wp:shortcode -->',
	] );
}
