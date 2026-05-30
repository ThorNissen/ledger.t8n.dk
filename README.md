# Ledger

A personal finance tracker for managing bank accounts, categorizing transactions, and understanding your spending — built with Laravel and Filament.

## Features

- **Accounts** — manage multiple bank accounts with different currencies
- **Transactions** — record income and expenses with dates, descriptions, and amounts
- **Categories** — organize transactions with customizable, color-coded categories
- **Transaction types** — reusable templates that link transactions to categories consistently
- **Auto-classification rules** — keyword-based rules that automatically categorize transactions on import, with priority ordering and case-sensitivity options
- **Rule suggestions** — the app detects patterns in uncategorized transactions and proposes rules for you to accept or reject
- **Import** — bulk-import transactions from files with import history tracking

## Requirements

- [Docker](https://www.docker.com/products/docker-desktop)
- [Git](https://git-scm.com)

Everything else (PHP, Composer, Node, a database) runs inside Docker via Laravel Sail.

## Local Installation

### 1. Clone the repo

```bash
git clone https://github.com/your-org/ledger.t8n.dk.git
cd ledger.t8n.dk
```

### 2. Install Composer dependencies

Use the Sail bootstrap script so you don't need PHP installed locally:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php85-composer:latest \
    composer install --ignore-platform-reqs
```

### 3. Configure environment

```bash
cp .env.example .env
```

The default `.env.example` is pre-configured for Sail. You can optionally change the seed user credentials before running migrations:

```env
SEED_USER_NAME="Test User"
SEED_USER_EMAIL="test@example.com"
SEED_USER_PASSWORD="password"
```

### 4. Start Docker containers

```bash
vendor/bin/sail up -d
```

### 5. Generate application key

```bash
vendor/bin/sail artisan key:generate
```

### 6. Run migrations and seed the database

```bash
vendor/bin/sail artisan migrate --seed
```

### 7. Install frontend assets

```bash
vendor/bin/sail npm install
vendor/bin/sail npm run build
```

### 8. Open the app

```bash
vendor/bin/sail open
```

The admin panel is at `/app`. Log in with the `SEED_USER_EMAIL` and `SEED_USER_PASSWORD` you configured in `.env` (defaults: `test@example.com` / `password`).

## Development

| Task | Command |
|---|---|
| Start services | `vendor/bin/sail up -d` |
| Stop services | `vendor/bin/sail stop` |
| Run tests | `vendor/bin/sail artisan test --compact` |
| Watch assets | `vendor/bin/sail npm run dev` |
| Tail logs | `vendor/bin/sail artisan pail` |
| Open Tinker | `vendor/bin/sail artisan tinker` |
| Format code | `vendor/bin/sail bin pint` |

## Tech Stack

- [Laravel 13](https://laravel.com) — application framework
- [Filament 5](https://filamentphp.com) — admin panel
- [Livewire 4](https://livewire.laravel.com) — reactive UI components
- [Laravel Sail](https://laravel.com/docs/sail) — Docker development environment
- [Pest 4](https://pestphp.com) — testing framework
- [Brick/Money](https://github.com/brick/money) — precise monetary value handling
