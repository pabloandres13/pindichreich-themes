<?php
$post     = get_post();
$cats     = get_the_category( $post->ID );
$cat      = $cats ? $cats[0] : null;
$cat_slug = $cat ? $cat->slug : '';
?>
<a href="<?php the_permalink(); ?>"
   class="aa-article"
   data-category="<?php echo esc_attr( $cat_slug ); ?>">

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="aa-article__media">
			<?php the_post_thumbnail( 'medium_large', [ 'alt' => '' ] ); ?>
			<?php if ( $cat ) : ?>
				<span class="aa-article__cat">
					<span class="aa-tag" style="background:rgba(14,13,15,.70);backdrop-filter:blur(2px);">
						<?php echo esc_html( $cat->name ); ?>
					</span>
				</span>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="aa-article__body">
		<h3 class="aa-article__title"><?php the_title(); ?></h3>

		<?php if ( has_excerpt() || get_the_excerpt() ) : ?>
			<p class="aa-article__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 18 ); ?></p>
		<?php endif; ?>

		<div class="aa-article__meta">
			<span><?php the_author(); ?></span>
			<span aria-hidden="true">&middot;</span>
			<span><?php echo esc_html( get_the_date( 'M j' ) ); ?></span>
		</div>
	</div>
</a>
