<?php
defined( 'ABSPATH' ) || exit;

$tone       = $args['tone'] ?? 'green';
$tone_class = in_array( $tone, [ 'blue', 'sand', 'dark' ], true ) ? ' au-newsletter--' . $tone : '';
$action     = get_theme_mod( 'aurelia_newsletter_url', '#' );
$btn_class  = 'dark' === $tone ? 'au-btn au-btn--accent' : 'au-btn au-btn--primary';
?>
<section class="au-newsletter<?php echo esc_attr( $tone_class ); ?>">
	<div class="au-newsletter__inner">
		<div class="au-newsletter__copy">
			<?php aurelia_label( __( 'Newsletter', 'aurelia' ), false ); ?>
			<h2><?php esc_html_e( 'Impulse für ein gesundes, ruhiges Leben', 'aurelia' ); ?></h2>
			<p><?php esc_html_e( 'Alle zwei Wochen sanfte Anregungen zu Ernährung, Achtsamkeit und Naturheilkunde — kostenlos und jederzeit abbestellbar.', 'aurelia' ); ?></p>
		</div>
		<form class="au-newsletter__form" method="post" action="<?php echo esc_url( $action ); ?>">
			<input type="email" name="email" placeholder="<?php esc_attr_e( 'Ihre E-Mail-Adresse', 'aurelia' ); ?>" aria-label="<?php esc_attr_e( 'E-Mail-Adresse', 'aurelia' ); ?>" required>
			<button type="submit" class="<?php echo esc_attr( $btn_class ); ?>"><?php esc_html_e( 'Abonnieren', 'aurelia' ); ?></button>
		</form>
	</div>
</section>
