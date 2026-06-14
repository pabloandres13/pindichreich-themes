<?php
/**
 * Default page template.
 *
 * @package maren-cole
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	// Pages built entirely from blocks/patterns render full-bleed; simple text
	// pages get a readable, centered measure.
	$mc_has_blocks = has_blocks( get_the_content() ) && has_block( 'core/group', get_the_content() );

	if ( $mc_has_blocks ) {
		the_content();
	} else {
		?>
		<article class="mc-page">
			<div class="mc-container">
				<header class="mc-page__header">
					<h1 class="mc-page__title"><?php the_title(); ?></h1>
				</header>
				<div class="mc-prose">
					<?php the_content(); ?>
				</div>
			</div>
		</article>
		<?php
	}

endwhile;

get_footer();
