# Components

gui·olsen design system — component specs  
Version 1.0 — June 2026

---

## Buttons

Three variants. One primary per section maximum. All buttons use 0px border
radius — this is non-negotiable, it defines the sharp modern personality.

| Variant | Background | Text | Border | Usage |
|---|---|---|---|---|
| Primary | `#0066FF` | `#FFFFFF` | none | Main CTA. One per section. |
| Secondary | transparent | `#111111` / `#FFFFFF` | 1.5px `#2A2A2A` | Paired with primary. |
| Ghost | none | `#0066FF` | none | Text links, subtle navigation. |

### Button specs

| Property | Value |
|---|---|
| Padding (standard) | 10px 24px |
| Padding (large hero) | 12px 32px |
| Font | Inter 500, 14px |
| Letter spacing | 0.01em |
| Border radius | 0px |
| Hover transition | 150ms ease |
| Primary hover | `#0052CC` |

### CSS classes

Add these CSS classes to Elementor button widgets:

- `.btn-primary` — solid blue CTA
- `.btn-secondary` — outlined button
- `.btn-ghost` — text link style

```css
.elementor-button.btn-primary {
    background-color: #0066FF !important;
    color: #FFFFFF !important;
    border: none !important;
    padding: 10px 24px !important;
    border-radius: 0 !important;
}

.elementor-button.btn-secondary {
    background-color: transparent !important;
    color: #111111 !important;
    border: 1.5px solid #2A2A2A !important;
    padding: 10px 24px !important;
    border-radius: 0 !important;
}

.elementor-button.btn-ghost {
    background-color: transparent !important;
    color: #0066FF !important;
    border: none !important;
    text-decoration: underline !important;
    text-underline-offset: 3px !important;
}
```

---

## Cards

Used in services overview, how it works, and blog grid sections.

| Property | Value |
|---|---|
| Background | `#F4F4F4` |
| Border | `0.5px solid #E5E5E5` |
| Border radius | 4px |
| Padding | 24px |
| Title font | Syne 600, 18px |
| Body font | Inter 400, 16px |

### Card on dark background

| Property | Value |
|---|---|
| Background | `#1A1A1A` |
| Border | `0.5px solid #2A2A2A` |
|
