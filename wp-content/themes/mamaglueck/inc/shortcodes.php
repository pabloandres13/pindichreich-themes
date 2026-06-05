<?php
defined( 'ABSPATH' ) || exit;

/**
 * Shortcodes that embed homepage template-part sections into page content.
 * Use these inside the block editor (Shortcode block) to keep dynamic
 * sections live while editing the rest of the page as blocks.
 *
 * Available shortcodes:
 *   [mg_topics]       — topic category grid
 *   [mg_posts_grid]   — latest posts magazine grid
 *   [mg_popular_posts]— most-read posts strip
 *   [mg_testimonials] — reader quote cards
 *   [mg_newsletter]   — newsletter sign-up band
 *   [mg_instagram]    — Instagram photo strip
 */

function mg_shortcode( $template ) {
	return function ( $atts ) use ( $template ) {
		ob_start();
		get_template_part( 'template-parts/home/' . $template );
		return ob_get_clean();
	};
}

add_shortcode( 'mg_topics',        mg_shortcode( 'topics' ) );
add_shortcode( 'mg_posts_grid',    mg_shortcode( 'posts' ) );
add_shortcode( 'mg_popular_posts', mg_shortcode( 'popular' ) );
add_shortcode( 'mg_testimonials',  mg_shortcode( 'testimonials' ) );
add_shortcode( 'mg_newsletter',    mg_shortcode( 'newsletter' ) );
add_shortcode( 'mg_instagram',     mg_shortcode( 'instagram' ) );

function mg_newsletter_form_shortcode() {
	$action      = get_theme_mod( 'mg_newsletter_action', '#' );
	$privacy_url = get_permalink( get_page_by_path( 'datenschutz' ) ) ?: home_url( '/datenschutzerklaerung/' );

	ob_start();
	?>
	<form class="newsletter__form" action="<?php echo esc_url( $action ); ?>" method="post">
		<?php wp_nonce_field( 'mamaglueck_newsletter', 'mg_nonce' ); ?>
		<label for="nl-email" class="sr-only" style="position:absolute;left:-9999px"><?php esc_html_e( 'E-Mail-Adresse', 'mamaglueck' ); ?></label>
		<input id="nl-email" type="email" name="email" placeholder="<?php esc_attr_e( 'deine@email.de', 'mamaglueck' ); ?>" autocomplete="email" required />
		<button type="submit" class="btn btn--yellow"><?php esc_html_e( 'Jetzt anmelden', 'mamaglueck' ); ?></button>
	</form>
	<label class="newsletter__consent">
		<input type="checkbox" required />
		<span>
			<?php
			printf(
				wp_kses(
					__( 'Ja, ich möchte den Newsletter erhalten und habe die <a href="%s">Datenschutzerklärung</a> gelesen. Abmeldung jederzeit möglich.', 'mamaglueck' ),
					[ 'a' => [ 'href' => [] ] ]
				),
				esc_url( $privacy_url )
			);
			?>
		</span>
	</label>
	<?php
	return ob_get_clean();
}
add_shortcode( 'mg_newsletter_form', 'mg_newsletter_form_shortcode' );
