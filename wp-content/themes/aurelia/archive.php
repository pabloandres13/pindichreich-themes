<?php
defined( 'ABSPATH' ) || exit;

get_header();

$archive_title = is_category() ? single_cat_title( '', false ) : __( 'Magazin', 'aurelia' );
$archive_intro = is_category() && category_description()
	? wp_strip_all_tags( category_description() )
	: __( 'Sanfte Impulse zu Ernährung, Achtsamkeit und Naturheilkunde — verständlich und alltagstauglich.', 'aurelia' );
?>

<section class="au-page-hero">
	<div class="au-container">
		<div class="au-page-hero__inner">
			<?php aurelia_label( __( 'Magazin', 'aurelia' ) ); ?>
			<h1><?php echo esc_html( $archive_title ); ?></h1>
			<p class="au-page-hero__intro"><?php echo esc_html( $archive_intro ); ?></p>
		</div>
	</div>
</section>

<section class="au-section au-section--white" style="padding-top:var(--space-8)">
	<div class="au-container">
		<div class="au-archive__filters">
			<a class="au-tag<?php echo is_category() ? '' : ' is-active'; ?>" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/magazin/' ) ); ?>"><?php esc_html_e( 'Alle', 'aurelia' ); ?></a>
			<?php foreach ( get_categories( [ 'hide_empty' => true ] ) as $aurelia_cat ) : ?>
				<a class="au-tag<?php echo is_category( $aurelia_cat->term_id ) ? ' is-active' : ''; ?>" href="<?php echo esc_url( get_category_link( $aurelia_cat ) ); ?>">
					<?php echo esc_html( $aurelia_cat->name ); ?>
				</a>
			<?php endforeach; ?>
		</div>

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

<section class="au-section au-section--cream">
	<div class="au-container">
		<?php get_template_part( 'template-parts/home/newsletter', null, [ 'tone' => 'blue' ] ); ?>
	</div>
</section>

<?php get_footer(); ?>
