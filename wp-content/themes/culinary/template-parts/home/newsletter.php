<?php
/**
 * Newsletter band — reusable across pages.
 * Accepts $args['tone'] = 'tint' | 'sage' | 'dark'
 */
$tone       = isset( $args['tone'] ) ? $args['tone'] : 'tint';
$action_url = get_theme_mod( 'culinary_newsletter_url', '#' );
$title      = get_theme_mod( 'culinary_newsletter_title', __( 'New recipes in your inbox', 'culinary' ) );
$body_text  = get_theme_mod( 'culinary_newsletter_body', __( 'One warm, seasonal recipe each week — plus the odd kitchen note. No spam, unsubscribe anytime.', 'culinary' ) );
?>
<section id="newsletter" class="culinary-container culinary-home-section culinary-reveal">
	<div class="newsletter-band newsletter-band--<?php echo esc_attr( $tone ); ?>">
		<div class="newsletter-band__inner">
			<span class="newsletter-band__eyebrow"><?php esc_html_e( 'The Saturday letter', 'culinary' ); ?></span>
			<h2 class="newsletter-band__title"><?php echo esc_html( $title ); ?></h2>
			<p class="newsletter-band__body"><?php echo esc_html( $body_text ); ?></p>
			<form class="newsletter-band__form" action="<?php echo esc_url( $action_url ); ?>" method="post">
				<?php wp_nonce_field( 'culinary_newsletter', 'culinary_nonce' ); ?>
				<input
					type="email"
					name="email"
					class="newsletter-band__input"
					placeholder="<?php esc_attr_e( 'Your email address', 'culinary' ); ?>"
					required
					autocomplete="email"
				>
				<button type="submit" class="btn btn--primary">
					<?php esc_html_e( 'Subscribe', 'culinary' ); ?>
				</button>
			</form>
		</div>
	</div>
</section>
