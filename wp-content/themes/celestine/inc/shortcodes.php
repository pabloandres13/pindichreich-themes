<?php
/**
 * Shortcodes for data-driven home sections.
 *
 * These power the block patterns (see inc/block-patterns.php): an editor drops
 * one into a page and it renders live WordPress data, falling back to tasteful
 * demo content so a fresh install still looks complete.
 *
 * @package celestine
 */

defined( 'ABSPATH' ) || exit;

/**
 * A short rotating set of celestial glyphs used as image fallbacks so the
 * journal looks intentional before real cover images exist.
 *
 * @return string
 */
function cel_glyph_for( int $i ): string {
	$glyphs = [ '☽', '✦', '♃', '◇', '☉', '✧' ];
	return $glyphs[ $i % count( $glyphs ) ];
}

/**
 * Render one journal/article card for the current post in the loop.
 *
 * @param int $i Index (for glyph fallback variety).
 */
function cel_render_post_card( int $i = 0 ): void {
	$cats     = get_the_category();
	$cat_name = $cats ? $cats[0]->name : '';
	$permalink = get_permalink();
	?>
	<a class="cel-article cel-reveal" href="<?php echo esc_url( $permalink ); ?>">
		<div class="cel-article__media">
			<?php if ( $cat_name ) : ?>
				<span class="cel-article__cat"><span class="cel-badge cel-badge--jewel"><?php echo esc_html( $cat_name ); ?></span></span>
			<?php endif; ?>
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'medium_large', [ 'loading' => 'lazy', 'decoding' => 'async', 'alt' => '' ] ); ?>
			<?php else : ?>
				<span class="cel-article__glyph" aria-hidden="true"><?php echo esc_html( cel_glyph_for( $i ) ); ?></span>
			<?php endif; ?>
		</div>
		<div class="cel-article__body">
			<span class="cel-article__meta">
				<?php echo esc_html( get_the_date() ); ?> &nbsp;·&nbsp; <?php echo esc_html( cel_reading_time() ); ?>
			</span>
			<h3 class="cel-article__title"><?php the_title(); ?></h3>
			<p class="cel-article__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
			<span class="cel-article__more"><?php esc_html_e( 'Read', 'celestine' ); ?> &rarr;</span>
		</div>
	</a>
	<?php
}

/**
 * Estimate reading time from the current post content.
 */
function cel_reading_time(): string {
	$words   = str_word_count( wp_strip_all_tags( (string) get_the_content() ) );
	$minutes = max( 1, (int) ceil( $words / 200 ) );
	/* translators: %d: minutes */
	return sprintf( _n( '%d min read', '%d min read', $minutes, 'celestine' ), $minutes );
}

/**
 * Demo journal entries (celestial sample), used when no posts exist yet.
 *
 * @return array<int,array<string,string>>
 */
function cel_demo_articles(): array {
	return [
		[ 'glyph' => '☽', 'cat' => __( 'Moon', 'celestine' ),      'title' => __( 'Working with the new moon', 'celestine' ),  'excerpt' => __( 'A simple ritual for setting intentions when the sky goes dark.', 'celestine' ), 'meta' => __( 'Jun 12  ·  5 min read', 'celestine' ) ],
		[ 'glyph' => '♃', 'cat' => __( 'Astrology', 'celestine' ), 'title' => __( 'Jupiter’s slow gift', 'celestine' ),        'excerpt' => __( 'What the year’s most generous transit asks of you, and offers.', 'celestine' ), 'meta' => __( 'Jun 04  ·  7 min read', 'celestine' ) ],
		[ 'glyph' => '✦', 'cat' => __( 'Tarot', 'celestine' ),     'title' => __( 'The Star, reversed', 'celestine' ),         'excerpt' => __( 'When hope feels far away, the card has something quieter to say.', 'celestine' ), 'meta' => __( 'May 28  ·  6 min read', 'celestine' ) ],
		[ 'glyph' => '◇', 'cat' => __( 'Ritual', 'celestine' ),    'title' => __( 'Cleansing your space', 'celestine' ),       'excerpt' => __( 'Beyond smoke: small, grounded ways to reset a room and a mind.', 'celestine' ), 'meta' => __( 'May 19  ·  4 min read', 'celestine' ) ],
	];
}

