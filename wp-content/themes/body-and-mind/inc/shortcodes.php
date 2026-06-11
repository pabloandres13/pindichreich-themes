<?php
/**
 * Shortcodes for data-driven home sections.
 *
 * These power the block patterns (see inc/block-patterns.php): an editor drops
 * one of these into a page and it renders live WordPress data, falling back to
 * tasteful demo content when none exists yet — so a fresh install still looks
 * complete.
 *
 * @package body-and-mind
 */

defined( 'ABSPATH' ) || exit;

/**
 * Demo class/Angebot data, used when no `bm_class` posts exist yet.
 *
 * @return array<int,array<string,string>>
 */
function bm_demo_classes(): array {
	return [
		[
			'img'   => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=800&q=80',
			'level' => __( 'Alle Level', 'body-and-mind' ),
			'tone'  => 'sage',
			'title' => __( 'Hatha Yoga', 'body-and-mind' ),
			'dur'   => __( '60 Min', 'body-and-mind' ),
			'text'  => __( 'Ruhige, klare Haltungen mit Fokus auf Atmung und Ausrichtung — ideal zum Ankommen.', 'body-and-mind' ),
		],
		[
			'img'   => 'https://images.unsplash.com/photo-1545389336-cf090694435e?auto=format&fit=crop&w=800&q=80',
			'level' => __( 'Mittel', 'body-and-mind' ),
			'tone'  => 'lavender',
			'title' => __( 'Vinyasa Flow', 'body-and-mind' ),
			'dur'   => __( '60 Min', 'body-and-mind' ),
			'text'  => __( 'Fließende Bewegung im Rhythmus des Atems, für Kraft und Beweglichkeit.', 'body-and-mind' ),
		],
		[
			'img'   => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=800&q=80',
			'level' => __( 'Anfänger', 'body-and-mind' ),
			'tone'  => 'lavender',
			'title' => __( 'Meditation', 'body-and-mind' ),
			'dur'   => __( '45 Min', 'body-and-mind' ),
			'text'  => __( 'Geführte Stille, um den Kopf frei und den Atem ruhig werden zu lassen.', 'body-and-mind' ),
		],
		[
			'img'   => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=800&q=80',
			'level' => __( 'Individuell', 'body-and-mind' ),
			'tone'  => 'honey',
			'title' => __( 'Personal Training', 'body-and-mind' ),
			'dur'   => __( '50 Min', 'body-and-mind' ),
			'text'  => __( 'Kraft und Beweglichkeit, abgestimmt auf dein Tempo und deine Ziele.', 'body-and-mind' ),
		],
	];
}

/**
 * Render a single class card.
 *
 * @param array<string,string> $c        Card data.
 * @param string               $permalink Link target.
 */
