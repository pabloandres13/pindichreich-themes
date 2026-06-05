<?php
/**
 * Archive post grid.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="taa-archive-posts ast-container">
	<?php if ( have_posts() ) : ?>
		<div class="taa-post-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/post/card' );
			endwhile;
			?>
		</div>

		<div class="taa-pagination">
			<?php the_posts_pagination(); ?>
		</div>
	<?php else : ?>
		<div class="taa-empty-state">
			<h2><?php esc_html_e( 'Noch keine Beitraege gefunden', 'travel-and-adventure' ); ?></h2>
			<p><?php esc_html_e( 'Lege den ersten Beitrag an oder pruefe die Sucheingabe.', 'travel-and-adventure' ); ?></p>
		</div>
	<?php endif; ?>
</section>

