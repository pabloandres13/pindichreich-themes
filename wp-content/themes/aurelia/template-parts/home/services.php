<?php
defined( 'ABSPATH' ) || exit;
?>
<section class="au-section au-section--white">
	<div class="au-container">
		<div class="au-section-head au-section-head--center au-reveal">
			<?php aurelia_label( __( 'Unsere Leistungen', 'aurelia' ) ); ?>
			<h2><?php esc_html_e( 'Sanfte Begleitung für Körper und Geist', 'aurelia' ); ?></h2>
			<p class="au-section-head__intro"><?php esc_html_e( 'Vier Wege zu mehr Wohlbefinden — einzeln oder kombiniert, immer abgestimmt auf Sie.', 'aurelia' ); ?></p>
		</div>
		<div class="au-reveal">
			<?php
			echo do_shortcode(
				'[au_services]
				[au_service icon="salad" tone="green" title="' . esc_attr__( 'Ernährungsberatung', 'aurelia' ) . '" url="' . esc_url( home_url( '/leistungen/' ) ) . '"]' . esc_html__( 'Eine alltagstaugliche Ernährung, abgestimmt auf Ihre Ziele und Ihren Rhythmus.', 'aurelia' ) . '[/au_service]
				[au_service icon="wind" tone="blue" title="' . esc_attr__( 'Achtsamkeit & Stress', 'aurelia' ) . '" url="' . esc_url( home_url( '/leistungen/' ) ) . '"]' . esc_html__( 'Sanfte Übungen für mehr Ruhe, besseren Schlaf und einen klaren Kopf.', 'aurelia' ) . '[/au_service]
				[au_service icon="sprout" tone="green" title="' . esc_attr__( 'Naturheilkunde', 'aurelia' ) . '" url="' . esc_url( home_url( '/leistungen/' ) ) . '"]' . esc_html__( 'Ganzheitliche Begleitung mit Methoden aus der Erfahrungsheilkunde.', 'aurelia' ) . '[/au_service]
				[au_service icon="hand-heart" tone="blue" title="' . esc_attr__( 'Gesundheitscoaching', 'aurelia' ) . '" url="' . esc_url( home_url( '/leistungen/' ) ) . '"]' . esc_html__( 'Gemeinsam Gewohnheiten entwickeln, die im Alltag wirklich tragen.', 'aurelia' ) . '[/au_service]
				[/au_services]'
			);
			?>
		</div>
	</div>
</section>
