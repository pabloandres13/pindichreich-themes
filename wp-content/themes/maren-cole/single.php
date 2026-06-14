<?php
/**
 * Single post template.
 *
 * @package maren-cole
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'mc-page' ); ?>>
		<div class="mc-container">
			<header class="mc-page__header">
				<?php
				$cats = get_the_category();
				if ( $cats ) :
					?>
					<div style="margin-bottom:0.75rem"><span class="mc-badge"><?php echo esc_html( $cats[0]->name ); ?></span></div>
				<?php endif; ?>
				<h1 class="mc-page__title"><?php the_title(); ?></h1>
				<p style="color:var(--text-subtle);font-size:var(--text-sm)"><?php echo esc_html( get_the_date() ); ?></p>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="mc-prose" style="margin-bottom:var(--space-6)">
					<?php the_post_thumbnail( 'large', [ 'style' => 'border-radius:var(--radius-lg);width:100%' ] ); ?>
				</figure>
			<?php endif; ?>

			<div class="mc-prose mc-entry-content">
				<?php
				the_content();
				wp_link_pages();
				?>
			</div>
		</div>
	</article>
	<?php

	if ( comments_open() || get_comments_number() ) {
		?>
		<div class="mc-container" style="padding-bottom:var(--section-y)">
			<div class="mc-prose"><?php comments_template(); ?></div>
		</div>
		<?php
	}

endwhile;

get_footer();
