<?php
/**
 * Homepage about teaser block.
 */
$author_name  = get_theme_mod( 'culinary_author_name', get_bloginfo( 'name' ) );
$author_bio   = get_theme_mod( 'culinary_author_bio', __( 'I cook the way most of us actually live — quickly, on a weeknight, with whatever\'s in the fridge. Every recipe here is tested in my own small kitchen until it\'s reliable enough to share.', 'culinary' ) );
$author_photo = get_theme_mod( 'culinary_author_photo', '' );
$about_page   = get_page_by_path( 'about' );
$about_url    = $about_page ? get_permalink( $about_page ) : home_url( '/about/' );
?>
<section class="culinary-container" style="margin-bottom: var(--space-24);">
	<div class="about-teaser culinary-reveal">
		<?php if ( $author_photo ) : ?>
			<img
				src="<?php echo esc_url( $author_photo ); ?>"
				alt="<?php echo esc_attr( $author_name ); ?>"
				class="about-teaser__image"
				loading="lazy"
			>
		<?php else : ?>
			<div class="about-teaser__image" style="background: var(--cream-200); display:flex; align-items:center; justify-content:center; min-height:380px;">
				<?php echo culinary_icon( 'user', 48 ); ?>
			</div>
		<?php endif; ?>

		<div class="about-teaser__content">
			<div class="about-teaser__eyebrow">
				<?php
				printf(
					/* translators: %s author name */
					esc_html__( 'Meet %s', 'culinary' ),
					esc_html( $author_name )
				);
				?>
			</div>
			<h2 class="about-teaser__title"><?php esc_html_e( 'Hi, I\'m the cook behind the mess', 'culinary' ); ?></h2>
			<p class="about-teaser__body"><?php echo esc_html( $author_bio ); ?></p>
			<div>
				<a href="<?php echo esc_url( $about_url ); ?>" class="btn btn--secondary">
					<?php esc_html_e( 'Read the story', 'culinary' ); ?>
					<?php echo culinary_icon( 'arrow-right', 17 ); ?>
				</a>
			</div>
		</div>
	</div>
</section>
