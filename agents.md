# GeorgeAG Theme — Agent Guide

WordPress custom theme for Naif Arts museum (Minsk). Based on Underscores (_s).

## Commands

```bash
composer install         # PHP deps (PHPCS, parallel-lint)
npm install              # JS deps (wp-scripts, rtlcss)

# Linting
composer lint:wpcs       # PHP coding standards (WordPress + WPThemeReview)
composer lint:php        # PHP syntax check (parallel-lint)
npm run lint:scss        # SCSS lint (but sass/ dir doesn't exist — skip)
npm run lint:js          # JS lint (WordPress standards)

# No build step needed for styles
# TailwindCSS v4 loaded via CDN in header.php
# All custom CSS is inline in header.php <style> block
```

## Critical Architecture Facts

- **No SCSS compilation.** `sass/` directory doesn't exist. `npm run watch` and `npm run compile:css` reference it and will fail. All styles live inline in `header.php` (lines 28–546) or as Tailwind utility classes in templates.
- **TailwindCSS v4 via CDN.** Loaded in `header.php:27`. Custom theme config is in a `<style type="text/tailwindcss">` block. Fonts (`Literata`, `Golos Text`) loaded via Google Fonts.
- **ACF fields are code-defined**, not JSON. All field groups in `inc/acf-fields.php` using `acf_add_local_field_group()`. Requires ACF plugin active.
- **Three custom post types** (all in `inc/events-cpt.php`):
  - `vystavka` — Exhibitions (slug: `vystavka`, rewrite: `/vystavka/`)
  - `event` — Events (slug: `events`, taxonomy: `event_category`)
  - `subscription` — Subscriptions (slug: `subscriptions`)
- **Vystavka has a separate template** (`single-vystavka.php`, `exhibition.php`) with its own ACF field set (prefixed `sv_*`).
- **Duplicate functionality** built into events, vystavka, and subscriptions CPTs.

## File Layout

```
functions.php            # Theme setup, enqueues, includes
header.php               # <head>, Tailwind config, ALL custom CSS (~550 lines inline), nav
footer.php               # Site footer
homepage.php             # Homepage template (ACF-driven sections)
exhibition.php           # Exhibition page template
afisha.php               # Events/schedule page
shop-catalog.php         # Shop catalog page
about.php                # About museum
cafe.php, contacts.php   # Static pages
single-event.php         # Single event
single-vystavka.php      # Single exhibition
single-product.php       # WooCommerce product (if active)
inc/
  acf-fields.php         # ACF field group registrations (~1450 lines)
  events-cpt.php         # Event, vystavka, subscription CPTs + duplicate logic
  template-tags.php      # Template helper functions
  template-functions.php # WordPress hooks
  customizer.php         # Customizer settings
  custom-header.php      # Custom header support
  jetpack.php            # Jetpack compatibility
img/                     # SVG icons + a few PNGs (no hero/event images yet)
js/navigation.js         # Desktop nav (from _s, mostly unused — mobile uses inline JS)
js/customizer.js         # Customizer preview
template-parts/          # content.php, content-page.php, content-search.php,
                         # content-none.php, special-exposition.php, subscription-card.php
```

## ACF Field Access Pattern

```php
// Simple field
$title = get_field('hero_title');

// Group field (e.g., CTA buttons)
$cta = get_field('hero_cta_primary');
echo esc_html($cta['text']);
echo esc_url($cta['link']);

// Repeater
$events = get_field('upcoming_events');
if ($events) {
    foreach ($events as $event) {
        echo esc_html($event['title']);
    }
}
```

## Conventions

- **Text domain:** `georgeag`
- **Function prefix:** `georgeag_`
- **Language:** All UI text is Russian
- **Escaping:** Use `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()`
- **Colors (CSS vars in `:root`):**
  - `--brand-orange: #F28A2E` (primary)
  - `--brand-cream: #FAF6EF` (background)
  - `--brand-text: #2D2926` (text)
- **Button classes:** `.btn-primary` (orange filled), `.btn-secondary` (cream + orange border), `.btn-outline` (transparent + orange border)
- **Responsive hide:** `.hide-mobile` / `.hide-desktop` (custom, not Tailwind)
- **Container:** `.container-main` (max-width: 1240px, centered)
- **Image placeholders:** `.ph-hero`, `.ph-museum`, `.ph-ussr`, `.ph-shop`, `.ph-cta`, `.ph-art1-5` — gradient backgrounds until real images

## Gotchas

- `navigation.js` looks for `#site-navigation` element — mobile menu is actually handled by inline JS in `header.php` (burger button `#menuBtn` toggles `.mobile-menu`).
- `functions.php` enqueues `georgeag-navigation` script but the actual mobile toggle doesn't depend on it.
- PHPCS config (`phpcs.xml.dist`) still references `_s` as text domain prefix — will flag false positives on `georgeag` prefixed globals.
- The `homepage.php` template is assigned to the front page via WordPress page template selector, not `front-page.php`.
- Exhibition single pages use `single-vystavka.php` (not `single.php`). The vystavka CPT ACF fields use `sv_` prefix for hero, about, what-to-see, practical info, and CTA sections.
