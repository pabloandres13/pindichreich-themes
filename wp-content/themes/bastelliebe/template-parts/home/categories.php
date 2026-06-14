<?php
/**
 * Home demo fallback — Kategorien.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="bl-section bl-section--cream">
	<div class="bl-container">
		<div class="bl-section-head">
			<p class="bl-section-head__eyebrow"><?php esc_html_e( 'Stöbern nach Thema', 'bastelliebe' ); ?></p>
			<h2 class="bl-section-title"><?php esc_html_e( 'Kategorien', 'bastelliebe' ); ?></h2>
		</div>
		<div style="height:28px"></div>
		<?php echo do_shortcode( '[bl_categories]' ); // phpcs:ignore ?>
	</div>
</section>
