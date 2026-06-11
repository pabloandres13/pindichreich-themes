<?php
defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$aurelia_cats = get_the_category();
	$aurelia_cat  = $aurelia_cats ? $aurelia_cats[0] : null;
	$readtime     = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_post_field( 'post_content' ) ) ) / 200 ) );
	$author_name  = get_the_author();
	$initials     = strtoupper( mb_substr( $author_name, 0, 1 ) . mb_substr( strrchr( $author_name, ' ' ) ?: ' ', 1, 1 ) );
	?>

	<article <?php post_class(); ?>>
		<section class="au-section au-section--white" style="padding-bottom:var(--space-6)">
			<div class="au-container au-container--narrow">
				<a class="au-article__back" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/magazin/' ) ); ?>">
					<?php echo aurelia_icon( 'arrow-left', 16 ); // phpcs:ignore ?>
					<?php esc_html_e( 'Zurück zum Magazin', 'aurelia' ); ?>
				</a>

				<?php if ( $aurelia_cat ) : ?>
					<div><span class="au-badge au-badge--blue"><?php echo esc_html( $aurelia_cat->name ); ?></span></div>
				<?php endif; ?>

				<h1 class="au-article__title"><?php the_title(); ?></h1>

				<div class="au-article__meta">
					<span class="au-avatar"><?php echo esc_html( $initials ); ?></span>
					<span><?php echo esc_html( $author_name ); ?></span>
					<span>·</span>
					<span>
						<?php
						/* translators: %d: reading time in minutes */
						printf( esc_html__( '%d Min. Lesezeit', 'aurelia' ), (int) $readtime );
						?>
					</span>
					<span>·</span>
					<span><?php echo esc_html( get_the_date( 'j. F Y' ) ); ?></span>
				</div>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="au-article__hero-image">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</section>

		<section class="au-section au-section--white" style="padding-top:var(--space-6)">
			<div class="au-container au-container--narrow">
				<div class="au-article__content entry-content">
					<?php the_content(); ?>
				</div>

				<?php $aurelia_tags = get_the_tags(); ?>
				<?php if ( $aurelia_tags ) : ?>
					<div class="au-article__tags">
						<?php foreach ( $aurelia_tags as $aurelia_tag ) : ?>
							<a class="au-tag" href="<?php echo esc_url( get_tag_link( $aurelia_tag ) ); ?>"><?php echo esc_html( $aurelia_tag->name ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
	</article>

	<?php
	// Related posts — same category, most recent.
	$related = new WP_Query( [
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post__not_in'   => [ get_the_ID() ],
		'category__in'   => $aurelia_cat ? [ $aurelia_cat->term_id ] : [],
	] );
	if ( $related->have_posts() ) :
		?>
		<section class="au-section au-section--cream">
			<div class="au-container">
				<div class="au-section-head au-section-head--center">
					<?php aurelia_label( __( 'Weiterlesen', 'aurelia' ) ); ?>
					<h2><?php esc_html_e( 'Das könnte Sie auch interessieren', 'aurelia' ); ?></h2>
				</div>
				<div class="au-grid au-grid--wide">
					<?php
					while ( $related->have_posts() ) :
						$related->the_post();
						aurelia_article_card( get_the_ID() );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
