<?php
defined( 'ABSPATH' ) || exit;
?>
<section class="au-section au-section--blue">
	<div class="au-container">
		<div class="au-section-head au-section-head--center au-reveal">
			<?php aurelia_label( __( 'Stimmen', 'aurelia' ) ); ?>
			<h2><?php esc_html_e( 'Was unsere Klient:innen erleben', 'aurelia' ); ?></h2>
		</div>
		<div class="au-reveal">
			<?php
			echo do_shortcode(
				'[au_testimonials]
				[au_testimonial name="Sabine R." role="' . esc_attr__( 'Klientin seit 2023', 'aurelia' ) . '" initials="SR" tone="white"]' . esc_html__( 'Ich fühle mich endlich gehört und Schritt für Schritt gut begleitet. Kein Druck, nur echte Unterstützung.', 'aurelia' ) . '[/au_testimonial]
				[au_testimonial name="Markus T." role="' . esc_attr__( 'Ernährungsberatung', 'aurelia' ) . '" initials="MT" tone="white"]' . esc_html__( 'Die ruhige, fachliche Art hat mir geholfen, meine Ernährung dauerhaft umzustellen.', 'aurelia' ) . '[/au_testimonial]
				[au_testimonial name="Lena B." role="' . esc_attr__( 'Achtsamkeitskurs', 'aurelia' ) . '" initials="LB" tone="white"]' . esc_html__( 'Endlich ein Ort, an dem ich zur Ruhe komme. Die Atemübungen begleiten mich täglich.', 'aurelia' ) . '[/au_testimonial]
				[/au_testimonials]'
			);
			?>
		</div>
	</div>
</section>
