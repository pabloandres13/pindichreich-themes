<?php get_header(); ?>

<?php
$slug = get_post_field( 'post_name', get_queried_object_id() );
$is_about   = ( $slug === 'about' );
$is_contact = ( $slug === 'contact' );
?>

<?php if ( $is_about ) : ?>
	<?php
	/* About / Services page — rich layout */
	$author_name = get_theme_mod( 'aurum_author_name', 'Mara Voss' );
	$author_bio  = get_theme_mod( 'aurum_author_bio', 'For twenty years I have read cards and charts for seekers across the world. Aurum Arcana is my study made public. My promise is plain: no fear, no flattery, only a careful reading of what the symbols are actually saying.' );
	$reading_url = get_theme_mod( 'aurum_reading_url', '#contact' );
	?>

	<div class="aa-ab-hero">
		<div class="aa-ab-hero__media">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'large', [ 'alt' => esc_attr( $author_name ) ] ); ?>
			<?php else : ?>
				<div style="width:100%;height:100%;background:var(--ink-600);"></div>
			<?php endif; ?>
		</div>
		<div>
			<?php echo aurum_label( __( 'The Practitioner', 'aurum-arcana' ), true ); ?>
			<h1><?php echo esc_html( $author_name ); ?></h1>
			<?php foreach ( explode( "\n", $author_bio ) as $para ) : if ( trim( $para ) ) : ?>
				<p><?php echo esc_html( trim( $para ) ); ?></p>
			<?php endif; endforeach; ?>
			<?php if ( $reading_url ) : ?>
				<div style="margin-top:26px;">
					<a href="<?php echo esc_url( $reading_url ); ?>" class="aa-btn aa-btn--primary aa-btn--lg">
						<?php esc_html_e( 'Book a Reading', 'aurum-arcana' ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- Page content (for any Gutenberg blocks added by the editor) -->
	<?php while ( have_posts() ) : the_post(); ?>
		<?php if ( get_the_content() ) : ?>
			<div class="aa-container" style="padding-block:var(--space-8);">
				<div class="entry-content" style="max-width:var(--measure);margin:0 auto;font-family:var(--font-body);font-size:var(--text-md);line-height:var(--leading-relaxed);color:var(--text-secondary);">
					<?php the_content(); ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>

	<!-- Services / pricing section -->
	<div class="aa-svc">
		<div class="aa-svc__head">
			<?php echo aurum_label( __( 'The Offerings', 'aurum-arcana' ) ); ?>
			<h2><?php esc_html_e( 'Sit at the table', 'aurum-arcana' ); ?></h2>
		</div>
		<div class="aa-svc__grid">
			<?php
			$services = [
				[
					'name'     => __( 'The Brief Reading', 'aurum-arcana' ),
					'cost'     => '$90',
					'unit'     => '30 min',
					'desc'     => __( 'A single, focused question met with a three-card draw.', 'aurum-arcana' ),
					'features' => [
						__( 'One question, three cards', 'aurum-arcana' ),
						__( 'Live by veil-call', 'aurum-arcana' ),
						__( 'A short written summary', 'aurum-arcana' ),
					],
					'featured' => false,
				],
				[
					'name'     => get_theme_mod( 'aurum_reading_title', __( 'The Signature Reading', 'aurum-arcana' ) ),
					'cost'     => get_theme_mod( 'aurum_reading_price', '$180' ),
					'unit'     => '60 min',
					'desc'     => get_theme_mod( 'aurum_reading_desc', __( 'A full Celtic-cross reading, recorded and transcribed, with a written letter of reflection sent within three days.', 'aurum-arcana' ) ),
					'features' => [
						__( '60 minutes, in person or remote', 'aurum-arcana' ),
						__( 'Recording + full transcript', 'aurum-arcana' ),
						__( 'A follow-up letter within 3 days', 'aurum-arcana' ),
					],
					'featured' => true,
				],
				[
					'name'     => __( 'The Year Ahead', 'aurum-arcana' ),
					'cost'     => '$320',
					'unit'     => '90 min',
					'desc'     => __( 'A natal-and-transit study mapping the turning of your coming year.', 'aurum-arcana' ),
					'features' => [
						__( 'Natal chart + transits', 'aurum-arcana' ),
						__( '90-minute session', 'aurum-arcana' ),
						__( 'Bound written report', 'aurum-arcana' ),
					],
					'featured' => false,
				],
			];

			foreach ( $services as $svc ) :
			?>
				<div class="aa-card aa-card--hover" style="position:relative;display:flex;">
					<div class="aa-price">
						<?php if ( $svc['featured'] ) : ?>
							<div style="position:absolute;top:16px;right:16px;">
								<span class="aa-badge"><?php esc_html_e( 'Most chosen', 'aurum-arcana' ); ?></span>
							</div>
						<?php endif; ?>
						<span class="aa-price__name"><?php echo esc_html( $svc['name'] ); ?></span>
						<span class="aa-price__cost"><?php echo esc_html( $svc['cost'] ); ?> <small>/ <?php echo esc_html( $svc['unit'] ); ?></small></span>
						<span class="aa-price__desc"><?php echo esc_html( $svc['desc'] ); ?></span>
						<ul>
							<?php foreach ( $svc['features'] as $feat ) : ?>
								<li><?php echo aurum_icon( 'check', 18 ); ?><?php echo esc_html( $feat ); ?></li>
							<?php endforeach; ?>
						</ul>
						<div class="aa-price__cta">
							<?php if ( $reading_url ) : ?>
								<a href="<?php echo esc_url( $reading_url ); ?>"
								   class="aa-btn <?php echo $svc['featured'] ? 'aa-btn--primary' : 'aa-btn--secondary'; ?>"
								   style="width:100%;justify-content:center;">
									<?php esc_html_e( 'Book', 'aurum-arcana' ); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

<?php elseif ( $is_contact ) : ?>
	<!-- Contact page -->
	<div class="aa-page-head">
		<?php echo aurum_label( __( 'Contact', 'aurum-arcana' ), true ); ?>
		<h1><?php the_title(); ?></h1>
	</div>
	<div class="aa-container" style="padding-block:var(--space-8);max-width:720px;">
		<div class="entry-content" style="font-family:var(--font-body);font-size:var(--text-md);line-height:var(--leading-relaxed);color:var(--text-secondary);">
			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
		</div>
	</div>

<?php else : ?>
	<!-- Generic page -->
	<div class="aa-page-head">
		<h1><?php the_title(); ?></h1>
	</div>
	<div class="aa-container" style="padding-block:var(--space-8);">
		<div class="entry-content" style="max-width:var(--measure);margin:0 auto;font-family:var(--font-body);font-size:var(--text-md);line-height:var(--leading-relaxed);color:var(--text-secondary);">
			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
