<?php
$latest_q = new WP_Query( [
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'no_found_rows'  => true,
] );

if ( ! $latest_q->have_posts() ) {
	return;
}

$archive_url = get_permalink( get_option( 'page_for_posts' ) ) ?: get_post_type_archive_link( 'post' ) ?: home_url( '/' );
?>
<section class="aa-sec aa-reveal" style="padding-top:0;">
	<div class="aa-sec__head">
		<?php echo aurum_label( __( 'Latest Dispatches', 'aurum-arcana' ) ); ?>
		<h2><?php esc_html_e( 'From the Journal', 'aurum-arcana' ); ?></h2>
	</div>

	<div class="aa-grid-3">
		<?php while ( $latest_q->have_posts() ) : $latest_q->the_post(); ?>
			<?php get_template_part( 'template-parts/content/article-card' ); ?>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>

	<div style="text-align:center;margin-top:40px;">
		<a href="<?php echo esc_url( $archive_url ); ?>" class="aa-btn aa-btn--ghost">
			<?php esc_html_e( 'All dispatches', 'aurum-arcana' ); ?>
			<?php echo aurum_icon( 'arrow-right', 16 ); ?>
		</a>
	</div>
</section>
