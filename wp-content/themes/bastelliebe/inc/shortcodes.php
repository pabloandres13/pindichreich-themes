<?php
/**
 * Shortcodes for data-driven home sections.
 *
 * Each powers a block pattern (see inc/block-patterns.php): an editor drops one
 * into a page and it renders live WordPress data, falling back to tasteful demo
 * content when none exists yet — so a fresh install still looks complete.
 *
 * @package bastelliebe
 */

defined( 'ABSPATH' ) || exit;

/**
 * Demo projects, used when no posts exist yet.
 *
 * @return array<int,array<string,string>>
 */
function bl_demo_projects(): array {
	return [
		[ 'title' => __( 'Origami-Sterne fürs Fenster', 'bastelliebe' ),      'category' => 'papier',     'time' => '20 Min.', 'difficulty' => __( 'Einfach', 'bastelliebe' ), 'beginner' => true ],
		[ 'title' => __( 'Makramee-Wandbehang ganz einfach', 'bastelliebe' ), 'category' => 'wohndeko',   'time' => '45 Min.', 'difficulty' => __( 'Mittel', 'bastelliebe' ) ],
		[ 'title' => __( 'Wandregal aus alten Weinkisten', 'bastelliebe' ),   'category' => 'heimwerken', 'time' => '2 Std.',  'difficulty' => __( 'Mittel', 'bastelliebe' ) ],
		[ 'title' => __( 'Lustige Tiere aus Klopapierrollen', 'bastelliebe' ),'category' => 'kinder',     'time' => '30 Min.', 'difficulty' => __( 'Einfach', 'bastelliebe' ), 'beginner' => true ],
		[ 'title' => __( 'Duftkerzen selber gießen', 'bastelliebe' ),         'category' => 'wohndeko',   'time' => '1 Std.',  'difficulty' => __( 'Mittel', 'bastelliebe' ) ],
		[ 'title' => __( 'Geprägte Grußkarten gestalten', 'bastelliebe' ),    'category' => 'papier',     'time' => '25 Min.', 'difficulty' => __( 'Einfach', 'bastelliebe' ), 'beginner' => true ],
		[ 'title' => __( 'Couchtisch aus einer Palette', 'bastelliebe' ),     'category' => 'heimwerken', 'time' => '3 Std.',  'difficulty' => __( 'Fortgeschritten', 'bastelliebe' ) ],
		[ 'title' => __( 'Filz-Mobile fürs Kinderzimmer', 'bastelliebe' ),    'category' => 'kinder',     'time' => '40 Min.', 'difficulty' => __( 'Mittel', 'bastelliebe' ) ],
		[ 'title' => __( 'Mini-Vasen aus Beton', 'bastelliebe' ),            'category' => 'wohndeko',   'time' => '50 Min.', 'difficulty' => __( 'Mittel', 'bastelliebe' ) ],
	];
}

/**
 * Map a post to project-card data, deriving the craft category from its terms.
 *
 * @return array<string,string>
 */
function bl_post_to_project( int $post_id ): array {
	$cats   = bl_categories();
	$cat    = 'papier';
	foreach ( get_the_category( $post_id ) as $c ) {
		if ( isset( $cats[ $c->slug ] ) ) {
			$cat = $c->slug;
			break;
		}
	}
	return [
		'title'      => get_the_title( $post_id ),
		'category'   => $cat,
		'image'      => get_the_post_thumbnail_url( $post_id, 'large' ) ?: '',
		'time'       => (string) get_post_meta( $post_id, 'bl_time', true ),
		'difficulty' => (string) get_post_meta( $post_id, 'bl_difficulty', true ),
		'href'       => get_permalink( $post_id ),
	];
}

/**
 * [bl_projects count="6" beginner="0" columns="3"] — project (Anleitung) cards.
 * Uses latest published posts, with demo fallback.
 */
