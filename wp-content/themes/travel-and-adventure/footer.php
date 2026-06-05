<?php
/**
 * Custom footer for the Travel and Adventure child theme.
 *
 * @package TravelAndAdventure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php astra_content_bottom(); ?>
		</div>
	</main>
<?php
astra_content_after();

astra_footer_before();
?>
	<footer class="taa-site-footer" aria-label="<?php esc_attr_e( 'Footer', 'travel-and-adventure' ); ?>">
		<div class="ast-container">
			<div class="taa-site-footer__top">
				<div class="taa-site-footer__brand">
					<?php
					if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
						the_custom_logo();
					} else {
						?>
						<a class="taa-site-footer__title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>
						<?php
					}
					?>
					<p class="taa-site-footer__tagline"><?php bloginfo( 'description' ); ?></p>
				</div>

				<div class="taa-site-footer__widgets">
					<div class="taa-site-footer__column">
						<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
							<?php dynamic_sidebar( 'footer-1' ); ?>
						<?php endif; ?>
					</div>
					<div class="taa-site-footer__column">
						<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
							<?php dynamic_sidebar( 'footer-2' ); ?>
						<?php endif; ?>
					</div>
					<div class="taa-site-footer__column">
						<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
							<?php dynamic_sidebar( 'footer-3' ); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="taa-site-footer__bottom">
                <p class="taa-site-footer__copyright">
                    <?php
                    printf(
                        esc_html__( '© %1$s %2$s', 'travel-and-adventure' ),
                        esc_html( date_i18n( 'Y' ) ),
                        esc_html( get_bloginfo( 'name' ) )
                    );
                    ?>
                </p>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => 'nav',
						'container_class'=> 'taa-site-footer__nav',
						'menu_class'     => 'taa-site-footer__menu',
						'fallback_cb'    => false,
						'depth'          => 1,
					)
				);
				?>
			</div>
		</div>
	</footer>
<?php astra_footer_after(); ?>
	</div>
<?php
astra_body_bottom();
wp_footer();
?>
</body>
</html>
