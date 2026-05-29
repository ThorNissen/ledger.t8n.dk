# Personal Finance App Architecture

## Laravel 13 + Filament 5 + Laravel Sail

---

# Overview

This document describes the architecture and implementation plan for a modern personal finance / budgeting application built with:

* Laravel 13
* Filament 5
* Laravel Sail
* Laravel Boost
* MySQL
* Database queues

The system should support:

* Multi-user accounts
* CSV transaction imports
* Automatic transaction categorization
* Rules-based categorization
* Rule suggestions / learning system
* Analytics dashboards
* Future AI categorization
* Scalable architecture

---

# Core Principles

1. Multi-user from the beginning
2. No plain text categories on transactions
3. All categorization uses relationships
4. Queue-based architecture for imports and processing
5. Rules are user-editable
6. System should gradually “learn” user behavior
7. Keep infrastructure simple initially

---

# Tech Stack

| Component               | Technology                |
| ----------------------- | ------------------------- |
| Backend                 | Laravel 13                |
| Admin Panel             | Filament 5                |
| Development Environment | Laravel Sail              |
| Database                | MySQL                     |
| Queue Driver            | Database                  |
| Authentication          | Laravel Breeze            |
| CSV Parsing             | Laravel Excel             |
| Permissions             | Spatie Laravel Permission |
| Money Handling          | brick/money               |

---

# Composer Packages

```bash id="pkg1"
composer require filament/filament
composer require maatwebsite/excel
composer require spatie/laravel-permission
composer require brick/money
composer require laravel/sanctum
composer require laravel/boost --dev
```

---

# Environment Configuration

## `.env`

```env id="env1"
QUEUE_CONNECTION=database
CACHE_STORE=database
SESSION_DRIVER=database
```

---

# Queue Setup

Generate required tables:

```bash id="queue1"
php artisan queue:table
php artisan cache:table
php artisan session:table

php artisan migrate
```

Run queue worker:

```bash id="queue2"
php artisan queue:work
```

With Sail:

```bash id="queue3"
./vendor/bin/sail artisan queue:work
```

---

# Recommended Project Structure

```text id="structure1"
app/
├── Actions/
├── DTOs/
├── Enums/
├── Filament/
├── Jobs/
├── Models/
├── Policies/
├── Services/
├── Support/
└── ValueObjects/
```

---

# Database Structure

---

# Users Table

Use Laravel default users migration.

Add:

```php id="users1"
$table->string('currency')->default('DKK');
$table->string('timezone')->default('Europe/Copenhagen');
```

---

# Accounts Table

Represents:

* checking accounts
* savings accounts
* cash
* credit cards

## Migration

```php id="accounts1"
Schema::create('accounts', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->string('name');

    $table->string('bank_name')
        ->nullable();

    $table->enum('type', [
        'checking',
        'savings',
        'cash',
        'credit_card',
    ]);

    $table->string('currency')
        ->default('DKK');

    $table->boolean('is_active')
        ->default(true);

    $table->timestamps();
});
```

---

# Categories Table

Top-level category groups.

Examples:

* Income
* Transport
* Food & Groceries
* Savings

## Migration

```php id="categories1"
Schema::create('categories', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();

    $table->string('name');

    $table->string('group');

    $table->integer('sort_order')
        ->default(0);

    $table->string('color')
        ->nullable();

    $table->string('icon')
        ->nullable();

    $table->boolean('is_system')
        ->default(false);

    $table->timestamps();
});
```

---

# Transaction Types Table

Represents detailed transaction types.

Examples:

* Takeout
* Groceries
* Fuel
* Fitness
* Internet
* Subscriptions

## Migration

```php id="types1"
Schema::create('transaction_types', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();

    $table->foreignId('category_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->string('name');

    $table->boolean('is_system')
        ->default(false);

    $table->timestamps();
});
```

---

# Transactions Table

Core financial data table.

## Migration

