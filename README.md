# gui·olsen design system

Visual language, tokens, and implementation guide for guiolsendesign.com

**Version:** 1.0  
**Last updated:** June 2026  
**Stack:** WordPress, Hello Elementor (child theme), Elementor Free

---

## What's in this repo

| Folder | Contents |
|---|---|
| `/tokens` | **Reusable design system (Aug 2026).** Variable-based tokens + classes — the base for every new client project. Edit the color/font variables here per project, then push to Figma and Elementor. See [`tokens/design-system-reference.md`](tokens/design-system-reference.md). |
| `/css` | Global CSS for guiolsendesign.com specifically — hardcoded values, WordPress/Elementor selectors, blog post styles. Not project-portable. |
| `/theme` | WordPress child theme files and page templates for guiolsendesign.com. |
| `/docs` | Original (June 2026) design decisions for guiolsendesign.com, documented in markdown. Each file now links to the variable-based version in `/tokens`. |

---

## Quick reference

**Fonts:** Syne (headings, `font-secondary`) + Inter (body, `font-primary`)  
**Accent:** `#0066FF`  
**Primary:** `#0F0F0F`  
**Max width:** `1200px`  
**Base spacing unit:** `4px`

For a new client project: copy `/tokens`, edit the 11 color variables + 2 font variables in `design-tokens.json`/`.css` for that brand. Everything else (sizes, spacing, radius, class definitions) stays as-is.

---

## Setup

1. Upload `/theme/child-theme/` to `/wp-content/themes/` on your WordPress install
2. Activate the child theme in Appearance → Themes
3. Paste `/css/global.css` contents into Elementor → Site Settings → Custom CSS
4. Add Inter + Syne font enqueue from `/theme/child-theme/functions.php`

---

## Pages

| Page | URL | Status |
|---|---|---|
| Homepage | `/` | In progress |
| Work | `/work` | In progress |
| Services | `/services` | In progress |
| Blog | `/blog` | In progress |
| About | `/about` | In progress |
| Contact | `/contact` | In progress |

---

## Design system docs

- [Colors](docs/colors.md)
- [Typography](docs/typography.md)
- [Spacing](docs/spacing.md)
- [Components](docs/components.md)
