<?php
/**
 * Editorial post card.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article <?php post_class( 'taa-post-card' ); ?>>
	<a class="taa-post-card__image" href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large' ); ?>
		<?php endif; ?>
	</a>
	<div class="taa-post-card__body">
		<?php $has_category = has_category(); ?>
		<div class="taa-post-card__meta-row">
			<?php if ( $has_category ) : ?>
				<?php taa_the_primary_category(); ?>
				<span class="taa-post-card__meta-separator">/</span>
			<?php endif; ?>
			<span class="taa-post-card__meta"><?php echo esc_html( taa_get_reading_time_label() ); ?></span>
		</div>
		<h2 class="taa-post-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<div class="taa-post-card__excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>
