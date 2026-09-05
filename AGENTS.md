# AGENTS.md

## Overview

WordPress plugin that converts Gregorian post dates to Nepali Bikram Sambat (BS) dates. PHP 8.0+ backend with PSR-4 autoloading; admin UI built with Vite-compiled JS/CSS.

## Setup

```bash
pnpm install        # install Node deps (Vite, Prettier, PostCSS)
composer install    # install PHP deps (date libs, coding standards)
```

## Commands

```bash
pnpm run build            # compile src/ → build/ via Vite
pnpm run format           # Prettier format CSS/JS/JSON
pnpm version <semver>     # bump version (uses easy-replace.json)
pnpm run deploy           # full build + package to deploy/
composer run lint         # parallel-lint + phpcs
composer run format       # phpcbf auto-fix
composer run pot          # generate .pot file
composer run po           # update .po files
composer run mo           # compile .mo files
```

## Conventions

- **Namespace map:** `Nilambar\BikramDate\` → `app/` (PSR-4). Every class lives under `App/{Admin,Common,Core,Hooks,Options}/`.
- **Bootstrap order:** `Core\Bootstrap::run()` wires services as Options → Admin → Hooks on `plugins_loaded`. Don't reorder without reason.
- **WPHP guard:** Every PHP file must open with `<?php` and include `defined( 'WPINC' ) || die;` (or equivalent) before any logic.
- **I18n:** All strings use `__()` / `_e()` with text domain `bikram-date`. POT lives in `languages/`.
- **Imports:** Use `use` statements for all class references (no FQN in code). Slevomat `ReferenceUsedNamesOnly` + `AlphabeticallySortedUses` are enforced.
- **Options access:** Read settings via `Nilambar\BikramDate\Core\Option::get( 'key' )`, not `get_option()` directly.

## Quality Gate

Run in this order; all must exit 0 before declaring a task complete:

```bash
composer run format       # auto-fix PHP
composer run lint         # PHP lint + phpcs (zero errors)
pnpm run format           # auto-format CSS/JS/JSON
pnpm run build            # Vite build succeeds
```