function bl_shortcode_projects( array $atts ): string {
	$atts = shortcode_atts( [
		'count'    => 6,
		'beginner' => 0,
		'columns'  => 3,
		'compact'  => 0,
	], $atts, 'bl_projects' );

	$count    = max( 1, (int) $atts['count'] );
	$beginner = (int) $atts['beginner'];
	$compact  = (int) $atts['compact'];
	$cols     = 4 === (int) $atts['columns'] ? ' bl-project-grid--4' : '';

	$query = new WP_Query( [
		'post_type'           => 'post',
		'posts_per_page'      => $count,
		'post_status'         => 'publish',
		'no_found_rows'       => true,
		'ignore_sticky_posts' => true,
	] );

	ob_start();
	echo '<div class="bl-project-grid' . esc_attr( $cols ) . '">';

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$p = bl_post_to_project( get_the_ID() );
			if ( $compact ) {
				$p['compact'] = '1';
			}
			echo bl_project_card( $p ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		wp_reset_postdata();
	} else {
		$projects = bl_demo_projects();
		if ( $beginner ) {
			$projects = array_values( array_filter( $projects, static fn( $p ) => ! empty( $p['beginner'] ) ) );
		}
		foreach ( array_slice( $projects, 0, $count ) as $p ) {
			if ( $compact ) {
				$p['compact'] = '1';
			}
			echo bl_project_card( $p ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	echo '</div>';
	return (string) ob_get_clean();
}
add_shortcode( 'bl_projects', 'bl_shortcode_projects' );

/**
 * [bl_categories] — the four color-coded craft category tiles.
 */
function bl_shortcode_categories(): string {
	$cats   = bl_categories();
	$counts = [];
	// Live post counts per matching category term, if present.
	foreach ( $cats as $slug => $meta ) {
		$term = get_category_by_slug( $slug );
		$counts[ $slug ] = $term ? (int) $term->count : 0;
	}
	// Tasteful demo counts when the site has no posts yet.
	$demo_counts = [ 'papier' => 48, 'heimwerken' => 26, 'wohndeko' => 31, 'kinder' => 22 ];

	ob_start();
	echo '<div class="bl-category-grid">';
	foreach ( $cats as $slug => $meta ) {
		$count = $counts[ $slug ] > 0 ? $counts[ $slug ] : $demo_counts[ $slug ];
		$href  = get_category_by_slug( $slug ) ? get_category_link( get_category_by_slug( $slug )->term_id ) : home_url( '/anleitungen/' );
		?>
		<a href="<?php echo esc_url( $href ); ?>" class="bl-category-tile bl-category-tile--<?php echo esc_attr( $slug ); ?> bl-reveal">
			<span class="bl-category-tile__motif"><?php echo bl_icon( $meta['icon'], 110, 1.4 ); // phpcs:ignore ?></span>
			<span class="bl-category-tile__icon"><?php echo bl_icon( $meta['icon'], 24, 2.2 ); // phpcs:ignore ?></span>
			<span class="bl-category-tile__label">
				<span class="bl-category-tile__name"><?php echo esc_html( $meta['label'] ); ?></span>
				<span class="bl-category-tile__count"><?php printf( esc_html__( '%d Projekte', 'bastelliebe' ), (int) $count ); ?></span>
			</span>
		</a>
		<?php
	}
	echo '</div>';
	return (string) ob_get_clean();
}
add_shortcode( 'bl_categories', 'bl_shortcode_categories' );

/**
 * [bl_affiliate] — "Shop the Post" affiliate favourites with the
 * legally-required Anzeige label and disclosure.
 */
function bl_shortcode_affiliate( array $atts ): string {
	$atts  = shortcode_atts( [ 'count' => 4 ], $atts, 'bl_affiliate' );
	$count = max( 1, (int) $atts['count'] );

	$items = [
		[ 'source' => 'Amazon', 'title' => __( 'Heißklebepistole Starter-Set', 'bastelliebe' ), 'price' => '14,99 €', 'old' => '19,99 €' ],
		[ 'source' => 'Amazon', 'title' => __( 'Bastelschere Set (5-teilig)', 'bastelliebe' ),  'price' => '9,49 €' ],
		[ 'source' => 'Etsy',   'title' => __( 'Baumwollkordel natur, 50 m', 'bastelliebe' ),    'price' => '11,90 €' ],
		[ 'source' => 'Amazon', 'title' => __( 'Acrylfarben 24er Pack', 'bastelliebe' ),         'price' => '17,99 €' ],
	];

	ob_start();
	?>
	<div class="bl-disclosure bl-reveal" style="margin-bottom:20px">
		<?php echo bl_icon( 'info', 16 ); // phpcs:ignore ?>
		<span><?php esc_html_e( 'Affiliate-Links: Kaufst du darüber, erhalte ich eine kleine Provision – für dich bleibt der Preis gleich.', 'bastelliebe' ); ?></span>
	</div>
	<div class="bl-shop-grid">
		<?php foreach ( array_slice( $items, 0, $count ) as $item ) : ?>
			<div class="bl-shop-card bl-reveal">
				<div class="bl-shop-card__media">
					<span class="bl-shop-card__placeholder"><?php echo bl_icon( 'shopping-bag', 40, 1.6 ); // phpcs:ignore ?></span>
					<span class="bl-shop-card__badge"><span class="bl-badge bl-badge--ad"><?php esc_html_e( 'Anzeige', 'bastelliebe' ); ?></span></span>
				</div>
				<div class="bl-shop-card__body">
					<span class="bl-shop-card__source"><?php echo esc_html( $item['source'] ); ?></span>
					<h4 class="bl-shop-card__title"><?php echo esc_html( $item['title'] ); ?></h4>
					<div class="bl-shop-card__price-row">
						<span class="bl-shop-card__price"><?php echo esc_html( $item['price'] ); ?></span>
						<?php if ( ! empty( $item['old'] ) ) : ?>
							<span class="bl-shop-card__old-price"><?php echo esc_html( $item['old'] ); ?></span>
						<?php endif; ?>
					</div>
					<a href="#" class="bl-btn bl-btn--secondary bl-btn--sm bl-btn--full" rel="nofollow sponsored noopener"><?php esc_html_e( 'Zum Produkt', 'bastelliebe' ); ?><?php echo bl_icon( 'external-link', 16 ); // phpcs:ignore ?></a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'bl_affiliate', 'bl_shortcode_affiliate' );

/**
 * [bl_newsletter] — coral newsletter band with DSGVO consent.
 * Form target comes from Customizer (bl_newsletter_url).
 */
function bl_shortcode_newsletter(): string {
	$form_url = get_theme_mod( 'bl_newsletter_url', '#' );
	$privacy  = home_url( '/datenschutz/' );

	ob_start();
	?>
	<section class="bl-newsletter bl-reveal" id="newsletter">
		<div class="bl-newsletter__intro">
			<span class="bl-newsletter__eyebrow"><?php echo bl_icon( 'mail', 20 ); // phpcs:ignore ?><?php esc_html_e( 'Newsletter', 'bastelliebe' ); ?></span>
			<h2 class="bl-newsletter__title"><?php esc_html_e( 'Nichts mehr verpassen', 'bastelliebe' ); ?></h2>
			<p class="bl-newsletter__text"><?php esc_html_e( 'Hol dir jede Woche neue Anleitungen und kreative Ideen direkt in dein Postfach.', 'bastelliebe' ); ?></p>
		</div>
		<form action="<?php echo esc_url( $form_url ); ?>" method="post" class="bl-newsletter__form">
			<div class="bl-newsletter__row">
				<input type="email" name="email" required placeholder="<?php esc_attr_e( 'deine@email.de', 'bastelliebe' ); ?>" class="bl-newsletter__input" aria-label="<?php esc_attr_e( 'E-Mail-Adresse', 'bastelliebe' ); ?>">
				<button type="submit" class="bl-btn bl-btn--on-ink"><?php esc_html_e( 'Abonnieren', 'bastelliebe' ); ?></button>
			</div>
			<label class="bl-newsletter__consent">
				<input type="checkbox" name="consent" required>
				<span>
					<?php
					printf(
						/* translators: %s: link to Datenschutzerklärung */
						esc_html__( 'Ich möchte den Newsletter erhalten und stimme der %s zu. Abmeldung jederzeit möglich.', 'bastelliebe' ),
						'<a href="' . esc_url( $privacy ) . '">' . esc_html__( 'Datenschutzerklärung', 'bastelliebe' ) . '</a>'
					);
					?>
				</span>
			</label>
		</form>
	</section>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'bl_newsletter', 'bl_shortcode_newsletter' );

/**
 * [bl_social count="6"] — Instagram feed strip (category-tinted placeholders).
 */
function bl_shortcode_social( array $atts ): string {
	$atts   = shortcode_atts( [ 'count' => 6 ], $atts, 'bl_social' );
	$count  = max( 1, (int) $atts['count'] );
	$handle = get_theme_mod( 'bl_instagram_handle', '@bastelliebe' );
	$url    = get_theme_mod( 'bl_instagram', '#' );

	ob_start();
	?>
	<div class="bl-social bl-reveal">
		<div class="bl-social__head">
			<a href="<?php echo esc_url( $url ); ?>" class="bl-social__handle" rel="noopener noreferrer">
				<?php echo bl_icon( 'instagram', 22 ); // phpcs:ignore ?><?php echo esc_html( $handle ); ?>
			</a>
			<a href="<?php echo esc_url( $url ); ?>" class="bl-textlink" rel="noopener noreferrer"><?php esc_html_e( 'Folgen', 'bastelliebe' ); ?><?php echo bl_icon( 'arrow-right', 16 ); // phpcs:ignore ?></a>
		</div>
		<div class="bl-social__grid">
			<?php for ( $i = 0; $i < $count; $i++ ) : ?>
				<a href="<?php echo esc_url( $url ); ?>" class="bl-social__item" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Instagram-Beitrag', 'bastelliebe' ); ?>">
					<?php echo bl_icon( 'instagram', 28 ); // phpcs:ignore ?>
				</a>
			<?php endfor; ?>
		</div>
	</div>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'bl_social', 'bl_shortcode_social' );
