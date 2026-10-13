# Web Hustle — a WordPress theme, modernized

**Web Hustle** is an open-source WordPress + WooCommerce theme — an atomic-CSS take on the classic monolithic theme, built with **[UnoCSS](https://unocss.dev/)** and [Alpine.js](https://alpinejs.dev/).

It is maintained by **[Take the Space](https://takethe.space)** as a reference for modern, edge-friendly WordPress builds.

> 🙏 A note of respect: WordPress built a huge part of the open web, and this theme keeps its structure, hooks and spirit. It simply swaps the asset pipeline (an in-browser CSS CDN) for a proper, prebuilt, production-grade one.

---

## ✨ What is modern here

- **UnoCSS instead of a CSS CDN** — utilities are generated at build time into a single `assets/uno.css`. No runtime CSS compiler, no FOUC, no external dependency.
- **Tailwind-compatible syntax** — the theme uses `presetWind4`, so the familiar classes (`flex`, `grid`, `px-4`, `text-[var(--wh-primary)]`) still read the same.
- **Design tokens stay in WordPress** — colors/layout are injected by `inc/design-tokens.php` as `--wh-*` CSS variables and mapped into the UnoCSS `theme`, so the **Customizer remains live**.
- **Alpine.js** for light interactivity (side-cart, toggles) — no jQuery, no React.
- **WooCommerce** ready: custom wrappers, mini-cart, memberships badges, AJAX cart fragments.

## 🚀 Quick start

```bash
# 1. Install build tooling
npm install

# 2. Build the utility stylesheet (outputs web-hustle/assets/uno.css)
npm run css

# Develop with a watcher
npm run css:watch
```

Then drop `web-hustle/` into `wp-content/themes/` and activate **Web Hustle**.

> The build output `web-hustle/assets/uno.css` is committed so the theme works out of the box — run `npm run css` again after editing templates or `uno.config.ts`.

## 🧱 Stack

| Layer | Choice |
| --- | --- |
| CSS engine | UnoCSS (`presetWind4` — Tailwind v4 compatible) |
| Interactivity | Alpine.js |
| Commerce | WooCommerce (+ Memberships) |
| Fonts | Inter, Plus Jakarta Sans |

## 🎛 Design tokens

All tokens are CSS variables (`inc/design-tokens.php`) and are mapped in [`uno.config.ts`](./uno.config.ts):

| Variable | Purpose | Default |
| --- | --- | --- |
| `--wh-primary` | Primary text / dark elements | `#1a1a1a` |
| `--wh-secondary` | Secondary text | `#4a4a4a` |
| `--wh-accent` | Buttons & links | `#007bff` |
| `--wh-background` | Page background | `#ffffff` |
| `--wh-surface` | Cards / sections | `#f8f9fa` |
| `--wh-container-max` | Max site width | `1920px` |
| `--wh-content-max` | Narrow content width | `800px` |
| `--wh-section-gap` | Vertical section spacing | `4rem` |

### Usage

```html
<div class="bg-surface border border-surface p-6 rounded-xl">
    <h2 class="text-primary font-bold">Title</h2>
    <button class="bg-accent text-white px-4 py-2 rounded-lg">Action</button>
</div>
```

## 🧩 Hooks & logic

Modular PHP in `inc/`:

- `wh_setup` — theme init (menus, thumbnails, title-tag, WooCommerce support).
- `wh_enqueue_scripts` — fonts + `style.css` + `assets/uno.css` + Alpine.
- `wh_inject_design_tokens` — injects the `--wh-*` variables.
- `wh_customize_register` — Customizer options (colors, typography, layout).
- `wh_comment_callback`, `wh_breadcrumbs`, `wh_woocommerce_*` — UI helpers.

## 🛒 WooCommerce

Defaults are reset; custom templates live in `woocommerce/`. The Alpine-powered **side cart** opens on the `wh-open-side-cart` window event. Memberships support adds member badges and styled restriction messages (`inc/memberships.php`).

## 🤝 Credits

Maintained by [Take the Space](https://takethe.space) — an AI-first engineering studio that builds fast, open, edge-native websites. If you are weighing WordPress against modern stacks for a new project, our team has written about it on [takethe.space](https://takethe.space).

## 📄 License

MIT.
