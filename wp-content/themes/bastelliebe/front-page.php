<?php
/**
 * Front page — editable, page-driven model.
 *
 * If a static page is set as the front page (Einstellungen → Lesen) and has
 * content, that content renders — so the site owner builds and edits the whole
 * home page from block patterns in the editor (Bastelliebe → „Startseite
 * (komplett)" or individual sections). No PHP/HTML editing required.
 *
 * When no front-page content exists yet (fresh install / posts as front page),
 * the bundled demo sections render so the site looks complete out of the box.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;

get_header();

$bl_front       = get_queried_object();
$bl_has_content = is_page()
	&& $bl_front instanceof WP_Post
	&& '' !== trim( (string) $bl_front->post_content );

if ( $bl_has_content ) :
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
else :
	get_template_part( 'template-parts/home/hero' );
	get_template_part( 'template-parts/home/categories' );
	get_template_part( 'template-parts/home/beginners' );
	get_template_part( 'template-parts/home/latest' );
	get_template_part( 'template-parts/home/popular' );
	get_template_part( 'template-parts/home/about' );
	get_template_part( 'template-parts/home/affiliate' );
	get_template_part( 'template-parts/home/newsletter' );
	get_template_part( 'template-parts/home/social' );
endif;

get_footer();
