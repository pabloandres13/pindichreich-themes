<?php
/**
 * Block patterns for the Maren Cole home page.
 *
 * Each home section is an insertable pattern so a non-technical coach can build
 * and edit the entire front page in the block editor — no PHP or HTML required.
 * Editable copy uses native blocks (heading / paragraph / buttons / image);
 * data-driven or slider sections use the shortcodes in inc/shortcodes.php; fixed
 * decorative structure (hero portrait, promise & offer cards, stats) uses
 * wp:html. A combined "Full home page" pattern assembles every section in order.
 *
 * @package maren-cole
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the pattern category.
 */
function mc_register_pattern_category(): void {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category( 'maren-cole', [
			'label' => __( 'Maren Cole', 'maren-cole' ),
		] );
	}
}
add_action( 'init', 'mc_register_pattern_category' );

/* ============================================================
   Section builders — each returns serialized block markup.
   ============================================================ */

/**
 * Hero — editable eyebrow / headline / lead / CTAs (native);
 * portrait + offset shape + credential badge + social proof (wp:html).
 */
function mc_pattern_hero(): string {
	$book     = mc_booking_url();
	$services = esc_url( home_url( '/services/' ) );
	$arrow    = mc_icon( 'arrow-right', 19 );
	$play     = mc_icon( 'play', 15 );
	$compass  = mc_icon( 'compass', 22 );
	$stars    = str_repeat( mc_icon( 'star', 14 ), 5 );
	$portrait = 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=900&h=1125&q=80&crop=faces';
	$av1 = 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=80&h=80&q=80&crop=faces';
	$av2 = 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=80&h=80&q=80&crop=faces';
	$av3 = 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=80&h=80&q=80&crop=faces';
	$av4 = 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=80&h=80&q=80&crop=faces';

	$proof = <<<HTML
<div class="mc-hero__proof">
	<div class="mc-hero__avatars">
		<img src="{$av1}" alt="" loading="lazy" decoding="async"><img src="{$av2}" alt="" loading="lazy" decoding="async"><img src="{$av3}" alt="" loading="lazy" decoding="async"><img src="{$av4}" alt="" loading="lazy" decoding="async">
	</div>
	<div class="mc-hero__proof-text"><span class="mc-hero__stars">{$stars}</span><br><strong>200+ leaders</strong> coached to their next season</div>
</div>
HTML;

	$media = <<<HTML
<div class="mc-hero__media">
	<div class="mc-hero__shape" aria-hidden="true"></div>
	<figure class="mc-hero__portrait"><img src="{$portrait}" alt="Maren Cole, executive coach"></figure>
	<div class="mc-hero__credential">
		<div class="mc-hero__credential-icon">{$compass}</div>
		<div>
			<div class="mc-hero__credential-title">ICF-certified</div>
			<div class="mc-hero__credential-sub">15 years in the room</div>
		</div>
	</div>
</div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"mc-hero","layout":{"type":"constrained"}} -->
<section class="wp-block-group mc-hero">
<!-- wp:group {"className":"mc-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-container">
<!-- wp:columns {"verticalAlignment":"center","className":"mc-hero__grid"} -->
<div class="wp-block-columns are-vertically-aligned-center mc-hero__grid">
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:paragraph {"className":"mc-eyebrow"} -->
<p class="mc-eyebrow">Executive &amp; leadership coaching</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":1,"className":"mc-hero__headline"} -->
<h1 class="wp-block-heading mc-hero__headline">Lead at your <em>edge</em>.<br>Without burning out.</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"mc-hero__lead"} -->
<p class="mc-hero__lead">Coaching for founders and senior leaders who want to scale their impact, sharpen their decisions, and still have a life worth leading.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"className":"mc-hero__actions"} -->
<div class="wp-block-buttons mc-hero__actions">
<!-- wp:button {"className":"is-style-mc-primary mc-btn--lg"} -->
<div class="wp-block-button is-style-mc-primary mc-btn--lg"><a class="wp-block-button__link wp-element-button" href="{$book}">Book a discovery call {$arrow}</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"is-style-mc-secondary mc-btn--lg"} -->
<div class="wp-block-button is-style-mc-secondary mc-btn--lg"><a class="wp-block-button__link wp-element-button" href="{$services}">{$play} See how it works</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
<!-- wp:html -->
{$proof}
<!-- /wp:html -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:html -->
{$media}
<!-- /wp:html -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Trust strip — "as featured in" via [mc_trust].
 */
