# Colors

gui·olsen design system — color tokens  
Version 1.0 — June 2026

---

## Dark section palette

Used in hero, navigation, footer, and feature sections.

| Token | Hex | Usage |
|---|---|---|
| Dark BG | `#0F0F0F` | Hero, nav, footer — primary dark surface |
| Dark Surface | `#1A1A1A` | Cards and containers on dark background |
| Dark Border | `#2A2A2A` | Dividers and borders on dark sections |
| Text on dark | `#FFFFFF` | Primary text on dark backgrounds |
| Muted on dark | `#9999AA` | Secondary text, captions on dark |

---

## Light section palette

Used in content sections, service cards, portfolio grid.

| Token | Hex | Usage |
|---|---|---|
| Light BG | `#FFFFFF` | Content sections — primary light surface |
| Light Surface | `#F4F4F4` | Cards, code blocks, subtle containers |
| Light Border | `#E5E5E5` | Dividers and borders on light sections |
| Text Primary | `#111111` | Headings and primary body text |
| Text Secondary | `#555555` | Supporting text, descriptions |
| Text Muted | `#999999` | Captions, labels, helper text |

---

## Accent

Used sparingly — one accent element per section maximum.

| Token | Hex | Usage |
|---|---|---|
| Accent | `#0066FF` | CTAs, active states, logo dot, eyebrow labels |
| Accent Hover | `#0052CC` | Hover state on accent buttons and links |
| Accent Tint | `#E6F0FF` | Subtle accent backgrounds, badges |

---

## Usage rules

- One accent per section. Never two accent-colored elements competing for attention.
- Use accent on CTAs, the logo dot, eyebrow labels, and active nav items only.
- Never use accent for body text or large background fills.
- On dark backgrounds, accent buttons use solid `#0066FF` fill with white text.
- On light backgrounds, accent appears as text links, outlined buttons, or subtle labels.

---

## Section alternation pattern

The site alternates dark and light sections to create visual rhythm.

```
Navigation   → #0F0F0F dark
Hero         → #0F0F0F dark
Services     → #FFFFFF light
How it works → #F4F4F4 light grey
Plans        → #0F0F0F dark
Work         → #FFFFFF light
Testimonials → #F4F4F4 light grey
CTA banner   → #0066FF accent
Footer       → #0F0F0F dark
```
