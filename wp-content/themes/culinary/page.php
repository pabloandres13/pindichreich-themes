<?php
/**
 * Generic page template.
 * Also serves as the About page if no dedicated template exists.
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main id="primary" class="site-main" role="main">
<?php while ( have_posts() ) : the_post(); ?>

	<?php
	$post_id    = get_the_ID();
	$slug       = get_post_field( 'post_name', $post_id );
	$is_about   = ( $slug === 'about' );
	$thumb_url  = get_the_post_thumbnail_url( $post_id, 'full' );
	$author_id  = get_theme_mod( 'culinary_author_name', get_the_author_meta( 'display_name' ) );
	?>

	<?php if ( $is_about ) : ?>
		<!-- About page — uses the full editorial layout -->

		<section class="culinary-narrow culinary-reveal" style="padding-top:var(--space-16);text-align:center;">
			<div style="font-family:var(--font-body);font-size:var(--text-sm);font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--accent);margin-bottom:var(--space-3);">
				<?php esc_html_e( 'Our story', 'culinary' ); ?>
			</div>
			<h1 style="font-family:var(--font-display);font-size:var(--text-5xl);font-weight:700;color:var(--text-heading);margin:0 0 var(--space-6);letter-spacing:-0.02em;">
				<?php echo esc_html( get_the_title() ); ?>
			</h1>
		</section>

		<?php if ( $thumb_url ) : ?>
			<section style="max-width:900px;margin:0 auto var(--space-16);padding:0 var(--space-6);" class="culinary-reveal">
				<img
					src="<?php echo esc_url( $thumb_url ); ?>"
					alt="<?php echo esc_attr( get_the_title() ); ?>"
					style="width:100%;height:440px;object-fit:cover;border-radius:var(--radius-2xl);box-shadow:var(--shadow-md);display:block;"
					loading="eager"
				>
			</section>
		<?php endif; ?>

		<div class="culinary-narrow culinary-prose culinary-reveal">
			<?php the_content(); ?>
		</div>

		<!-- Values grid -->
		<?php
		$values = apply_filters( 'culinary_about_values', [
			[ 'icon' => 'sprout',          'title' => __( 'Seasonal first', 'culinary' ),    'body' => __( 'Recipes follow the calendar — what\'s good, ripe and affordable right now.', 'culinary' ) ],
			[ 'icon' => 'timer',           'title' => __( 'Weeknight-real', 'culinary' ),    'body' => __( 'Most dishes land on the table in under 45 minutes, with one pan where I can manage it.', 'culinary' ) ],
			[ 'icon' => 'heart-handshake', 'title' => __( 'Properly tested', 'culinary' ),   'body' => __( 'Nothing is published until it works in my kitchen, three times over.', 'culinary' ) ],
		] );
		if ( $values ) : ?>
			<div class="culinary-narrow culinary-reveal">
				<div class="about-values">
					<?php foreach ( $values as $v ) : ?>
						<div class="about-value-card">
							<span class="about-value-card__icon"><?php echo culinary_icon( $v['icon'], 22 ); ?></span>
							<h3 class="about-value-card__title"><?php echo esc_html( $v['title'] ); ?></h3>
							<p class="about-value-card__body"><?php echo esc_html( $v['body'] ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<!-- Social row -->
		<div class="culinary-narrow culinary-reveal">
			<div class="about-social-row">
				<span style="font-family:var(--font-body);font-size:var(--text-base);font-weight:600;color:var(--text-muted);"><?php esc_html_e( 'Say hello —', 'culinary' ); ?></span>
				<?php
				$socials = [
					'instagram' => get_theme_mod( 'culinary_instagram', '#' ),
					'facebook'  => get_theme_mod( 'culinary_facebook', '#' ),
					'youtube'   => get_theme_mod( 'culinary_youtube', '#' ),
					'mail'      => 'mailto:' . antispambot( get_option( 'admin_email' ) ),
				];
				foreach ( $socials as $icon => $url ) : ?>
					<a href="<?php echo esc_url( $url ); ?>" class="social-icon-btn" aria-label="<?php echo esc_attr( $icon ); ?>" target="_blank" rel="noopener noreferrer">
						<?php echo culinary_icon( $icon, 19 ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>

		<?php get_template_part( 'template-parts/home/newsletter', null, [ 'tone' => 'sage' ] ); ?>

	<?php else : ?>
		<!-- Generic page layout -->

		<article class="culinary-narrow culinary-reveal" style="padding-top:var(--space-12);padding-bottom:var(--space-16);">
			<header style="margin-bottom:var(--space-8);">
				<h1 style="font-family:var(--font-display);font-size:var(--text-5xl);font-weight:700;color:var(--text-heading);margin:0;letter-spacing:-0.02em;">
					<?php echo esc_html( get_the_title() ); ?>
				</h1>
			</header>

			<?php if ( $thumb_url ) : ?>
				<img
					src="<?php echo esc_url( $thumb_url ); ?>"
					alt="<?php echo esc_attr( get_the_title() ); ?>"
					style="width:100%;height:360px;object-fit:cover;border-radius:var(--radius-2xl);box-shadow:var(--shadow-md);margin-bottom:var(--space-10);display:block;"
					loading="eager"
				>
			<?php endif; ?>

			<div class="culinary-prose">
				<?php the_content(); ?>
			</div>
		</article>

	<?php endif; ?>

<?php endwhile; ?>
</main>

<?php get_footer(); ?>