function mc_pattern_trust(): string {
	return <<<HTML
<!-- wp:group {"tagName":"section","className":"mc-section--tight mc-section--sunken","layout":{"type":"constrained"}} -->
<section class="wp-block-group mc-section--tight mc-section--sunken" style="padding-top:var(--space-9);padding-bottom:var(--space-9)">
<!-- wp:group {"className":"mc-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-container">
<!-- wp:shortcode -->
[mc_trust]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Promise / who I help — editable centered head + 3 icon cards (wp:html).
 */
function mc_pattern_promise(): string {
	$target  = mc_icon( 'target', 26 );
	$compass = mc_icon( 'compass', 26 );
	$leaf    = mc_icon( 'leaf', 26 );

	$cards = <<<HTML
<div class="mc-grid-3">
	<div class="mc-promise-card mc-reveal">
		<div class="mc-promise-card__icon">{$target}</div>
		<h3>You're carrying the whole thing</h3>
		<p>Every decision routes through you. The team waits. The calendar wins. Growth has started to cost you your evenings — and your edge.</p>
	</div>
	<div class="mc-promise-card mc-reveal">
		<div class="mc-promise-card__icon">{$compass}</div>
		<h3>You want to lead, not just react</h3>
		<p>You don't need another framework. You need a thinking partner who helps you see the board clearly and act on what actually matters.</p>
	</div>
	<div class="mc-promise-card mc-reveal">
		<div class="mc-promise-card__icon">{$leaf}</div>
		<h3>And you refuse to burn out doing it</h3>
		<p>Real leadership compounds. We build the habits, boundaries, and clarity that let you scale your impact without scaling your stress.</p>
	</div>
</div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"mc-section mc-section--page","layout":{"type":"constrained"}} -->
<section class="wp-block-group mc-section mc-section--page">
<!-- wp:group {"className":"mc-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-container">
<!-- wp:group {"className":"mc-section-head mc-section-head--center","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-section-head mc-section-head--center">
<!-- wp:paragraph {"align":"center","className":"mc-eyebrow"} -->
<p class="has-text-align-center mc-eyebrow">Who I help</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","className":"mc-section-title"} -->
<h2 class="wp-block-heading has-text-align-center mc-section-title">If you're the one everyone <em>depends on</em></h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"mc-section-head__text"} -->
<p class="has-text-align-center mc-section-head__text">Here's what tends to be true when leaders find their way to me.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:spacer {"height":"3rem"} -->
<div style="height:3rem" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:html -->
{$cards}
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Services / packages — editable head + 3 offer cards (wp:html, middle featured).
 */
function mc_pattern_services(): string {
	$book  = mc_booking_url();
	$svc   = esc_url( home_url( '/services/' ) );
	$check = mc_icon( 'check', 19 );

	$cards = <<<HTML
<div class="mc-grid-3">
	<div class="mc-offer mc-reveal">
		<h3 class="mc-offer__name">The Course</h3>
		<p class="mc-offer__for">For self-starters</p>
		<div class="mc-offer__price"><span class="mc-offer__amount">\$390</span><span class="mc-offer__per">one-time</span></div>
		<div class="mc-offer__divider"></div>
		<ul class="mc-offer__list">
			<li class="mc-offer__item"><span class="mc-offer__check">{$check}</span>6 self-paced modules</li>
			<li class="mc-offer__item"><span class="mc-offer__check">{$check}</span>Lifetime access + updates</li>
			<li class="mc-offer__item"><span class="mc-offer__check">{$check}</span>The full ritual library</li>
			<li class="mc-offer__item"><span class="mc-offer__check">{$check}</span>Private community</li>
		</ul>
		<div class="mc-offer__cta"><a class="mc-btn mc-btn--secondary mc-btn--full" href="{$svc}">Explore the course</a></div>
	</div>
	<div class="mc-offer mc-offer--featured mc-reveal">
		<div class="mc-offer__badge"><span class="mc-badge mc-badge--solid">Most popular</span></div>
		<h3 class="mc-offer__name">1:1 Executive Coaching</h3>
		<p class="mc-offer__for">For founders &amp; senior leaders</p>
		<div class="mc-offer__price"><span class="mc-offer__amount">\$2,400</span><span class="mc-offer__per">/ month</span></div>
		<div class="mc-offer__divider"></div>
		<ul class="mc-offer__list">
			<li class="mc-offer__item"><span class="mc-offer__check">{$check}</span>Twice-monthly 60-min sessions</li>
			<li class="mc-offer__item"><span class="mc-offer__check">{$check}</span>Async support between calls</li>
			<li class="mc-offer__item"><span class="mc-offer__check">{$check}</span>A 90-day leadership plan</li>
			<li class="mc-offer__item"><span class="mc-offer__check">{$check}</span>Quarterly progress review</li>
		</ul>
		<div class="mc-offer__cta"><a class="mc-btn mc-btn--primary mc-btn--full" href="{$book}">Book a discovery call</a></div>
	</div>
	<div class="mc-offer mc-reveal">
		<h3 class="mc-offer__name">The Leadership Intensive</h3>
		<p class="mc-offer__for">For leadership teams</p>
		<div class="mc-offer__price"><span class="mc-offer__amount">Let's talk</span></div>
		<div class="mc-offer__divider"></div>
		<ul class="mc-offer__list">
			<li class="mc-offer__item"><span class="mc-offer__check">{$check}</span>12-week group program</li>
			<li class="mc-offer__item"><span class="mc-offer__check">{$check}</span>Weekly live cohorts</li>
			<li class="mc-offer__item"><span class="mc-offer__check">{$check}</span>Team alignment workshops</li>
			<li class="mc-offer__item"><span class="mc-offer__check">{$check}</span>Manager toolkit + playbooks</li>
		</ul>
		<div class="mc-offer__cta"><a class="mc-btn mc-btn--secondary mc-btn--full" href="{$svc}">Enquire for your team</a></div>
	</div>
</div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"mc-section mc-section--sunken","layout":{"type":"constrained"}} -->
<section class="wp-block-group mc-section mc-section--sunken">
<!-- wp:group {"className":"mc-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-container">
<!-- wp:group {"className":"mc-section-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-section-head">
<!-- wp:paragraph {"className":"mc-eyebrow"} -->
<p class="mc-eyebrow">Work with me</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"mc-section-title"} -->
<h2 class="wp-block-heading mc-section-title">Coaching built around <em>your</em> next season</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"mc-section-head__text"} -->
<p class="mc-section-head__text">Three ways to work together — from deep 1:1 partnership to a self-paced start.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:spacer {"height":"3rem"} -->
<div style="height:3rem" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:html -->
{$cards}
<!-- /wp:html -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * About teaser — editable image + story + stats (wp:html) + link.
 */
function mc_pattern_about(): string {
	$about = esc_url( home_url( '/about/' ) );
	$arrow = mc_icon( 'arrow-right', 17 );
	$img   = 'https://images.unsplash.com/photo-1551836022-deb4988cc6c0?auto=format&fit=crop&w=800&h=1000&q=80&crop=faces';

	$stats = <<<HTML
<div class="mc-stats">
	<div><div class="mc-stat__value">15</div><div class="mc-stat__label">Years coaching leaders</div></div>
	<div><div class="mc-stat__value">200+</div><div class="mc-stat__label">Executives partnered</div></div>
	<div><div class="mc-stat__value">93%</div><div class="mc-stat__label">Renew or refer</div></div>
</div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"mc-section mc-section--page","layout":{"type":"constrained"}} -->
<section class="wp-block-group mc-section mc-section--page">
<!-- wp:group {"className":"mc-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-container">
<!-- wp:columns {"verticalAlignment":"center","className":"mc-about"} -->
<div class="wp-block-columns are-vertically-aligned-center mc-about">
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:image {"className":"mc-about__image","sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large mc-about__image"><img src="{$img}" alt="Maren coaching a client"/></figure>
<!-- /wp:image -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center">
<!-- wp:paragraph {"className":"mc-eyebrow"} -->
<p class="mc-eyebrow">My story</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"mc-section-title"} -->
<h2 class="wp-block-heading mc-section-title">Fifteen years in the room with leaders who carry a lot</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"mc-about__lead"} -->
<p class="mc-about__lead">I spent a decade scaling operations teams before I learned the hard way that output without boundaries doesn't last. Now I help leaders do the harder, quieter work — leading from clarity instead of adrenaline.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"mc-about__note"} -->
<p class="mc-about__note">ICF Professional Certified Coach (PCC). Former VP of Operations. Trained in Polyvagal-informed leadership.</p>
<!-- /wp:paragraph -->
<!-- wp:html -->
{$stats}
<!-- /wp:html -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-mc-secondary"} -->
<div class="wp-block-button is-style-mc-secondary"><a class="wp-block-button__link wp-element-button" href="{$about}">Read the full story {$arrow}</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Testimonials — dark band, editable head + [mc_testimonials] slider.
 */
function mc_pattern_testimonials(): string {
	return <<<HTML
<!-- wp:group {"tagName":"section","className":"mc-section mc-testimonials","layout":{"type":"constrained"}} -->
<section class="wp-block-group mc-section mc-testimonials">
<!-- wp:group {"className":"mc-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-container">
<!-- wp:group {"className":"mc-section-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-section-head">
<!-- wp:paragraph {"className":"mc-eyebrow mc-eyebrow--on-dark"} -->
<p class="mc-eyebrow mc-eyebrow--on-dark">Success stories</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"mc-section-title"} -->
<h2 class="wp-block-heading mc-section-title">Results that <em>compound</em></h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"mc-section-head__text"} -->
<p class="mc-section-head__text">Real leaders. Real shifts. Concrete outcomes.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- wp:spacer {"height":"2.5rem"} -->
<div style="height:2.5rem" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:shortcode -->
[mc_testimonials]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Lead-magnet opt-in — accent panel, editable left copy + [mc_optin] form.
 */
function mc_pattern_optin(): string {
	$check = mc_icon( 'check', 18 );

	$list = <<<HTML
<ul class="mc-optin__list">
	<li>{$check}A weekly reset that takes 10 minutes</li>
	<li>{$check}The decision filter for hard calls</li>
	<li>{$check}How to protect deep work without guilt</li>
</ul>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"mc-section mc-section--page","layout":{"type":"constrained"}} -->
<section class="wp-block-group mc-section mc-section--page">
<!-- wp:group {"className":"mc-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-container">
<!-- wp:group {"className":"mc-optin-panel","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-optin-panel">
<!-- wp:columns {"verticalAlignment":"center"} -->
<div class="wp-block-columns are-vertically-aligned-center">
<!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">
<!-- wp:paragraph {"className":"mc-eyebrow"} -->
<p class="mc-eyebrow">Free guide</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"mc-optin__title"} -->
<h2 class="wp-block-heading mc-optin__title">The Calm Operator's Playbook</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"className":"mc-optin__lead"} -->
<p class="mc-optin__lead">Seven rituals the best leaders use to stay clear and decisive under pressure. A 12-page field guide, free.</p>
<!-- /wp:paragraph -->
<!-- wp:html -->
{$list}
<!-- /wp:html -->
</div>
<!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
<!-- wp:shortcode -->
[mc_optin]
<!-- /wp:shortcode -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Resources teaser — editable head + "browse all" link + [mc_resources].
 */
function mc_pattern_resources(): string {
	$res   = esc_url( home_url( '/resources/' ) );
	$arrow = mc_icon( 'arrow-right', 17 );

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"mc-section mc-section--sunken","layout":{"type":"constrained"}} -->
<section class="wp-block-group mc-section mc-section--sunken">
<!-- wp:group {"className":"mc-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-container">
<!-- wp:group {"className":"mc-flex-head","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group mc-flex-head">
<!-- wp:group {"className":"mc-section-head","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-section-head">
<!-- wp:paragraph {"className":"mc-eyebrow"} -->
<p class="mc-eyebrow">Resources</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"mc-section-title"} -->
<h2 class="wp-block-heading mc-section-title">Ideas worth your <em>attention</em></h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button {"className":"is-style-mc-ghost"} -->
<div class="wp-block-button is-style-mc-ghost"><a class="wp-block-button__link wp-element-button" href="{$res}">Browse all articles {$arrow}</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
<!-- wp:shortcode -->
[mc_resources count="3"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * FAQ — editable head (left) + [mc_faq] accordion (right).
 */
function mc_pattern_faq(): string {
	return <<<HTML
<!-- wp:group {"tagName":"section","className":"mc-section mc-section--page","layout":{"type":"constrained"}} -->
<section class="wp-block-group mc-section mc-section--page">
<!-- wp:group {"className":"mc-container","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-container">
<!-- wp:columns {"className":"mc-faq-layout"} -->
<div class="wp-block-columns mc-faq-layout">
<!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%">
<!-- wp:paragraph {"className":"mc-eyebrow"} -->
<p class="mc-eyebrow">Questions</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"className":"mc-section-title"} -->
<h2 class="wp-block-heading mc-section-title">Good to <em>know</em></h2>
<!-- /wp:heading -->
</div>
<!-- /wp:column -->
<!-- wp:column {"width":"60%"} -->
<div class="wp-block-column" style="flex-basis:60%">
<!-- wp:shortcode -->
[mc_faq]
<!-- /wp:shortcode -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/**
 * Final CTA band — dark, editable headline + dual CTA, brand mark (wp:html).
 */
function mc_pattern_final_cta(): string {
	$book  = mc_booking_url();
	$arrow = mc_icon( 'arrow-right', 19 );
	$mail  = mc_icon( 'mail', 17 );
	$mark  = mc_mark( 44 );

	$markup = <<<HTML
<div class="mc-final__mark">{$mark}</div>
HTML;

	return <<<HTML
<!-- wp:group {"tagName":"section","className":"mc-section mc-final","layout":{"type":"constrained"}} -->
<section class="wp-block-group mc-section mc-final">
<!-- wp:group {"className":"mc-container mc-final__inner","layout":{"type":"constrained"}} -->
<div class="wp-block-group mc-container mc-final__inner">
<!-- wp:html -->
{$markup}
<!-- /wp:html -->
<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">Ready to lead from <em>clarity?</em></h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"mc-final__lead"} -->
<p class="has-text-align-center mc-final__lead">Book a free 30-minute discovery call. We'll map where you are, where you want to be, and whether we're a fit.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"className":"mc-final__actions"} -->
<div class="wp-block-buttons mc-final__actions">
<!-- wp:button {"className":"is-style-mc-primary mc-btn--lg"} -->
<div class="wp-block-button is-style-mc-primary mc-btn--lg"><a class="wp-block-button__link wp-element-button" href="{$book}">Book a discovery call {$arrow}</a></div>
<!-- /wp:button -->
<!-- wp:button {"className":"is-style-mc-secondary mc-btn--lg mc-btn--on-dark"} -->
<div class="wp-block-button is-style-mc-secondary mc-btn--lg mc-btn--on-dark"><a class="wp-block-button__link wp-element-button" href="#optin">{$mail} Get the free guide</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML;
}

/* ============================================================
   Registration
   ============================================================ */
function mc_register_block_patterns(): void {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	$cat      = [ 'maren-cole' ];
	$patterns = [
		'maren-cole/hero'         => [ __( 'Home: Hero', 'maren-cole' ),            __( 'Eyebrow, headline with italic accent, dual CTA, social proof and portrait with credential badge.', 'maren-cole' ), mc_pattern_hero() ],
		'maren-cole/trust'        => [ __( 'Home: Trust strip', 'maren-cole' ),     __( '“As featured in” logo row (edit the list inline).', 'maren-cole' ),                              mc_pattern_trust() ],
		'maren-cole/promise'      => [ __( 'Home: Who I help', 'maren-cole' ),       __( 'Centered heading and three icon cards naming the reader’s situation.', 'maren-cole' ),           mc_pattern_promise() ],
		'maren-cole/services'     => [ __( 'Home: Work with me', 'maren-cole' ),     __( 'Three offer cards (middle featured) with prices, outcomes and CTAs.', 'maren-cole' ),            mc_pattern_services() ],
		'maren-cole/about'        => [ __( 'Home: About teaser', 'maren-cole' ),     __( 'Portrait, story copy, stats and a link to the full About page.', 'maren-cole' ),                 mc_pattern_about() ],
		'maren-cole/testimonials' => [ __( 'Home: Success stories', 'maren-cole' ),  __( 'Dark band with a testimonial slider (concrete result chips).', 'maren-cole' ),                   mc_pattern_testimonials() ],
		'maren-cole/optin'        => [ __( 'Home: Free-guide opt-in', 'maren-cole' ),__( 'Lead-magnet panel with benefits list and an email capture form.', 'maren-cole' ),                mc_pattern_optin() ],
		'maren-cole/resources'    => [ __( 'Home: Resources', 'maren-cole' ),        __( 'Latest three posts as cards (demo articles until you publish).', 'maren-cole' ),                 mc_pattern_resources() ],
		'maren-cole/faq'          => [ __( 'Home: FAQ', 'maren-cole' ),              __( 'Two-column FAQ with an expanding accordion.', 'maren-cole' ),                                    mc_pattern_faq() ],
		'maren-cole/final-cta'    => [ __( 'Home: Final CTA band', 'maren-cole' ),   __( 'Dark closing band with the brand mark and the booking CTA.', 'maren-cole' ),                    mc_pattern_final_cta() ],
	];

	foreach ( $patterns as $name => $args ) {
		register_block_pattern( $name, [
			'title'       => $args[0],
			'description' => $args[1],
			'categories'  => $cat,
			'content'     => $args[2],
		] );
	}

	// Combined full home page — every section in design order.
	register_block_pattern( 'maren-cole/home', [
		'title'       => __( 'Full home page', 'maren-cole' ),
		'description' => __( 'The entire home page at once: hero, trust strip, who I help, services, about, success stories, opt-in, resources, FAQ and final CTA.', 'maren-cole' ),
		'categories'  => $cat,
		'content'     =>
			mc_pattern_hero() .
			mc_pattern_trust() .
			mc_pattern_promise() .
			mc_pattern_services() .
			mc_pattern_about() .
			mc_pattern_testimonials() .
			mc_pattern_optin() .
			mc_pattern_resources() .
			mc_pattern_faq() .
			mc_pattern_final_cta(),
	] );
}
add_action( 'init', 'mc_register_block_patterns' );
