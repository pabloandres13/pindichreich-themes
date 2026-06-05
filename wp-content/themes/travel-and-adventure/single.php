<?php
/**
 * Single post template.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div id="primary" <?php astra_primary_class(); ?>>
	<?php astra_primary_content_top(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'template-parts/single/post-hero' ); ?>

		<article <?php post_class( 'taa-single-post ast-container' ); ?>>
			<div class="taa-single-post__content">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="taa-single-post__media">
						<?php the_post_thumbnail( 'full' ); ?>
					</div>
				<?php endif; ?>

				<div class="taa-single-post__entry">
					<?php the_content(); ?>
				</div>

				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Seiten:', 'travel-and-adventure' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>
		</article>

		<?php if ( comments_open() || get_comments_number() ) : ?>
			<div class="ast-container taa-comments-wrap">
				<?php comments_template(); ?>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>

	<?php astra_primary_content_bottom(); ?>
</div>

<?php get_footer(); ?>

