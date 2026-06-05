<?php
/**
 * Visual story strip for the homepage.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$story_posts = new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
		'meta_query'          => array(
			array(
				'key'     => '_thumbnail_id',
				'compare' => 'EXISTS',
			),
		),
	)
);

if ( ! $story_posts->have_posts() ) {
	return;
}
?>
<section class="taa-story-strip">
	<div class="ast-container">
		<div class="taa-section-heading taa-section-heading--split">
			<div>
				<p class="taa-section-heading__eyebrow"><?php esc_html_e( 'Inspiration', 'travel-and-adventure' ); ?></p>
				<h2 class="taa-section-heading__title"><?php esc_html_e( 'Reiseerlebnisse, Orte und praktische Tipps', 'travel-and-adventure' ); ?></h2>
			</div>
			<p class="taa-section-heading__text"><?php esc_html_e( 'Eine visuelle Startseite, die dich direkt in Themen, Regionen und aktuelle Geschichten fuehrt.', 'travel-and-adventure' ); ?></p>
		</div>

		<div class="taa-story-strip__grid">
			<?php
			$index = 0;
			while ( $story_posts->have_posts() ) :
				$story_posts->the_post();
				++$index;
				?>
				<a class="taa-story-tile taa-story-tile--<?php echo esc_attr( $index ); ?>" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'large' ); ?>
					<span class="taa-story-tile__overlay"></span>
					<span class="taa-story-tile__content">
						<?php if ( has_category() ) : ?>
							<span class="taa-story-tile__eyebrow"><?php echo esc_html( get_the_category()[0]->name ); ?></span>
						<?php endif; ?>
						<span class="taa-story-tile__title"><?php the_title(); ?></span>
					</span>
				</a>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php
wp_reset_postdata();
