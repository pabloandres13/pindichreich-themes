<?php
/**
 * Home demo fallback — Newsletter.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="bl-section bl-section--cream">
	<div class="bl-container">
		<?php echo do_shortcode( '[bl_newsletter]' ); // phpcs:ignore ?>
	</div>
</section>
