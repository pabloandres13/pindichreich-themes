<section class="hero">
  <span class="deco dot float" style="width:18px;height:18px;background:var(--teal);top:18%;left:6%"></span>
  <span class="deco dot float float--rev" style="width:11px;height:11px;background:var(--yellow);top:30%;left:14%"></span>
  <span class="deco dot float float--slow" style="width:14px;height:14px;background:var(--coral);bottom:22%;left:4%"></span>
  <div class="container">
    <div class="hero__grid">

      <div class="hero__copy">
        <span class="eyebrow hero__eyebrow"><?php esc_html_e( 'Willkommen bei', 'mamaglueck' ); ?> <?php bloginfo( 'name' ); ?></span>
        <h1 class="hero__title">
          <?php esc_html_e( 'Echtes Mama-Leben — mit Herz, Chaos und einer', 'mamaglueck' ); ?>
          <span class="accent"><?php esc_html_e( 'Prise Humor', 'mamaglueck' ); ?></span>
        </h1>
        <p class="lead hero__sub">
          <?php esc_html_e( 'Kein Hochglanz, keine Belehrungen. Nur ehrliche Geschichten, gute Tipps und das Gefühl, mit dem ganzen Mama-Wahnsinn nicht allein zu sein.', 'mamaglueck' ); ?>
        </p>
        <div class="hero__actions">
          <a href="#blog" class="btn btn--primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            <?php esc_html_e( 'Zum Blog', 'mamaglueck' ); ?>
          </a>
          <a href="#intro" class="btn btn--ghost"><?php esc_html_e( 'Über mich', 'mamaglueck' ); ?></a>
        </div>
        <div class="hero__stats">
          <div class="hero__stat"><b>240+</b><span><?php esc_html_e( 'ehrliche Beiträge', 'mamaglueck' ); ?></span></div>
          <div class="hero__stat"><b>12.000</b><span><?php esc_html_e( 'liebe Leserinnen', 'mamaglueck' ); ?></span></div>
          <div class="hero__stat"><b>5 <?php esc_html_e( 'Jahre', 'mamaglueck' ); ?></b><span><?php esc_html_e( 'Mama-Wahnsinn', 'mamaglueck' ); ?></span></div>
        </div>
      </div>

      <div class="hero__media">
        <span class="hero__halo float float--slow"></span>
        <div class="hero__blob">
          <span class="photo" data-tint="coral" role="img" aria-label="<?php esc_attr_e( 'Foto: Mama mit Kind', 'mamaglueck' ); ?>">
            <span class="photo__label">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
              <?php esc_html_e( 'Lifestyle-Foto', 'mamaglueck' ); ?>
            </span>
          </span>
        </div>
        <div class="hero__badge hero__badge--tl float">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
          <?php esc_html_e( 'Mit ganz viel Herz', 'mamaglueck' ); ?>
        </div>
        <div class="hero__badge hero__badge--br float float--rev">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>
          <?php esc_html_e( 'Frisch gebloggt', 'mamaglueck' ); ?>
        </div>
      </div>

    </div>
  </div>
</section>
