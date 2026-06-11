<?php
defined( 'ABSPATH' ) || exit;

$testimonials = [
	[
		'rating' => 5,
		'quote'  => __( 'Ich komme jede Woche gern — das Studio ist hell und die Stunden tun einfach gut.', 'body-and-mind' ),
		'author' => 'Marie K.',
		'meta'   => __( 'Mitglied seit 2023', 'body-and-mind' ),
		'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=160&q=80',
	],
	[
		'rating' => 5,
		'quote'  => __( 'Lena nimmt sich Zeit und erklärt ruhig. Ich habe mich vom ersten Tag an willkommen gefühlt.', 'body-and-mind' ),
		'author' => 'Sophie B.',
		'meta'   => __( 'Vinyasa & Meditation', 'body-and-mind' ),
		'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=160&q=80',
	],
	[
		'rating' => 5,
		'quote'  => __( 'Das Personal Training ist genau auf mich abgestimmt. Endlich Bewegung, die sich leicht anfühlt.', 'body-and-mind' ),
		'author' => 'Johanna R.',
		'meta'   => __( 'Personal Training', 'body-and-mind' ),
		'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=160&q=80',
	],
];
?>
<section class="bm-section bm-section--white">
	<div class="bm-container">

		<div class="bm-section-head bm-section-head--center bm-reveal">
			<span class="bm-eyebrow"><?php esc_html_e( 'Stimmen', 'body-and-mind' ); ?></span>
			<h2 class="bm-section-title"><?php esc_html_e( 'Was unsere Mitglieder sagen', 'body-and-mind' ); ?></h2>
		</div>

		<div class="bm-testimonials-grid">
			<?php foreach ( $testimonials as $t ) : ?>
				<div class="bm-testimonial-card bm-reveal">
					<div class="bm-testimonial-card__stars" aria-label="<?php echo (int) $t['rating']; ?> von 5 Sternen">
						<?php for ( $i = 0; $i < $t['rating']; $i++ ) : ?>
							<?php echo bm_icon( 'star', 16 ); // phpcs:ignore ?>
						<?php endfor; ?>
					</div>
					<p class="bm-testimonial-card__quote">&ldquo;<?php echo esc_html( $t['quote'] ); ?>&rdquo;</p>
					<div class="bm-testimonial-card__footer">
						<img class="bm-testimonial-card__avatar" src="<?php echo esc_url( $t['avatar'] ); ?>" alt="<?php echo esc_attr( $t['author'] ); ?>" loading="lazy" decoding="async">
						<div>
							<div class="bm-testimonial-card__author"><?php echo esc_html( $t['author'] ); ?></div>
							<div class="bm-testimonial-card__meta"><?php echo esc_html( $t['meta'] ); ?></div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
