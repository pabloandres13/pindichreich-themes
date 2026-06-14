<?php
/**
 * Single post (Anleitung / tutorial) template.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	// Map the first post category slug onto a craft category, if it matches.
	$bl_cats  = bl_categories();
	$bl_cat   = '';
	foreach ( get_the_category() as $bl_c ) {
		if ( isset( $bl_cats[ $bl_c->slug ] ) ) {
			$bl_cat = $bl_c->slug;
			break;
		}
	}
	?>
	<main class="bl-page">
		<article <?php post_class(); ?>>
			<header class="bl-article__header bl-container">
				<?php if ( $bl_cat ) : ?>
					<div class="bl-article__tag"><?php echo bl_tag( $bl_cat ); // phpcs:ignore ?></div>
				<?php endif; ?>
				<h1 class="bl-article__title"><?php the_title(); ?></h1>
				<div class="bl-article__meta">
					<span><?php echo bl_icon( 'user', 15 ); // phpcs:ignore ?><?php the_author(); ?></span>
					<span><?php echo bl_icon( 'clock', 15 ); // phpcs:ignore ?><?php echo esc_html( get_the_date() ); ?></span>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="bl-article__featured">
					<?php the_post_thumbnail( 'large' ); ?>
				</figure>
			<?php endif; ?>

			<div class="bl-prose">
				<?php the_content(); ?>
			</div>
		</article>
	</main>
	<?php
endwhile;

get_footer();
