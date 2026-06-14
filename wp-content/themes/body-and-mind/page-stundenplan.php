<?php
/**
 * Template Name: Stundenplan
 *
 * Auto-applies to a page with the slug "stundenplan"; also selectable via
 * Page Attributes → Template. Demo timetable — in production wrap a booking
 * plugin's output or drive it from `bm_class` schedule meta. Day tabs are
 * progressively enhanced by assets/js/theme.js (.bm-day-tab / .bm-day-pane).
 *
 * @package body-and-mind
 */

defined( 'ABSPATH' ) || exit;

get_header();

$kontakt = get_page_by_path( 'kontakt' );
$kontakt = $kontakt ? get_permalink( $kontakt ) : home_url( '/kontakt/' );

$day_names = [
	'Mo' => __( 'Montag', 'body-and-mind' ),
	'Di' => __( 'Dienstag', 'body-and-mind' ),
	'Mi' => __( 'Mittwoch', 'body-and-mind' ),
	'Do' => __( 'Donnerstag', 'body-and-mind' ),
	'Fr' => __( 'Freitag', 'body-and-mind' ),
	'Sa' => __( 'Samstag', 'body-and-mind' ),
];

$by_day = [
	'Mo' => [
		[ '09:00', '10:00', __( 'Hatha Yoga', 'body-and-mind' ),   __( 'Alle Level', 'body-and-mind' ), 'sage',     'Lena', 'Studio 1',  6, false ],
		[ '12:15', '13:00', __( 'Meditation', 'body-and-mind' ),   __( 'Anfänger', 'body-and-mind' ),   'lavender', 'Mara', 'Ruheraum', 2, false ],
		[ '18:30', '19:30', __( 'Vinyasa Flow', 'body-and-mind' ), __( 'Mittel', 'body-and-mind' ),     'lavender', 'Lena', 'Studio 1',  9, false ],
	],
	'Di' => [
		[ '08:00', '08:50', __( 'Personal Training', 'body-and-mind' ), __( 'Individuell', 'body-and-mind' ), 'honey',    'Tom',  'Studio 2', 1, false ],
		[ '10:30', '11:30', __( 'Yin Yoga', 'body-and-mind' ),         __( 'Alle Level', 'body-and-mind' ),  'sage',     'Mara', 'Studio 1', 0, true ],
		[ '19:00', '20:00', __( 'Vinyasa Flow', 'body-and-mind' ),     __( 'Mittel', 'body-and-mind' ),      'lavender', 'Lena', 'Studio 1', 5, false ],
	],
	'Mi' => [
		[ '09:00', '10:00', __( 'Hatha Yoga', 'body-and-mind' ), __( 'Alle Level', 'body-and-mind' ), 'sage',     'Lena', 'Studio 1',  7, false ],
		[ '17:30', '18:15', __( 'Meditation', 'body-and-mind' ), __( 'Anfänger', 'body-and-mind' ),   'lavender', 'Mara', 'Ruheraum', 4, false ],
	],
	'Do' => [
		[ '08:00', '08:50', __( 'Personal Training', 'body-and-mind' ), __( 'Individuell', 'body-and-mind' ), 'honey',    'Tom',  'Studio 2', 2, false ],
		[ '18:30', '19:30', __( 'Vinyasa Flow', 'body-and-mind' ),     __( 'Mittel', 'body-and-mind' ),      'lavender', 'Lena', 'Studio 1', 8, false ],
	],
	'Fr' => [
		[ '09:00', '10:00', __( 'Yin Yoga', 'body-and-mind' ),  __( 'Alle Level', 'body-and-mind' ), 'sage', 'Mara', 'Studio 1', 6, false ],
		[ '17:00', '18:00', __( 'Hatha Yoga', 'body-and-mind' ), __( 'Alle Level', 'body-and-mind' ), 'sage', 'Lena', 'Studio 1', 3, false ],
	],
	'Sa' => [
		[ '10:00', '11:15', __( 'Vinyasa Flow', 'body-and-mind' ), __( 'Mittel', 'body-and-mind' ),   'lavender', 'Lena', 'Studio 1',  10, false ],
		[ '11:45', '12:30', __( 'Meditation', 'body-and-mind' ),   __( 'Anfänger', 'body-and-mind' ), 'lavender', 'Mara', 'Ruheraum', 9,  false ],
	],
];
?>

