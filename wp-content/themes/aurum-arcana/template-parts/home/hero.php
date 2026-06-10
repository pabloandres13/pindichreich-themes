<?php
$pub_name = get_theme_mod( 'aurum_pub_name', get_bloginfo( 'name' ) );
?>
<section class="aa-hero">
	<span class="aa-hero__emblem"><?php echo aurum_hero_emblem( 96 ); ?></span>

	<div><?php echo aurum_label( __( 'The Veil Grows Thin', 'aurum-arcana' ), true ); ?></div>

	<h1><?php esc_html_e( 'Study the ', 'aurum-arcana' ); ?><em><?php esc_html_e( 'old arts', 'aurum-arcana' ); ?></em><?php esc_html_e( ' by candlelight', 'aurum-arcana' ); ?></h1>

	<p><?php esc_html_e( 'An esoteric journal and house of readings — tarot, astrology, and alchemy, kept with a scholar\'s care and a seeker\'s wonder.', 'aurum-arcana' ); ?></p>

	<div class="aa-hero__cta">
		<?php
		$about_page  = get_page_by_path( 'about' );
		$blog_page   = get_option( 'page_for_posts' );
		$reading_url = get_theme_mod( 'aurum_reading_url', $about_page ? get_permalink( $about_page ) : home_url( '/about/' ) );
		$journal_url = $blog_page ? get_permalink( $blog_page ) : home_url( '/?post_type=post' );
		?>
		<a href="<?php echo esc_url( $reading_url ); ?>" class="aa-btn aa-btn--primary aa-btn--lg">
			<?php esc_html_e( 'Book a Reading', 'aurum-arcana' ); ?>
		</a>
		<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/' ) ); ?>" class="aa-btn aa-btn--secondary aa-btn--lg">
			<?php esc_html_e( 'Read the Journal', 'aurum-arcana' ); ?>
		</a>
	</div>
</section>
