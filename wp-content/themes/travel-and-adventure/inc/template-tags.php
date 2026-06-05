<?php
/**
 * Template helpers for the Travel and Adventure child theme.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns a simple reading time estimate for a post.
 *
 * @param int|null $post_id Optional post ID.
 * @return string
 */
function taa_get_reading_time_label( $post_id = null ) {
	$post_id      = $post_id ? (int) $post_id : get_the_ID();
	$content      = get_post_field( 'post_content', $post_id );
	$word_count   = str_word_count( wp_strip_all_tags( $content ) );
	$minutes      = max( 1, (int) ceil( $word_count / 220 ) );
	/* translators: %d is the estimated reading time in minutes. */
	$label_format = _n( '%d Min. Lesezeit', '%d Min. Lesezeit', $minutes, 'travel-and-adventure' );

	return sprintf( $label_format, $minutes );
}

/**
 * Prints the primary category name for the current post if one exists.
 *
 * @return void
 */
function taa_the_primary_category() {
	$categories = get_the_category();

	if ( empty( $categories ) ) {
		return;
	}

	printf(
		'<a class="taa-eyebrow-link" href="%1$s">%2$s</a>',
		esc_url( get_category_link( $categories[0]->term_id ) ),
		esc_html( $categories[0]->name )
	);
}

/**
 * Returns a default archive description when WordPress has none.
 *
 * @return string
 */
function taa_get_archive_intro() {
	if ( is_search() ) {
		return __( 'Entdecke passende Beitraege, Reisetipps und Inspirationen fuer deinen Kreta- und Griechenlandurlaub.', 'travel-and-adventure' );
	}

	$description = get_the_archive_description();

	if ( $description ) {
		return wp_strip_all_tags( $description );
	}

	if ( is_home() ) {
		return __( 'Die neuesten Geschichten, Guides und Reiseideen im Ueberblick.', 'travel-and-adventure' );
	}

	return __( 'Sammlung redaktioneller Inhalte, Reiseberichte und praktischer Tipps.', 'travel-and-adventure' );
}

/**
 * Returns the most useful categories for the homepage feature grid.
 *
 * @return WP_Term[]
 */
function taa_get_featured_categories() {
	$categories = get_categories(
		array(
			'taxonomy'   => 'category',
			'hide_empty' => true,
			'number'     => 3,
			'exclude'    => array( 1 ),
			'orderby'    => 'count',
			'order'      => 'DESC',
		)
	);

	return is_array( $categories ) ? $categories : array();
}

/**
 * Returns a suitable hero title for the homepage.
 *
 * @return string
 */
function taa_get_front_page_title() {
	$title = get_the_title();

	if ( $title && ! in_array( strtolower( trim( $title ) ), array( 'home', 'startseite' ), true ) ) {
		return $title;
	}

	return __( 'Kreta entdecken mit Franzi', 'travel-and-adventure' );
}

/**
 * Returns a suitable hero intro for the homepage.
 *
 * @return string
 */
function taa_get_front_page_intro() {
	$excerpt = get_the_excerpt();

	if ( $excerpt ) {
		return wp_strip_all_tags( $excerpt );
	}

	$description = get_bloginfo( 'description' );

	if ( $description ) {
		return $description;
	}

	return __( 'Persoenliche Kreta-Tipps, Reiseideen und praktische Empfehlungen fuer entspannte Ferien auf der Insel.', 'travel-and-adventure' );
}

/**
 * Returns a safe blog URL for homepage CTAs.
 *
 * @return string
 */
function taa_get_blog_url() {
	$posts_page_id = (int) get_option( 'page_for_posts' );

	if ( $posts_page_id > 0 ) {
		$url = get_permalink( $posts_page_id );

		if ( $url ) {
			return $url;
		}
	}

	return home_url( '/' );
}

/**
 * Returns a safe about URL for homepage CTAs.
 *
 * @return string
 */
function taa_get_about_url() {
	$page = get_page_by_path( 'ueber-mich' );

	if ( $page instanceof WP_Post ) {
		$url = get_permalink( $page );

		if ( $url ) {
			return $url;
		}
	}

	return home_url( '/' );
}

/**
 * Returns a representative image URL for a category based on its latest post.
 *
 * @param int $category_id Category ID.
 * @return string
 */
function taa_get_category_image_url( $category_id ) {
	$query = new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 1,
			'ignore_sticky_posts' => true,
			'cat'                 => (int) $category_id,
			'meta_query'          => array(
				array(
					'key'     => '_thumbnail_id',
					'compare' => 'EXISTS',
				),
			),
		)
	);

	if ( ! $query->have_posts() ) {
		return '';
	}

	$query->the_post();
	$image_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
	wp_reset_postdata();

	return $image_url ? $image_url : '';
}
