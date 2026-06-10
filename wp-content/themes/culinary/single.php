<?php
/**
 * Single recipe post template.
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main id="primary" class="site-main" role="main">
<?php while ( have_posts() ) : the_post(); ?>

	<?php
	$post_id     = get_the_ID();
	$title       = get_the_title();
	$thumb_url   = get_the_post_thumbnail_url( $post_id, 'full' );
	$category    = get_the_category();
	$cat_name    = $category ? $category[0]->name : '';
	$cat_url     = $category ? get_category_link( $category[0] ) : '';
	$recipe_time = culinary_get_recipe_time( $post_id );
	$rating      = (float) get_post_meta( $post_id, '_recipe_rating', true );
	$review_cnt  = (int)  get_post_meta( $post_id, '_recipe_reviews', true );
	$servings    = get_post_meta( $post_id, '_recipe_servings', true );
	$prep_time   = get_post_meta( $post_id, '_recipe_prep_time', true );
	$cook_time   = get_post_meta( $post_id, '_recipe_cook_time', true );
	$author_name = get_the_author_meta( 'display_name' );
	$author_url  = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$author_avatar = get_avatar_url( get_the_author_meta( 'ID' ), [ 'size' => 64 ] );

	// Related posts
	$related_args = [
		'posts_per_page'      => 3,
		'post__not_in'        => [ $post_id ],
		'ignore_sticky_posts' => 1,
		'post_status'         => 'publish',
	];
	if ( $category ) {
		$related_args['category__in'] = [ $category[0]->term_id ];
	}
	$related = new WP_Query( $related_args );
	?>

	<!-- Breadcrumb + title -->
	<header class="single-recipe-header culinary-narrow culinary-reveal">
		<nav class="single-recipe-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'culinary' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'culinary' ); ?></a>
			<?php echo culinary_icon( 'chevron-right', 14 ); ?>
			<?php if ( $cat_name ) : ?>
				<a href="<?php echo esc_url( $cat_url ); ?>"><?php echo esc_html( $cat_name ); ?></a>
			<?php endif; ?>
		</nav>

		<h1 class="single-recipe__title"><?php echo esc_html( $title ); ?></h1>

		<div class="single-recipe__meta">
			<span class="single-recipe__author">
				<img src="<?php echo esc_url( $author_avatar ); ?>" alt="<?php echo esc_attr( $author_name ); ?>" width="32" height="32">
				<a href="<?php echo esc_url( $author_url ); ?>" class="single-recipe__author-name"><?php echo esc_html( $author_name ); ?></a>
			</span>
			<span style="color:var(--text-faint)">·</span>
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			<?php if ( $rating > 0 ) : ?>
				<span style="color:var(--text-faint)">·</span>
				<?php echo culinary_star_rating( $rating, 16, true, $review_cnt ?: null ); ?>
			<?php endif; ?>
		</div>
	</header>

	<!-- Actions -->
	<div class="single-recipe__actions culinary-narrow culinary-reveal">
		<a href="#recipe-card" class="btn btn--primary">
			<?php echo culinary_icon( 'arrow-down', 17 ); ?>
			<?php esc_html_e( 'Jump to recipe', 'culinary' ); ?>
		</a>
		<button class="btn btn--secondary" onclick="window.print()">
			<?php echo culinary_icon( 'printer', 17 ); ?>
			<?php esc_html_e( 'Print', 'culinary' ); ?>
		</button>
	</div>

	<!-- Hero image -->
	<?php if ( $thumb_url ) : ?>
		<div style="max-width:980px;margin:0 auto var(--space-12);padding:0 var(--space-6);">
			<img
				src="<?php echo esc_url( $thumb_url ); ?>"
				alt="<?php echo esc_attr( $title ); ?>"
				class="single-recipe__hero culinary-reveal"
				loading="eager"
			>
		</div>
	<?php endif; ?>

	<!-- Post body (story) -->
	<div class="culinary-narrow culinary-prose culinary-reveal">
		<?php the_content(); ?>
	</div>

	<!-- Recipe card block -->
	<div id="recipe-card" class="culinary-reveal" style="max-width:860px;margin:var(--space-12) auto 0;padding:0 var(--space-6);">
		<div class="recipe-card-block">
			<!-- Card header -->
			<div class="recipe-card-block__header">
				<?php if ( $thumb_url ) : ?>
					<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="recipe-card-block__thumb">
				<?php endif; ?>
				<div>
					<div class="recipe-card-block__label"><?php esc_html_e( 'Recipe', 'culinary' ); ?></div>
					<h2 class="recipe-card-block__title"><?php echo esc_html( $title ); ?></h2>
					<?php if ( $rating > 0 ) : ?>
						<div style="margin-top:var(--space-2);display:flex;align-items:center;gap:var(--space-3);">
							<?php echo culinary_star_rating( $rating, 17, true, $review_cnt ?: null ); ?>
							<button class="btn btn--utility btn--sm" onclick="window.print()">
								<?php echo culinary_icon( 'printer', 15 ); ?>
								<?php esc_html_e( 'Print', 'culinary' ); ?>
							</button>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Meta stats -->
			<div class="recipe-meta-stats">
				<?php if ( $prep_time ) : ?>
					<div class="recipe-meta-stat">
						<span class="recipe-meta-stat__icon"><?php echo culinary_icon( 'timer', 20 ); ?></span>
						<span class="recipe-meta-stat__label"><?php esc_html_e( 'Prep', 'culinary' ); ?></span>
						<span class="recipe-meta-stat__value"><?php echo esc_html( $prep_time ); ?></span>
					</div>
					<div class="recipe-card-block__divider"></div>
				<?php endif; ?>
				<?php if ( $cook_time ) : ?>
					<div class="recipe-meta-stat">
						<span class="recipe-meta-stat__icon"><?php echo culinary_icon( 'flame', 20 ); ?></span>
						<span class="recipe-meta-stat__label"><?php esc_html_e( 'Cook', 'culinary' ); ?></span>
						<span class="recipe-meta-stat__value"><?php echo esc_html( $cook_time ); ?></span>
					</div>
					<div class="recipe-card-block__divider"></div>
				<?php endif; ?>
				<?php if ( $recipe_time ) : ?>
					<div class="recipe-meta-stat">
						<span class="recipe-meta-stat__icon"><?php echo culinary_icon( 'clock', 20 ); ?></span>
						<span class="recipe-meta-stat__label"><?php esc_html_e( 'Total', 'culinary' ); ?></span>
						<span class="recipe-meta-stat__value"><?php echo esc_html( $recipe_time ); ?></span>
					</div>
					<?php if ( $servings ) : ?>
						<div class="recipe-card-block__divider"></div>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ( $servings ) : ?>
					<div class="recipe-meta-stat">
						<span class="recipe-meta-stat__icon"><?php echo culinary_icon( 'users', 20 ); ?></span>
						<span class="recipe-meta-stat__label"><?php esc_html_e( 'Serves', 'culinary' ); ?></span>
						<span class="recipe-meta-stat__value"><?php echo esc_html( $servings ); ?></span>
					</div>
				<?php endif; ?>
			</div>

			<!-- WP Recipe Maker compatibility notice / fallback -->
			<div class="recipe-card-block__body">
				<div class="recipe-ingredients">
					<?php
					$ingredients = get_post_meta( $post_id, '_recipe_ingredients', true );
					if ( $ingredients ) :
						$items = is_array( $ingredients ) ? $ingredients : explode( "\n", $ingredients );
					?>
						<h3><?php esc_html_e( 'Ingredients', 'culinary' ); ?></h3>
						<ul class="recipe-ingredients__list">
							<?php foreach ( $items as $item ) :
								$item = trim( $item );
								if ( ! $item ) continue;
							?>
								<li class="recipe-ingredients__item">
									<span class="ingredient-check" style="flex:none;width:22px;height:22px;margin-top:2px;border-radius:var(--radius-sm);border:1.5px solid var(--border-strong);display:inline-flex;align-items:center;justify-content:center;transition:background var(--dur-fast),border-color var(--dur-fast);">
										<span class="ingredient-check__tick" style="display:none;color:#fff;"><?php echo culinary_icon( 'check', 14 ); ?></span>
									</span>
									<span><?php echo esc_html( $item ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php else : ?>
						<h3><?php esc_html_e( 'Ingredients', 'culinary' ); ?></h3>
						<p style="color:var(--text-muted);font-family:var(--font-body);">
							<?php esc_html_e( 'Add ingredients via the recipe meta fields or WP Recipe Maker.', 'culinary' ); ?>
						</p>
					<?php endif; ?>
				</div>

				<div class="recipe-method">
					<?php
					$method = get_post_meta( $post_id, '_recipe_method', true );
					if ( $method ) :
						$steps = is_array( $method ) ? $method : explode( "\n", $method );
						$steps = array_values( array_filter( array_map( 'trim', $steps ) ) );
					?>
						<h3><?php esc_html_e( 'Method', 'culinary' ); ?></h3>
						<ol class="recipe-method__list">
							<?php foreach ( $steps as $i => $step ) : ?>
								<li class="recipe-method__item">
									<span class="recipe-method__step-num"><?php echo esc_html( $i + 1 ); ?></span>
									<span class="recipe-method__step-text"><?php echo esc_html( $step ); ?></span>
								</li>
							<?php endforeach; ?>
						</ol>
					<?php else : ?>
						<h3><?php esc_html_e( 'Method', 'culinary' ); ?></h3>
						<p style="color:var(--text-muted);font-family:var(--font-body);">
							<?php esc_html_e( 'Add method steps via the recipe meta fields or WP Recipe Maker.', 'culinary' ); ?>
						</p>
					<?php endif; ?>
				</div>
			</div>

		</div><!-- .recipe-card-block -->
	</div>

	<!-- Related recipes -->
	<?php if ( $related->have_posts() ) : ?>
		<section style="max-width:var(--container-max);margin:var(--space-24) auto 0;padding:0 var(--space-6);" class="culinary-reveal">
			<h2 style="font-family:var(--font-display);font-size:var(--text-3xl);font-weight:700;color:var(--text-heading);margin:0 0 var(--space-8);text-align:center;letter-spacing:-0.01em;">
				<?php esc_html_e( 'You might also like', 'culinary' ); ?>
			</h2>
			<div class="recipe-grid">
				<?php while ( $related->have_posts() ) : $related->the_post(); ?>
					<?php get_template_part( 'template-parts/content/recipe-card' ); ?>
				<?php endwhile; ?>
			</div>
		</section>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

	<!-- Comments -->
	<div class="culinary-narrow" style="margin-top:var(--space-24);">
		<?php comments_template(); ?>
	</div>

	<!-- Newsletter -->
	<?php get_template_part( 'template-parts/home/newsletter', null, [ 'tone' => 'dark' ] ); ?>

<?php endwhile; ?>
</main>

<?php get_footer(); ?>
