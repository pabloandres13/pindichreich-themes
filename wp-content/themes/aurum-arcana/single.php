<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- Full-bleed hero -->
<div class="aa-art__hero">
	<?php if ( has_post_thumbnail() ) : ?>
		<?php the_post_thumbnail( 'full', [ 'alt' => '' ] ); ?>
	<?php else : ?>
		<div style="width:100%;height:100%;background:var(--ink-700);"></div>
	<?php endif; ?>

	<div class="aa-art__head">
		<?php
		$cats = get_the_category();
		if ( $cats ) :
			$cat = $cats[0];
		?>
			<span class="aa-badge aa-badge--oxblood aa-badge--dot">
				<?php echo esc_html( $cat->name ); ?>
			</span>
		<?php endif; ?>

		<h1><?php the_title(); ?></h1>

		<div class="aa-art__meta">
			<span><?php esc_html_e( 'By', 'aurum-arcana' ); ?> <b><?php the_author(); ?></b></span>
			<span aria-hidden="true">&middot;</span>
			<span><?php echo esc_html( get_the_date() ); ?></span>
			<?php
			$words     = str_word_count( wp_strip_all_tags( get_the_content() ) );
			$read_time = max( 1, (int) ceil( $words / 200 ) );
			?>
			<span aria-hidden="true">&middot;</span>
			<span><?php echo esc_html( $read_time ); ?> <?php esc_html_e( 'min', 'aurum-arcana' ); ?></span>
		</div>
	</div>
</div>

<!-- Article body -->
<div class="aa-art__body">
	<div class="entry-content lead">
		<?php the_content(); ?>
	</div>

	<!-- Tags -->
	<?php
	$tags = get_the_tags();
	if ( $tags ) : ?>
		<div class="aa-art__tags">
			<?php foreach ( $tags as $tag ) : ?>
				<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="aa-tag">
					<?php echo esc_html( $tag->name ); ?>
				</a>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>

<!-- Ornamental divider -->
<div style="display:flex;justify-content:center;padding:8px 0;">
	<?php echo aurum_divider( '280px' ); ?>
</div>

<!-- Related posts -->
<?php
$categories  = get_the_category();
$cat_ids     = array_map( fn( $c ) => $c->term_id, $categories );
$related_q   = new WP_Query( [
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'post__not_in'   => [ get_the_ID() ],
	'category__in'   => $cat_ids,
	'orderby'        => 'rand',
	'no_found_rows'  => true,
] );
?>
<?php if ( $related_q->have_posts() ) : ?>
	<div class="aa-related">
		<?php echo aurum_label( __( 'Read Next', 'aurum-arcana' ), true ); ?>
		<div class="aa-related__grid">
			<?php while ( $related_q->have_posts() ) : $related_q->the_post(); ?>
				<?php get_template_part( 'template-parts/content/article-card' ); ?>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
<?php endif; ?>

<!-- Newsletter band -->
<div class="aa-related" style="padding-top:48px;padding-bottom:96px;">
	<?php get_template_part( 'template-parts/home/newsletter' ); ?>
</div>

<!-- Comments -->
<?php if ( comments_open() || get_comments_number() ) : ?>
	<div class="aa-container" style="padding-bottom:var(--space-9);">
		<?php comments_template(); ?>
	</div>
<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>