function bm_render_class_card( array $c, string $permalink ): string {
	ob_start();
	?>
	<article class="bm-class-card bm-reveal">
		<div class="bm-class-card__image">
			<img src="<?php echo esc_url( $c['img'] ); ?>" alt="<?php echo esc_attr( $c['title'] ); ?>" loading="lazy" decoding="async">
			<?php if ( ! empty( $c['level'] ) ) : ?>
				<div class="bm-class-card__badge"><?php bm_badge( $c['level'], $c['tone'] ?? 'sage' ); ?></div>
			<?php endif; ?>
		</div>
		<div class="bm-class-card__body">
			<div class="bm-class-card__header">
				<h3 class="bm-class-card__title"><?php echo esc_html( $c['title'] ); ?></h3>
				<?php if ( ! empty( $c['dur'] ) ) : ?>
					<span class="bm-class-card__duration"><?php echo esc_html( $c['dur'] ); ?></span>
				<?php endif; ?>
			</div>
			<p class="bm-class-card__text"><?php echo esc_html( $c['text'] ); ?></p>
			<div style="margin-top:0.6rem">
				<a href="<?php echo esc_url( $permalink ); ?>" class="bm-btn bm-btn--ghost bm-btn--sm">
					<?php esc_html_e( 'Mehr erfahren', 'body-and-mind' ); ?>
					<?php echo bm_icon( 'arrow-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			</div>
		</div>
	</article>
	<?php
	return (string) ob_get_clean();
}

/**
 * [bm_classes count="4"] — class/Angebot cards from the `bm_class` CPT,
 * with demo fallback.
 */
function bm_shortcode_classes( array $atts ): string {
	$atts  = shortcode_atts( [ 'count' => 4 ], $atts, 'bm_classes' );
	$count = max( 1, (int) $atts['count'] );

	$query = new WP_Query( [
		'post_type'              => 'bm_class',
		'posts_per_page'         => $count,
		'post_status'            => 'publish',
		'no_found_rows'          => true,
		'update_post_meta_cache' => true,
		'ignore_sticky_posts'    => true,
	] );

	ob_start();
	echo '<div class="bm-class-grid">';

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			echo bm_render_class_card( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				[
					'img'   => get_the_post_thumbnail_url( get_the_ID(), 'large' ) ?: '',
					'level' => (string) get_post_meta( get_the_ID(), 'bm_level', true ),
					'tone'  => (string) ( get_post_meta( get_the_ID(), 'bm_level_tone', true ) ?: 'sage' ),
					'title' => get_the_title(),
					'dur'   => (string) get_post_meta( get_the_ID(), 'bm_duration', true ),
					'text'  => wp_strip_all_tags( get_the_excerpt() ),
				],
				get_permalink()
			);
		}
		wp_reset_postdata();
	} else {
		foreach ( array_slice( bm_demo_classes(), 0, $count ) as $c ) {
			echo bm_render_class_card( $c, home_url( '/kurse/' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	echo '</div>';
	return (string) ob_get_clean();
}
add_shortcode( 'bm_classes', 'bm_shortcode_classes' );

/**
 * [bm_schedule count="3"] — a short Stundenplan preview.
 *
 * Renders demo rows; wire to a booking plugin or `bm_class` schedule meta in
 * production. The full weekly plan lives on the Stundenplan page.
 */
function bm_shortcode_schedule( array $atts ): string {
	$atts  = shortcode_atts( [ 'count' => 3 ], $atts, 'bm_schedule' );
	$count = max( 1, (int) $atts['count'] );

	$rows = [
		[ 'time' => '09:00', 'end' => '10:00', 'title' => __( 'Hatha Yoga', 'body-and-mind' ),   'level' => __( 'Alle Level', 'body-and-mind' ), 'tone' => 'sage',     'instructor' => 'Lena', 'room' => 'Studio 1',  'spots' => 6 ],
		[ 'time' => '12:15', 'end' => '13:00', 'title' => __( 'Meditation', 'body-and-mind' ),   'level' => __( 'Anfänger', 'body-and-mind' ),   'tone' => 'lavender', 'instructor' => 'Mara', 'room' => 'Ruheraum', 'spots' => 2 ],
		[ 'time' => '18:30', 'end' => '19:30', 'title' => __( 'Vinyasa Flow', 'body-and-mind' ), 'level' => __( 'Mittel', 'body-and-mind' ),     'tone' => 'lavender', 'instructor' => 'Lena', 'room' => 'Studio 1',  'spots' => 9 ],
	];

	$kontakt = home_url( '/kontakt/' );

	ob_start();
	echo '<div class="bm-schedule-list">';
	foreach ( array_slice( $rows, 0, $count ) as $s ) :
		?>
		<div class="bm-schedule-row bm-reveal">
			<div class="bm-schedule-row__time">
				<div class="bm-schedule-row__time-start"><?php echo esc_html( $s['time'] ); ?></div>
				<div class="bm-schedule-row__time-end">– <?php echo esc_html( $s['end'] ); ?></div>
			</div>
			<div class="bm-schedule-row__info">
				<div style="display:flex;align-items:center;gap:0.6rem;flex-wrap:wrap">
					<span class="bm-schedule-row__title"><?php echo esc_html( $s['title'] ); ?></span>
					<?php bm_badge( $s['level'], $s['tone'] ); ?>
				</div>
				<div class="bm-schedule-row__meta">
					<?php echo esc_html( $s['instructor'] ); ?> · <?php echo esc_html( $s['room'] ); ?>
				</div>
			</div>
			<div class="bm-schedule-row__action">
				<?php if ( $s['spots'] <= 2 ) : ?>
					<span class="bm-schedule-row__spots bm-schedule-row__spots--urgent">
						<?php printf( esc_html__( 'Nur noch %d Plätze', 'body-and-mind' ), (int) $s['spots'] ); ?>
					</span>
				<?php else : ?>
					<span class="bm-schedule-row__spots">
						<?php printf( esc_html__( '%d Plätze frei', 'body-and-mind' ), (int) $s['spots'] ); ?>
					</span>
				<?php endif; ?>
				<a href="<?php echo esc_url( $kontakt ); ?>" class="bm-btn bm-btn--secondary bm-btn--sm">
					<?php esc_html_e( 'Buchen', 'body-and-mind' ); ?>
				</a>
			</div>
		</div>
		<?php
	endforeach;
	echo '</div>';
	return (string) ob_get_clean();
}
add_shortcode( 'bm_schedule', 'bm_shortcode_schedule' );

/**
 * [bm_magazine count="3"] — latest posts as article cards, demo fallback.
 */
function bm_shortcode_magazine( array $atts ): string {
	$atts  = shortcode_atts( [ 'count' => 3 ], $atts, 'bm_magazine' );
	$count = max( 1, (int) $atts['count'] );

	$posts = get_posts( [
		'numberposts'         => $count,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
	] );

	if ( $posts ) {
		$articles = [];
		foreach ( $posts as $post ) {
			$cats       = get_the_category( $post->ID );
			$articles[] = [
				'cat'   => $cats ? $cats[0]->name : '',
				'title' => get_the_title( $post ),
				'img'   => get_the_post_thumbnail_url( $post->ID, 'medium_large' ) ?: '',
				'link'  => get_permalink( $post ),
			];
		}
	} else {
		$mag  = home_url( '/magazin/' );
		$articles = [
			[ 'cat' => __( 'Achtsamkeit', 'body-and-mind' ), 'title' => __( '5 Minuten Atempause für den Alltag', 'body-and-mind' ),    'img' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=700&q=80', 'link' => $mag ],
			[ 'cat' => __( 'Yoga', 'body-and-mind' ),        'title' => __( 'Warum Yin Yoga gerade im Winter guttut', 'body-and-mind' ), 'img' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=700&q=80', 'link' => $mag ],
			[ 'cat' => __( 'Bewegung', 'body-and-mind' ),    'title' => __( 'Kraft sanft aufbauen — ohne Druck', 'body-and-mind' ),     'img' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=700&q=80', 'link' => $mag ],
		];
		$articles = array_slice( $articles, 0, $count );
	}

	ob_start();
	echo '<div class="bm-magazine-grid">';
	foreach ( $articles as $a ) :
		?>
		<article class="bm-article-card bm-reveal">
			<?php if ( ! empty( $a['img'] ) ) : ?>
				<div class="bm-article-card__image">
					<a href="<?php echo esc_url( $a['link'] ); ?>" aria-hidden="true" tabindex="-1">
						<img src="<?php echo esc_url( $a['img'] ); ?>" alt="" loading="lazy" decoding="async">
					</a>
				</div>
			<?php endif; ?>
			<div class="bm-article-card__body">
				<?php if ( ! empty( $a['cat'] ) ) : ?>
					<div class="bm-article-card__cat"><?php echo esc_html( $a['cat'] ); ?></div>
				<?php endif; ?>
				<h3 class="bm-article-card__title">
					<a href="<?php echo esc_url( $a['link'] ); ?>" style="color:inherit;text-decoration:none"><?php echo esc_html( $a['title'] ); ?></a>
				</h3>
			</div>
		</article>
		<?php
	endforeach;
	echo '</div>';
	return (string) ob_get_clean();
}
add_shortcode( 'bm_magazine', 'bm_shortcode_magazine' );

/**
 * [bm_newsletter] — newsletter band with DSGVO consent.
 * Form target comes from Customizer (bm_newsletter_url).
 */
function bm_shortcode_newsletter(): string {
	$form_url   = get_theme_mod( 'bm_newsletter_url', '#' );
	$privacy    = home_url( '/datenschutz/' );

	ob_start();
	?>
	<div class="bm-newsletter bm-reveal">
		<div>
			<div class="bm-newsletter__eyebrow"><?php esc_html_e( 'Newsletter', 'body-and-mind' ); ?></div>
			<h2 class="bm-newsletter__title"><?php esc_html_e( 'Bleib in Verbindung', 'body-and-mind' ); ?></h2>
			<p class="bm-newsletter__text">
				<?php esc_html_e( 'Sanfte Impulse, neue Kurse und Termine — etwa einmal im Monat in dein Postfach.', 'body-and-mind' ); ?>
			</p>
		</div>
		<form action="<?php echo esc_url( $form_url ); ?>" method="post" class="bm-newsletter__form">
			<div class="bm-newsletter__row">
				<input type="email" name="email" required placeholder="<?php esc_attr_e( 'deine@email.de', 'body-and-mind' ); ?>" class="bm-newsletter__input" aria-label="<?php esc_attr_e( 'E-Mail-Adresse', 'body-and-mind' ); ?>">
				<button type="submit" class="bm-btn bm-btn--primary"><?php esc_html_e( 'Abonnieren', 'body-and-mind' ); ?></button>
			</div>
			<div style="text-align:left">
				<label class="bm-checkbox-wrap">
					<input type="checkbox" name="consent" required>
					<span class="bm-checkbox-label">
						<?php
						printf(
							/* translators: %s: link to Datenschutzerklärung */
							esc_html__( 'Ich möchte den Newsletter erhalten und stimme der %s zu. Abmeldung jederzeit möglich.', 'body-and-mind' ),
							'<a href="' . esc_url( $privacy ) . '" style="color:var(--accent-text)">' . esc_html__( 'Datenschutzerklärung', 'body-and-mind' ) . '</a>'
						);
						?>
					</span>
				</label>
			</div>
		</form>
	</div>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'bm_newsletter', 'bm_shortcode_newsletter' );
