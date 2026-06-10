<?php
/**
 * Homepage categories grid — 4 tiles.
 */
$cats = get_categories( [
	'number'     => 4,
	'hide_empty' => true,
	'orderby'    => 'count',
	'order'      => 'DESC',
] );

if ( empty( $cats ) ) return;
?>
<section class="culinary-container" style="margin-bottom: var(--space-24);">
	<div class="section-head culinary-reveal">
		<div>
			<div class="section-head__eyebrow"><?php esc_html_e( 'Browse by category', 'culinary' ); ?></div>
			<h2 class="section-head__title"><?php esc_html_e( 'What are you cooking?', 'culinary' ); ?></h2>
		</div>
	</div>
	<div class="category-grid">
		<?php foreach ( $cats as $cat ) : ?>
			<?php
			$cat_thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
			$cat_thumb    = $cat_thumb_id ? wp_get_attachment_image_url( $cat_thumb_id, 'medium_large' ) : '';
			// Fallback: first post thumbnail in this category
			if ( ! $cat_thumb ) {
				$q = new WP_Query( [
					'posts_per_page' => 1,
					'cat'            => $cat->term_id,
					'post_status'    => 'publish',
				] );
				if ( $q->have_posts() ) {
					$cat_thumb = get_the_post_thumbnail_url( $q->posts[0]->ID, 'medium_large' );
				}
				wp_reset_postdata();
			}
			?>
			<a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="category-tile culinary-reveal">
				<?php if ( $cat_thumb ) : ?>
					<img
						src="<?php echo esc_url( $cat_thumb ); ?>"
						alt="<?php echo esc_attr( $cat->name ); ?>"
						class="category-tile__image"
						loading="lazy"
					>
				<?php else : ?>
					<div class="category-tile__image" style="background: var(--cream-300);"></div>
				<?php endif; ?>
				<div class="category-tile__scrim"></div>
				<div class="category-tile__label">
					<p class="category-tile__name"><?php echo esc_html( $cat->name ); ?></p>
					<div class="category-tile__count">
						<?php
						printf(
							/* translators: %d recipe count */
							esc_html( _n( '%d recipe', '%d recipes', $cat->count, 'culinary' ) ),
							esc_html( $cat->count )
						);
						?>
					</div>
				</div>
			</a>
		<?php endforeach; ?>
	</div>
</section>
