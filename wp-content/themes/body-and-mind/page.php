<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="bm-main" class="bm-main">
	<?php while ( have_posts() ) : the_post(); ?>

		<div class="bm-page-hero bm-section--cream">
			<div class="bm-container bm-container--narrow" style="padding-top:var(--space-16);padding-bottom:var(--space-10)">
				<h1 class="bm-section-title" style="text-align:center"><?php the_title(); ?></h1>
			</div>
		</div>

		<div class="bm-section">
			<div class="bm-container bm-container--narrow">
				<div class="bm-page-content entry-content">
					<?php the_content(); ?>
				</div>
				<?php
				wp_link_pages( [
					'before' => '<div class="bm-page-links">' . esc_html__( 'Seiten:', 'body-and-mind' ),
					'after'  => '</div>',
				] );
				?>
			</div>
		</div>

	<?php endwhile; ?>
</main>

<?php get_footer(); ?>