```php id="transactions1"
Schema::create('transactions', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->foreignId('account_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();

    $table->foreignId('transaction_type_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();

    $table->date('date');

    $table->string('description');

    $table->decimal('amount', 12, 2);

    $table->enum('direction', [
        'income',
        'expense',
        'transfer',
    ]);

    $table->text('notes')
        ->nullable();

    $table->string('external_id')
        ->nullable();

    $table->json('meta')
        ->nullable();

    $table->timestamps();

    $table->index(['user_id', 'date']);
});
```

---

# Rules Table

Rules are used for automatic categorization.

Example:

* keyword: "wolt"
* type: "Takeout"

## Migration

```php id="rules1"
Schema::create('rules', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->foreignId('transaction_type_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->string('keyword');

    $table->integer('priority')
        ->default(100);

    $table->boolean('case_sensitive')
        ->default(false);

    $table->boolean('is_enabled')
        ->default(true);

    $table->timestamps();
});
```

---

# Rule Suggestions Table

Used to suggest new rules based on recurring uncategorized transactions.

Example:

> "Wolt Copenhagen appears 16 times. Create rule?"

## Migration

```php id="suggestions1"
Schema::create('rule_suggestions', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->string('pattern');

    $table->integer('occurrences')
        ->default(0);

    $table->foreignId('suggested_transaction_type_id')
        ->nullable()
        ->constrained('transaction_types')
        ->nullOnDelete();

    $table->boolean('is_reviewed')
        ->default(false);

    $table->boolean('is_accepted')
        ->default(false);

    $table->timestamps();

    $table->unique(['user_id', 'pattern']);
});
```

---

# Imports Table

Tracks uploaded CSV imports.

## Migration

```php id="imports1"
Schema::create('imports', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->string('filename');

    $table->integer('rows_imported')
        ->default(0);

    $table->timestamp('imported_at');

    $table->timestamps();
});
```

---

# Eloquent Models

Create:

```text id="models1"
app/Models/

Account.php
Category.php
Import.php
Rule.php
RuleSuggestion.php
Transaction.php
TransactionType.php
```

---

# Model Relationships

---

# User

```php id="userrel1"
hasMany(Transaction::class)
hasMany(Account::class)
hasMany(Category::class)
hasMany(TransactionType::class)
hasMany(Rule::class)
hasMany(RuleSuggestion::class)
```

---

# TransactionType

```php id="typerel1"
belongsTo(Category::class)
hasMany(Transaction::class)
hasMany(Rule::class)
```

---

# Transaction

```php id="transactionrel1"
belongsTo(User::class)
belongsTo(Account::class)
belongsTo(TransactionType::class)
```

---

# Services

Create:

```text id="services1"
app/Services/
```

---

# RuleMatcherService

Responsible for:

* matching transaction descriptions
* finding matching transaction types

## Methods

```php id="matcher1"
match(Transaction $transaction): ?TransactionType
```

## Logic

* normalize descriptions
* lowercase comparison
* order by priority
* first match wins

---

# TransactionImportService

Responsible for:

* parsing CSV files
* creating transactions
* dispatching categorization jobs

---

# TransactionCategorizerService

Responsible for:

* finding uncategorized transactions
* applying matching rules

---

# RuleSuggestionService

Responsible for:

* scanning uncategorized transactions
* grouping recurring merchants
* generating suggestions

## Methods

```php id="suggestionservice1"
generateSuggestions(int $userId): void
```

## Example Logic

```text id="suggestionlogic1"
1. Find uncategorized transactions
2. Normalize descriptions
3. Group by normalized text
4. Count occurrences
5. If occurrences exceed threshold:
   create or update suggestion
```

---

# Description Normalization

Create helper:

```php id="normalize1"
normalizeDescription(string $description): string
```

Should:

* lowercase text
* trim whitespace
* collapse duplicate spaces
* remove unnecessary formatting
* optionally remove symbols like "*"

