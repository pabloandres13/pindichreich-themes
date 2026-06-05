<section class="section" id="themen">
  <div class="container">
    <div class="section-head center reveal">
      <span class="eyebrow"><?php esc_html_e( 'Stöbern nach Thema', 'mamaglueck' ); ?></span>
      <h2><?php esc_html_e( 'Wonach ist dir heute?', 'mamaglueck' ); ?></h2>
      <p><?php esc_html_e( 'Von den ersten Schwangerschaftswochen bis zum Bastelnachmittag — such dir aus, was gerade in dein Leben passt.', 'mamaglueck' ); ?></p>
    </div>

    <?php
    // Use real categories if they exist, fall back to design placeholders
    $cats = get_categories( [ 'number' => 6, 'hide_empty' => false ] );
    $icons = [
      'baby'        => '<path d="M9 12h.01"/><path d="M15 12h.01"/><path d="M10 16c.5.3 1.2.5 2 .5s1.5-.2 2-.5"/><path d="M19 6.3a9 9 0 0 1 1.8 3.9 2 2 0 0 1 0 3.6 9 9 0 0 1-17.6 0 2 2 0 0 1 0-3.6A9 9 0 0 1 12 3c2 0 3.5 1.1 3.5 2.5s-.9 2.5-2 2.5c-.8 0-1.5-.4-1.5-1"/>',
      'sprout'      => '<path d="M7 20h10"/><path d="M10 20c5.5-2.5.8-6.4 3-10"/><path d="M9.5 9.4c1.1.8 1.8 2.2 2.3 3.7-2 .4-3.5.4-4.8-.3-1.2-.6-2.3-1.9-3-4.2 2.8-.5 4.4 0 5.5.8z"/><path d="M14.1 6a7 7 0 0 1 1.1 7.3c-1.4.7-2.8 1.5-4 .3-1.3-1.3-.6-3.4.2-4.7C12.2 7.4 13 6.5 14.1 6z"/>',
      'house'       => '<path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
      'cooking-pot' => '<path d="M2 12h20"/><path d="M20 12v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8"/><path d="m4 8 16-4"/><path d="m8.86 6.78-.45-1.81a2 2 0 0 1 1.45-2.43l1.94-.48a2 2 0 0 1 2.43 1.46l.45 1.8"/><path d="M15 2h1a2 2 0 0 1 2 2v2"/><path d="M6 2h1a2 2 0 0 1 2 2v2"/>',
      'luggage'     => '<path d="M6 20a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2"/><path d="M8 18V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v14"/><path d="M10 20h4"/><circle cx="16" cy="20" r="2"/><circle cx="8" cy="20" r="2"/>',
      'palette'     => '<circle cx="13.5" cy="6.5" r=".5"/><circle cx="17.5" cy="10.5" r=".5"/><circle cx="8.5" cy="7.5" r=".5"/><circle cx="6.5" cy="12.5" r=".5"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"/>',
    ];
    $accents = [ 'var(--coral)', 'var(--teal)', 'var(--yellow-deep)', 'var(--coral)', 'var(--teal)', 'var(--yellow-deep)' ];
    $defaults = [
      [ 'Schwangerschaft', 'baby' ],
      [ 'Erziehung',       'sprout' ],
      [ 'Familienalltag',  'house' ],
      [ 'Rezepte',         'cooking-pot' ],
      [ 'Reisen mit Kind', 'luggage' ],
      [ 'DIY & Basteln',   'palette' ],
    ];
    ?>

    <div class="topics reveal">
      <?php if ( ! empty( $cats ) && $cats[0]->name !== 'Uncategorized' ) : ?>
        <?php foreach ( array_slice( $cats, 0, 6 ) as $i => $cat ) :
          $icon_key = array_keys( $icons )[ $i % count( $icons ) ];
          $accent   = $accents[ $i % count( $accents ) ];
        ?>
          <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="topic" style="--_accent:<?php echo esc_attr( $accent ); ?>">
            <span class="topic__icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $icons[ $icon_key ]; ?></svg>
            </span>
            <h3><?php echo esc_html( $cat->name ); ?></h3>
          </a>
        <?php endforeach; ?>
      <?php else : ?>
        <?php foreach ( $defaults as $i => [ $label, $icon_key ] ) :
          $accent = $accents[ $i % count( $accents ) ];
        ?>
          <a href="<?php echo esc_url( home_url( '/#blog' ) ); ?>" class="topic" style="--_accent:<?php echo esc_attr( $accent ); ?>">
            <span class="topic__icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $icons[ $icon_key ]; ?></svg>
            </span>
            <h3><?php echo esc_html( $label ); ?></h3>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>
