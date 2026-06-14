<?php
/**
 * Shortcodes for the data-driven / fixed-structure home sections.
 *
 * These power the block patterns (inc/block-patterns.php). An editor drops one
 * into a page and it renders live data where it makes sense (resources = latest
 * posts), falling back to tasteful demo content so a fresh install still looks
 * complete. Booking/opt-in targets come from the Customizer.
 *
 * @package maren-cole
 */

defined( 'ABSPATH' ) || exit;

/* ============================================================
   Trust strip — "as featured in" logos
   [mc_trust logos="Forbes, Inc., Fast Company, Harvard Business Review, TEDx"]
   ============================================================ */
function mc_shortcode_trust( array $atts ): string {
	$atts  = shortcode_atts( [
		'label' => __( 'As featured in', 'maren-cole' ),
		'logos' => 'Forbes, Inc., Fast Company, Harvard Business Review, TEDx',
	], $atts, 'mc_trust' );
	$logos = array_filter( array_map( 'trim', explode( ',', $atts['logos'] ) ) );

	ob_start();
	?>
	<div class="mc-trust mc-reveal">
		<span class="mc-trust__label"><?php echo esc_html( $atts['label'] ); ?></span>
		<div class="mc-trust__logos">
			<?php foreach ( $logos as $logo ) : ?>
				<span class="mc-trust__logo"><?php echo esc_html( $logo ); ?></span>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'mc_trust', 'mc_shortcode_trust' );

/* ============================================================
   Testimonials slider (dark band)
   ============================================================ */
function mc_demo_testimonials(): array {
	return [
		[
			'quote'  => __( 'Maren helped me <em>lead without losing myself</em>. I finally delegate like I mean it — and my team stepped up to meet me.', 'maren-cole' ),
			'result' => __( 'Promoted to VP in 6 months', 'maren-cole' ),
			'name'   => 'Daniela Ortiz',
			'role'   => __( 'VP Product, Northwind', 'maren-cole' ),
			'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=120&h=120&q=80',
		],
		[
			'quote'  => __( 'I came in burnt out and reactive. I left with a way of working I actually trust. <em>Best investment</em> I’ve made in myself.', 'maren-cole' ),
			'result' => __( 'Cut working hours by 30%', 'maren-cole' ),
			'name'   => 'Marcus Bell',
			'role'   => __( 'Founder & CEO, Lumen', 'maren-cole' ),
			'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=120&h=120&q=80',
		],
		[
			'quote'  => __( 'Our whole leadership team speaks a common language now. The intensive <em>changed how we make decisions</em> under pressure.', 'maren-cole' ),
			'result' => __( '2x faster decision cycles', 'maren-cole' ),
			'name'   => 'Priya Nair',
			'role'   => __( 'COO, Atlas Health', 'maren-cole' ),
			'avatar' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=120&h=120&q=80',
		],
	];
}

