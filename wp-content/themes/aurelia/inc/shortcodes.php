<?php
defined( 'ABSPATH' ) || exit;

/* ============================================================
   Aurelia shortcodes — dynamic sections embeddable anywhere
   in page content, no PHP editing required.
   ============================================================ */

/**
 * [au_services] … [/au_services] — grid wrapper for service cards.
 */
function aurelia_shortcode_services( array $atts, string $content = '' ): string {
	return '<div class="au-grid">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'au_services', 'aurelia_shortcode_services' );

/**
 * [au_service icon="salad" tone="green" title="Ernährungsberatung" url="/leistungen/" cta="Mehr erfahren"]Kurztext[/au_service]
 */
function aurelia_shortcode_service( array $atts, string $content = '' ): string {
	$atts = shortcode_atts( [
		'icon'  => 'leaf',
		'tone'  => 'green',
		'title' => '',
		'url'   => '#',
		'cta'   => __( 'Mehr erfahren', 'aurelia' ),
	], $atts, 'au_service' );

	$tone_class = in_array( $atts['tone'], [ 'blue', 'sand' ], true ) ? ' au-medallion--' . $atts['tone'] : '';

	return sprintf(
		'<article class="au-service-card">
			<span class="au-medallion%1$s">%2$s</span>
			<h3 class="au-service-card__title">%3$s</h3>
			<p class="au-service-card__text">%4$s</p>
			<a class="au-service-card__cta" href="%5$s">%6$s %7$s</a>
		</article>',
		esc_attr( $tone_class ),
		aurelia_icon( $atts['icon'], 24 ),
		esc_html( $atts['title'] ),
		esc_html( wp_strip_all_tags( $content ) ),
		esc_url( $atts['url'] ),
		esc_html( $atts['cta'] ),
		aurelia_icon( 'arrow-right', 16 )
	);
}
add_shortcode( 'au_service', 'aurelia_shortcode_service' );

/**
 * [au_posts_grid count="3" category=""] — latest Magazin articles.
 */
function aurelia_shortcode_posts_grid( array $atts ): string {
	$atts = shortcode_atts( [
		'count'    => 3,
		'category' => '',
	], $atts, 'au_posts_grid' );

	$args = [
		'post_type'      => 'post',
		'posts_per_page' => (int) $atts['count'],
		'post_status'    => 'publish',
	];
	if ( $atts['category'] ) {
		$args['category_name'] = sanitize_text_field( $atts['category'] );
	}
	$query = new WP_Query( $args );

	ob_start();
	if ( $query->have_posts() ) :
		echo '<div class="au-grid au-grid--wide">';
		while ( $query->have_posts() ) :
			$query->the_post();
			aurelia_article_card( get_the_ID() );
		endwhile;
		echo '</div>';
		wp_reset_postdata();
	endif;
	return ob_get_clean();
}
add_shortcode( 'au_posts_grid', 'aurelia_shortcode_posts_grid' );

/**
 * Render one article card for a post (used by archive, shortcode, related posts).
 */
function aurelia_article_card( int $post_id ): void {
	$cats     = get_the_category( $post_id );
	$cat      = $cats ? $cats[0] : null;
	$tones    = [ 'green', 'blue', 'sand' ];
	$tone     = $cat ? $tones[ $cat->term_id % 3 ] : 'green';
	$media    = 'blue' === $tone ? ' au-article-card__media--blue' : ( 'sand' === $tone ? ' au-article-card__media--sand' : '' );
	$badge    = 'green' === $tone ? '' : ' au-badge--' . $tone;
	$readtime = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) ) / 200 ) );
	?>
	<a class="au-article-card" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
		<div class="au-article-card__media<?php echo esc_attr( $media ); ?>">
			<?php
			if ( has_post_thumbnail( $post_id ) ) {
				echo get_the_post_thumbnail( $post_id, 'medium_large' );
			} else {
				echo aurelia_icon( 'leaf', 34 ); // phpcs:ignore
			}
			?>
		</div>
		<div class="au-article-card__body">
			<?php if ( $cat ) : ?>
				<span><span class="au-badge<?php echo esc_attr( $badge ); ?>"><?php echo esc_html( $cat->name ); ?></span></span>
			<?php endif; ?>
			<h3 class="au-article-card__title"><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>
			<p class="au-article-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $post_id ), 18 ) ); ?></p>
			<span class="au-article-card__meta">
				<?php
				printf(
					/* translators: 1: reading time in minutes, 2: date */
					esc_html__( '%1$d Min. Lesezeit · %2$s', 'aurelia' ),
					(int) $readtime,
					esc_html( get_the_date( 'j. M Y', $post_id ) )
				);
				?>
			</span>
		</div>
	</a>
	<?php
}