Example:

```text id="normalize2"
"WOLT * Copenhagen"
→
"wolt copenhagen"
```

---

# Jobs

Create:

```text id="jobs1"
app/Jobs/
```

---

# ProcessImportJob

Processes CSV imports asynchronously.

---

# CategorizeTransactionsJob

Applies categorization rules in the background.

---

# GenerateRuleSuggestionsJob

Scans uncategorized transactions and creates suggestions.

---

# CSV Import Pipeline

```text id="pipeline1"
CSV Upload
→ Parse rows
→ Normalize data
→ Save transactions
→ Run categorization
→ Generate suggestions
→ Display summary
```

---

# Filament Resources

Generate:

```bash id="resources1"
php artisan make:filament-resource Transaction
php artisan make:filament-resource TransactionType
php artisan make:filament-resource Category
php artisan make:filament-resource Rule
php artisan make:filament-resource RuleSuggestion
php artisan make:filament-resource Account
```

---

# TransactionResource

## Table Columns

* Date
* Description
* Amount
* Type
* Category
* Account

## Filters

* Date range
* Category
* Transaction type
* Amount
* Uncategorized only

## Bulk Actions

* Categorize selected
* Delete selected
* Export selected

---

# RuleResource

## Fields

* Keyword
* Transaction Type
* Priority
* Enabled

---

# RuleSuggestionResource

## Fields

* Pattern
* Occurrences
* Suggested Type
* Status

## Actions

* Accept suggestion
* Reject suggestion
* Bulk accept

---

# Rule Suggestion Flow

```text id="flow1"
"Wolt Copenhagen"

↓ appears 16 times

System creates suggestion

↓ user accepts

Rule automatically created:
keyword = "wolt"
type = "Takeout"
```

---

# Dashboard Widgets

Suggested Filament widgets:

* Monthly spending
* Spending by category
* Spending by type
* Income vs expenses
* Uncategorized transactions
* New rule suggestions

---

# Suggested Enums

Create:

```text id="enums1"
app/Enums/
```

## Recommended Enums

```text id="enums2"
AccountTypeEnum
TransactionDirectionEnum
CategoryGroupEnum
```

---

# Important Design Decisions

---

# Never Store Plain Text Types

Do NOT store:

```text id="decision1"
type = "Takeout"
```

on transactions.

Instead store:

```text id="decision2"
transaction_type_id
```

Reason:

* prevents typos
* easier analytics
* easier future changes
* normalized database structure

---

# Database Queues Are Enough

Use Laravel database queues initially.

They are more than sufficient for:

* CSV imports
* categorization
* rule suggestions
* scheduled jobs

Redis can always be added later if needed.

---

# Multi-Tenancy

Every query must be scoped by `user_id`.

Users must NEVER see other users' transactions.

Use:

* Policies
* Global scopes
* Filament tenancy

---

# Suggested Seeders

Seed default:

## Categories

* Income
* Housing & Utilities
* Transport
* Food & Groceries
* Personal Care & Health
* Savings
* Miscellaneous

## Transaction Types

* Takeout
* Groceries
* Fuel
* Fitness
* Internet
* Subscriptions
* Parking
* Insurance

---

# Future Features

Architecture should support:

* AI categorization
* Shared budgets
* Bank API integrations
* Subscription detection
* Savings goals
* Recurring transaction detection
* Mobile applications
* Notifications
* Advanced analytics
* Budget limits

---

# Recommended Development Order

1. Laravel Sail setup
2. Authentication
3. Core migrations
4. Queue setup
5. Models and relationships
6. Filament resources
7. CSV import
8. Rule engine
9. Suggestion engine
10. Dashboards
11. AI categorization

---

# Example Categorization Flow

```text id="example1"
Transaction:
"WOLT COPENHAGEN"

↓ normalize

"wolt copenhagen"

↓ match rule

keyword = "wolt"

↓ assign type

Takeout
```
