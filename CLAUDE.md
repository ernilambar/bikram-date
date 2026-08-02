# CLAUDE.md

Guidance for Claude Code when working in this repository.

## Commands

```bash
composer run lint          # parallel-lint + phpcs
composer run format        # phpcbf auto-fix
pnpm run build              # compile src/ → build/ via Vite
pnpm run format              # prettier CSS/JS/JSON
composer run pot|po|mo      # i18n pipeline
pnpm version <semver>        # bump version everywhere (via easy-replace.json)
pnpm run deploy               # build + package to deploy/
```

## Architecture

Entry point `bikram-date.php` loads the autoloader + optiz init, then calls `Core\Bootstrap::run()`, which wires services in order: `Core → Options → Admin → Hooks`.

Admin settings UI is built with `ernilambar/optiz`. Admin JS/CSS (`src/`) compiles to `build/` and loads only on the plugin's settings page.

## Quality gate

All must pass before a task is complete:

- `composer format` — auto-fix PHPCS violations (run before lint)
- `composer lint` — zero errors; fix and re-run until clean
- `pnpm format` — auto-format JS/CSS
- `pnpm build` — zero errors
