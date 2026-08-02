# Bikram Date

WordPress plugin to display post dates in Nepali (Bikram Sambat calendar).

## Requirements

- WordPress 6.9+
- PHP 8.0+

## What it does

Hooks into `get_the_date` and `get_the_time` filters and converts Gregorian dates to Nepali BS dates using the configured language and format.

## Settings

**Admin → Settings → Bikram Date**

| Option | Values | Default |
|---|---|---|
| Language | Nepali / English | — |
| Date Format | format string | `d F Y` |

## Contributing

```bash
composer run lint    # parallel-lint + phpcs
composer run format  # phpcbf auto-fix
pnpm run build        # compile src/ → build/ via Vite
pnpm run format        # prettier CSS/JS/JSON
```

Run lint and build before submitting a pull request.

## License

GPLv2 or later
