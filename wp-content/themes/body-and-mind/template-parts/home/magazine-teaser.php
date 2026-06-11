<?php
defined( 'ABSPATH' ) || exit;

$articles = [
	[
		'cat'   => __( 'Achtsamkeit', 'body-and-mind' ),
		'title' => __( '5 Minuten Atempause für den Alltag', 'body-and-mind' ),
		'img'   => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=700&q=80',
	],
	[
		'cat'   => __( 'Yoga', 'body-and-mind' ),
		'title' => __( 'Warum Yin Yoga gerade im Winter guttut', 'body-and-mind' ),
		'img'   => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=700&q=80',
	],
	[
		'cat'   => __( 'Bewegung', 'body-and-mind' ),
		'title' => __( 'Kraft sanft aufbauen — ohne Druck', 'body-and-mind' ),
		'img'   => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?auto=format&fit=crop&w=700&q=80',
	],
];

/* Use latest posts if available, otherwise fall back to placeholder data */
$wp_articles = get_posts( [ 'numberposts' => 3, 'post_status' => 'publish' ] );
if ( $wp_articles ) {
	$articles = [];
	foreach ( $wp_articles as $post ) {
		setup_postdata( $post );
		$articles[] = [
			'cat'      => get_the_category( $post->ID )[0]->name ?? '',
			'title'    => get_the_title( $post ),
			'img'      => get_the_post_thumbnail_url( $post->ID, 'medium' ) ?: '',
			'permalink'=> get_permalink( $post ),
		];
	}
	wp_reset_postdata();
}
?>
<section class="bm-section bm-section--lavender">
	<div class="bm-container">

		<div class="bm-section-flex-head bm-reveal">
			<div class="bm-section-head">
				<span class="bm-eyebrow"><?php esc_html_e( 'Magazin', 'body-and-mind' ); ?></span>
				<h2 class="bm-section-title"><?php esc_html_e( 'Sanfte Impulse zum Lesen', 'body-and-mind' ); ?></h2>
			</div>
		</div>

		<div class="bm-magazine-grid">
			<?php foreach ( $articles as $a ) : ?>
				<article class="bm-article-card bm-reveal">
					<?php if ( ! empty( $a['img'] ) ) : ?>
						<div class="bm-article-card__image">
							<img src="<?php echo esc_url( $a['img'] ); ?>" alt="<?php echo esc_attr( $a['title'] ); ?>" loading="lazy" decoding="async">
						</div>
					<?php endif; ?>
					<div class="bm-article-card__body">
						<?php if ( ! empty( $a['cat'] ) ) : ?>
							<div class="bm-article-card__cat"><?php echo esc_html( $a['cat'] ); ?></div>
						<?php endif; ?>
						<h3 class="bm-article-card__title">
							<a href="<?php echo esc_url( $a['permalink'] ?? home_url( '/magazin/' ) ); ?>" style="color:inherit;text-decoration:none">
								<?php echo esc_html( $a['title'] ); ?>
							</a>
						</h3>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

	</div>
</section>
