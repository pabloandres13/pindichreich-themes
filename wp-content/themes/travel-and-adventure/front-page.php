<?php
/**
 * Front page template for the Travel and Adventure child theme.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div id="primary" class="taa-front-page">
	<?php astra_primary_content_top(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<div class="taa-front-page-content">
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>

	<?php astra_primary_content_bottom(); ?>
</div>

<?php
get_footer();
