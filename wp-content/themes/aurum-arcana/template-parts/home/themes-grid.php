<?php
$mysteries = [
	[ 'cards',      __( 'Tarot',     'aurum-arcana' ), __( 'The seventy-eight keys', 'aurum-arcana' ) ],
	[ 'moon-stars', __( 'Astrology', 'aurum-arcana' ), __( 'The wheel of the stars', 'aurum-arcana' ) ],
	[ 'flask',      __( 'Alchemy',   'aurum-arcana' ), __( 'The great work', 'aurum-arcana' ) ],
	[ 'scroll',     __( 'Folklore',  'aurum-arcana' ), __( 'The old stories', 'aurum-arcana' ) ],
];

$archive_url = get_permalink( get_option( 'page_for_posts' ) ) ?: get_post_type_archive_link( 'post' ) ?: home_url( '/' );
?>
<section class="aa-sec aa-reveal">
	<div class="aa-sec__head">
		<?php echo aurum_label( __( 'Enter the Mysteries', 'aurum-arcana' ) ); ?>
		<h2><?php esc_html_e( 'Four doors stand open', 'aurum-arcana' ); ?></h2>
	</div>

	<div class="aa-grid-4">
		<?php foreach ( $mysteries as [ $icon, $title, $desc ] ) : ?>
			<a href="<?php echo esc_url( $archive_url ); ?>" class="aa-tile">
				<span class="aa-tile__icon"><?php echo aurum_icon( $icon, 38 ); ?></span>
				<h3 class="aa-tile__title"><?php echo esc_html( $title ); ?></h3>
				<p class="aa-tile__desc"><?php echo esc_html( $desc ); ?></p>
			</a>
		<?php endforeach; ?>
	</div>
</section>
