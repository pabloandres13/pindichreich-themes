<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="bm-main" class="bm-main">
	<?php while ( have_posts() ) : the_post(); ?>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="bm-single-hero" style="background:#1a1a1a;overflow:hidden;max-height:480px">
				<?php the_post_thumbnail( 'full', [ 'style' => 'width:100%;height:480px;object-fit:cover;opacity:0.85', 'loading' => 'eager' ] ); ?>
			</div>
		<?php endif; ?>

		<div class="bm-section">
			<div class="bm-container bm-container--narrow">

				<header class="bm-single-header" style="margin-bottom:var(--space-10)">
					<?php $cats = get_the_category(); ?>
					<?php if ( $cats ) : ?>
						<div class="bm-article-card__cat" style="margin-bottom:var(--space-4)"><?php echo esc_html( $cats[0]->name ); ?></div>
					<?php endif; ?>
					<h1 style="font-family:var(--font-serif);font-size:clamp(1.75rem,4vw,3rem);line-height:1.2;margin-bottom:var(--space-6)"><?php the_title(); ?></h1>
					<div style="display:flex;align-items:center;gap:var(--space-4);color:var(--ink-muted);font-size:0.875rem">
						<span><?php the_author(); ?></span>
						<span aria-hidden="true">·</span>
						<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					</div>
				</header>

				<div class="bm-single-content entry-content">
					<?php the_content(); ?>
				</div>

				<?php
				wp_link_pages( [
					'before' => '<div class="bm-page-links">' . esc_html__( 'Seiten:', 'body-and-mind' ),
					'after'  => '</div>',
				] );
				?>

				<div class="bm-single-nav" style="display:flex;justify-content:space-between;gap:var(--space-8);margin-top:var(--space-14);padding-top:var(--space-8);border-top:1px solid var(--border-subtle)">
					<?php
					$prev = get_previous_post();
					$next = get_next_post();
					if ( $prev ) {
						echo '<a href="' . esc_url( get_permalink( $prev ) ) . '" class="bm-btn bm-btn--ghost bm-btn--sm">' .
							bm_icon( 'arrow-left', 16 ) . esc_html__( 'Vorheriger Beitrag', 'body-and-mind' ) . '</a>';
					} else {
						echo '<span></span>';
					}
					if ( $next ) {
						echo '<a href="' . esc_url( get_permalink( $next ) ) . '" class="bm-btn bm-btn--ghost bm-btn--sm">' .
							esc_html__( 'Nächster Beitrag', 'body-and-mind' ) . bm_icon( 'arrow-right', 16 ) . '</a>';
					}
					?>
				</div>

			</div>
		</div>

	<?php endwhile; ?>
</main>

<?php get_footer(); ?>
