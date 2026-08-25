# Budget Management System

A full-stack task, project, and budget tracker built with Laravel 11. Users manage projects, break them into tasks and subtasks, track comments and activity, and monitor monthly budgets by category. An admin role can view cross-user spending trends, team productivity, and manage user accounts.

## Features

- **Auth** — registration/login, OTP-based password reset (emailed one-time code)
- **Projects** — create projects with start/end dates and status, track progress
- **Tasks & Subtasks** — priority, due dates, status, nested subtasks per task
- **Comments** — per-task comment thread
- **Budgets** — monthly budgets by category with remaining/exceeded tracking
- **Admin panel** — role-gated: manage users, view all tasks, spending trends, and team productivity stats

## Tech stack

- PHP 8.2+, Laravel 11
- SQLite (default, zero-config local dev) or MySQL/PostgreSQL for production
- Vite 6 + Tailwind CSS 3
- Pest for testing

## Getting started

```bash
git clone https://github.com/HasnainBilash/Budget-Management-System.git
cd Budget-Management-System

composer install
npm install

cp .env.example .env
php artisan key:generate

# SQLite is the default — just make sure the file exists:
touch database/database.sqlite

php artisan migrate
npm run build

php artisan serve
```

Visit `http://127.0.0.1:8000`.

For local development with hot-reloading assets, run both dev servers at once:

```bash
composer run dev
```

### Using MySQL/PostgreSQL instead

Edit `.env`: set `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` to match your database, then run `php artisan migrate`.

### Granting admin access

New accounts default to the `user` role. To create the initial admin account, set `ADMIN_EMAIL` and `ADMIN_PASSWORD` (and optionally `ADMIN_NAME`) in `.env`, then run `php artisan db:seed`. This is safe to run more than once — it won't duplicate or overwrite an existing account with that email. There's no in-app UI to promote further users; see **Known limitations** below.

## Testing

```bash
php artisan test
```

## Deployment

The repo includes a `Procfile` for Heroku-style / Nixpacks platforms (Railway, Heroku, etc.) — it runs migrations and the admin seed as a release step, then serves the app. Requirements:

- PHP 8.2+, with the `pdo_sqlite` or `pdo_mysql`/`pdo_pgsql` extension for whichever `DB_CONNECTION` you use
- Node 18+ available at build time (to run `npm run build`)

### Environment checklist

Set these on your host (most platforms have a dashboard or CLI for env vars — don't commit them):

| Variable | Notes |
|---|---|
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` — never `true` in production, it leaks stack traces |
| `APP_KEY` | generate with `php artisan key:generate --show` and paste the output |
| `APP_URL` | your deployed URL, e.g. `https://your-app.up.railway.app` |
| `DB_CONNECTION` + `DB_*` | point at a real MySQL/PostgreSQL instance — SQLite works but isn't recommended for multi-user production |
| `MAIL_MAILER` | `resend` |
| `RESEND_KEY` | your Resend API key ([resend.com](https://resend.com)) |
| `MAIL_FROM_ADDRESS` | `onboarding@resend.dev` works without setup; use your own verified domain in Resend for a real "from" address |
| `ADMIN_EMAIL` / `ADMIN_PASSWORD` | creates the initial admin account when the seeder runs (see below) |

### Build & release steps

If your platform doesn't auto-run these via the `Procfile`'s `release` step, run them manually after each deploy:

```bash
composer install --no-dev --optimize-autoloader
npm ci && npm run build
php artisan migrate --force
php artisan db:seed --force        # creates the admin account from ADMIN_EMAIL/ADMIN_PASSWORD
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

`php artisan serve` (what the `Procfile`'s `web` process uses) is fine for a portfolio-scale deployment. For real traffic, put the app behind PHP-FPM + nginx/Apache instead.

## Known limitations

- No in-app UI for promoting additional users to admin beyond the seeded account — do it directly:
  ```bash
  php artisan tinker --execute="App\Models\User::where('email', 'you@example.com')->update(['role' => 'admin']);"
  ```
