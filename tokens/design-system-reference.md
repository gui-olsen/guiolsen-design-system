# gui·olsen — Design System Reference

Cross-tool implementation guide. Figma variables, Elementor v4 Variables/Classes, the GitHub component library, and Claude generating code from a Figma prototype should all match the names and values below.

**Source of truth:** `design-tokens.json` (edit here first, then propagate everything else from it).

## Architecture — two layers

1. **Primitives** (`design-tokens.json` / `design-tokens.css`) — the values you edit for every new project: 11 color variables + 2 font families. Sizes, spacing and radius are the fixed system scale and don't change per project.
2. **Classes** (`components.css`) — buttons and typography, built entirely from the primitives via `var()`. Never a hardcoded hex or px. Swap the primitives and every class reskins at once.

## Primitives

### Color (edit per project)

| Variable | Value | Role |
|---|---|---|
| `color-primary` | `#0F0F0F` | Headings, primary text, `.btn-secondary` fill |
| `color-primary-hover` | `#1A1A1A` | Hover state for primary-colored elements |
| `color-primary-tint` | `#F4F4F4` | Light tint of primary — subtle backgrounds, cards |
| `color-secondary` | `#555555` | Supporting/muted text |
| `color-secondary-hover` | `#6E6E6E` | Hover state for secondary-colored elements |
| `color-secondary-tint` | `#E5E5E5` | Light tint of secondary — borders, dividers |
| `color-accent` | `#0066FF` | CTAs, links, eyebrow labels — one per section max |
| `color-accent-hover` | `#0052CC` | Accent hover state |
| `color-accent-tint` | `#E6F0FF` | Badges, subtle accent backgrounds |
| `white` | `#FFFFFF` | Base neutral — rarely changes |
| `black` | `#0F0F0F` | Base neutral — rarely changes |

`color-primary` and `black` happen to share a value in this project by design (primary = brand identity, black = fixed neutral) — they can diverge on a client with a colored brand primary.

### Font (edit per project)

| Variable | Value | Role |
|---|---|---|
| `font-primary` | Inter | Body/UI text |
| `font-secondary` | Syne | Headings (display, H1, H2, H3) |

### Font size (fixed scale)

| Variable | Value |
|---|---|
| `font-display` | 64px |
| `font-h1` | 40px |
| `font-h2` | 28px |
| `font-h3` | 18px |
| `font-body-lg` | 18px |
| `font-body` | 16px |
| `font-body-sm` | 14px |
| `font-eyebrow` | 12px |
| `font-caption` | 12px |
| `font-button` | 14px |

### Spacing (fixed scale, base 4px — name = px value)

`space-4, space-8, space-12, space-16, space-24, space-32, space-48, space-64, space-96, space-128`

### Radius (fixed scale)

| Variable | Value | Usage |
|---|---|---|
| `radius-none` | 0px | Buttons, tags (brand default) |
| `radius-sm` | 2px | Inputs, CTAs |
| `radius-md` | 4px | Cards |
| `radius-lg` | 8px | Modals, panels |
| `radius-rounded` | 999px | Full pill — opt-in, not used by default |

## Classes

### Buttons

| Class | Background | Text | Border | Hover |
|---|---|---|---|---|
| `.btn-primary` | `color-accent` | `white` | — | bg → `color-accent-hover` |
| `.btn-secondary` | `color-primary` | `white` | — | bg → `color-primary-hover` |
| `.btn-outlined` | transparent | `color-primary` | `1px solid color-primary` | border/text → `color-accent` |

Modifiers: `.btn--lg` (larger padding, hero CTAs).

> Note: the live guiolsendesign.com site (`css/global.css` in this repo) has an older 3-variant system — Primary / Secondary (outlined) / Ghost (underlined link) — with different class semantics for `.btn-secondary`. That file wasn't touched by this update. Don't load both stylesheets on the same page without reconciling the two `.btn-secondary` definitions first.

### Typography

| Class | Font | Color | Size | Weight | Tracking | Line-height |
|---|---|---|---|---|---|---|
| `.text-display` | secondary (Syne) | primary | `font-display` | 800 | -0.03em | 1.1 |
| `.text-h1` | secondary (Syne) | primary | `font-h1` | 700 | -0.025em | 1.15 |
| `.text-h2` | secondary (Syne) | primary | `font-h2` | 700 | -0.02em | 1.15 |
| `.text-h3` | secondary (Syne) | primary | `font-h3` | 600 | -0.01em | 1.2 |
| `.text-body-lg` | primary (Inter) | primary | `font-body-lg` | 400 | normal | 1.7 |
| `.text-body` | primary (Inter) | primary | `font-body` | 400 | normal | 1.7 |
| `.text-body-sm` | primary (Inter) | secondary | `font-body-sm` | 400 | normal | 1.6 |
| `.text-eyebrow` | primary (Inter) | accent | `font-eyebrow` | 500 | 0.08em, uppercase | — |
| `.text-caption` | primary (Inter) | secondary | `font-caption` | 400 | normal | — |

## Files in `/tokens`

| File | Purpose |
|---|---|
| `design-tokens.json` | Master tokens, W3C Design Tokens format (`$value`/`$type`). Import into Figma via the **Tokens Studio** plugin to generate matching Variables in one pass. |
| `design-tokens.css` | Same tokens as CSS custom properties — paste into Elementor Custom CSS, or `@import` from the component library. |
| `components.css` | `.btn-*` and `.text-*` classes built on the tokens. |
| `design-system-reference.md` | This file. |

## Setting this up per tool

**New client project checklist:** edit the 11 `--color-*` vars and the 2 `--font-*` vars in `design-tokens.json`/`.css` for that client's brand — nothing else changes.

- **GitHub** — this repo (`guiolsen-design-system`) holds the base. For a new project, branch or copy `/tokens`, edit the per-project variables, and that becomes the client's starting point.
- **Figma** — create Variables locally in that project's Figma file (not a published Team Library — publishing would sync one shared value across every project, which defeats per-client editing). Either build the 13 variables by hand, or install **Tokens Studio for Figma** and import `design-tokens.json` directly.
- **Elementor v4** — Elementor's Variables/Classes JSON import schema isn't public yet (v4 is in beta as of Aug 2026). Build once by hand in **Variables Manager** + **Class Manager** using the tables above, then **Elementor → Tools → Elementor v4 Export** to get a real, working JSON blueprint — from then on it's Merge/Overwrite import per client. Send that first export back to Claude to get a generator script that produces a ready-to-import JSON straight from an edited `design-tokens.json`.
- **Claude (code-gen from a Figma prototype)** — read this file first. Map every Figma Variable binding back to the matching CSS custom property, reuse `.btn-*`/`.text-*` instead of inventing one-off styles, and flag any value on the frame that doesn't match a token instead of hardcoding it.
