<?php
/**
 * Front page — page-driven & fully editable.
 *
 * If a static page is set as the front page (Settings → Reading) and has
 * content, we render that page's blocks — so the coach builds and edits the
 * whole home page from the "Maren Cole" block patterns in the editor, with no
 * PHP or HTML to touch.
 *
 * With no front-page content yet (fresh install / posts as front page) we fall
 * back to the bundled demo home — the exact same patterns rendered through
 * do_blocks — so the site looks complete out of the box.
 *
 * @package maren-cole
 */

defined( 'ABSPATH' ) || exit;

get_header();

$mc_front       = get_queried_object();
$mc_has_content = is_page()
	&& $mc_front instanceof WP_Post
	&& '' !== trim( (string) $mc_front->post_content );

if ( $mc_has_content ) :
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
else :
	echo do_blocks( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		mc_pattern_hero() .
		mc_pattern_trust() .
		mc_pattern_promise() .
		mc_pattern_services() .
		mc_pattern_about() .
		mc_pattern_testimonials() .
		mc_pattern_optin() .
		mc_pattern_resources() .
		mc_pattern_faq() .
		mc_pattern_final_cta()
	);
endif;

get_footer();
