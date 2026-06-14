<?php
defined( 'ABSPATH' ) || exit;

/**
 * Shortcodes for dynamic recipe sections.
 * Usage: [culinary_recipes_grid count="6" category="breakfast"]
 *         [culinary_categories count="4"]
 *         [culinary_newsletter tone="tint"]
 */

/**
 * Recipe grid shortcode.
 * [culinary_recipes_grid count="6" category="" orderby="date"]
 */
function culinary_sc_recipes_grid( array $atts ): string {
	$atts = shortcode_atts( [
		'count'    => 6,
		'category' => '',
		'orderby'  => 'date',
		'order'    => 'DESC',
	], $atts, 'culinary_recipes_grid' );

	$args = [
		'posts_per_page' => absint( $atts['count'] ),
		'post_status'    => 'publish',
		'orderby'        => sanitize_key( $atts['orderby'] ),
		'order'          => in_array( strtoupper( $atts['order'] ), [ 'ASC', 'DESC' ], true ) ? strtoupper( $atts['order'] ) : 'DESC',
	];

	if ( $atts['category'] ) {
		$args['category_name'] = sanitize_text_field( $atts['category'] );
	}

	$q = new WP_Query( $args );

	ob_start();
	echo '<div class="recipe-grid">';
	if ( $q->have_posts() ) {
		while ( $q->have_posts() ) {
			$q->the_post();
			get_template_part( 'template-parts/content/recipe-card' );
		}
		wp_reset_postdata();
	} else {
		// Demo fallback so freshly-inserted patterns still look complete.
		foreach ( array_slice( culinary_demo_recipes(), 0, absint( $atts['count'] ) ) as $r ) {
			echo culinary_render_demo_recipe_card( $r );
		}
	}
	echo '</div>';
	return ob_get_clean() ?: '';
}
add_shortcode( 'culinary_recipes_grid', 'culinary_sc_recipes_grid' );

/**
 * Category tiles shortcode.
 * [culinary_categories count="4"]
 */
function culinary_sc_categories( array $atts ): string {
	$atts = shortcode_atts( [ 'count' => 4 ], $atts, 'culinary_categories' );

	$cats = get_categories( [
		'number'     => absint( $atts['count'] ),
		'hide_empty' => true,
		'orderby'    => 'count',
		'order'      => 'DESC',
	] );

	ob_start();
	echo '<div class="category-grid">';

	if ( empty( $cats ) ) {
		// Demo fallback so freshly-inserted patterns still look complete.
		foreach ( array_slice( culinary_demo_categories(), 0, absint( $atts['count'] ) ) as $c ) {
			echo culinary_render_demo_category_tile( $c );
		}
		echo '</div>';
		return ob_get_clean() ?: '';
	}

	foreach ( $cats as $cat ) {
		$cat_thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
		$cat_thumb    = $cat_thumb_id ? wp_get_attachment_image_url( $cat_thumb_id, 'medium_large' ) : '';
		if ( ! $cat_thumb ) {
			$q = new WP_Query( [ 'posts_per_page' => 1, 'cat' => $cat->term_id ] );
			if ( $q->have_posts() ) $cat_thumb = get_the_post_thumbnail_url( $q->posts[0]->ID, 'medium_large' );
			wp_reset_postdata();
		}
		printf(
			'<a href="%s" class="category-tile">%s<div class="category-tile__scrim"></div><div class="category-tile__label"><p class="category-tile__name">%s</p><div class="category-tile__count">%s</div></div></a>',
			esc_url( get_category_link( $cat ) ),
			$cat_thumb ? '<img src="' . esc_url( $cat_thumb ) . '" alt="' . esc_attr( $cat->name ) . '" class="category-tile__image" loading="lazy">' : '<div class="category-tile__image" style="background:var(--cream-200)"></div>',
			esc_html( $cat->name ),
			sprintf( esc_html( _n( '%d recipe', '%d recipes', $cat->count, 'culinary' ) ), esc_html( $cat->count ) )
		);
	}
	echo '</div>';
	return ob_get_clean() ?: '';
}
add_shortcode( 'culinary_categories', 'culinary_sc_categories' );

/**
 * Newsletter band shortcode.
 * [culinary_newsletter tone="tint|sage|dark"]
 */
function culinary_sc_newsletter( array $atts ): string {
	$atts = shortcode_atts( [ 'tone' => 'tint' ], $atts, 'culinary_newsletter' );
	ob_start();
	get_template_part( 'template-parts/home/newsletter', null, [ 'tone' => sanitize_key( $atts['tone'] ) ] );
	return ob_get_clean() ?: '';
}
add_shortcode( 'culinary_newsletter', 'culinary_sc_newsletter' );
