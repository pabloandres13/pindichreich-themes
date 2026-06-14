<?php
/**
 * Single journal entry.
 *
 * @package celestine
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="cel-main" class="cel-main">
	<?php while ( have_posts() ) : the_post(); ?>

		<div class="cel-page-hero">
			<div class="cel-container--text">
				<?php $cats = get_the_category(); ?>
				<?php if ( $cats ) : ?>
					<p class="cel-label cel-label--center"><?php echo esc_html( $cats[0]->name ); ?></p>
				<?php endif; ?>
				<h1 class="cel-page-hero__title"><?php the_title(); ?></h1>
				<div class="cel-page-hero__meta">
					<span><?php the_author(); ?></span>
					<span class="cel-glyph" aria-hidden="true">&#10022;</span>
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
				</div>
			</div>
		</div>

		<div class="cel-section cel-section--tight">
			<div class="cel-container--text">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="cel-cover">
						<?php the_post_thumbnail( 'large', [ 'loading' => 'eager' ] ); ?>
					</div>
				<?php endif; ?>

				<div class="cel-prose entry-content">
					<?php
					the_content();
					wp_link_pages( [
						'before' => '<div class="cel-page-links">' . esc_html__( 'Pages:', 'celestine' ),
						'after'  => '</div>',
					] );
					?>
				</div>

				<nav class="cel-single-nav" style="display:flex;justify-content:space-between;gap:var(--space-8);margin-top:var(--space-16);padding-top:var(--space-8);border-top:1px solid var(--line-moon)" aria-label="<?php esc_attr_e( 'Entry navigation', 'celestine' ); ?>">
					<?php
					$prev = get_previous_post();
					$next = get_next_post();
					echo $prev
						? '<a class="cel-btn cel-btn--ghost cel-btn--sm" href="' . esc_url( get_permalink( $prev ) ) . '">' . cel_icon( 'arrow-left', 16 ) . esc_html__( 'Previous', 'celestine' ) . '</a>'
						: '<span></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo $next
						? '<a class="cel-btn cel-btn--ghost cel-btn--sm" href="' . esc_url( get_permalink( $next ) ) . '">' . esc_html__( 'Next', 'celestine' ) . cel_icon( 'arrow-right', 16 ) . '</a>'
						: '<span></span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
				</nav>
			</div>
		</div>

	<?php endwhile; ?>
</main>

<?php
get_footer();
