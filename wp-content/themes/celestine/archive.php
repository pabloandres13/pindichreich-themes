<?php
/**
 * Archive (categories, tags, dates).
 *
 * @package celestine
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="cel-main" class="cel-main">
	<div class="cel-page-hero">
		<div class="cel-container--text">
			<p class="cel-label cel-label--center"><?php esc_html_e( 'From the Journal', 'celestine' ); ?></p>
			<?php the_archive_title( '<h1 class="cel-page-hero__title">', '</h1>' ); ?>
			<?php the_archive_description( '<p class="cel-section-head__lede" style="margin-top:var(--space-4)">', '</p>' ); ?>
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
				<p class="cel-section-head__lede" style="text-align:center"><?php esc_html_e( 'No entries here yet.', 'celestine' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</main>

<?php
get_footer();
