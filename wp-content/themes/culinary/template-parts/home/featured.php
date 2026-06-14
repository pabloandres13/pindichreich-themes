<?php
/**
 * Homepage featured recipes strip — 3 cards.
 */
$featured = new WP_Query( [
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'meta_query'     => [
		[
			'key'     => '_featured_recipe',
			'value'   => '1',
			'compare' => '=',
		],
	],
] );

if ( ! $featured->have_posts() ) {
	$featured = new WP_Query( [
		'posts_per_page' => 3,
		'post_status'    => 'publish',
		'offset'         => 1,
	] );
}

if ( ! $featured->have_posts() ) return;
?>
<section class="culinary-container culinary-home-section">
	<div class="section-head culinary-reveal">
		<div>
			<div class="section-head__eyebrow"><?php esc_html_e( 'Reader favourites', 'culinary' ); ?></div>
			<h2 class="section-head__title"><?php esc_html_e( 'Popular this season', 'culinary' ); ?></h2>
		</div>
		<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="section-head__action">
			<?php esc_html_e( 'All recipes', 'culinary' ); ?>
			<?php echo culinary_icon( 'arrow-right', 17 ); ?>
		</a>
	</div>
	<div class="recipe-grid">
		<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>
			<?php get_template_part( 'template-parts/content/recipe-card' ); ?>
		<?php endwhile; ?>
	</div>
</section>
<?php wp_reset_postdata(); ?>