/**
 * [cel_journal count="4"] — latest posts as article cards, with demo fallback.
 */
function cel_shortcode_journal( array $atts ): string {
	$atts  = shortcode_atts( [ 'count' => 4 ], $atts, 'cel_journal' );
	$count = max( 1, (int) $atts['count'] );

	$query = new WP_Query( [
		'post_type'           => 'post',
		'posts_per_page'      => $count,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	] );

	ob_start();
	echo '<div class="cel-article-grid">';

	if ( $query->have_posts() ) {
		$i = 0;
		while ( $query->have_posts() ) {
			$query->the_post();
			cel_render_post_card( $i++ );
		}
		wp_reset_postdata();
	} else {
		$journal = cel_page_url( 'journal' );
		foreach ( array_slice( cel_demo_articles(), 0, $count ) as $a ) {
			?>
			<a class="cel-article cel-reveal" href="<?php echo esc_url( $journal ); ?>">
				<div class="cel-article__media">
					<span class="cel-article__cat"><span class="cel-badge cel-badge--jewel"><?php echo esc_html( $a['cat'] ); ?></span></span>
					<span class="cel-article__glyph" aria-hidden="true"><?php echo esc_html( $a['glyph'] ); ?></span>
				</div>
				<div class="cel-article__body">
					<span class="cel-article__meta"><?php echo esc_html( $a['meta'] ); ?></span>
					<h3 class="cel-article__title"><?php echo esc_html( $a['title'] ); ?></h3>
					<p class="cel-article__excerpt"><?php echo esc_html( $a['excerpt'] ); ?></p>
					<span class="cel-article__more"><?php esc_html_e( 'Read', 'celestine' ); ?> &rarr;</span>
				</div>
			</a>
			<?php
		}
	}

	echo '</div>';
	return (string) ob_get_clean();
}
add_shortcode( 'cel_journal', 'cel_shortcode_journal' );

/**
 * [cel_newsletter] — the "Join the Circle" band. Form action from Customizer.
 */
function cel_shortcode_newsletter(): string {
	$action  = get_theme_mod( 'cel_newsletter_url', '' );
	$privacy = cel_page_url( 'privacy' );

	ob_start();
	?>
	<section class="cel-circle cel-reveal" aria-label="<?php esc_attr_e( 'Newsletter', 'celestine' ); ?>">
		<div class="cel-starfield" aria-hidden="true"></div>
		<div class="cel-circle__inner">
			<div class="cel-circle__glyph" aria-hidden="true">☽</div>
			<p class="cel-circle__label"><?php esc_html_e( 'Join the Circle', 'celestine' ); ?></p>
			<h2 class="cel-circle__title"><?php esc_html_e( 'New-moon letters, written by hand', 'celestine' ); ?></h2>
			<p class="cel-circle__text"><?php esc_html_e( 'Seasonal readings, ritual notes, and quiet reminders to return to yourself. No noise, just the sky.', 'celestine' ); ?></p>
			<form class="cel-circle__form" action="<?php echo esc_url( $action ); ?>" method="post">
				<input class="cel-circle__input" type="email" name="email" required placeholder="<?php esc_attr_e( 'Your email', 'celestine' ); ?>" aria-label="<?php esc_attr_e( 'Your email', 'celestine' ); ?>" />
				<button type="submit" class="cel-btn cel-btn--primary"><?php esc_html_e( 'Join', 'celestine' ); ?></button>
			</form>
			<label class="cel-circle__consent">
				<input type="checkbox" name="consent" required />
				<span>
					<?php
					printf(
						/* translators: %s: link to the privacy policy */
						esc_html__( 'I’d like the new-moon letter and agree to the %s. Unsubscribe anytime.', 'celestine' ),
						'<a href="' . esc_url( $privacy ) . '">' . esc_html__( 'privacy policy', 'celestine' ) . '</a>'
					);
					?>
				</span>
			</label>
		</div>
	</section>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'cel_newsletter', 'cel_shortcode_newsletter' );
