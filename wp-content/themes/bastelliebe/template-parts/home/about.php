<?php
/**
 * Home demo fallback — Über mich.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;
$bl_about    = esc_url( home_url( '/ueber-mich/' ) );
$bl_name     = get_theme_mod( 'bl_author_name', 'Lena' );
$bl_portrait = get_theme_mod( 'bl_portrait_image' );
?>
<section class="bl-section bl-section--cream">
	<div class="bl-container">
		<div class="bl-about">
			<div class="bl-about__media">
				<?php if ( $bl_portrait ) : ?>
					<?php echo wp_get_attachment_image( (int) $bl_portrait, 'large', false, [ 'alt' => esc_attr( $bl_name ) ] ); // phpcs:ignore ?>
				<?php else : ?>
					<?php echo bl_icon( 'user', 72, 1.4 ); // phpcs:ignore ?>
				<?php endif; ?>
			</div>
			<div class="bl-about__body">
				<p class="bl-about__eyebrow"><?php printf( esc_html__( 'Hallo, ich bin %s', 'bastelliebe' ), esc_html( $bl_name ) ); ?></p>
				<h2 class="bl-about__title"><?php esc_html_e( 'Bastelliebe ist mein Herzensprojekt', 'bastelliebe' ); ?></h2>
				<p class="bl-about__text"><?php esc_html_e( 'Seit über zehn Jahren bastle, nähe und werkle ich für mein Leben gern. Hier teile ich meine liebsten Projekte – ehrlich, einfach erklärt und immer zum Selbermachen.', 'bastelliebe' ); ?></p>
				<a href="<?php echo $bl_about; // phpcs:ignore ?>" class="bl-btn bl-btn--secondary"><?php esc_html_e( 'Mehr über mich', 'bastelliebe' ); ?></a>
			</div>
		</div>
	</div>
</section>
