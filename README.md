<h1 align="center">Classic Editor &amp; Widgets</h1>

<p align="center">
  Bring back the classic TinyMCE editor and the classic widgets screen — in one lightweight plugin, with zero configuration.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/version-1.3.0-2563EB?style=flat-square" alt="Version 1.3.0" />
  <img src="https://img.shields.io/badge/WordPress-5.0%2B-1E293B?style=flat-square&logo=wordpress&logoColor=white" alt="WordPress 5.0+" />
  <img src="https://img.shields.io/badge/tested%20up%20to-6.8-1E293B?style=flat-square" alt="Tested up to WordPress 6.8" />
  <img src="https://img.shields.io/badge/PHP-7.4%2B-1E293B?style=flat-square&logo=php&logoColor=white" alt="PHP 7.4+" />
  <img src="https://img.shields.io/badge/license-GPL--2.0--or--later-1E293B?style=flat-square" alt="License GPL-2.0-or-later" />
</p>

---

## Why

Many sites, themes and client workflows still rely on the classic editing experience. Instead of installing two separate plugins, **Classic Editor & Widgets** restores both the classic post editor and the classic widget management screens in one go.

## Features

**Classic editor**
- Disables the block editor (Gutenberg) for **all post types** — posts, pages and custom post types
- Restores the classic **TinyMCE** editor with full meta box support
- Works with plugins that extend the classic editor
- Dequeues block-editor scripts and styles that aren't needed

**Classic widgets**
- Restores the classic **Appearance → Widgets** screen with drag & drop
- Uses classic widgets in the **Customizer** too
- Disables block-based widget management

**No configuration** — activate it and you're done.

## Requirements

| | |
| --- | --- |
| WordPress | 5.0 or higher (tested up to 6.8) |
| PHP | 7.4 or higher |

## Installation

**From a ZIP**
1. Download this repository as a ZIP (**Code → Download ZIP**).
2. In WordPress go to **Plugins → Add New → Upload Plugin**, choose the ZIP and click **Install Now**.
3. Activate **Classic Editor & Widgets**.

**With Git**
```bash
cd wp-content/plugins
git clone https://github.com/ghouliaras/classic-editor-widgets.git
```
Then activate it from **Plugins**.

## Usage

There's nothing to set up. Once activated:

- Editing any post, page or custom post type opens the **classic editor**. A small *"Classic Editor Active"* box in the post sidebar confirms it.
- **Appearance → Widgets** and the Customizer use the **classic widget** interface.

To go back to the block editor, simply deactivate the plugin — your content is not changed.

## FAQ

**Can I keep the block editor for some post types?**
Not in the current version — the plugin disables the block editor everywhere. If you need both editors side by side, the official *Classic Editor* plugin offers per-user switching.

**Does it change my content?**
No. It only changes which editing interface WordPress loads.

## Project structure

```
classic-editor-widgets/
├── classic-editor-widgets.php        # Bootstrap
├── includes/
│   ├── class-classic-editor.php      # Classic editor handling
│   └── class-classic-widgets.php     # Classic widgets handling
├── assets/
│   ├── css/admin.css
│   └── js/admin.js
└── languages/classic-editor-widgets.pot
```

## Changelog

- **1.3.0** — WordPress 6.8 compatibility, performance and stability improvements, better error handling, code and security hardening.
- **1.2.0** — Stability and performance improvements, WordPress 6.4+ compatibility, code organisation.
- **1.1.0** — Improved text-domain handling, removed unnecessary admin notices, code clean-up.
- **1.0.0** — Initial release.

## License

GPL-2.0-or-later — see [LICENSE](LICENSE).

---

<p align="center">
  Built by <a href="https://github.com/ghouliaras"><b>George Chouliaras</b></a> · WordPress, WooCommerce &amp; Laravel developer ·
  <a href="https://www.flowcreations.gr/contact/">Available for projects</a>
</p>
