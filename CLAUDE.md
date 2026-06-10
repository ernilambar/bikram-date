# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

### PHP

```bash
composer run lint          # parallel-lint + phpcs
composer run lint-php      # syntax check only
composer run phpcs         # coding standards check
composer run format        # auto-fix coding standards (phpcbf)
```

### JS / CSS

```bash
pnpm run build             # compile src/ → build/ via Vite
pnpm run format            # prettier on CSS/JS/JSON
```

### i18n

```bash
composer run pot           # regenerate .pot from source
composer run po            # update .po from .pot
composer run mo            # compile .po → .mo
```

### Release / Deploy

```bash
pnpm version <semver>      # bumps version in package.json, bikram-date.php, readme.txt (via easy-replace.json)
pnpm run deploy            # runs predeploy (clean + build + vendor) then packtor to create deploy/
```

## Architecture

**Entry point:** `bikram-date.php` — defines constants, loads Composer autoloader + optiz init, then calls `Core\Bootstrap::run()`.

**Bootstrap:** `app/Core/Bootstrap.php` — static `run()` method that explicitly instantiates and registers every service in order: `Core → Options → Admin → Hooks`.

**Namespace:** `Nilambar\BikramDate\` mapped to `app/` via PSR-4 (Composer).

**Prefix:** `bikmt`

**Key classes:**

| Class | Role |
|---|---|
| `Core\Bootstrap` | Entry point; wires all services |
| `Core\Core` | Loads plugin textdomain on `plugins_loaded` |
| `Core\Option` | Static accessor for `bikmt_plugin_options` (WP option) |
| `Options\Options` | Registers settings UI via `ernilambar/optiz` |
| `Admin\Admin` | Plugin action links, format picker UI, admin asset enqueue |
| `Hooks\Hooks` | Hooks `get_the_date` / `get_the_time` filters to replace dates |
| `Common\Helper` | Static utilities (example date formats) |

**Date conversion flow:** `Hooks::replace_date()` receives a formatted date string from WordPress, parses it via `gmdate`, passes year/month/day to `Nilambar\NepaliDate\NepaliDate::getDetails()` (vendor library), and returns a formatted Nepali date using the user's saved language + format options.

**Frontend assets:** `src/admin.js` + `src/admin.css` compiled by Vite into `build/`. Only loaded on `settings_page_bikram-date`.

**Vendor dependencies:**
- `ernilambar/nepali-date` — Gregorian ↔ Nepali date conversion
- `ernilambar/optiz` — settings page UI framework (requires `init.php` manually required in main file)

**Settings:**
- Admin page: `/wp-admin/options-general.php?page=bikram-date`
- Option key: `bikmt_plugin_options`
- Fields: `bikmt_language` (radio: np/en), `bikmt_format` (text, default `d F Y`)
- Optiz hook for custom field UI: `optiz_after_field_bikmt_plugin_options_bikmt_format`

## Quality Gate

Every task must end with:
1. `composer lint` — 0 errors, 0 warnings (run `composer format` to auto-fix first)
2. `pnpm build` — assets compiled cleanly
3. `pnpm format` — JS/CSS formatted with Prettier

## Coding Standards

PHPCS uses `NilambarCodingStandard` + `WordPress` + `WordPress-Extra` rulesets with `PHPCompatibility` targeting `8.0+`. `use` statements must be alphabetically sorted and fully qualified (no inline `\Foo\Bar` — import via `use`). Missing translator comments are warnings, not errors.

## Versioning

Running `pnpm version <x.y.z>` auto-syncs the version across `package.json`, the plugin header `Version:`, `BIKRAM_DATE_VERSION` constant, and `readme.txt` Stable tag — all driven by `easy-replace.json`.
