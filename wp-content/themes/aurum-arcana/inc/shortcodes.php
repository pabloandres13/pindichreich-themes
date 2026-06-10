<?php
/**
 * Aurum Arcana — Shortcodes
 *
 * Embeds dynamic sections in page content without touching PHP.
 *
 * [aurum_articles count="6" category="" orderby="date"]
 * [aurum_newsletter]
 */

add_shortcode( 'aurum_articles', 'aurum_sc_articles' );
function aurum_sc_articles( array $atts ): string {
	$atts = shortcode_atts( [
		'count'    => 6,
		'category' => '',
		'orderby'  => 'date',
	], $atts, 'aurum_articles' );

	$args = [
		'post_type'      => 'post',
		'posts_per_page' => (int) $atts['count'],
		'orderby'        => sanitize_key( $atts['orderby'] ),
		'order'          => 'DESC',
		'no_found_rows'  => true,
	];

	if ( ! empty( $atts['category'] ) ) {
		$args['category_name'] = sanitize_text_field( $atts['category'] );
	}

	$query = new WP_Query( $args );

	if ( ! $query->have_posts() ) {
		return '<p class="aa-no-posts">' . esc_html__( 'No dispatches found.', 'aurum-arcana' ) . '</p>';
	}

	ob_start();
	echo '<div class="aa-grid-3">';
	while ( $query->have_posts() ) {
		$query->the_post();
		get_template_part( 'template-parts/content/article-card' );
	}
	echo '</div>';
	wp_reset_postdata();

	return ob_get_clean();
}

add_shortcode( 'aurum_newsletter', 'aurum_sc_newsletter' );
function aurum_sc_newsletter( array $atts ): string {
	ob_start();
	get_template_part( 'template-parts/home/newsletter' );
	return ob_get_clean();
}
