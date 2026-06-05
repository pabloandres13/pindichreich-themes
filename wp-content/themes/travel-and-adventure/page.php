<?php
/**
 * Page template.
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
		<section class="taa-page-header">
			<div class="ast-container">
				<h1 class="taa-page-header__title"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<div class="taa-page-header__lead"><?php the_excerpt(); ?></div>
				<?php endif; ?>
			</div>
		</section>

		<article <?php post_class( 'taa-page-content ast-container' ); ?>>
			<?php the_content(); ?>
		</article>
	<?php endwhile; ?>

	<?php astra_primary_content_bottom(); ?>
</div>

<?php get_footer(); ?>

