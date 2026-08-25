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

New accounts default to the `user` role. There's currently no in-app way to promote a user to admin — do it directly:

```bash
php artisan tinker --execute="App\Models\User::where('email', 'you@example.com')->update(['role' => 'admin']);"
```

## Testing

```bash
php artisan test
```

## Known limitations

- No in-app flow for granting the admin role (see above) — a small admin-management UI or a seeded first-admin account would close this gap.
- The `task_categories` table and model scaffolding exist in the schema but aren't wired into any controller or view yet — an unfinished feature, not a bug.
- OTP delivery uses the `log` mail driver by default (`MAIL_MAILER=log` in `.env.example`), so reset codes land in `storage/logs/laravel.log` rather than an inbox until real SMTP credentials are configured.
