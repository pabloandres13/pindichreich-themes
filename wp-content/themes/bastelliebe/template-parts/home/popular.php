<?php
/**
 * Home demo fallback — Beliebte Projekte.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="bl-section bl-section--white">
	<div class="bl-container">
		<div class="bl-section-head">
			<p class="bl-section-head__eyebrow"><?php esc_html_e( 'Reader Favorites', 'bastelliebe' ); ?></p>
			<h2 class="bl-section-title"><?php esc_html_e( 'Beliebte Projekte', 'bastelliebe' ); ?></h2>
		</div>
		<div style="height:28px"></div>
		<?php echo do_shortcode( '[bl_projects count="4" columns="4" compact="1"]' ); // phpcs:ignore ?>
	</div>
</section>
