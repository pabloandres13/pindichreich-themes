<?php
/**
 * Fallback / blog index (the Journal).
 *
 * @package celestine
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="cel-main" class="cel-main">
	<div class="cel-page-hero">
		<div class="cel-container--text">
			<?php
			if ( is_search() ) {
				printf(
					'<p class="cel-label cel-label--center">%s</p><h1 class="cel-page-hero__title">%s</h1>',
					esc_html__( 'Search', 'celestine' ),
					sprintf( /* translators: %s: search query */ esc_html__( 'Results for “%s”', 'celestine' ), '<em>' . esc_html( get_search_query() ) . '</em>' )
				);
			} else {
				echo '<p class="cel-label cel-label--center">' . esc_html__( 'From the Journal', 'celestine' ) . '</p>';
				echo '<h1 class="cel-page-hero__title">' . esc_html__( 'Notes from the practice', 'celestine' ) . '</h1>';
			}
			?>
		</div>
	</div>

	<div class="cel-section cel-section--tight">
		<div class="cel-container">
			<?php if ( have_posts() ) : ?>
				<div class="cel-article-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						cel_render_post_card();
					endwhile;
					?>
				</div>

				<div class="cel-pagination">
					<?php
					echo paginate_links( [ // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'mid_size'  => 2,
						'prev_text' => cel_icon( 'arrow-left', 16 ),
						'next_text' => cel_icon( 'arrow-right', 16 ),
					] );
					?>
				</div>
			<?php else : ?>
				<div style="text-align:center;padding:var(--space-16) 0">
					<h2 class="cel-section-head__title"><?php esc_html_e( 'Nothing here yet', 'celestine' ); ?></h2>
					<p class="cel-section-head__lede"><?php esc_html_e( 'No entries have been written so far. Return soon.', 'celestine' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</main>

<?php
get_footer();
