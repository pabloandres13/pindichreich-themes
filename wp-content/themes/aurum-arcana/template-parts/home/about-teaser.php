<?php
$author_name = get_theme_mod( 'aurum_author_name', 'Mara Voss' );
$author_bio  = get_theme_mod( 'aurum_author_bio', __( 'For twenty years I have read cards and charts for seekers across the world. Aurum Arcana is my study made public — a place to learn the old arts slowly, and well.', 'aurum-arcana' ) );
$about_page  = get_page_by_path( 'about' );
$about_url   = $about_page ? get_permalink( $about_page ) : home_url( '/about/' );
?>
<section class="aa-sec aa-reveal">
	<div class="aa-about">
		<div class="aa-about__media">
			<?php
			/* Use author photo from about page if available */
			if ( $about_page && has_post_thumbnail( $about_page ) ) {
				echo get_the_post_thumbnail( $about_page, 'large', [ 'alt' => esc_attr( $author_name ) ] );
			} else {
				/* Fallback: a silhouette or dark placeholder */
				echo '<div style="width:100%;height:100%;min-height:320px;background:var(--ink-600);display:flex;align-items:center;justify-content:center;color:var(--accent);">'
				   . aurum_icon( 'user', 64 )
				   . '</div>';
			}
			?>
		</div>

		<div>
			<?php echo aurum_label( __( 'The Practitioner', 'aurum-arcana' ) ); ?>
			<h2><?php esc_html_e( 'Kept by a single careful hand', 'aurum-arcana' ); ?></h2>
			<p><?php echo esc_html( $author_bio ); ?></p>
			<a href="<?php echo esc_url( $about_url ); ?>" class="aa-btn aa-btn--secondary">
				<?php esc_html_e( 'Read my story', 'aurum-arcana' ); ?>
			</a>
		</div>
	</div>
</section>