function mc_shortcode_testimonials(): string {
	$items = mc_demo_testimonials();
	$star  = str_repeat( mc_icon( 'star', 16 ), 5 );

	ob_start();
	?>
	<div class="mc-slider" data-mc-slider>
		<div class="mc-slider__viewport">
			<div class="mc-slider__track">
				<?php foreach ( $items as $t ) : ?>
					<figure class="mc-quote">
						<div class="mc-quote__stars" aria-label="<?php esc_attr_e( '5 out of 5 stars', 'maren-cole' ); ?>"><?php echo $star; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
						<blockquote class="mc-quote__text"><?php echo wp_kses_post( $t['quote'] ); ?></blockquote>
						<span class="mc-quote__result"><?php echo mc_icon( 'check', 14 ); // phpcs:ignore ?> <?php echo esc_html( $t['result'] ); ?></span>
						<figcaption class="mc-quote__footer">
							<img class="mc-quote__avatar" src="<?php echo esc_url( $t['avatar'] ); ?>" alt="<?php echo esc_attr( $t['name'] ); ?>" loading="lazy" decoding="async">
							<div>
								<div class="mc-quote__name"><?php echo esc_html( $t['name'] ); ?></div>
								<div class="mc-quote__role"><?php echo esc_html( $t['role'] ); ?></div>
							</div>
						</figcaption>
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="mc-slider__controls">
			<button type="button" class="mc-testimonials__nav-btn" data-slider="prev" aria-label="<?php esc_attr_e( 'Previous', 'maren-cole' ); ?>"><?php echo mc_icon( 'chevron-left', 22 ); // phpcs:ignore ?></button>
			<div class="mc-testimonials__dots" role="tablist"></div>
			<button type="button" class="mc-testimonials__nav-btn" data-slider="next" aria-label="<?php esc_attr_e( 'Next', 'maren-cole' ); ?>"><?php echo mc_icon( 'chevron-right', 22 ); // phpcs:ignore ?></button>
		</div>
	</div>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'mc_testimonials', 'mc_shortcode_testimonials' );

/* ============================================================
   Lead-magnet opt-in form
   ============================================================ */
function mc_shortcode_optin(): string {
	$action  = get_theme_mod( 'mc_newsletter_url', '' );
	$action  = $action ? esc_url( $action ) : '#';

	ob_start();
	?>
	<div class="mc-optin__card">
		<form class="mc-form" data-mc-optin-form action="<?php echo $action; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" method="post">
			<div class="mc-field">
				<label for="mc-optin-name"><?php esc_html_e( 'First name', 'maren-cole' ); ?></label>
				<input class="mc-input" id="mc-optin-name" name="fname" type="text" placeholder="<?php esc_attr_e( 'Maren', 'maren-cole' ); ?>" required>
			</div>
			<div class="mc-field">
				<label for="mc-optin-email"><?php esc_html_e( 'Email', 'maren-cole' ); ?></label>
				<input class="mc-input" id="mc-optin-email" name="email" type="email" placeholder="<?php esc_attr_e( 'you@company.com', 'maren-cole' ); ?>" required>
				<span class="mc-field__help"><?php esc_html_e( 'No spam, ever. Unsubscribe anytime.', 'maren-cole' ); ?></span>
			</div>
			<button type="submit" class="mc-btn mc-btn--primary mc-btn--lg mc-btn--full">
				<?php esc_html_e( 'Send me the playbook', 'maren-cole' ); ?> <?php echo mc_icon( 'arrow-right', 18 ); // phpcs:ignore ?>
			</button>
		</form>
		<div class="mc-form__success" data-mc-optin-success hidden>
			<div class="mc-form__success-icon"><?php echo mc_icon( 'check', 28 ); // phpcs:ignore ?></div>
			<h3 class="mc-form__success-title"><?php esc_html_e( 'Check your inbox', 'maren-cole' ); ?></h3>
			<p class="mc-form__success-text"><?php esc_html_e( 'The playbook is on its way to you.', 'maren-cole' ); ?></p>
		</div>
	</div>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'mc_optin', 'mc_shortcode_optin' );

/* ============================================================
   Resources teaser — latest posts (demo fallback)
   ============================================================ */
