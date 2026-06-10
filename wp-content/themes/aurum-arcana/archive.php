<?php get_header(); ?>

<div class="aa-page-head">
	<?php echo aurum_label( __( 'The Journal', 'aurum-arcana' ), true ); ?>
	<h1>
		<?php
		if ( is_category() ) {
			single_cat_title();
		} elseif ( is_tag() ) {
			single_tag_title();
		} elseif ( is_author() ) {
			the_author();
		} else {
			echo esc_html__( 'Dispatches from the veil', 'aurum-arcana' );
		}
		?>
	</h1>
	<?php if ( get_the_archive_description() ) : ?>
		<p><?php echo wp_kses_post( get_the_archive_description() ); ?></p>
	<?php else : ?>
		<p><?php esc_html_e( 'Essays, field notes, and quiet instruction on tarot, the stars, alchemy, and the old stories.', 'aurum-arcana' ); ?></p>
	<?php endif; ?>

	<?php
	echo '<div style="display:flex;justify-content:center;margin:28px 0 24px;">' . aurum_divider( '240px' ) . '</div>';
	?>

	<!-- Category chips -->
	<div class="aa-chips">
		<button class="aa-tag aa-tag--solid aa-chip-btn" data-category="all">
			<?php esc_html_e( 'All', 'aurum-arcana' ); ?>
		</button>
		<?php
		$cats = get_categories( [ 'hide_empty' => true ] );
		foreach ( $cats as $cat ) :
		?>
			<button class="aa-tag aa-chip-btn" data-category="<?php echo esc_attr( $cat->slug ); ?>">
				<?php echo esc_html( $cat->name ); ?>
			</button>
		<?php endforeach; ?>
	</div>
</div>

<div class="aa-blog-grid">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'template-parts/content/article-card' ); ?>
	<?php endwhile; else : ?>
		<p class="aa-no-posts" style="grid-column:1/-1;text-align:center;color:var(--text-muted);padding:var(--space-8);">
			<?php esc_html_e( 'No dispatches found.', 'aurum-arcana' ); ?>
		</p>
	<?php endif; ?>
</div>

<?php if ( $GLOBALS['wp_query']->max_num_pages > 1 ) : ?>
	<nav class="aa-pag" aria-label="<?php esc_attr_e( 'Posts navigation', 'aurum-arcana' ); ?>">
		<?php
		$prev = get_previous_posts_link( '&lsaquo; ' . __( 'Prev', 'aurum-arcana' ) );
		$next = get_next_posts_link( __( 'Next', 'aurum-arcana' ) . ' &rsaquo;' );
		if ( $prev ) echo '<span class="prev">' . $prev . '</span>';
		echo paginate_links( [
			'mid_size'  => 2,
			'prev_next' => false,
			'type'      => 'list',
			'before_page_number' => '',
		] );
		if ( $next ) echo '<span class="next">' . $next . '</span>';
		?>
	</nav>
<?php endif; ?>

<?php get_footer(); ?>