/**
 * [au_topics] — category filter chips (Magazin).
 */
function aurelia_shortcode_topics(): string {
	$cats = get_categories( [ 'hide_empty' => true ] );
	if ( ! $cats ) {
		return '';
	}
	$out  = '<div class="au-archive__filters">';
	$out .= '<a class="au-tag is-active" href="' . esc_url( home_url( '/magazin/' ) ) . '">' . esc_html__( 'Alle', 'aurelia' ) . '</a>';
	foreach ( $cats as $cat ) {
		$out .= '<a class="au-tag" href="' . esc_url( get_category_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a>';
	}
	return $out . '</div>';
}
add_shortcode( 'au_topics', 'aurelia_shortcode_topics' );

/**
 * [au_testimonials] … [/au_testimonials] — grid wrapper.
 */
function aurelia_shortcode_testimonials( array $atts, string $content = '' ): string {
	return '<div class="au-grid au-grid--wide">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'au_testimonials', 'aurelia_shortcode_testimonials' );

/**
 * [au_testimonial name="Sabine R." role="Klientin seit 2023" initials="SR" tone="white"]Zitat[/au_testimonial]
 */
function aurelia_shortcode_testimonial( array $atts, string $content = '' ): string {
	$atts = shortcode_atts( [
		'name'     => '',
		'role'     => '',
		'initials' => '',
		'tone'     => 'soft',
	], $atts, 'au_testimonial' );

	$tone_class = in_array( $atts['tone'], [ 'white', 'blue' ], true ) ? ' au-testimonial--' . $atts['tone'] : '';
	$initials   = $atts['initials'] ?: strtoupper( mb_substr( $atts['name'], 0, 2 ) );

	return sprintf(
		'<figure class="au-testimonial%1$s">
			<span class="au-testimonial__mark" aria-hidden="true">&ldquo;</span>
			<blockquote>%2$s</blockquote>
			<figcaption>
				<span class="au-avatar">%3$s</span>
				<span>
					<span class="au-testimonial__name">%4$s</span>
					<span class="au-testimonial__role">%5$s</span>
				</span>
			</figcaption>
		</figure>',
		esc_attr( $tone_class ),
		esc_html( wp_strip_all_tags( $content ) ),
		esc_html( $initials ),
		esc_html( $atts['name'] ),
		esc_html( $atts['role'] )
	);
}
add_shortcode( 'au_testimonial', 'aurelia_shortcode_testimonial' );

/**
 * [au_newsletter tone="green"] — newsletter band.
 */
function aurelia_shortcode_newsletter( array $atts ): string {
	$atts = shortcode_atts( [ 'tone' => 'green' ], $atts, 'au_newsletter' );
	ob_start();
	get_template_part( 'template-parts/home/newsletter', null, [ 'tone' => $atts['tone'] ] );
	return ob_get_clean();
}
add_shortcode( 'au_newsletter', 'aurelia_shortcode_newsletter' );

/**
 * [au_hinweis title="Hinweis" tone="info"]Text[/au_hinweis] — HWG-aware soft callout.
 * Tones: info (blue), note (green), sand.
 */
function aurelia_shortcode_hinweis( array $atts, string $content = '' ): string {
	$atts = shortcode_atts( [
		'title' => __( 'Hinweis', 'aurelia' ),
		'tone'  => 'info',
	], $atts, 'au_hinweis' );

	$tone_class = in_array( $atts['tone'], [ 'note', 'sand' ], true ) ? ' au-callout--' . $atts['tone'] : '';

	return sprintf(
		'<aside class="au-callout%1$s" role="note">
			<span class="au-callout__icon">%2$s</span>
			<div class="au-callout__content">
				<strong class="au-callout__title">%3$s</strong>
				%4$s
			</div>
		</aside>',
		esc_attr( $tone_class ),
		aurelia_icon( 'info', 17 ),
		esc_html( $atts['title'] ),
		wp_kses_post( wpautop( $content ) )
	);
}
add_shortcode( 'au_hinweis', 'aurelia_shortcode_hinweis' );

/**
 * [au_faq] … [/au_faq] + [au_faq_item frage="…"]Antwort[/au_faq_item] — soft accordion.
 */
function aurelia_shortcode_faq( array $atts, string $content = '' ): string {
	return '<div class="au-accordion">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'au_faq', 'aurelia_shortcode_faq' );

function aurelia_shortcode_faq_item( array $atts, string $content = '' ): string {
	$atts = shortcode_atts( [ 'frage' => '' ], $atts, 'au_faq_item' );
	return sprintf(
		'<details class="au-accordion__item">
			<summary>%1$s <span class="au-accordion__icon">%2$s</span></summary>
			<p class="au-accordion__body">%3$s</p>
		</details>',
		esc_html( $atts['frage'] ),
		aurelia_icon( 'plus', 14 ),
		esc_html( wp_strip_all_tags( $content ) )
	);
}
add_shortcode( 'au_faq_item', 'aurelia_shortcode_faq_item' );

/**
 * [au_trust items="Heilpraktikerin;Staatlich geprüft, seit 2015|Ernährungsberaterin;Zertifiziert · VFED e.V."]
 * Items separated by |, label and sub separated by ;
 */
function aurelia_shortcode_trust( array $atts ): string {
	$atts = shortcode_atts( [ 'items' => '' ], $atts, 'au_trust' );
	if ( ! $atts['items'] ) {
		return '';
	}
	$out = '<div class="au-trust">';
	foreach ( explode( '|', $atts['items'] ) as $item ) {
		$parts = array_map( 'trim', explode( ';', $item ) );
		$out  .= '<div class="au-trust__item"><span class="au-trust__label">' . esc_html( $parts[0] ) . '</span>';
		if ( ! empty( $parts[1] ) ) {
			$out .= '<span class="au-trust__sub">' . esc_html( $parts[1] ) . '</span>';
		}
		$out .= '</div>';
	}
	return $out . '</div>';
}
add_shortcode( 'au_trust', 'aurelia_shortcode_trust' );

/**
 * [au_steps] … [/au_steps] + [au_step nummer="1" titel="…"]Text[/au_step] — numbered step list.
 */
function aurelia_shortcode_steps( array $atts, string $content = '' ): string {
	return '<div class="au-steplist">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'au_steps', 'aurelia_shortcode_steps' );

function aurelia_shortcode_step( array $atts, string $content = '' ): string {
	$atts = shortcode_atts( [
		'nummer' => '1',
		'titel'  => '',
	], $atts, 'au_step' );
	return sprintf(
		'<div class="au-steplist__item">
			<span class="au-steplist__num">%1$s</span>
			<div><strong>%2$s</strong><p>%3$s</p></div>
		</div>',
		esc_html( $atts['nummer'] ),
		esc_html( $atts['titel'] ),
		esc_html( wp_strip_all_tags( $content ) )
	);
}
add_shortcode( 'au_step', 'aurelia_shortcode_step' );

/**
 * [au_kontakt_info] — "Direkt erreichen" card from Customizer settings.
 */
function aurelia_shortcode_kontakt_info(): string {
	$phone   = get_theme_mod( 'aurelia_phone', '+49 30 1234 567' );
	$email   = get_theme_mod( 'aurelia_email', 'hallo@aurelia-praxis.de' );
	$address = get_theme_mod( 'aurelia_address', 'Lindenstraße 12, 10115 Berlin' );

	$rows = [
		[ 'phone', $phone ],
		[ 'mail', antispambot( $email ) ],
		[ 'map-pin', $address ],
	];

	$out = '<div class="au-card au-card--green"><h3>' . esc_html__( 'Direkt erreichen', 'aurelia' ) . '</h3>';
	foreach ( $rows as [ $icon, $value ] ) {
		$out .= '<div class="au-info-row">' . aurelia_icon( $icon, 18 ) . '<span class="au-info-row__key">' . esc_html( $value ) . '</span></div>';
	}
	return $out . '</div>';
}
add_shortcode( 'au_kontakt_info', 'aurelia_shortcode_kontakt_info' );

/**
 * [au_oeffnungszeiten] — opening hours card from Customizer.
 * Setting format: "Mo – Do;09:00 – 18:00|Freitag;09:00 – 14:00"
 */
function aurelia_shortcode_hours(): string {
	$hours = get_theme_mod( 'aurelia_hours', 'Mo – Do;09:00 – 18:00|Freitag;09:00 – 14:00|Sa – So;Geschlossen' );

	$out = '<div class="au-card"><h3>' . esc_html__( 'Öffnungszeiten', 'aurelia' ) . '</h3>';
	foreach ( explode( '|', $hours ) as $row ) {
		$parts = array_map( 'trim', explode( ';', $row ) );
		$out  .= '<div class="au-info-row"><span class="au-info-row__key">' . esc_html( $parts[0] ) . '</span><span class="au-info-row__val">' . esc_html( $parts[1] ?? '' ) . '</span></div>';
	}
	return $out . '</div>';
}
add_shortcode( 'au_oeffnungszeiten', 'aurelia_shortcode_hours' );

/**
 * [au_kontakt_form] — DSGVO-compliant contact/booking form
 * (consent checkbox, HTTPS note, success state — handled in theme.js).
 */
function aurelia_shortcode_kontakt_form(): string {
	ob_start();
	?>
	<div class="au-card">
		<form id="au-contact-form" class="au-stack" method="post" action="">
			<div class="au-form-grid">
				<div class="au-field">
					<label for="au-f-name"><?php esc_html_e( 'Name', 'aurelia' ); ?> <span class="required">*</span></label>
					<input id="au-f-name" name="name" type="text" placeholder="<?php esc_attr_e( 'Ihr Name', 'aurelia' ); ?>" required>
				</div>
				<div class="au-field">
					<label for="au-f-email"><?php esc_html_e( 'E-Mail', 'aurelia' ); ?> <span class="required">*</span></label>
					<input id="au-f-email" name="email" type="email" placeholder="name@beispiel.de" required>
				</div>
			</div>
			<div class="au-form-grid" style="margin-top:1.1rem">
				<div class="au-field">
					<label for="au-f-phone"><?php esc_html_e( 'Telefon (optional)', 'aurelia' ); ?></label>
					<input id="au-f-phone" name="phone" type="tel" placeholder="+49 …">
				</div>
				<div class="au-field">
					<label for="au-f-topic"><?php esc_html_e( 'Wunschthema', 'aurelia' ); ?></label>
					<input id="au-f-topic" name="topic" type="text" placeholder="<?php esc_attr_e( 'z. B. Ernährungsberatung', 'aurelia' ); ?>">
				</div>
			</div>
			<div class="au-field" style="margin-top:1.1rem">
				<label for="au-f-message"><?php esc_html_e( 'Ihre Nachricht', 'aurelia' ); ?> <span class="required">*</span></label>
				<textarea id="au-f-message" name="message" rows="5" placeholder="<?php esc_attr_e( 'Wie können wir Sie unterstützen?', 'aurelia' ); ?>" required></textarea>
			</div>
			<label class="au-check" style="margin-top:1.1rem">
				<input type="checkbox" id="au-consent" required>
				<span>
					<?php
					printf(
						/* translators: %s: link to Datenschutzerklärung */
						esc_html__( 'Ich habe die %s gelesen und stimme der Verarbeitung meiner Daten zur Bearbeitung meiner Anfrage zu.', 'aurelia' ),
						'<a href="' . esc_url( home_url( '/datenschutz/' ) ) . '">' . esc_html__( 'Datenschutzerklärung', 'aurelia' ) . '</a>'
					);
					?>
					<span class="required">*</span>
				</span>
			</label>
			<p class="au-form-note" style="margin:0.8rem 0 1.1rem">
				<?php echo aurelia_icon( 'lock', 14 ); // phpcs:ignore ?>
				<?php esc_html_e( 'Verschlüsselte Übertragung (HTTPS)', 'aurelia' ); ?>
			</p>
			<button type="submit" class="au-btn au-btn--primary au-btn--lg" disabled><?php esc_html_e( 'Nachricht senden', 'aurelia' ); ?></button>
		</form>
		<div id="au-contact-success" hidden style="text-align:center;padding:2rem 1rem">
			<span class="au-medallion" style="width:64px;height:64px;border-radius:50%"><?php echo aurelia_icon( 'check', 30 ); // phpcs:ignore ?></span>
			<h3 style="margin-top:1rem"><?php esc_html_e( 'Vielen Dank!', 'aurelia' ); ?></h3>
			<p style="color:var(--text-muted)"><?php esc_html_e( 'Ihre Nachricht ist bei uns eingegangen. Wir melden uns in Kürze.', 'aurelia' ); ?></p>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'au_kontakt_form', 'aurelia_shortcode_kontakt_form' );

/**
 * [au_button url="/kontakt/" label="Termin buchen" variante="primary" groesse="lg" icon="calendar-check"]
 */
function aurelia_shortcode_button( array $atts ): string {
	$atts = shortcode_atts( [
		'url'      => '#',
		'label'    => __( 'Termin buchen', 'aurelia' ),
		'variante' => 'primary',
		'groesse'  => '',
		'icon'     => '',
	], $atts, 'au_button' );

	$classes = 'au-btn au-btn--' . sanitize_html_class( $atts['variante'] );
	if ( $atts['groesse'] ) {
		$classes .= ' au-btn--' . sanitize_html_class( $atts['groesse'] );
	}

	return sprintf(
		'<a class="%1$s" href="%2$s">%3$s%4$s</a>',
		esc_attr( $classes ),
		esc_url( $atts['url'] ),
		$atts['icon'] ? aurelia_icon( $atts['icon'], 18 ) : '',
		esc_html( $atts['label'] )
	);
}
add_shortcode( 'au_button', 'aurelia_shortcode_button' );
