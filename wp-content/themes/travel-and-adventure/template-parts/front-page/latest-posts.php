<?php
/**
 * Latest posts section for the front page.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$latest_posts = taa_get_front_page_posts();

if ( ! $latest_posts->have_posts() ) {
	return;
}
?>
<section class="taa-latest-posts">
	<div class="ast-container">
		<div class="taa-section-heading">
			<p class="taa-section-heading__eyebrow"><?php esc_html_e( 'Blog', 'travel-and-adventure' ); ?></p>
			<h2 class="taa-section-heading__title"><?php esc_html_e( 'Neueste Beitraege', 'travel-and-adventure' ); ?></h2>
		</div>

		<div class="taa-post-grid">
			<?php
			while ( $latest_posts->have_posts() ) :
				$latest_posts->the_post();
				get_template_part( 'template-parts/post/card' );
			endwhile;
			?>
		</div>
	</div>
</section>
<?php
wp_reset_postdata();
