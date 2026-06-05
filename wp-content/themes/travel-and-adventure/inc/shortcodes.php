<?php
/**
 * Shortcodes for editor-managed homepage sections.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renders a compact latest posts grid.
 *
 * Usage: [taa_latest_posts limit="6"]
 *
 * @param array<string, string> $atts Shortcode attributes.
 * @return string
 */
function taa_shortcode_latest_posts( $atts ) {
	$atts = shortcode_atts(
		array(
			'limit' => '6',
		),
		$atts,
		'taa_latest_posts'
	);

	$query = new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => max( 1, (int) $atts['limit'] ),
			'ignore_sticky_posts' => true,
		)
	);

	if ( ! $query->have_posts() ) {
		return '';
	}

	ob_start();
	?>
	<div class="taa-shortcode-post-list">
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<article class="taa-shortcode-post-list__item">
				<?php if ( has_post_thumbnail() ) : ?>
					<a class="taa-shortcode-post-list__image" href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'thumbnail' ); ?>
					</a>
				<?php endif; ?>
				<div class="taa-shortcode-post-list__body">
					<p class="taa-shortcode-post-list__meta"><?php echo esc_html( get_the_date() ); ?></p>
					<h3 class="taa-shortcode-post-list__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
	<?php
	wp_reset_postdata();

	return ob_get_clean();
}
add_shortcode( 'taa_latest_posts', 'taa_shortcode_latest_posts' );

/**
 * Renders a horizontal post carousel strip.
 *
 * Usage: [taa_post_carousel limit="10"]
 *
 * @param array<string, string> $atts Shortcode attributes.
 * @return string
 */
function taa_shortcode_post_carousel( $atts ) {
	$atts = shortcode_atts(
		array(
			'limit' => '10',
		),
		$atts,
		'taa_post_carousel'
	);

	$query = new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => max( 1, (int) $atts['limit'] ),
			'ignore_sticky_posts' => true,
		)
	);

	if ( ! $query->have_posts() ) {
		return '';
	}

	ob_start();
	?>
	<div class="taa-post-carousel" tabindex="0">
		<div class="taa-post-carousel__track">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<article class="taa-post-carousel__card">
					<a class="taa-post-carousel__image" href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'medium_large' ); ?>
						<?php endif; ?>
					</a>
					<div class="taa-post-carousel__body">
						<?php if ( has_category() ) : ?>
							<p class="taa-post-carousel__meta"><?php echo esc_html( get_the_category()[0]->name ); ?></p>
						<?php endif; ?>
						<h3 class="taa-post-carousel__title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
	</div>
	<?php
	wp_reset_postdata();

	return ob_get_clean();
}
add_shortcode( 'taa_post_carousel', 'taa_shortcode_post_carousel' );
