<?php
/**
 * Front page.
 *
 * Editable, page-driven model: if a static page is set as the front page
 * (Einstellungen → Lesen) and has content, we render that — so the studio owner
 * builds and edits the home page from block patterns in the editor
 * (Body & Mind → „Startseite (komplett)“ or individual sections).
 *
 * When no front-page content exists yet (fresh install / blog posts as front
 * page), we fall back to the bundled demo sections so the site still looks
 * complete out of the box.
 *
 * @package body-and-mind
 */

defined( 'ABSPATH' ) || exit;

get_header();

$bm_front = get_queried_object();
$bm_has_content = is_page()
	&& $bm_front instanceof WP_Post
	&& '' !== trim( (string) $bm_front->post_content );

if ( $bm_has_content ) :
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
else :
	get_template_part( 'template-parts/home/hero' );
	get_template_part( 'template-parts/home/classes' );
	get_template_part( 'template-parts/home/about' );
	get_template_part( 'template-parts/home/schedule-preview' );
	get_template_part( 'template-parts/home/pricing' );
	get_template_part( 'template-parts/home/testimonials' );
	get_template_part( 'template-parts/home/magazine-teaser' );
	get_template_part( 'template-parts/home/newsletter' );
endif;

get_footer();
