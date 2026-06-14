<?php
/**
 * Front page.
 *
 * Editable, page-driven model: when a static page is set as the front page
 * (Settings → Reading) and has content, we render that page's blocks — so the
 * site owner builds and edits the entire home page from block patterns in the
 * editor (Aurum Arcana → "Home Page (complete)" or the individual "Home · …"
 * sections).
 *
 * When no front-page content exists yet (fresh install, or blog posts shown on
 * the front page) we fall back to the bundled demo sections so the site still
 * looks complete out of the box.
 *
 * @package aurum-arcana
 */

defined( 'ABSPATH' ) || exit;

get_header();

$aurum_front       = get_queried_object();
$aurum_has_content = is_page()
	&& $aurum_front instanceof WP_Post
	&& '' !== trim( (string) $aurum_front->post_content );

if ( $aurum_has_content ) :
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
else :
	get_template_part( 'template-parts/home/hero' );
	get_template_part( 'template-parts/home/themes-grid' );
	get_template_part( 'template-parts/home/latest' );
	get_template_part( 'template-parts/home/offering' );
	get_template_part( 'template-parts/home/about-teaser' );
	get_template_part( 'template-parts/home/newsletter' );
endif;

get_footer();
