<?php
/**
 * Homepage hero — latest sticky/featured post or most recent post.
 * Expects $args['post'] (WP_Post) or falls back to the most recent post.
 */
$hero = isset( $args['post'] ) ? $args['post'] : null;
if ( ! $hero ) {
	$q = new WP_Query( [ 'posts_per_page' => 1, 'post_status' => 'publish' ] );
	if ( $q->have_posts() ) {
		$hero = $q->posts[0];
	}
}
if ( ! $hero ) return;

$url         = get_permalink( $hero );
$title       = get_the_title( $hero );
$excerpt     = get_the_excerpt( $hero );
$category    = get_the_category( $hero->ID );
$cat_name    = $category ? $category[0]->name : '';
$thumb_url   = get_the_post_thumbnail_url( $hero->ID, 'full' );
$recipe_time = culinary_get_recipe_time( $hero->ID );
$rating      = (float) get_post_meta( $hero->ID, '_recipe_rating', true );
$reviews     = (int) get_post_meta( $hero->ID, '_recipe_reviews', true );
?>
<section class="hero-section culinary-container culinary-reveal">
	<div class="hero-block">
		<?php if ( $thumb_url ) : ?>
			<img
				src="<?php echo esc_url( $thumb_url ); ?>"
				alt="<?php echo esc_attr( $title ); ?>"
				class="hero-block__image"
				loading="eager"
			>
		<?php else : ?>
			<div class="hero-block__image" style="background: var(--cream-300);"></div>
		<?php endif; ?>

		<div class="hero-block__scrim"></div>

		<div class="hero-block__content">
			<div class="hero-block__badges">
				<?php if ( $cat_name ) : ?>
					<span class="culinary-badge culinary-badge--solid"><?php echo esc_html( $cat_name ); ?></span>
				<?php endif; ?>
				<?php if ( $recipe_time ) : ?>
					<span class="culinary-badge culinary-badge--dark"><?php echo esc_html( $recipe_time ); ?></span>
				<?php endif; ?>
			</div>

			<h1 class="hero-block__title"><?php echo esc_html( $title ); ?></h1>

			<?php if ( $excerpt ) : ?>
				<p class="hero-block__description"><?php echo esc_html( wp_trim_words( $excerpt, 24 ) ); ?></p>
			<?php endif; ?>

			<div class="hero-block__actions">
				<a href="<?php echo esc_url( $url ); ?>" class="btn btn--primary btn--lg">
					<?php echo culinary_icon( 'arrow-right', 18 ); ?>
					<?php esc_html_e( 'View recipe', 'culinary' ); ?>
				</a>
				<?php if ( $rating > 0 ) : ?>
					<span class="hero-block__rating">
						<?php echo culinary_star_rating( $rating, 18 ); ?>
						<span>
							<?php
							echo esc_html( number_format( $rating, 1 ) );
							if ( $reviews > 0 ) {
								/* translators: %d review count */
								echo ' &middot; ' . esc_html( sprintf( _n( '%d review', '%d reviews', $reviews, 'culinary' ), $reviews ) );
							}
							?>
						</span>
					</span>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
