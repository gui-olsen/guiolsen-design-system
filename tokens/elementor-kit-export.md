# Elementor 4 kit export

How to package this design system as a `.zip` that imports into Elementor's
Site Settings → Import, so the tokens in [`/tokens`](design-tokens.json) become
native Elementor global variables and global classes.

> **This is a living doc.** Every time a piece of the schema below gets
> confirmed or corrected against a real Elementor export, update it here —
> don't let the confirmed shape drift back into guesswork in a chat thread.
> Last verified: 2026-09-04, against two real kits exported from
> felipezanutel.com.br (Elementor 4.2.3).

## Kit anatomy

A kit is a `.zip`, flat at the root, forward-slash paths inside:

```
manifest.json
global-variables.json
global-classes/
  order.json
  g-<id>.json   (one file per class)
site-settings.json
```

Import path in WordPress: **Elementor → Site Settings → Import**.

## `global-variables.json`

```json
{
  "data": {
    "e-gv-0000005": {
      "label": "primary-500",
      "value": "#7A7A7A",
      "type": "global-color-variable",
      "order": 5,
      "created_at": "2026-09-04 12:00:00",
      "updated_at": "2026-09-04 12:00:00"
    }
  },
  "watermark": 1,
  "version": 1
}
```

- Variable ids: `e-gv-` + 7 hex chars. Anything unique works — Elementor
  doesn't care how you generated them.
- `type` is `"global-color-variable"` (value = hex string) or
  `"global-font-variable"` (value = font family name string).
- **Only color and font variable types are proven.** No evidence Elementor 4
  has a size/spacing/number global-variable type — spacing, radius, stroke
  etc. get embedded as literal values inside class props, not as reusable
  variables. Re-check this if a future Elementor version adds one.

## `global-classes/order.json`

```json
[{ "id": "g-0000001", "label": "text-h1" }]
```

Controls display order in the Elementor panel. One entry per class, must
match every file in `global-classes/`.

## `global-classes/g-<id>.json`

```json
{
  "id": "g-0000001",
  "label": "text-h1",
  "type": "class",
  "variants": [
    {
      "meta": { "breakpoint": "desktop", "state": null },
      "props": {
        "font-family": { "$$type": "global-font-variable", "value": "e-gv-0000035" },
        "font-weight": { "$$type": "string", "value": "700" },
        "font-size": { "$$type": "size", "value": { "size": 48, "unit": "px" } },
        "letter-spacing": { "$$type": "size", "value": { "size": -0.02, "unit": "em" } },
        "color": { "$$type": "global-color-variable", "value": "e-gv-0000009" }
      },
      "custom_css": null
    }
  ]
}
```

One `variants` entry per breakpoint/state combination that needs different
values. A variant only needs to carry the props actually changing at that
breakpoint — no need to repeat unchanged sides/props.

### `meta.breakpoint` — **proven**

`"desktop"`, `"tablet"`, `"mobile"` are all confirmed against a real export
(a class named `breakpoints-example` built by hand in the Elementor editor
specifically to test this, then exported and read). `"desktop"` is the base;
`"tablet"`/`"mobile"` override it downward. These correspond to the site's
`viewport_md` (768) / `viewport_lg` (1025) breakpoint settings in
`site-settings.json` — if a project's Elementor breakpoints panel has more
tiers configured (mobile_extra, tablet_extra, laptop, widescreen), those
extra keys are unconfirmed; build one test class by hand and export to check
before relying on them.

### `meta.state` — **partially proven**

`null` (default/base state) is proven. `"hover"` / `"focus"` are **not yet
confirmed** — no real export has shown a state variant. Used in this
project's buttons on the working assumption that state follows the same
pattern as breakpoint, but verify with a hand-built test class before
trusting it fully.

### `props` — key-by-key confidence

| Prop | Shape | Status |
|---|---|---|
| `font-family` | `{"$$type":"global-font-variable","value":"<id>"}` | proven |
| `color` | `{"$$type":"global-color-variable","value":"<id>"}` | proven |
| `font-weight`, `border-style` | `{"$$type":"string","value":"..."}` | proven |
| `font-size`, `letter-spacing`, `border-width`, `border-radius`, `max-width` | `{"$$type":"size","value":{"size":N,"unit":"px\|em\|rem"}}` | `font-size`/`letter-spacing` proven; `border-width`/`border-radius`/`max-width` are extrapolated from the same pattern, unconfirmed |
| `padding` | **single prop**, `$$type: "dimensions"` — see below | proven |
| `background-color`, `border-color` | presumed same shape as `color` | extrapolated, unconfirmed |
| `display` | `{"$$type":"string","value":"flex"}` | proven (seen once) |

**`padding` is not four separate props.** It's one `padding` prop of
`$$type: "dimensions"`:

```json
"padding": {
  "$$type": "dimensions",
  "value": {
    "block-start":  { "$$type": "size", "value": { "size": 96, "unit": "px" } },
    "block-end":    { "$$type": "size", "value": { "size": 96, "unit": "px" } },
    "inline-start": { "$$type": "size", "value": { "size": 0,  "unit": "px" } },
    "inline-end":   { "$$type": "size", "value": { "size": 0,  "unit": "px" } }
  }
}
```

A variant can set only the sides it's overriding — a tablet variant that
only changes vertical spacing needs just `block-start`/`block-end`, not all
four. `margin` almost certainly follows the same `dimensions` shape by
analogy — unconfirmed, check before relying on it.

## `manifest.json`

Kit metadata: `name`, `title`, `description`, `author`, `version`,
`elementor_version`, `created`, `site`, `theme` (`name`/`theme_uri`/`version`/`slug`),
`experiments` (array of active Elementor feature-flag slugs — copy from a
real export off the target site rather than inventing one), `site-settings`
(bool flags per category + `classesCount`/`variablesCount`), `plugins`.

## `site-settings.json`

Present even when the manifest's category flags for it are false. Carries
`content`, `settings` (`template`, `viewport_md`, `viewport_lg` — the site's
real breakpoint cutoffs in px), `metadata`, `theme`, `experiments` (an object
keyed by slug here, not the array shape used in `manifest.json`).

## Building a new kit from `/tokens`

1. Assign one `e-gv-<hex>` id per entry in `design-tokens.json`'s `color`
   and `font.family` sections (colors → `global-color-variable`, fonts →
   `global-font-variable`). Everything else in `design-tokens.json` (size,
   radius, stroke, padding, gap, layout) has no variable type yet — embed
   those values as literals inside class props instead.
2. One `g-<id>.json` per component/typography class, built from
   `components.css` — same colors, same sizes, translated into the prop
   table above.
3. Validate every JSON file parses before zipping (a bad file fails the
   whole import silently in some Elementor versions — don't skip this).
4. Zip flat at the root with forward-slash paths. `Compress-Archive` on
   Windows writes backslash paths — don't use it; build the zip with
   `System.IO.Compression.ZipArchive` directly, or 7-Zip/`zip` if available,
   to get real forward slashes.

## Closing a schema gap

The fastest way to confirm anything still marked unproven above: build one
small test class by hand in the real Elementor editor exercising just that
prop/state, export the kit, and read the JSON that comes back. That's how
the breakpoint and `padding` shapes above got confirmed — don't guess twice
when a two-minute test settles it for good.
