<?php
/**
 * Fallback template — blog index / archive / search.
 *
 * @package maren-cole
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="mc-page">
	<div class="mc-container">
		<header class="mc-page__header">
			<?php if ( is_search() ) : ?>
				<p class="mc-eyebrow"><?php esc_html_e( 'Search', 'maren-cole' ); ?></p>
				<h1 class="mc-page__title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Results for “%s”', 'maren-cole' ), '<em>' . esc_html( get_search_query() ) . '</em>' );
					?>
				</h1>
			<?php elseif ( is_home() && ! is_front_page() ) : ?>
				<p class="mc-eyebrow"><?php esc_html_e( 'Resources', 'maren-cole' ); ?></p>
				<h1 class="mc-page__title"><?php single_post_title(); ?></h1>
			<?php else : ?>
				<p class="mc-eyebrow"><?php esc_html_e( 'Resources', 'maren-cole' ); ?></p>
				<h1 class="mc-page__title"><?php the_archive_title(); ?></h1>
				<?php the_archive_description( '<p class="mc-section-head__text">', '</p>' ); ?>
			<?php endif; ?>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="mc-archive-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					$mc_cats = get_the_category();
					?>
					<article <?php post_class( 'mc-article' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a class="mc-article__image" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
								<?php the_post_thumbnail( 'medium_large' ); ?>
							</a>
						<?php endif; ?>
						<div class="mc-article__body">
							<?php if ( $mc_cats ) : ?>
								<div><span class="mc-badge"><?php echo esc_html( $mc_cats[0]->name ); ?></span></div>
							<?php endif; ?>
							<h2 class="mc-article__title"><a href="<?php the_permalink(); ?>" style="color:inherit"><?php the_title(); ?></a></h2>
							<div class="mc-article__meta"><?php echo esc_html( get_the_date() ); ?></div>
						</div>
					</article>
					<?php
				endwhile;
				?>
			</div>

			<div style="margin-top:var(--space-8)">
				<?php the_posts_pagination( [ 'mid_size' => 1, 'prev_text' => __( 'Previous', 'maren-cole' ), 'next_text' => __( 'Next', 'maren-cole' ) ] ); ?>
			</div>
		<?php else : ?>
			<p class="mc-prose"><?php esc_html_e( 'Nothing here yet — check back soon.', 'maren-cole' ); ?></p>
		<?php endif; ?>
	</div>
</div>
<?php
get_footer();
