<?php
/**
 * Single post hero.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="taa-single-hero">
	<div class="ast-container taa-single-hero__inner">
		<div class="taa-single-hero__copy">
			<?php taa_the_primary_category(); ?>
			<h1 class="taa-single-hero__title"><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<div class="taa-single-hero__lead"><?php the_excerpt(); ?></div>
			<?php endif; ?>
			<div class="taa-single-hero__meta">
				<span><?php echo esc_html( get_the_date() ); ?></span>
				<span><?php the_author(); ?></span>
				<span><?php echo esc_html( taa_get_reading_time_label() ); ?></span>
			</div>
		</div>
	</div>
</section>

