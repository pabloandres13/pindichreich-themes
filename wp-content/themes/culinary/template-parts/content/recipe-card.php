<?php
/**
 * Recipe card — used in grids on homepage, archive, related.
 * Uses the current post in The Loop.
 */
$url         = get_permalink();
$title       = get_the_title();
$category    = get_the_category();
$cat_name    = $category ? $category[0]->name : '';
$cat_url     = $category ? get_category_link( $category[0] ) : '';
$recipe_time = culinary_get_recipe_time( get_the_ID() );
$difficulty  = get_post_meta( get_the_ID(), '_recipe_difficulty', true );
$rating      = (float) get_post_meta( get_the_ID(), '_recipe_rating', true );
$thumb_url   = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
?>
<article class="recipe-card culinary-reveal" id="post-<?php the_ID(); ?>">
	<a href="<?php echo esc_url( $url ); ?>" class="recipe-card__image-wrap" tabindex="-1" aria-hidden="true">
		<?php if ( $thumb_url ) : ?>
			<img
				src="<?php echo esc_url( $thumb_url ); ?>"
				alt="<?php echo esc_attr( $title ); ?>"
				loading="lazy"
			>
		<?php else : ?>
			<div style="width:100%;height:100%;background:var(--cream-200);display:flex;align-items:center;justify-content:center;">
				<?php echo culinary_icon( 'image', 32 ); ?>
			</div>
		<?php endif; ?>
		<?php if ( $cat_name ) : ?>
			<div class="recipe-card__category">
				<span class="culinary-tag culinary-tag--accent culinary-tag--sm"><?php echo esc_html( $cat_name ); ?></span>
			</div>
		<?php endif; ?>
	</a>

	<div class="recipe-card__body">
		<h3 class="recipe-card__title">
			<a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $title ); ?></a>
		</h3>

		<div class="recipe-card__meta">
			<?php if ( $recipe_time ) : ?>
				<span class="recipe-card__meta-item">
					<?php echo culinary_icon( 'clock', 15 ); ?>
					<?php echo esc_html( $recipe_time ); ?>
				</span>
			<?php endif; ?>
			<?php if ( $difficulty ) : ?>
				<span class="recipe-card__meta-item">
					<?php echo culinary_icon( 'gauge', 15 ); ?>
					<?php echo esc_html( $difficulty ); ?>
				</span>
			<?php endif; ?>
		</div>

		<?php if ( $rating > 0 ) : ?>
			<div class="recipe-card__rating">
				<?php echo culinary_star_rating( $rating, 15, true ); ?>
			</div>
		<?php endif; ?>
	</div>
</article>
