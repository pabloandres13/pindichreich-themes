<?php
defined( 'ABSPATH' ) || exit;

/**
 * Fallback template — renders the same bright card grid as the archive.
 */
get_header();
?>

<section class="au-page-hero">
	<div class="au-container">
		<div class="au-page-hero__inner">
			<?php aurelia_label( __( 'Magazin', 'aurelia' ) ); ?>
			<h1><?php esc_html_e( 'Wissen, das guttut', 'aurelia' ); ?></h1>
			<p class="au-page-hero__intro"><?php esc_html_e( 'Sanfte Impulse zu Ernährung, Achtsamkeit und Naturheilkunde — verständlich und alltagstauglich.', 'aurelia' ); ?></p>
		</div>
	</div>
</section>

<section class="au-section au-section--white" style="padding-top:var(--space-8)">
	<div class="au-container">
		<?php if ( have_posts() ) : ?>
			<div class="au-grid au-grid--fill">
				<?php
				while ( have_posts() ) :
					the_post();
					aurelia_article_card( get_the_ID() );
				endwhile;
				?>
			</div>
			<nav class="au-pagination" aria-label="<?php esc_attr_e( 'Seitennavigation', 'aurelia' ); ?>">
				<?php echo paginate_links( [ 'prev_text' => '←', 'next_text' => '→' ] ); // phpcs:ignore ?>
			</nav>
		<?php else : ?>
			<p><?php esc_html_e( 'Hier erscheinen in Kürze unsere ersten Artikel.', 'aurelia' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>
