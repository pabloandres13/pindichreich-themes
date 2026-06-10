<?php
/**
 * Custom search form — overrides Astra default with culinary-styled markup.
 */
$unique_id = esc_attr( uniqid( 'culinary-search-' ) );
?>
<form role="search" method="get" class="culinary-search-form search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>" class="screen-reader-text">
		<?php esc_html_e( 'Search for:', 'culinary' ); ?>
	</label>
	<div style="position:relative;display:flex;align-items:center;">
		<span style="position:absolute;left:15px;display:inline-flex;color:var(--text-faint);pointer-events:none;">
			<?php echo culinary_icon( 'search', 18 ); ?>
		</span>
		<input
			id="<?php echo $unique_id; ?>"
			type="search"
			name="s"
			placeholder="<?php esc_attr_e( 'Search recipes…', 'culinary' ); ?>"
			value="<?php echo esc_attr( get_search_query() ); ?>"
			autocomplete="off"
		>
	</div>
</form>
