# WEB HUSTLE: THEME DOCUMENTATION

## 1. Overview
**Web Hustle** is a premium, monolithic WordPress theme designed for high-performance e-commerce. It utilizes a modern front-end stack while maintaining a clean, modular PHP structure.

- **Prefix:** `wh_`
- **Text Domain:** `web-hustle`
- **Stack:** Tailwind CSS (v4.0.0), Alpine.js (v3.x)

---

## 2. CSS Variables (Design Tokens)
All styling is controlled via CSS variables injected in `wp_head`. These are also mapped to Tailwind v4 `@theme` tokens.

| Variable | Description | Default Value |
|----------|-------------|---------------|
| `--wh-primary` | Main text and dark elements | `#1a1a1a` |
| `--wh-secondary` | Secondary text and accents | `#4a4a4a` |
| `--wh-accent` | Action colors (buttons, links) | `#007bff` |
| `--wh-background` | Page background | `#ffffff` |
| `--wh-surface` | Card and section backgrounds | `#f8f9fa` |
| `--wh-container-max` | Maximum site width | `1920px` |
| `--wh-content-max` | Maximum content width (narrow layout) | `800px` |
| `--wh-section-gap` | Vertical spacing between sections | `4rem` |
| `--wh-font-sans` | Primary font family | `'Inter', 'Plus Jakarta Sans', sans-serif` |

---

## 3. Custom Hooks & Logic
Logic is modularized in the `inc/` directory.

### Hooks List
- `wh_setup`: Theme initialization (menus, thumbnails, title-tag).
- `wh_enqueue_scripts`: Loading assets (Tailwind v4, Alpine, style.css).
- `wh_inject_design_tokens`: Injects CSS variables and Tailwind v4 `@theme` configuration.
- `wh_customize_register`: Registers Theme Customizer options (Colors, Typography, Layout).
- `wh_comment_callback`: Custom callback for styled comments list.
- `wh_breadcrumbs`: Custom breadcrumbs navigation.
- `wh_woocommerce_setup`: WC support and style reset.
- `wh_woocommerce_header_add_to_cart_fragment`: AJAX fragments for side-cart updates.
- `wh_woocommerce_add_to_cart_script`: Script to trigger side-cart opening on add-to-cart event.

---

## 4. Usage Snippets

### Tailwind v4 + CSS Variables
Use Tailwind classes that map to our design tokens (defined via `@theme` in `inc/design-tokens.php`):
```html
<div class="bg-surface border border-surface p-6 rounded-xl">
    <h2 class="text-primary font-bold">Title</h2>
    <button class="bg-accent text-white px-4 py-2 rounded-lg">Action</button>
</div>
```

### Alpine.js Interactivity
Example of a simple toggle:
```html
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    <div x-show="open" x-transition>Content</div>
</div>
```

---

## 5. Gutenberg Support
The theme includes a `theme.json` file that synchronizes our design tokens with the WordPress Block Editor. This allows you to use theme colors and layout settings directly within Gutenberg.

## 6. WooCommerce Customization
The theme resets default WooCommerce styles. All custom layouts are located in the `woocommerce/` directory of the theme.
- **Wrapper Start:** `wh_woocommerce_wrapper_start` (hooked to `woocommerce_before_main_content`)
- **Wrapper End:** `wh_woocommerce_wrapper_end` (hooked to `woocommerce_after_main_content`)
- **Side Cart:** Alpine.js powered side-cart triggered by `wh-open-side-cart` window event.
- **Mini Cart Template:** Custom `woocommerce/cart/mini-cart.php` with Tailwind styling.

## 7. WooCommerce Memberships
The theme includes built-in support for WooCommerce Memberships:
- **Member Badges:** Automatically added to restricted products in the shop loop and to titles on single pages.
- **Custom Restriction Messages:** Styled using theme design tokens (Surface background, Accent icons).
- **Logic File:** `inc/memberships.php`
