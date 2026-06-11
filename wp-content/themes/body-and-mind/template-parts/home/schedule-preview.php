<?php
defined( 'ABSPATH' ) || exit;

$schedule = [
	[
		'time'      => '09:00',
		'end_time'  => '10:00',
		'title'     => __( 'Hatha Yoga', 'body-and-mind' ),
		'level'     => __( 'Alle Level', 'body-and-mind' ),
		'tone'      => 'sage',
		'instructor'=> 'Lena',
		'room'      => 'Studio 1',
		'spots'     => 6,
		'full'      => false,
	],
	[
		'time'      => '12:15',
		'end_time'  => '13:00',
		'title'     => __( 'Meditation', 'body-and-mind' ),
		'level'     => __( 'Anfänger', 'body-and-mind' ),
		'tone'      => 'lavender',
		'instructor'=> 'Mara',
		'room'      => 'Ruheraum',
		'spots'     => 2,
		'full'      => false,
	],
	[
		'time'      => '18:30',
		'end_time'  => '19:30',
		'title'     => __( 'Vinyasa Flow', 'body-and-mind' ),
		'level'     => __( 'Mittel', 'body-and-mind' ),
		'tone'      => 'lavender',
		'instructor'=> 'Lena',
		'room'      => 'Studio 1',
		'spots'     => 9,
		'full'      => false,
	],
];
?>
<section class="bm-section bm-section--white">
	<div class="bm-container">

		<div class="bm-section-flex-head">
			<div class="bm-section-head">
				<span class="bm-eyebrow"><?php esc_html_e( 'Stundenplan', 'body-and-mind' ); ?></span>
				<h2 class="bm-section-title"><?php esc_html_e( 'Diese Woche im Studio', 'body-and-mind' ); ?></h2>
			</div>
			<a href="<?php echo esc_url( home_url( '/stundenplan/' ) ); ?>" class="bm-btn bm-btn--ghost">
				<?php esc_html_e( 'Ganzer Stundenplan', 'body-and-mind' ); ?>
				<?php echo bm_icon( 'arrow-right', 18 ); // phpcs:ignore ?>
			</a>
		</div>

		<div class="bm-schedule-list">
			<?php foreach ( $schedule as $s ) : ?>
				<div class="bm-schedule-row bm-reveal">
					<div class="bm-schedule-row__time">
						<div class="bm-schedule-row__time-start"><?php echo esc_html( $s['time'] ); ?></div>
						<div class="bm-schedule-row__time-end">– <?php echo esc_html( $s['end_time'] ); ?></div>
					</div>
					<div class="bm-schedule-row__info">
						<div style="display:flex;align-items:center;gap:0.6rem;flex-wrap:wrap">
							<span class="bm-schedule-row__title"><?php echo esc_html( $s['title'] ); ?></span>
							<?php bm_badge( $s['level'], $s['tone'] ); ?>
						</div>
						<div class="bm-schedule-row__meta">
							<?php echo esc_html( $s['instructor'] ); ?>
							<?php if ( $s['room'] ) : ?>
								· <?php echo esc_html( $s['room'] ); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="bm-schedule-row__action">
						<?php if ( $s['full'] ) : ?>
							<span class="bm-schedule-row__full"><?php esc_html_e( 'Ausgebucht', 'body-and-mind' ); ?></span>
						<?php else : ?>
							<?php if ( $s['spots'] <= 2 ) : ?>
								<span class="bm-schedule-row__spots bm-schedule-row__spots--urgent">
									<?php
									printf(
										/* translators: %d: spots remaining */
										esc_html__( 'Nur noch %d Plätze', 'body-and-mind' ),
										(int) $s['spots']
									);
									?>
								</span>
							<?php else : ?>
								<span class="bm-schedule-row__spots">
									<?php
									printf(
										/* translators: %d: spots remaining */
										esc_html__( '%d Plätze frei', 'body-and-mind' ),
										(int) $s['spots']
									);
									?>
								</span>
							<?php endif; ?>
							<a href="<?php echo esc_url( home_url( '/kontakt/' ) ); ?>" class="bm-btn bm-btn--secondary bm-btn--sm">
								<?php esc_html_e( 'Buchen', 'body-and-mind' ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
