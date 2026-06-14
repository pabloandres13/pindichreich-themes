<?php
/**
 * Home demo fallback — Für Einsteiger.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;
$bl_anleitungen = esc_url( home_url( '/anleitungen/' ) );
?>
<section class="bl-section bl-section--white">
	<div class="bl-container">
		<div class="bl-section-flex-head">
			<div class="bl-section-head">
				<p class="bl-section-head__eyebrow"><?php esc_html_e( 'Neu beim Basteln?', 'bastelliebe' ); ?></p>
				<h2 class="bl-section-title"><?php esc_html_e( 'Für Einsteiger', 'bastelliebe' ); ?></h2>
				<p class="bl-section-head__text"><?php esc_html_e( 'Schnell gemacht, wenig Material, garantierter Erfolg – ideal für deine ersten Projekte.', 'bastelliebe' ); ?></p>
			</div>
			<a class="bl-textlink" href="<?php echo $bl_anleitungen; // phpcs:ignore ?>"><?php esc_html_e( 'Alle Einsteiger-Projekte', 'bastelliebe' ); ?><?php echo bl_icon( 'arrow-right', 16 ); // phpcs:ignore ?></a>
		</div>
		<div style="height:28px"></div>
		<?php echo do_shortcode( '[bl_projects count="3" beginner="1"]' ); // phpcs:ignore ?>
	</div>
</section>
