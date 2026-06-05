<?php
/**
 * Archive template.
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
	<?php get_template_part( 'template-parts/archive/hero' ); ?>
	<?php get_template_part( 'template-parts/archive/post-grid' ); ?>
	<?php astra_primary_content_bottom(); ?>
</div>

<?php get_footer(); ?>

