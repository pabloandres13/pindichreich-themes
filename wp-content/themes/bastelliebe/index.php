<?php
/**
 * Fallback index template (blog listing).
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="bl-page bl-section--cream">
	<div class="bl-container">
		<header class="bl-archive__header">
			<h1 class="bl-archive__title"><?php is_home() && ! is_front_page() ? single_post_title() : esc_html_e( 'Anleitungen', 'bastelliebe' ); ?></h1>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="bl-project-grid">
				<?php
				$bl_cats = bl_categories();
				while ( have_posts() ) :
					the_post();
					$bl_cat = 'papier';
					foreach ( get_the_category() as $bl_c ) {
						if ( isset( $bl_cats[ $bl_c->slug ] ) ) {
							$bl_cat = $bl_c->slug;
							break;
						}
					}
					echo bl_project_card( [ // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'title'    => get_the_title(),
						'category' => $bl_cat,
						'image'    => get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: '',
						'href'     => get_permalink(),
					] );
				endwhile;
				?>
			</div>

			<div class="bl-pagination">
				<?php
				echo paginate_links( [ // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'prev_text' => __( 'Zurück', 'bastelliebe' ),
					'next_text' => __( 'Weiter', 'bastelliebe' ),
				] );
				?>
			</div>
		<?php else : ?>
			<p><?php esc_html_e( 'Noch keine Beiträge vorhanden.', 'bastelliebe' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
