<?php get_header(); ?>

<div class="aa-blog-grid">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'template-parts/content/article-card' ); ?>
<?php endwhile; else : ?>
	<p class="aa-no-posts"><?php esc_html_e( 'No dispatches found.', 'aurum-arcana' ); ?></p>
<?php endif; ?>
</div>

<?php get_footer(); ?>
