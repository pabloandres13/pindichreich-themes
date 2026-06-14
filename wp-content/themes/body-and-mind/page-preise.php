<?php
/**
 * Template Name: Preise & Mitgliedschaft
 *
 * Auto-applies to a page with the slug "preise"; also selectable via
 * Page Attributes → Template.
 *
 * @package body-and-mind
 */

defined( 'ABSPATH' ) || exit;

get_header();

$kontakt = get_page_by_path( 'kontakt' );
$kontakt = $kontakt ? get_permalink( $kontakt ) : home_url( '/kontakt/' );

$plans = [
	[
		'name'     => __( 'Probestunde', 'body-and-mind' ),
		'price'    => '15 €',
		'period'   => '',
		'desc'     => __( 'Einmalig, unverbindlich', 'body-and-mind' ),
		'badge'    => '',
		'featured' => false,
		'features' => [ __( 'Eine Kursstunde nach Wahl', 'body-and-mind' ), __( 'Persönliches Kennenlernen', 'body-and-mind' ) ],
		'cta'      => __( 'Buchen', 'body-and-mind' ),
	],
	[
		'name'     => __( 'Flat Monat', 'body-and-mind' ),
		'price'    => '89 €',
		'period'   => __( '/ Monat', 'body-and-mind' ),
		'desc'     => __( 'Unbegrenzt alle Kurse', 'body-and-mind' ),
		'badge'    => __( 'Beliebt', 'body-and-mind' ),
		'featured' => true,
		'features' => [ __( 'Alle Yoga- & Meditationskurse', 'body-and-mind' ), __( 'Personal-Training-Rabatt', 'body-and-mind' ), __( 'Monatlich kündbar', 'body-and-mind' ) ],
		'cta'      => __( 'Mitglied werden', 'body-and-mind' ),
	],
	[
		'name'     => __( '10er-Karte', 'body-and-mind' ),
		'price'    => '135 €',
		'period'   => '',
		'desc'     => __( '12 Monate gültig', 'body-and-mind' ),
		'badge'    => '',
		'featured' => false,
		'features' => [ __( '10 Kursstunden frei wählbar', 'body-and-mind' ), __( 'Übertragbar auf Freunde', 'body-and-mind' ) ],
		'cta'      => __( 'Auswählen', 'body-and-mind' ),
	],
];
?>

<section class="bm-page-hero bm-page-hero--cream">
	<div class="bm-container bm-container--narrow">
		<span class="bm-eyebrow"><?php esc_html_e( 'Preise & Mitgliedschaft', 'body-and-mind' ); ?></span>
		<h1 class="bm-section-title"><?php esc_html_e( 'Flexibel starten', 'body-and-mind' ); ?></h1>
		<p class="bm-section-head__text" style="margin-inline:auto">
			<?php esc_html_e( 'Unverbindlich ausprobieren oder dauerhaft dabei sein — du entscheidest.', 'body-and-mind' ); ?>
		</p>
	</div>
</section>

<section class="bm-section bm-section--white">
	<div class="bm-container">

		<div class="bm-pricing-grid">
			<?php foreach ( $plans as $plan ) : ?>
				<div class="bm-pricing-card bm-reveal<?php echo $plan['featured'] ? ' bm-pricing-card--featured' : ''; ?>">
					<div class="bm-pricing-card__top">
						<span class="bm-pricing-card__name"><?php echo esc_html( $plan['name'] ); ?></span>
						<?php if ( $plan['badge'] ) : ?>
							<span class="bm-pricing-card__badge"><?php echo esc_html( $plan['badge'] ); ?></span>
						<?php endif; ?>
					</div>
					<div class="bm-pricing-card__price-wrap">
						<span class="bm-pricing-card__price"><?php echo esc_html( $plan['price'] ); ?></span>
						<?php if ( $plan['period'] ) : ?>
							<span class="bm-pricing-card__period"><?php echo esc_html( $plan['period'] ); ?></span>
						<?php endif; ?>
					</div>
					<p class="bm-pricing-card__desc"><?php echo esc_html( $plan['desc'] ); ?></p>
					<ul class="bm-pricing-card__features">
						<?php foreach ( $plan['features'] as $feat ) : ?>
							<li class="bm-pricing-card__feature">
								<span class="bm-pricing-card__check"><?php echo bm_icon( 'check', 12 ); // phpcs:ignore ?></span>
								<?php echo esc_html( $feat ); ?>
							</li>
						<?php endforeach; ?>
					</ul>
					<a href="<?php echo esc_url( $kontakt ); ?>" class="bm-btn bm-btn--<?php echo $plan['featured'] ? 'primary' : 'secondary'; ?> bm-btn--full"><?php echo esc_html( $plan['cta'] ); ?></a>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ( trim( (string) get_the_content() ) !== '' ) : ?>
			<div class="bm-content-area" style="padding-block:2.5rem 0">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>

		<div style="max-width:720px;margin:2.5rem auto 0" class="bm-reveal">
			<div class="bm-disclaimer">
				<span class="bm-disclaimer__icon"><?php echo bm_icon( 'info', 16 ); // phpcs:ignore ?></span>
				<div>
					<div class="bm-disclaimer__title"><?php esc_html_e( 'Hinweis', 'body-and-mind' ); ?></div>
					<p class="bm-disclaimer__text"><?php esc_html_e( 'Unsere Angebote dienen dem Wohlbefinden und ersetzen keine ärztliche Beratung oder Behandlung. Bei gesundheitlichen Beschwerden sprich bitte vorab mit deiner Ärztin oder deinem Arzt.', 'body-and-mind' ); ?></p>
				</div>
			</div>
		</div>

	</div>
</section>

<?php
get_footer();
