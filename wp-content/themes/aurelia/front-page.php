<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php get_template_part( 'template-parts/home/hero' ); ?>
<?php get_template_part( 'template-parts/home/services' ); ?>
<?php get_template_part( 'template-parts/home/about-teaser' ); ?>
<?php get_template_part( 'template-parts/home/approach' ); ?>
<?php get_template_part( 'template-parts/home/testimonials' ); ?>
<?php get_template_part( 'template-parts/home/magazine-teaser' ); ?>
<section class="au-section au-section--cream">
	<div class="au-container">
		<?php get_template_part( 'template-parts/home/newsletter', null, [ 'tone' => 'green' ] ); ?>
	</div>
</section>

<?php get_footer(); ?>
