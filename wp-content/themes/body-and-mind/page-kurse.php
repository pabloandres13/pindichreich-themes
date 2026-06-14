<?php
/**
 * Template Name: Kurse / Angebote
 *
 * Auto-applies to a page with the slug "kurse"; also selectable via
 * Page Attributes → Template. Class cards come from the `bm_class` CPT when it
 * exists, otherwise demo data (see [bm_classes]).
 *
 * @package body-and-mind
 */

defined( 'ABSPATH' ) || exit;

get_header();

$kontakt = get_page_by_path( 'kontakt' );
$kontakt = $kontakt ? get_permalink( $kontakt ) : home_url( '/kontakt/' );

$features = [
	[ 'leaf', __( 'Kleine Gruppen', 'body-and-mind' ), __( 'Maximal 10 Teilnehmerinnen pro Stunde.', 'body-and-mind' ) ],
	[ 'sun',  __( 'Helle Räume', 'body-and-mind' ),    __( 'Viel Tageslicht, Matten und Hilfsmittel vorhanden.', 'body-and-mind' ) ],
	[ 'wind', __( 'Sanftes Tempo', 'body-and-mind' ),  __( 'Wir holen dich da ab, wo du gerade stehst.', 'body-and-mind' ) ],
];
?>

<section class="bm-page-hero bm-page-hero--lavender">
	<div class="bm-container bm-container--narrow">
		<span class="bm-eyebrow"><?php esc_html_e( 'Kurse & Angebote', 'body-and-mind' ); ?></span>
		<h1 class="bm-section-title"><?php esc_html_e( 'Yoga, Meditation & Personal Training', 'body-and-mind' ); ?></h1>
		<p class="bm-section-head__text" style="margin-inline:auto">
			<?php esc_html_e( 'Jede Stunde ist eine Einladung, bewusst zu atmen und in Bewegung zu kommen. Für Anfängerinnen wie für Geübte.', 'body-and-mind' ); ?>
		</p>
	</div>
</section>

<section class="bm-section bm-section--white">
	<div class="bm-container">

		<?php echo do_shortcode( '[bm_classes count="8"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<div class="bm-info-grid" style="margin-top:3rem">
			<?php foreach ( $features as $f ) : ?>
				<div class="bm-info-box bm-reveal">
					<span class="bm-info-box__icon"><?php echo bm_icon( $f[0], 20 ); // phpcs:ignore ?></span>
					<div>
						<div class="bm-info-box__title"><?php echo esc_html( $f[1] ); ?></div>
						<div class="bm-info-box__text"><?php echo esc_html( $f[2] ); ?></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ( trim( (string) get_the_content() ) !== '' ) : ?>
			<div class="bm-content-area" style="padding-block:2.5rem 0">
				<?php the_content(); ?>
			</div>
		<?php endif; ?>

		<div style="max-width:760px;margin:2.5rem auto 0" class="bm-reveal">
			<div class="bm-disclaimer bm-disclaimer--sage">
				<span class="bm-disclaimer__icon"><?php echo bm_icon( 'info', 16 ); // phpcs:ignore ?></span>
				<div>
					<div class="bm-disclaimer__title"><?php esc_html_e( 'Hinweis', 'body-and-mind' ); ?></div>
					<p class="bm-disclaimer__text"><?php esc_html_e( 'Die Beschreibungen dienen der Orientierung und ersetzen keine ärztliche Beratung. Bei Beschwerden oder in der Schwangerschaft sprich bitte vorab mit uns.', 'body-and-mind' ); ?></p>
				</div>
			</div>
		</div>

	</div>
</section>

<section class="bm-cta-dark">
	<div class="bm-container bm-container--narrow" style="text-align:center">
		<h2 class="bm-cta-dark__title"><?php esc_html_e( 'Noch unsicher, was passt?', 'body-and-mind' ); ?></h2>
		<p class="bm-cta-dark__text"><?php esc_html_e( 'Buche eine Probestunde — wir finden gemeinsam heraus, was dir guttut.', 'body-and-mind' ); ?></p>
		<a href="<?php echo esc_url( $kontakt ); ?>" class="bm-btn bm-btn--accent bm-btn--lg"><?php esc_html_e( 'Probestunde buchen', 'body-and-mind' ); ?></a>
	</div>
</section>

<?php
get_footer();
