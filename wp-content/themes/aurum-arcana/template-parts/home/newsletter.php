<?php
$eyebrow  = get_theme_mod( 'aurum_nl_eyebrow', __( 'Join the Circle', 'aurum-arcana' ) );
$title    = get_theme_mod( 'aurum_nl_title',   __( 'Receive the dispatches', 'aurum-arcana' ) );
$sub      = get_theme_mod( 'aurum_nl_sub',     __( 'Monthly letters on tarot, the stars, and the old arts. No noise — only signal from the veil.', 'aurum-arcana' ) );
$form_url = get_theme_mod( 'aurum_nl_url',     '' );
?>
<div class="aa-circle">
	<div class="aa-circle__inner">
		<?php if ( $eyebrow ) : ?>
			<span class="aa-circle__eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
		<?php endif; ?>

		<h2 class="aa-circle__title"><?php echo esc_html( $title ); ?></h2>

		<?php if ( $sub ) : ?>
			<p class="aa-circle__sub"><?php echo esc_html( $sub ); ?></p>
		<?php endif; ?>

		<?php if ( $form_url ) : ?>
			<form class="aa-circle__form" method="post" action="<?php echo esc_url( $form_url ); ?>">
				<input type="email" name="email"
				       placeholder="<?php esc_attr_e( 'Your email', 'aurum-arcana' ); ?>"
				       aria-label="<?php esc_attr_e( 'Email address', 'aurum-arcana' ); ?>"
				       required>
				<button type="submit" class="aa-btn aa-btn--primary">
					<?php esc_html_e( 'Subscribe', 'aurum-arcana' ); ?>
				</button>
			</form>
		<?php else : ?>
			<form class="aa-circle__form">
				<input type="email" name="email"
				       placeholder="<?php esc_attr_e( 'Your email', 'aurum-arcana' ); ?>"
				       aria-label="<?php esc_attr_e( 'Email address', 'aurum-arcana' ); ?>"
				       required>
				<button type="submit" class="aa-btn aa-btn--primary">
					<?php esc_html_e( 'Subscribe', 'aurum-arcana' ); ?>
				</button>
			</form>
			<p style="font-family:var(--font-label);font-size:var(--text-xs);color:var(--text-faint);letter-spacing:var(--tracking-wide);text-transform:uppercase;margin:0;">
				<?php esc_html_e( 'Set newsletter URL in Appearance → Customize → Aurum Arcana Design', 'aurum-arcana' ); ?>
			</p>
		<?php endif; ?>
	</div>
</div>
