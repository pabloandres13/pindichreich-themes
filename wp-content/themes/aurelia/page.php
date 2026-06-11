<?php
defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<section class="au-page-hero">
		<div class="au-container">
			<div class="au-page-hero__inner">
				<h1><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="au-page-hero__intro"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="au-section au-section--white" style="padding-top:var(--space-8)">
		<div class="au-container au-container--narrow">
			<div class="au-page-content entry-content">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
<?php endwhile; ?>

<?php get_footer(); ?>
