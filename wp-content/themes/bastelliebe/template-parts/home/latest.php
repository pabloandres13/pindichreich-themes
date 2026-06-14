<?php
/**
 * Home demo fallback — Neueste Anleitungen.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;
$bl_anleitungen = esc_url( home_url( '/anleitungen/' ) );
?>
<section class="bl-section bl-section--cream">
	<div class="bl-container">
		<div class="bl-section-flex-head">
			<div class="bl-section-head">
				<p class="bl-section-head__eyebrow"><?php esc_html_e( 'Frisch aus der Werkstatt', 'bastelliebe' ); ?></p>
				<h2 class="bl-section-title"><?php esc_html_e( 'Neueste Anleitungen', 'bastelliebe' ); ?></h2>
			</div>
			<a class="bl-textlink" href="<?php echo $bl_anleitungen; // phpcs:ignore ?>"><?php esc_html_e( 'Alle Anleitungen', 'bastelliebe' ); ?><?php echo bl_icon( 'arrow-right', 16 ); // phpcs:ignore ?></a>
		</div>
		<div style="height:28px"></div>
		<?php echo do_shortcode( '[bl_projects count="6"]' ); // phpcs:ignore ?>
	</div>
</section>
