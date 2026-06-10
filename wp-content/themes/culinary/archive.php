<?php
/**
 * Recipe archive / category page.
 */
defined( 'ABSPATH' ) || exit;
get_header();

$is_category = is_category();
$cat         = $is_category ? get_queried_object() : null;
$page_title  = $is_category ? $cat->name : __( 'Every recipe', 'culinary' );
$page_desc   = $is_category
	? ( $cat->description ?: __( 'Browse all recipes in this category.', 'culinary' ) )
	: __( 'Reliable, seasonal cooking — sorted so you can find dinner fast.', 'culinary' );

// Filter chips
$cats        = get_categories( [ 'hide_empty' => true, 'number' => 10 ] );
$active_cat  = $is_category ? $cat->term_id : 0;
?>

<main id="primary" class="site-main" role="main">

	<!-- Page header -->
	<header class="archive-header culinary-narrow culinary-reveal">
		<?php if ( ! $is_category ) : ?>
			<div class="archive-header__eyebrow"><?php esc_html_e( 'The recipe index', 'culinary' ); ?></div>
		<?php endif; ?>
		<h1 class="archive-header__title"><?php echo esc_html( $page_title ); ?></h1>
		<p class="archive-header__body"><?php echo esc_html( $page_desc ); ?></p>
	</header>

	<!-- Filter chips -->
	<?php if ( ! $is_category && $cats ) : ?>
		<div class="filter-chips culinary-reveal">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>"
			   class="culinary-tag culinary-tag--sage<?php echo ! $active_cat ? ' is-active' : ''; ?>">
				<?php esc_html_e( 'All', 'culinary' ); ?>
			</a>
			<?php foreach ( $cats as $filter_cat ) : ?>
				<a href="<?php echo esc_url( get_category_link( $filter_cat ) ); ?>"
				   class="culinary-tag culinary-tag--sage<?php echo $filter_cat->term_id === $active_cat ? ' is-active' : ''; ?>">
					<?php echo esc_html( $filter_cat->name ); ?>
				</a>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<!-- Recipe grid -->
	<div class="culinary-container" style="padding-bottom: var(--space-8);">
		<?php if ( have_posts() ) : ?>
			<div class="recipe-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content/recipe-card' ); ?>
				<?php endwhile; ?>
			</div>

			<!-- Pagination -->
			<div class="culinary-pagination" role="navigation" aria-label="<?php esc_attr_e( 'Recipes navigation', 'culinary' ); ?>">
				<?php
				$pagination = paginate_links( [
					'type'      => 'array',
					'prev_text' => culinary_icon( 'chevron-left', 18 ),
					'next_text' => culinary_icon( 'chevron-right', 18 ),
				] );
				if ( $pagination ) {
					foreach ( $pagination as $page_link ) {
						$is_current = strpos( $page_link, 'current' ) !== false;
						echo '<span class="culinary-page-num' . ( $is_current ? ' current' : '' ) . '">' . $page_link . '</span>';
					}
				}
				?>
			</div>

		<?php else : ?>
			<p style="text-align:center;font-family:var(--font-body);color:var(--text-muted);padding:var(--space-16) 0;">
				<?php esc_html_e( 'No recipes match that yet — try another category?', 'culinary' ); ?>
			</p>
		<?php endif; ?>
	</div>

</main>

<?php get_footer(); ?>
