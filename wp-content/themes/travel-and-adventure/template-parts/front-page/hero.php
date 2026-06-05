<?php
/**
 * Hero section for the front page.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hero_style = '';
$hero_title = taa_get_front_page_title();
$hero_intro = taa_get_front_page_intro();
$blog_url   = taa_get_blog_url();
$about_url  = taa_get_about_url();

if ( get_header_image() ) {
	$hero_style = sprintf(
		' style="background-image:linear-gradient(135deg, rgba(12, 35, 56, 0.78), rgba(28, 113, 133, 0.36)), url(%s);"',
		esc_url( get_header_image() )
	);
}
?>
<section class="taa-hero"<?php echo wp_kses_post( $hero_style ); ?>>
	<div class="taa-hero__inner ast-container">
		<div class="taa-hero__copy">
			<p class="taa-hero__eyebrow"><?php bloginfo( 'name' ); ?></p>
			<h1 class="taa-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
			<div class="taa-hero__lead">
				<p><?php echo esc_html( $hero_intro ); ?></p>
			</div>
		</div>
		<div class="taa-hero__actions">
			<a class="taa-button taa-button--primary" href="<?php echo esc_url( $blog_url ); ?>">
				<?php esc_html_e( 'Zum Blog', 'travel-and-adventure' ); ?>
			</a>
			<a class="taa-button taa-button--ghost" href="<?php echo esc_url( $about_url ); ?>">
				<?php esc_html_e( 'Mehr ueber Franzi', 'travel-and-adventure' ); ?>
			</a>
		</div>
	</div>
</section>
