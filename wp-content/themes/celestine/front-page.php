<?php
/**
 * Front page.
 *
 * Page-driven, fully editable model: when a static page is set as the front
 * page (Settings → Reading) and has content, that content is rendered — so the
 * site owner builds and edits the entire home page from block patterns in the
 * editor (Celestine → "Home page (complete)" or individual sections).
 *
 * With no front-page content yet (fresh install / posts as the front page), the
 * bundled demo — the very same block patterns — is rendered so the site looks
 * complete out of the box. The patterns are the single source of truth.
 *
 * @package celestine
 */

defined( 'ABSPATH' ) || exit;

get_header();

$cel_front       = get_queried_object();
$cel_has_content = is_page()
	&& $cel_front instanceof WP_Post
	&& '' !== trim( (string) $cel_front->post_content );
?>

<main id="cel-main" class="cel-main">
	<?php
	if ( $cel_has_content ) :
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
	else :
		// Demo fallback: render the bundled home patterns (incl. live shortcodes).
		echo do_blocks( cel_home_demo() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	endif;
	?>
</main>

<?php
get_footer();
