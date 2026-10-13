import { defineConfig, presetTypography, presetWind4 } from 'unocss';

/**
 * UnoCSS configuration for the Web Hustle WordPress theme.
 *
 * The theme's design tokens are injected at runtime by `inc/design-tokens.php`
 * as CSS variables (`--wh-*`). Here we map them to UnoCSS theme colors so the
 * utility classes (`bg-primary`, `text-accent`, `border-surface`, ...) resolve
 * to those variables — which keeps the WordPress Customizer live.
 *
 * Build: `npm run css` (outputs `web-hustle/assets/uno.css`)
 */
export default defineConfig({
  presets: [
    // Tailwind v4 compatible preset (includes the Tailwind-style reset/preflight).
    presetWind4({ preflights: { reset: true } }),
    presetTypography(),
  ],
  theme: {
    colors: {
      primary: {
        DEFAULT: 'var(--wh-primary)',
        600: 'var(--wh-primary)',
        700: 'var(--wh-primary)',
      },
      secondary: 'var(--wh-secondary)',
      accent: {
        DEFAULT: 'var(--wh-accent)',
        600: 'var(--wh-accent)',
        700: 'var(--wh-accent)',
      },
      background: 'var(--wh-background)',
      surface: 'var(--wh-surface)',
    },
    spacing: {
      section: 'var(--wh-section-gap, 4rem)',
      content: 'var(--wh-content-max, 800px)',
    },
  },
  // Classes composed dynamically in PHP templates.
  safelist: ['grid-cols-1', 'grid-cols-2', 'col-span-full'],
});
