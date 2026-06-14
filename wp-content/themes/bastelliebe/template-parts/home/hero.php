<?php
/**
 * Home demo fallback — Hero.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;

$bl_anleitungen = esc_url( home_url( '/anleitungen/' ) );
?>
<section class="bl-hero bl-paper">
	<div class="bl-container bl-hero__inner">
		<div>
			<p class="bl-hero__tagline"><?php esc_html_e( 'Willkommen bei Bastelliebe', 'bastelliebe' ); ?></p>
			<h1 class="bl-hero__headline"><?php esc_html_e( 'Kreative Ideen zum Nachmachen', 'bastelliebe' ); ?></h1>
			<p class="bl-hero__lead"><?php esc_html_e( 'Einfache DIY-Anleitungen für Papier, Wohndeko, Upcycling und Kinder – Schritt für Schritt erklärt, mit Materiallisten und vielen Fotos.', 'bastelliebe' ); ?></p>
			<div class="bl-hero__actions">
				<a href="<?php echo $bl_anleitungen; // phpcs:ignore ?>" class="bl-btn bl-btn--primary bl-btn--lg"><?php esc_html_e( 'Projekt der Woche', 'bastelliebe' ); ?><?php echo bl_icon( 'arrow-right', 20 ); // phpcs:ignore ?></a>
				<a href="<?php echo $bl_anleitungen; // phpcs:ignore ?>" class="bl-btn bl-btn--secondary bl-btn--lg"><?php echo bl_icon( 'sparkles', 20 ); // phpcs:ignore ?><?php esc_html_e( 'Für Einsteiger', 'bastelliebe' ); ?></a>
			</div>
		</div>
		<div class="bl-hero__media">
			<div class="bl-hero__image">
				<span class="bl-hero__image-icon"><?php echo bl_icon( 'sofa', 84, 1.4 ); // phpcs:ignore ?></span>
				<span class="bl-hero__image-tag"><?php echo bl_tag( 'wohndeko', 'sm' ); // phpcs:ignore ?></span>
			</div>
			<div class="bl-hero__badge">
				<div>
					<div class="bl-hero__badge-eyebrow"><?php esc_html_e( 'Projekt der Woche', 'bastelliebe' ); ?></div>
					<div class="bl-hero__badge-title"><?php esc_html_e( 'Makramee-Wandbehang', 'bastelliebe' ); ?></div>
				</div>
				<div class="bl-hero__badge-meta">
					<span><?php echo bl_icon( 'clock', 15 ); // phpcs:ignore ?>45 Min.</span>
					<span><?php echo bl_icon( 'gauge', 15 ); // phpcs:ignore ?><?php esc_html_e( 'Mittel', 'bastelliebe' ); ?></span>
				</div>
			</div>
		</div>
	</div>
</section>
