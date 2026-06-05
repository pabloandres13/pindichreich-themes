<?php
/**
 * Archive hero section.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title = ! empty( $args['title'] ) ? $args['title'] : get_the_archive_title();
?>
<section class="taa-archive-hero">
	<div class="ast-container">
		<p class="taa-archive-hero__eyebrow"><?php esc_html_e( 'Entdecken', 'travel-and-adventure' ); ?></p>
		<h1 class="taa-archive-hero__title"><?php echo esc_html( wp_strip_all_tags( $title ) ); ?></h1>
		<p class="taa-archive-hero__lead"><?php echo esc_html( taa_get_archive_intro() ); ?></p>
	</div>
</section>

