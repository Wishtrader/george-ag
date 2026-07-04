# GeorgeAG Theme - Agent Architecture & Responsibilities

## Overview

This document outlines the agent architecture and responsibilities for developing and maintaining the GeorgeAG WordPress theme for Naif Arts museum (Minsk).

## Project Context

- **Theme:** WordPress custom theme based on Underscores (_s)
- **Purpose:** Museum website for Naif Arts (Minsk)
- **Tech Stack:**
  - WordPress (PHP)
  - TailwindCSS v4 (CDN)
  - Google Fonts: Literata (headers), Golos Text (body)
  - Vanilla JavaScript (no frameworks)
  - ACF (Advanced Custom Fields)

## Agent Roles & Responsibilities

### 1. Theme Development Agent

**Responsibilities:**
- Implement WordPress theme templates and template parts
- Manage PHP functions and WordPress hooks
- Integrate ACF field groups into templates
- Ensure WordPress coding standards compliance
- Handle theme customization and customizer settings

**Key Files:**
- `functions.php` - Theme setup, enqueuing scripts/styles, theme support
- `header.php` - Site header with navigation, logo, mobile menu
- `footer.php` - Site footer
- Template files: `homepage.php`, `index.php`, `single.php`, `page.php`, `archive.php`, `404.php`

### 2. Styling Agent

**Responsibilities:**
- Implement TailwindCSS v4 styling via CDN
- Create custom CSS for theme-specific components
- Ensure responsive design across breakpoints
- Manage color palette implementation:
  - `--brand-orange: #F28A2E`
  - `--brand-cream: #F4EA`
  - `--brand-text: #3A2E24`
- Handle dark mode styling (if required)
- Create button and link styles

**Key Files:**
- `style.css` - Main stylesheet (base + custom)
- Inline Tailwind via CDN

### 3. JavaScript Agent

**Responsibilities:**
- Implement mobile menu navigation logic
- Handle customizer preview functionality
- Ensure vanilla JS best practices
- Optimize for performance

**Key Files:**
- `js/navigation.js` - Mobile menu toggle and navigation
- `js/customizer.js` - Customizer preview enhancements

### 4. ACF Integration Agent

**Responsibilities:**
- Define and register ACF field groups
- Map field groups to template data
- Implement repeater field handling
- Ensure proper field sanitization and escaping

**Field Groups (defined in `inc/acf-fields.php`):**

1. **Hero Section** - Hero image, title, description, CTAs
2. **Preview Events** - Event preview cards (max 3)
3. **Upcoming Events** - Event listings with dates, titles, descriptions
4. **About Museum** - Museum description and image
5. **Expositions** - Exhibition listings (max 4)
6. **Special Exposition** - Featured exhibition banner
7. **Classes & Lectures** - Masterclasses and lecture listings
8. **Museum Shop** - Product listings for museum store
9. **Why Us** - Value proposition cards with icons
10. **CTA Section** - Call-to-action banner

### 5. Template Architecture Agent

**Responsibilities:**
- Design and implement template hierarchy
- Create reusable template parts
- Ensure proper WordPress template tags usage
- Handle conditional logic for different content types

**Template Structure:**
```
georgeag/
├── header.php          # Header with navigation
├── footer.php          # Footer
├── homepage.php        # Homepage template
├── index.php           # Blog index
├── single.php          # Single post
├── page.php            # Single page
├── archive.php         # Archive pages
├── 404.php             # 404 page
├── functions.php       # Theme functions
├── style.css           # Main stylesheet
├── inc/                # Includes directory
│   ├── custom-header.php
│   ├── customizer.php
│   ├── template-tags.php
│   ├── template-functions.php
│   ├── jetpack.php
│   └── acf-fields.php
├── js/
│   ├── navigation.js
│   └── customizer.js
├── img/                # SVG icons
└── template-parts/     # Reusable template parts
```

### 6. Performance & Optimization Agent

**Responsibilities:**
- Optimize asset loading
- Implement proper image handling
- Ensure fast page load times
- Handle lazy loading for images
- Optimize CSS delivery via CDN

### 7. Accessibility Agent

**Responsibilities:**
- Ensure WCAG compliance
- Implement proper semantic HTML
- Handle keyboard navigation
- Manage ARIA attributes
- Ensure color contrast ratios

## Communication Protocols

### File Structure Updates
- All new template files must follow WordPress naming conventions
- Template parts should be placed in `/template-parts/`
- Custom functions should be in `/inc/` directory

### Code Standards
- PHP: Follow WordPress PHP Coding Standards
- CSS: Follow WordPress CSS Coding Standards
- JS: Follow WordPress JavaScript Coding Standards
- Use proper escaping: `esc_html()`, `esc_attr()`, `wp_kses_post()`

### ACF Field Access
```php
// Simple field
$title = get_field('hero_title');

// Group field
$cta = get_field('hero_cta_primary');
echo esc_html($cta['text']);
echo esc_url($cta['link']);

// Repeater field
$events = get_field('upcoming_events');
if ($events) {
    foreach ($events as $event) {
        echo esc_html($event['title']);
    }
}
```

## Development Workflow

1. **Feature Branch:** Create feature branches for new functionality
2. **Code Review:** Submit PRs for review before merging
3. **Testing:** Test across different devices and browsers
4. **Documentation:** Update this document for major changes

## Breakpoints

Tailwind default breakpoints:
- `sm`: 640px
- `md`: 768px (mobile breakpoint)
- `lg`: 1024px
- `xl`: 1280px

## Utilities

### Hide Classes
- `.hide-mobile` - Hide on mobile
- `.hide-desktop` - Hide on desktop

### Button Classes
- `.btn-primary` - Orange filled button
- `.btn-outline` - Transparent button with orange border

### Link Classes
- `.link-arrow` - Link with animated arrow

### Image Placeholders
- `.ph-hero`, `.ph-museum`, `.ph-ussr`, `.ph-shop`, `.ph-cta` - Section-specific placeholders

## Notes

- Theme is currently in development
- Images use placeholder gradients (to be replaced with real assets)
- Content is static (not from WooCommerce/ACF yet)
- All text is in Russian
- Theme optimized for Minsk audience