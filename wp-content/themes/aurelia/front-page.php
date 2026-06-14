<?php
/**
 * Front page.
 *
 * Editable, page-driven model: if a static page is set as the front page
 * (Einstellungen → Lesen) and has content, we render that — so the practice
 * owner builds and edits the home page from block patterns in the editor
 * (Aurelia → „Startseite (komplett)“ or individual sections).
 *
 * When no front-page content exists yet (fresh install / blog posts as front
 * page), we fall back to the bundled demo sections so the site still looks
 * complete out of the box.
 *
 * @package aurelia
 */

defined( 'ABSPATH' ) || exit;

get_header();

$au_front       = get_queried_object();
$au_has_content = is_page()
	&& $au_front instanceof WP_Post
	&& '' !== trim( (string) $au_front->post_content );

if ( $au_has_content ) :
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
else :
	get_template_part( 'template-parts/home/hero' );
	get_template_part( 'template-parts/home/services' );
	get_template_part( 'template-parts/home/about-teaser' );
	get_template_part( 'template-parts/home/approach' );
	get_template_part( 'template-parts/home/testimonials' );
	get_template_part( 'template-parts/home/magazine-teaser' );
	?>
	<section class="au-section au-section--cream">
		<div class="au-container">
			<?php get_template_part( 'template-parts/home/newsletter', null, [ 'tone' => 'green' ] ); ?>
		</div>
	</section>
	<?php
endif;

get_footer();
