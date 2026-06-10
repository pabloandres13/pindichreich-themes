<?php
$pub_name   = get_theme_mod( 'aurum_pub_name',   get_bloginfo( 'name' ) );
$pub_desc   = get_theme_mod( 'aurum_pub_tagline', __( 'A study of the old arts — tarot, the wheel of the stars, alchemy, and the quiet grammar of symbols.', 'aurum-arcana' ) );
$motto      = get_theme_mod( 'aurum_footer_motto', 'Per Aspera Ad Astra' );
$instagram  = get_theme_mod( 'aurum_social_instagram', '' );
$nl_url     = get_theme_mod( 'aurum_social_newsletter', '' );
?>
</div><!-- #page -->

<footer class="aa-ftr">
	<div class="aa-ftr__top">
		<span class="aa-sigil" aria-hidden="true" style="color:var(--accent);display:inline-flex;flex-direction:column;align-items:center;gap:.5em;">
			<?php echo aurum_sigil( 44 ); ?>
			<span style="font-family:var(--font-logo);font-weight:600;letter-spacing:.14em;text-transform:uppercase;font-size:1.05em;color:var(--accent);">
				<?php echo esc_html( $pub_name ); ?>
			</span>
		</span>
		<?php echo aurum_divider( '240px' ); ?>
	</div>

	<div class="aa-ftr__cols">
		<!-- Brand column -->
		<div class="aa-ftr__brand">
			<h4><?php echo esc_html( $pub_name ); ?></h4>
			<p><?php echo esc_html( $pub_desc ); ?></p>
		</div>

		<!-- Explore column -->
		<div>
			<h4><?php esc_html_e( 'Explore', 'aurum-arcana' ); ?></h4>
			<?php
			wp_nav_menu( [
				'theme_location' => 'footer-1',
				'container'      => false,
				'items_wrap'     => '<ul>%3$s</ul>',
				'fallback_cb'    => 'aurum_footer_explore_fallback',
			] );
			?>
		</div>

		<!-- The Order column -->
		<div>
			<h4><?php esc_html_e( 'The Order', 'aurum-arcana' ); ?></h4>
			<?php
			wp_nav_menu( [
				'theme_location' => 'footer-2',
				'container'      => false,
				'items_wrap'     => '<ul>%3$s</ul>',
				'fallback_cb'    => 'aurum_footer_order_fallback',
			] );
			?>
		</div>

		<!-- Follow column -->
		<div>
			<h4><?php esc_html_e( 'Follow', 'aurum-arcana' ); ?></h4>
			<div class="aa-ftr__social">
				<?php if ( $instagram ) : ?>
					<a href="<?php echo esc_url( $instagram ); ?>" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
						<?php echo aurum_icon( 'instagram-logo', 22 ); ?>
					</a>
				<?php endif; ?>
				<?php if ( $nl_url ) : ?>
					<a href="<?php echo esc_url( $nl_url ); ?>" aria-label="<?php esc_attr_e( 'Newsletter', 'aurum-arcana' ); ?>">
						<?php echo aurum_icon( 'envelope-simple', 22 ); ?>
					</a>
				<?php else : ?>
					<span style="color:var(--text-muted);"><?php echo aurum_icon( 'moon-stars', 22 ); ?></span>
					<span style="color:var(--text-muted);"><?php echo aurum_icon( 'star-four', 22 ); ?></span>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="aa-ftr__bottom">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( $pub_name ); ?></span>
		<span><?php echo esc_html( $motto ); ?></span>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

<?php
function aurum_footer_explore_fallback(): void {
	$cats = get_categories( [ 'number' => 5, 'hide_empty' => false ] );
	echo '<ul>';
	echo '<li><a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ?: home_url( '/' ) ) ) . '">' . esc_html__( 'The Journal', 'aurum-arcana' ) . '</a></li>';
	foreach ( $cats as $cat ) {
		echo '<li><a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
	}
	echo '</ul>';
}

function aurum_footer_order_fallback(): void {
	echo '<ul>';
	$about   = get_page_by_path( 'about' );
	$contact = get_page_by_path( 'contact' );
	if ( $about )   echo '<li><a href="' . esc_url( get_permalink( $about ) ) . '">' . esc_html__( 'About', 'aurum-arcana' ) . '</a></li>';
	echo '<li><a href="' . esc_url( get_permalink( $about ?: home_url( '/' ) ) ) . '">' . esc_html__( 'Readings', 'aurum-arcana' ) . '</a></li>';
	if ( $contact ) echo '<li><a href="' . esc_url( get_permalink( $contact ) ) . '">' . esc_html__( 'Contact', 'aurum-arcana' ) . '</a></li>';
	echo '</ul>';
}
?>
