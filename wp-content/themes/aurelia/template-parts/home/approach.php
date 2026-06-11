<?php
defined( 'ABSPATH' ) || exit;

$aurelia_steps = [
	[
		'num'   => '01',
		'icon'  => 'messages-square',
		'title' => __( 'Kennenlernen', 'aurelia' ),
		'text'  => __( 'Ein erstes, unverbindliches Gespräch — wir hören zu und verstehen Ihr Anliegen.', 'aurelia' ),
	],
	[
		'num'   => '02',
		'icon'  => 'route',
		'title' => __( 'Ihr Weg', 'aurelia' ),
		'text'  => __( 'Gemeinsam entwickeln wir einen Plan, der zu Ihrem Alltag und Ihren Zielen passt.', 'aurelia' ),
	],
	[
		'num'   => '03',
		'icon'  => 'sprout',
		'title' => __( 'Begleitung', 'aurelia' ),
		'text'  => __( 'Wir gehen den Weg mit Ihnen — in Ihrem Tempo, mit Raum für Anpassungen.', 'aurelia' ),
	],
];
?>
<section class="au-section au-section--white">
	<div class="au-container">
		<div class="au-section-head au-section-head--center au-reveal">
			<?php aurelia_label( __( 'So arbeiten wir', 'aurelia' ) ); ?>
			<h2><?php esc_html_e( 'In drei ruhigen Schritten', 'aurelia' ); ?></h2>
		</div>
		<div class="au-grid au-grid--steps au-reveal">
			<?php foreach ( $aurelia_steps as $step ) : ?>
				<div class="au-step">
					<div class="au-step__head">
						<span class="au-step__icon"><?php echo aurelia_icon( $step['icon'], 22 ); // phpcs:ignore ?></span>
						<span class="au-step__num"><?php echo esc_html( $step['num'] ); ?></span>
					</div>
					<h3><?php echo esc_html( $step['title'] ); ?></h3>
					<p><?php echo esc_html( $step['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
