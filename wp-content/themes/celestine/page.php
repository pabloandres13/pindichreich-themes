<?php
/**
 * Single page.
 *
 * @package celestine
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="cel-main" class="cel-main">
	<?php while ( have_posts() ) : the_post(); ?>

		<div class="cel-page-hero">
			<div class="cel-container--text">
				<p class="cel-label cel-label--center" aria-hidden="true">&#10022;</p>
				<h1 class="cel-page-hero__title"><?php the_title(); ?></h1>
			</div>
		</div>

		<div class="cel-section cel-section--tight">
			<div class="cel-container--text cel-prose entry-content">
				<?php
				the_content();
				wp_link_pages( [
					'before' => '<div class="cel-page-links">' . esc_html__( 'Pages:', 'celestine' ),
					'after'  => '</div>',
				] );
				?>
			</div>
		</div>

	<?php endwhile; ?>
</main>

<?php
get_footer();
