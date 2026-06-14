<?php
/**
 * Home demo fallback — Material-Favoriten (affiliate).
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="bl-section bl-section--white">
	<div class="bl-container">
		<div class="bl-section-head">
			<p class="bl-section-head__eyebrow"><?php esc_html_e( 'Shop the Post', 'bastelliebe' ); ?></p>
			<h2 class="bl-section-title"><?php esc_html_e( 'Meine Material-Favoriten', 'bastelliebe' ); ?></h2>
		</div>
		<div style="height:28px"></div>
		<?php echo do_shortcode( '[bl_affiliate]' ); // phpcs:ignore ?>
	</div>
</section>
