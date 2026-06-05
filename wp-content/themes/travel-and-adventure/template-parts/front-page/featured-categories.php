<?php
/**
 * Featured categories for the homepage.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$categories = taa_get_featured_categories();

if ( empty( $categories ) ) {
	return;
}
?>
<section class="taa-featured-categories">
	<div class="ast-container">
		<div class="taa-section-heading">
			<p class="taa-section-heading__eyebrow"><?php esc_html_e( 'Orientierung', 'travel-and-adventure' ); ?></p>
			<h2 class="taa-section-heading__title"><?php esc_html_e( 'Starte mit den wichtigsten Themen', 'travel-and-adventure' ); ?></h2>
		</div>

		<div class="taa-featured-grid">
			<?php foreach ( $categories as $category ) : ?>
				<?php
				$category_link = get_category_link( $category->term_id );
				$description   = $category->description;
				$image_url     = taa_get_category_image_url( $category->term_id );
				$style         = '';

				if ( empty( $description ) ) {
					$description = __( 'Tipps, Inspiration und praktische Reiseinfos.', 'travel-and-adventure' );
				}

				if ( $image_url ) {
					$style = sprintf(
						' style="background-image:linear-gradient(180deg, rgba(15, 53, 87, 0.12), rgba(15, 53, 87, 0.82)), url(%s);"',
						esc_url( $image_url )
					);
				}
				?>
				<a class="taa-featured-card" href="<?php echo esc_url( $category_link ); ?>"<?php echo wp_kses_post( $style ); ?>>
					<span class="taa-featured-card__label"><?php echo esc_html( $category->name ); ?></span>
					<span class="taa-featured-card__count"><?php echo esc_html( absint( $category->count ) . ' ' . __( 'Beitraege', 'travel-and-adventure' ) ); ?></span>
					<span class="taa-featured-card__copy"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $description ), 16 ) ); ?></span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
