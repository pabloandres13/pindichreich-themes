<?php
/**
 * Homepage template.
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main id="primary" class="site-main" role="main">
	<?php get_template_part( 'template-parts/home/hero' ); ?>
	<?php get_template_part( 'template-parts/home/featured' ); ?>
	<?php get_template_part( 'template-parts/home/categories' ); ?>
	<?php get_template_part( 'template-parts/home/latest' ); ?>
	<?php get_template_part( 'template-parts/home/about-teaser' ); ?>
	<?php get_template_part( 'template-parts/home/newsletter', null, [ 'tone' => 'tint' ] ); ?>
</main>

<?php get_footer(); ?>
