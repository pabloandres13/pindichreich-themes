<?php
$blog_name   = get_bloginfo( 'name' ) ?: 'Culinary';
$blog_desc   = get_bloginfo( 'description' ) ?: '';
$year        = date( 'Y' );
$footer_note = get_theme_mod( 'culinary_footer_note', __( 'Made with care, in a small kitchen.', 'culinary' ) );
$instagram   = get_theme_mod( 'culinary_instagram', '#' );
$facebook    = get_theme_mod( 'culinary_facebook', '#' );
$youtube     = get_theme_mod( 'culinary_youtube', '#' );
?>
</div><!-- #content -->

<footer class="culinary-footer" id="colophon" role="contentinfo">
	<div class="culinary-footer__main">

		<!-- Brand column -->
		<div class="culinary-footer__brand">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="culinary-logo" rel="home">
				<span class="culinary-logo__wordmark" style="color:#FAF7F2;"><?php echo esc_html( $blog_name ); ?></span>
			</a>
			<?php if ( $blog_desc ) : ?>
				<p class="culinary-footer__tagline"><?php echo esc_html( $blog_desc ); ?></p>
			<?php endif; ?>
			<div class="culinary-footer__social">
				<?php if ( $instagram && $instagram !== '#' ) : ?>
					<a href="<?php echo esc_url( $instagram ); ?>" class="culinary-footer__social-btn" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
						<?php echo culinary_icon( 'instagram', 18 ); ?>
					</a>
				<?php endif; ?>
				<?php if ( $facebook && $facebook !== '#' ) : ?>
					<a href="<?php echo esc_url( $facebook ); ?>" class="culinary-footer__social-btn" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
						<?php echo culinary_icon( 'facebook', 18 ); ?>
					</a>
				<?php endif; ?>
				<?php if ( $youtube && $youtube !== '#' ) : ?>
					<a href="<?php echo esc_url( $youtube ); ?>" class="culinary-footer__social-btn" aria-label="YouTube" target="_blank" rel="noopener noreferrer">
						<?php echo culinary_icon( 'youtube', 18 ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<!-- Browse column -->
		<div class="culinary-footer__col">
			<div class="culinary-footer__col-head"><?php esc_html_e( 'Browse', 'culinary' ); ?></div>
			<?php if ( has_nav_menu( 'footer-1' ) ) : ?>
				<?php
				wp_nav_menu( [
					'theme_location' => 'footer-1',
					'container'      => false,
					'items_wrap'     => '%3$s',
					'fallback_cb'    => false,
					'walker'         => new Culinary_Footer_Nav_Walker(),
				] );
				?>
			<?php else : ?>
				<?php
				$cats = get_categories( [ 'number' => 5, 'hide_empty' => true ] );
				foreach ( $cats as $cat ) :
				?>
					<a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="culinary-footer__link">
						<?php echo esc_html( $cat->name ); ?>
					</a>
				<?php endforeach; ?>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="culinary-footer__link">
					<?php esc_html_e( 'All recipes', 'culinary' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<!-- About column -->
		<div class="culinary-footer__col">
			<div class="culinary-footer__col-head"><?php echo esc_html( $blog_name ); ?></div>
			<?php if ( has_nav_menu( 'footer-2' ) ) : ?>
				<?php
				wp_nav_menu( [
					'theme_location' => 'footer-2',
					'container'      => false,
					'items_wrap'     => '%3$s',
					'fallback_cb'    => false,
					'walker'         => new Culinary_Footer_Nav_Walker(),
				] );
				?>
			<?php else : ?>
				<?php
				$about = get_page_by_path( 'about' );
				if ( $about ) :
				?>
					<a href="<?php echo esc_url( get_permalink( $about ) ); ?>" class="culinary-footer__link">
						<?php esc_html_e( 'About', 'culinary' ); ?>
					</a>
				<?php endif; ?>
				<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ?: '#contact' ); ?>" class="culinary-footer__link">
					<?php esc_html_e( 'Contact', 'culinary' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<!-- More column -->
		<div class="culinary-footer__col">
			<div class="culinary-footer__col-head"><?php esc_html_e( 'More', 'culinary' ); ?></div>
			<?php if ( has_nav_menu( 'footer-3' ) ) : ?>
				<?php
				wp_nav_menu( [
					'theme_location' => 'footer-3',
					'container'      => false,
					'items_wrap'     => '%3$s',
					'fallback_cb'    => false,
					'walker'         => new Culinary_Footer_Nav_Walker(),
				] );
				?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/recipe-index/' ) ); ?>" class="culinary-footer__link">
					<?php esc_html_e( 'Recipe index', 'culinary' ); ?>
				</a>
				<a href="<?php echo esc_url( get_privacy_policy_url() ?: '#' ); ?>" class="culinary-footer__link">
					<?php esc_html_e( 'Privacy', 'culinary' ); ?>
				</a>
			<?php endif; ?>
		</div>

	</div>

	<div class="culinary-footer__bottom">
		<div class="culinary-footer__bottom-inner">
			<span>
				<?php
				printf(
					/* translators: 1: year, 2: site name */
					esc_html__( '© %1$s %2$s. All rights reserved.', 'culinary' ),
					esc_html( $year ),
					esc_html( $blog_name )
				);
				?>
			</span>
			<span><?php echo esc_html( $footer_note ); ?></span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

<?php
if ( ! class_exists( 'Culinary_Footer_Nav_Walker' ) ) {
	class Culinary_Footer_Nav_Walker extends Walker_Nav_Menu {
		public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
			$item  = $data_object;
			$href  = ! empty( $item->url ) ? esc_url( $item->url ) : '#';
			$title = apply_filters( 'the_title', $item->title, $item->ID );
			$output .= '<a href="' . $href . '" class="culinary-footer__link">' . esc_html( $title ) . '</a>';
		}
		public function end_el( &$output, $data_object, $depth = 0, $args = null ) {}
		public function start_lvl( &$output, $depth = 0, $args = null ) {}
		public function end_lvl( &$output, $depth = 0, $args = null ) {}
	}
}
