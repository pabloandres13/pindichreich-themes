<?php
/**
 * Homepage latest recipes grid — 6 cards.
 */
$latest = new WP_Query( [
	'posts_per_page' => 6,
	'post_status'    => 'publish',
	'offset'         => 1,
] );

if ( ! $latest->have_posts() ) return;
?>
<section class="culinary-container" style="margin-bottom: var(--space-24);">
	<div class="section-head culinary-reveal">
		<div>
			<div class="section-head__eyebrow"><?php esc_html_e( 'Fresh from the kitchen', 'culinary' ); ?></div>
			<h2 class="section-head__title"><?php esc_html_e( 'Latest recipes', 'culinary' ); ?></h2>
		</div>
		<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="section-head__action">
			<?php esc_html_e( 'See more', 'culinary' ); ?>
			<?php echo culinary_icon( 'arrow-right', 17 ); ?>
		</a>
	</div>
	<div class="recipe-grid">
		<?php while ( $latest->have_posts() ) : $latest->the_post(); ?>
			<?php get_template_part( 'template-parts/content/recipe-card' ); ?>
		<?php endwhile; ?>
	</div>
</section>
<?php wp_reset_postdata(); ?>
