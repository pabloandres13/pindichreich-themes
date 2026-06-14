<?php
/**
 * Front page.
 *
 * Editable, page-driven model: if a static page is set as the front page
 * (Settings → Reading) and has content, we render that content — so the site
 * owner builds and edits the home page from block patterns in the editor
 * (Culinary → "Home page (complete)", or the individual section patterns).
 *
 * When no front-page content exists yet (fresh install / posts as front page),
 * we fall back to the bundled demo sections so the site still looks complete
 * out of the box.
 *
 * @package culinary
 */
defined( 'ABSPATH' ) || exit;
get_header();

$culinary_front       = get_queried_object();
$culinary_has_content = is_page()
	&& $culinary_front instanceof WP_Post
	&& '' !== trim( (string) $culinary_front->post_content );
?>

<main id="primary" class="site-main" role="main">
	<?php
	if ( $culinary_has_content ) :
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
	else :
		get_template_part( 'template-parts/home/hero' );
		get_template_part( 'template-parts/home/featured' );
		get_template_part( 'template-parts/home/categories' );
		get_template_part( 'template-parts/home/latest' );
		get_template_part( 'template-parts/home/about-teaser' );
		get_template_part( 'template-parts/home/newsletter', null, [ 'tone' => 'tint' ] );
	endif;
	?>
</main>

<?php get_footer(); ?>
