# gui·olsen design system

Visual language, tokens, and implementation guide for guiolsendesign.com

**Version:** 1.0  
**Last updated:** June 2026  
**Stack:** WordPress, Hello Elementor (child theme), Elementor Free

---

## What's in this repo

| Folder | Contents |
|---|---|
| `/css` | Global CSS — design tokens, typography, components |
| `/theme` | WordPress child theme files and page templates |
| `/docs` | Design decisions documented in markdown |

---

## Quick reference

**Fonts:** Syne (headings) + Inter (body)  
**Accent:** `#0066FF`  
**Dark bg:** `#0F0F0F`  
**Light bg:** `#FFFFFF`  
**Max width:** `1200px`  
**Base spacing unit:** `4px`

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
