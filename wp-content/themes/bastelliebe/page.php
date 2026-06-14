<?php
/**
 * Default page template.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<main class="bl-page">
		<div class="bl-container">
			<?php if ( ! get_post()->post_content || ! has_blocks() ) : ?>
				<header class="bl-archive__header">
					<h1 class="bl-archive__title"><?php the_title(); ?></h1>
				</header>
			<?php endif; ?>
			<div class="bl-prose">
				<?php the_content(); ?>
			</div>
		</div>
	</main>
	<?php
endwhile;

get_footer();