function mc_shortcode_resources( array $atts ): string {
	$atts  = shortcode_atts( [ 'count' => 3 ], $atts, 'mc_resources' );
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
				'tag'   => $cats ? $cats[0]->name : __( 'Article', 'maren-cole' ),
				'title' => get_the_title( $post ),
				'img'   => get_the_post_thumbnail_url( $post->ID, 'medium_large' ) ?: 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&w=600&h=400&q=80',
				'link'  => get_permalink( $post ),
				'meta'  => get_the_date( '', $post ),
			];
		}
	} else {
		$res      = home_url( '/resources/' );
		$articles = array_slice( [
			[ 'tag' => __( 'Leadership', 'maren-cole' ), 'title' => __( 'The case for boring decisions', 'maren-cole' ),               'img' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&w=600&h=400&q=80', 'link' => $res, 'meta' => __( 'Jun 2026 · 5 min read', 'maren-cole' ) ],
			[ 'tag' => __( 'Boundaries', 'maren-cole' ), 'title' => __( 'How to protect deep work without guilt', 'maren-cole' ),       'img' => 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?auto=format&fit=crop&w=600&h=400&q=80', 'link' => $res, 'meta' => __( 'May 2026 · 7 min read', 'maren-cole' ) ],
			[ 'tag' => __( 'Podcast', 'maren-cole' ),    'title' => __( 'Leading through your first 90 days as VP', 'maren-cole' ),    'img' => 'https://images.unsplash.com/photo-1589903308904-1010c2294adc?auto=format&fit=crop&w=600&h=400&q=80', 'link' => $res, 'meta' => __( 'May 2026 · 32 min listen', 'maren-cole' ) ],
		], 0, $count );
	}

	ob_start();
	echo '<div class="mc-grid-3">';
	foreach ( $articles as $a ) :
		?>
		<a class="mc-article mc-reveal" href="<?php echo esc_url( $a['link'] ); ?>">
			<div class="mc-article__image"><img src="<?php echo esc_url( $a['img'] ); ?>" alt="" loading="lazy" decoding="async"></div>
			<div class="mc-article__body">
				<div><span class="mc-badge"><?php echo esc_html( $a['tag'] ); ?></span></div>
				<h3 class="mc-article__title"><?php echo esc_html( $a['title'] ); ?></h3>
				<div class="mc-article__meta"><?php echo esc_html( $a['meta'] ); ?></div>
			</div>
		</a>
		<?php
	endforeach;
	echo '</div>';
	return (string) ob_get_clean();
}
add_shortcode( 'mc_resources', 'mc_shortcode_resources' );

/* ============================================================
   FAQ accordion
   ============================================================ */
function mc_shortcode_faq(): string {
	$faqs = [
		[ 'q' => __( 'How long are sessions, and how often?', 'maren-cole' ),       'a' => __( '1:1 sessions run 60 minutes, twice a month, by video — with async support in between for the moments that can’t wait.', 'maren-cole' ) ],
		[ 'q' => __( 'What if it isn’t the right fit?', 'maren-cole' ),             'a' => __( 'The discovery call is free and no-pressure. If after our first paid session it isn’t right, it’s on me — no charge.', 'maren-cole' ) ],
		[ 'q' => __( 'Do you work with whole leadership teams?', 'maren-cole' ),    'a' => __( 'Yes. The Leadership Intensive is a 12-week group program designed to align how your team thinks and decides together.', 'maren-cole' ) ],
		[ 'q' => __( 'Where does booking happen?', 'maren-cole' ),                  'a' => __( 'Every “Book a call” button opens your scheduler so you can grab a time that works — no back-and-forth email.', 'maren-cole' ) ],
	];

	ob_start();
	echo '<div class="mc-measure" style="width:100%">';
	foreach ( $faqs as $i => $f ) :
		$open = 0 === $i ? ' is-open' : '';
		?>
		<div class="mc-faq<?php echo esc_attr( $open ); ?>">
			<button type="button" class="mc-faq__btn" aria-expanded="<?php echo $open ? 'true' : 'false'; ?>">
				<span><?php echo esc_html( $f['q'] ); ?></span>
				<span class="mc-faq__icon"><?php echo mc_icon( 'plus', 22 ); // phpcs:ignore ?></span>
			</button>
			<div class="mc-faq__panel"><p class="mc-faq__answer"><?php echo esc_html( $f['a'] ); ?></p></div>
		</div>
		<?php
	endforeach;
	echo '</div>';
	return (string) ob_get_clean();
}
add_shortcode( 'mc_faq', 'mc_shortcode_faq' );
