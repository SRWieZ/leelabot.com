---
paths:
  - config/export.php
---

# Config

## Static export bakes absolute URLs from APP_URL
`composer build` runs the export with `APP_ENV=production APP_URL=https://leelabot.com`, so every asset, canonical and og: URL in dist/ is absolute against that host. Serving dist/ from localhost therefore renders unstyled — that is expected, not a bug.

To preview locally, re-export against the preview host:
  APP_ENV=production APP_URL=http://127.0.0.1:8123 php artisan export

Always re-run `composer build` afterwards so dist/ is production-correct before publishing. `rm -f public/hot` stays in the build script: if Vite's hot file survives, Laravel renders asset URLs pointing at the dev server.
