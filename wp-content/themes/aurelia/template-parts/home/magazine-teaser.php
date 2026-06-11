<?php
defined( 'ABSPATH' ) || exit;
?>
<section class="au-section au-section--white">
	<div class="au-container">
		<div class="au-reveal" style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:1rem;margin-bottom:var(--space-7)">
			<div>
				<?php aurelia_label( __( 'Magazin', 'aurelia' ) ); ?>
				<h2 style="margin:0.8rem 0 0"><?php esc_html_e( 'Impulse für ein gesundes Leben', 'aurelia' ); ?></h2>
			</div>
			<a class="au-btn au-btn--secondary" href="<?php echo esc_url( home_url( '/magazin/' ) ); ?>"><?php esc_html_e( 'Alle Artikel', 'aurelia' ); ?></a>
		</div>
		<div class="au-reveal">
			<?php echo do_shortcode( '[au_posts_grid count="3"]' ); ?>
		</div>
	</div>
</section>