<section class="bm-page-hero bm-page-hero--sage">
	<div class="bm-container bm-container--narrow">
		<span class="bm-eyebrow"><?php esc_html_e( 'Stundenplan', 'body-and-mind' ); ?></span>
		<h1 class="bm-section-title"><?php esc_html_e( 'Deine Woche im Studio', 'body-and-mind' ); ?></h1>
		<p class="bm-section-head__text" style="margin-inline:auto">
			<?php esc_html_e( 'Wähle einen Tag und buche deinen Platz. Plätze sind begrenzt — sei gern früh dran.', 'body-and-mind' ); ?>
		</p>
	</div>
</section>

<section class="bm-section bm-section--white">
	<div class="bm-container">

		<div class="bm-day-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Wochentage', 'body-and-mind' ); ?>">
			<?php $first = true; foreach ( $day_names as $abbr => $full ) : ?>
				<button
					class="bm-day-tab<?php echo $first ? ' is-active' : ''; ?>"
					data-day="<?php echo esc_attr( $abbr ); ?>"
					role="tab"
					aria-selected="<?php echo $first ? 'true' : 'false'; ?>"
				><?php echo esc_html( $abbr ); ?></button>
				<?php $first = false; endforeach; ?>
		</div>

		<div style="max-width:820px;margin:0 auto">
			<?php $first = true; foreach ( $by_day as $abbr => $rows ) : ?>
				<div class="bm-day-pane" data-day="<?php echo esc_attr( $abbr ); ?>"<?php echo $first ? '' : ' hidden'; ?>>
					<h2 style="font-size:var(--text-xl);margin:0 0 1.25rem"><?php echo esc_html( $day_names[ $abbr ] ); ?></h2>
					<div class="bm-schedule-list">
						<?php foreach ( $rows as $r ) :
							list( $start, $end, $title, $level, $tone, $instructor, $room, $spots, $full ) = $r;
							?>
							<div class="bm-schedule-row">
								<div class="bm-schedule-row__time">
									<div class="bm-schedule-row__time-start"><?php echo esc_html( $start ); ?></div>
									<div class="bm-schedule-row__time-end">– <?php echo esc_html( $end ); ?></div>
								</div>
								<div class="bm-schedule-row__info">
									<div style="display:flex;align-items:center;gap:0.6rem;flex-wrap:wrap">
										<span class="bm-schedule-row__title"><?php echo esc_html( $title ); ?></span>
										<?php bm_badge( $level, $tone ); ?>
									</div>
									<div class="bm-schedule-row__meta"><?php echo esc_html( $instructor ); ?> · <?php echo esc_html( $room ); ?></div>
								</div>
								<div class="bm-schedule-row__action">
									<?php if ( $full ) : ?>
										<span class="bm-schedule-row__full"><?php esc_html_e( 'Ausgebucht', 'body-and-mind' ); ?></span>
									<?php else : ?>
										<?php if ( $spots <= 2 ) : ?>
											<span class="bm-schedule-row__spots bm-schedule-row__spots--urgent"><?php printf( esc_html__( 'Nur noch %d Plätze', 'body-and-mind' ), (int) $spots ); ?></span>
										<?php else : ?>
											<span class="bm-schedule-row__spots"><?php printf( esc_html__( '%d Plätze frei', 'body-and-mind' ), (int) $spots ); ?></span>
										<?php endif; ?>
										<a href="<?php echo esc_url( $kontakt ); ?>" class="bm-btn bm-btn--secondary bm-btn--sm"><?php esc_html_e( 'Buchen', 'body-and-mind' ); ?></a>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php $first = false; endforeach; ?>
		</div>

		<div style="text-align:center;margin-top:3rem">
			<p style="color:var(--text-muted);font-size:var(--text-sm);margin-bottom:1rem"><?php esc_html_e( 'Kein passender Termin dabei?', 'body-and-mind' ); ?></p>
			<a href="<?php echo esc_url( $kontakt ); ?>" class="bm-btn bm-btn--secondary"><?php esc_html_e( 'Termin anfragen', 'body-and-mind' ); ?></a>
		</div>

	</div>
</section>

<?php
get_footer();
