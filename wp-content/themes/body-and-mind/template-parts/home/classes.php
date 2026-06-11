<?php
defined( 'ABSPATH' ) || exit;

$classes = [
	[
		'img'    => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=800&q=80',
		'level'  => __( 'Alle Level', 'body-and-mind' ),
		'tone'   => 'sage',
		'title'  => __( 'Hatha Yoga', 'body-and-mind' ),
		'dur'    => '60 Min',
		'text'   => __( 'Ruhige, klare Haltungen mit Fokus auf Atmung und Ausrichtung — ideal zum Ankommen.', 'body-and-mind' ),
	],
	[
		'img'    => 'https://images.unsplash.com/photo-1545389336-cf090694435e?auto=format&fit=crop&w=800&q=80',
		'level'  => __( 'Mittel', 'body-and-mind' ),
		'tone'   => 'lavender',
		'title'  => __( 'Vinyasa Flow', 'body-and-mind' ),
		'dur'    => '60 Min',
		'text'   => __( 'Fließende Bewegung im Rhythmus des Atems, für Kraft und Beweglichkeit.', 'body-and-mind' ),
	],
	[
		'img'    => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=800&q=80',
		'level'  => __( 'Anfänger', 'body-and-mind' ),
		'tone'   => 'lavender',
		'title'  => __( 'Meditation', 'body-and-mind' ),
		'dur'    => '45 Min',
		'text'   => __( 'Geführte Stille, um den Kopf frei und den Atem ruhig werden zu lassen.', 'body-and-mind' ),
	],
	[
		'img'    => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=800&q=80',
		'level'  => __( 'Individuell', 'body-and-mind' ),
		'tone'   => 'honey',
		'title'  => __( 'Personal Training', 'body-and-mind' ),
		'dur'    => '50 Min',
		'text'   => __( 'Kraft und Beweglichkeit, abgestimmt auf dein Tempo und deine Ziele.', 'body-and-mind' ),
	],
];
?>
<section class="bm-section bm-section--white">
	<div class="bm-container">

		<div class="bm-section-flex-head">
			<div class="bm-section-head">
				<span class="bm-eyebrow"><?php esc_html_e( 'Kurse & Angebote', 'body-and-mind' ); ?></span>
				<h2 class="bm-section-title"><?php esc_html_e( 'Finde, was dir guttut', 'body-and-mind' ); ?></h2>
				<p class="bm-section-head__text"><?php esc_html_e( 'Drei Wege, bei dir anzukommen — einzeln buchbar oder kombiniert.', 'body-and-mind' ); ?></p>
			</div>
			<a href="<?php echo esc_url( home_url( '/kurse/' ) ); ?>" class="bm-btn bm-btn--ghost">
				<?php esc_html_e( 'Alle Angebote', 'body-and-mind' ); ?>
				<?php echo bm_icon( 'arrow-right', 18 ); // phpcs:ignore ?>
			</a>
		</div>

		<div class="bm-class-grid">
			<?php foreach ( $classes as $c ) : ?>
				<article class="bm-class-card bm-reveal">
					<div class="bm-class-card__image">
						<img src="<?php echo esc_url( $c['img'] ); ?>" alt="<?php echo esc_attr( $c['title'] ); ?>" loading="lazy" decoding="async">
						<div class="bm-class-card__badge">
							<?php bm_badge( $c['level'], $c['tone'] ); ?>
						</div>
					</div>
					<div class="bm-class-card__body">
						<div class="bm-class-card__header">
							<h3 class="bm-class-card__title"><?php echo esc_html( $c['title'] ); ?></h3>
							<span class="bm-class-card__duration"><?php echo esc_html( $c['dur'] ); ?></span>
						</div>
						<p class="bm-class-card__text"><?php echo esc_html( $c['text'] ); ?></p>
						<div style="margin-top:0.6rem">
							<a href="<?php echo esc_url( home_url( '/kurse/' ) ); ?>" class="bm-btn bm-btn--ghost bm-btn--sm">
								<?php esc_html_e( 'Mehr erfahren', 'body-and-mind' ); ?>
								<?php echo bm_icon( 'arrow-right', 16 ); // phpcs:ignore ?>
							</a>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

	</div>
</section>
