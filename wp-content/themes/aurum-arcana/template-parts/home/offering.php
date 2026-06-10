<?php
$title       = get_theme_mod( 'aurum_reading_title', __( 'An hour with the cards', 'aurum-arcana' ) );
$desc        = get_theme_mod( 'aurum_reading_desc', __( 'A full Celtic-cross reading, recorded and transcribed, with a written letter of reflection sent within three days.', 'aurum-arcana' ) );
$price       = get_theme_mod( 'aurum_reading_price', '$180' );
$booking_url = get_theme_mod( 'aurum_reading_url', '' );
if ( ! $booking_url ) {
	$about = get_page_by_path( 'about' );
	$booking_url = $about ? get_permalink( $about ) : home_url( '/about/' );
}
?>
<section class="aa-offering aa-reveal">
	<div class="aa-offering__inner">
		<div class="aa-offering__media">
			<?php
			/* Use the most recent post's thumbnail as the offering image */
			$img_post = get_posts( [ 'posts_per_page' => 1, 'meta_key' => '_thumbnail_id', 'no_found_rows' => true ] );
			if ( $img_post && has_post_thumbnail( $img_post[0] ) ) {
				echo get_the_post_thumbnail( $img_post[0], 'large', [ 'alt' => '' ] );
			} else {
				echo '<div style="width:100%;height:100%;background:var(--ink-600);"></div>';
			}
			?>
		</div>

		<div>
			<?php echo aurum_label( __( 'The Signature Reading', 'aurum-arcana' ) ); ?>
			<h2><?php echo esc_html( $title ); ?></h2>
			<p><?php echo esc_html( $desc ); ?></p>
			<ul>
				<li><?php echo aurum_icon( 'check', 20 ); ?><?php esc_html_e( '60 minutes, in person or by veil-call', 'aurum-arcana' ); ?></li>
				<li><?php echo aurum_icon( 'check', 20 ); ?><?php esc_html_e( 'A recording and full transcript', 'aurum-arcana' ); ?></li>
				<li><?php echo aurum_icon( 'check', 20 ); ?><?php esc_html_e( 'A follow-up letter of reflection', 'aurum-arcana' ); ?></li>
			</ul>
			<a href="<?php echo esc_url( $booking_url ); ?>" class="aa-btn aa-btn--primary aa-btn--lg">
				<?php
				printf(
					/* translators: %s: price */
					esc_html__( 'Book the Reading &middot; %s', 'aurum-arcana' ),
					esc_html( $price )
				);
				?>
			</a>
		</div>
	</div>
</section>
