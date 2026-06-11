<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="bm-main" class="bm-main">
	<div class="bm-container bm-section">

		<div class="bm-section-head bm-section-head--center" style="margin-bottom:var(--space-12)">
			<?php the_archive_title( '<h1 class="bm-section-title">', '</h1>' ); ?>
			<?php the_archive_description( '<p class="bm-section-head__text">', '</p>' ); ?>
		</div>

		<?php if ( have_posts() ) : ?>

			<div class="bm-magazine-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					$cat = get_the_category();
					?>
					<article class="bm-article-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="bm-article-card__image">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'medium', [ 'loading' => 'lazy', 'decoding' => 'async' ] ); ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="bm-article-card__body">
							<?php if ( $cat ) : ?>
								<div class="bm-article-card__cat"><?php echo esc_html( $cat[0]->name ); ?></div>
							<?php endif; ?>
							<h2 class="bm-article-card__title">
								<a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none">
									<?php the_title(); ?>
								</a>
							</h2>
							<div class="bm-article-card__excerpt"><?php the_excerpt(); ?></div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<div class="bm-pagination" style="margin-top:var(--space-12);text-align:center">
				<?php
				the_posts_pagination( [
					'mid_size'  => 2,
					'prev_text' => bm_icon( 'arrow-left', 18 ) . ' ' . esc_html__( 'Zurück', 'body-and-mind' ),
					'next_text' => esc_html__( 'Weiter', 'body-and-mind' ) . ' ' . bm_icon( 'arrow-right', 18 ),
				] );
				?>
			</div>

		<?php else : ?>

			<div style="text-align:center;padding:var(--space-16) 0">
				<p><?php esc_html_e( 'Hier gibt es noch keine Beiträge.', 'body-and-mind' ); ?></p>
			</div>

		<?php endif; ?>

	</div>
</main>

<?php get_footer(); ?>
