<?php
/**
 * Blog index template.
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
	<?php get_template_part( 'template-parts/archive/hero', null, array( 'title' => get_the_title( get_option( 'page_for_posts' ) ) ?: __( 'Blog', 'travel-and-adventure' ) ) ); ?>
	<?php get_template_part( 'template-parts/archive/post-grid' ); ?>
	<?php astra_primary_content_bottom(); ?>
</div>

<?php get_footer(); ?>

