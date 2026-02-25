# WEB HUSTLE: TECHNICAL SPECIFICATION v3.0

## 1. Structure
- **Theme Folder:** `/wp-content/themes/web-hustle/`
- **Logic Layer:** All PHP logic, hooks, and WooCommerce setup must reside in `/themes/web-hustle/inc/`.
- **View Layer:** Root templates (`index.php`, `header.php`, `page.php`, `single.php`, `archive.php`, `404.php`) and `/themes/web-hustle/woocommerce/` for overrides.

## 2. Tech Stack
- **Styling:** Tailwind CSS (v3.4.1) via CDN.
- **Interactivity:** Alpine.js (v3.x).
- **Commerce:** WooCommerce (Total style reset via `inc/woocommerce-setup.php`).

## 3. Implementation Rules
- **Prefix:** Use `wh_` for all functions and constants.
- **Modular Logic:**
    - `inc/enqueue.php` — Scripts and styles.
    - `inc/woocommerce-setup.php` — WC support and clean-up.
    - `inc/design-tokens.php` — CSS variables injection.
- **Safety:** Strict use of `esc_html`, `esc_attr`, and `wp_kses`.

## 4. Documentation
- Maintain `DOCS.md` inside the theme folder with hooks and CSS variables list.