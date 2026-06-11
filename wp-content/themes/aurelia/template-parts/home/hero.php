<?php
defined( 'ABSPATH' ) || exit;

$hero_headline = get_theme_mod( 'aurelia_hero_headline', 'Zur Ruhe kommen.|Gesund leben.' );
$hero_lines    = array_map( 'trim', explode( '|', $hero_headline ) );
$hero_image_id = (int) get_theme_mod( 'aurelia_hero_image', 0 );
?>
<section class="au-hero">
	<img class="au-hero__blob" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/blob-blue.svg' ); ?>" alt="" aria-hidden="true">
	<div class="au-container">
		<div class="au-hero__grid">
			<div class="au-reveal">
				<span class="au-badge"><?php echo esc_html( get_theme_mod( 'aurelia_hero_badge', __( 'Praxis für ganzheitliche Gesundheit', 'aurelia' ) ) ); ?></span>
				<h1>
					<?php
					foreach ( $hero_lines as $i => $line ) {
						if ( $i > 0 ) {
							echo '<br>';
						}
						echo esc_html( $line );
					}
					?>
				</h1>
				<p class="au-hero__lead">
					<?php echo esc_html( get_theme_mod( 'aurelia_hero_lead', __( 'Ganzheitliche Begleitung für Ernährung, Achtsamkeit und ein ausgeglichenes Leben — fachkundig und in Ihrem Tempo.', 'aurelia' ) ) ); ?>
				</p>
				<div class="au-hero__actions">
					<a class="au-btn au-btn--primary au-btn--lg" href="<?php echo esc_url( aurelia_booking_url() ); ?>">
						<?php echo aurelia_icon( 'calendar-check', 18 ); // phpcs:ignore ?>
						<?php esc_html_e( 'Termin buchen', 'aurelia' ); ?>
					</a>
					<a class="au-btn au-btn--secondary au-btn--lg" href="<?php echo esc_url( home_url( '/leistungen/' ) ); ?>">
						<?php esc_html_e( 'Leistungen entdecken', 'aurelia' ); ?>
					</a>
				</div>
				<div class="au-hero__proof">
					<span class="au-hero__proof-avatars"><span></span><span></span><span></span></span>
					<?php echo esc_html( get_theme_mod( 'aurelia_hero_proof', __( 'Über 500 Menschen begleitet · 4,9 ★ Bewertung', 'aurelia' ) ) ); ?>
				</div>
			</div>

			<div class="au-hero__media au-reveal">
				<div class="au-image-frame">
					<?php
					if ( $hero_image_id ) {
						echo wp_get_attachment_image( $hero_image_id, 'large' );
					} else {
						echo aurelia_icon( 'leaf', 40 ); // phpcs:ignore
					}
					?>
				</div>
				<div class="au-hero__float-card">
					<span class="au-medallion au-medallion--blue"><?php echo aurelia_icon( 'hand-heart', 20 ); // phpcs:ignore ?></span>
					<span>
						<strong class="au-hero__float-title"><?php esc_html_e( 'Persönlich & ruhig', 'aurelia' ); ?></strong>
						<span class="au-hero__float-sub"><?php esc_html_e( 'Zeit für Ihre Anliegen', 'aurelia' ); ?></span>
					</span>
				</div>
			</div>
		</div>
	</div>
</section>
