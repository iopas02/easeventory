# Auto Supply — Inventory Management System

A **multi-tenant** web-based inventory system for small, **single-location** auto supply
businesses. Each business ("tenant") is isolated by its email domain, and every admin user
under that domain shares the same data set. Built with Laravel, it currently ships
authentication (with tenant isolation) plus the full set of staff-facing screens, populated
with placeholder data so the workflow and UI can be reviewed before the inventory database
is wired up.

> Status: **UI/scaffolding stage.** Every page renders real layouts and navigation, but the
> data shown is static placeholder data. See [Next Steps](#next-steps) for the work that
> turns each screen into a live one.

---

## Tech Stack

| Layer      | Choice                          |
| ---------- | ------------------------------- |
| Framework  | Laravel 12 (PHP 8.2+)           |
| Frontend   | Blade + Tailwind CSS 4 (Vite)   |
| Interactivity | Alpine.js (via CDN)          |
| Charts     | Chart.js (via CDN)              |
| Database   | SQLite (local) / PostgreSQL (Supabase) |

---

## Requirements

- PHP 8.2 or newer
- Composer 2
- Node.js 20+ and npm

---

## Setup

```bash
# 1. Install PHP dependencies
composer install

# 2. Create the environment file and app key
copy .env.example .env      # Windows
php artisan key:generate

# 3. Create the SQLite database, migrate, and seed the demo user
php artisan migrate:fresh --seed

# 4. Install and build frontend assets
npm install
npm run build

# 5. Serve the app
php artisan serve
```

Open http://127.0.0.1:8000 and sign in.

### Demo credentials

All seeded users use the password `password`. The tenant is derived from the email domain,
so the first two accounts share one data set and the third is fully separate.

| Email                  | Tenant                 | Notes                        |
| ---------------------- | ---------------------- | ---------------------------- |
| `admin@rjbr.com`       | RJBR Auto Supply       |                              |
| `admin2@rjbr.com`      | RJBR Auto Supply       | same data as `admin@rjbr.com`|
| `admin@gigandjims.com` | Gig & Jims Auto Supply |                              |

### During development

Run Vite in watch mode so Blade/CSS changes rebuild automatically:

```bash
npm run dev      # in one terminal
php artisan serve # in another
```

---

## Project Structure

```
app/Http/Controllers/
├── AuthController.php            # login / logout
├── DashboardController.php       # analytics overview
├── ProductController.php         # product catalog
├── InventoryController.php       # stock levels
├── StockMovementController.php   # stock in/out ledger
├── SupplierController.php        # supplier directory
├── PurchaseOrderController.php   # purchase orders
├── SaleController.php            # sales & invoices
├── ReportController.php          # report list
└── SettingController.php         # store settings

app/Models/
├── Tenant.php                    # a business, keyed by its email domain
└── User.php                      # belongs to a tenant

app/Support/TenantManager.php     # holds the current request's tenant
app/Models/Concerns/BelongsToTenant.php   # trait: scopes queries + fills tenant_id
app/Http/Middleware/SetCurrentTenant.php  # resolves tenant from the auth user

database/migrations/
├── 0000_01_01_000000_create_tenants_table.php
└── 0001_01_01_000000_create_users_table.php   # users.tenant_id FK

resources/views/
├── layouts/
│   ├── guest.blade.php           # minimal shell for login
│   └── app.blade.php             # sidebar + topbar shell
├── components/
│   ├── stat-card.blade.php       # reusable metric card (x-stat-card)
│   └── status-badge.blade.php    # reusable status pill (x-status-badge)
├── auth/login.blade.php
├── dashboard.blade.php
├── products/index.blade.php
├── inventory/index.blade.php
├── stock-movements/index.blade.php
├── suppliers/index.blade.php
├── purchase-orders/index.blade.php
├── sales/index.blade.php
├── reports/index.blade.php
└── settings/index.blade.php

routes/web.php                    # all routes
database/seeders/DatabaseSeeder.php
```

---

## Application Workflow

### 1. Authentication flow

```
GET  /            -> redirect to /login
GET  /login       -> auth.login  (guest middleware)
POST /login       -> AuthController@login   -> redirect to /dashboard on success
POST /logout      -> AuthController@logout  -> redirect to /login
```

- Unauthenticated users hitting any protected page are redirected to `/login`.
- On login the tenant is resolved from the email domain; unknown domains are rejected.
- Sessions are regenerated on login and invalidated on logout.
- The "Remember me" checkbox is supported.

### 2. Request lifecycle (every page)

1. Route in `routes/web.php` maps a URL to a controller action.
2. The controller prepares data (currently static arrays) and returns a view.
3. The view extends `layouts/app.blade.php`, which renders the sidebar, topbar, and the
   signed-in user.
4. Shared UI pieces are Blade components (`x-stat-card`, `x-status-badge`) so pages stay
   consistent and short.

### 3. Multi-tenancy

Tenant isolation is **row-level** on a single shared database (a good fit for the Supabase
free tier — no database-per-tenant overhead).

- A **tenant** is a row in `tenants`, uniquely keyed by its `domain` (e.g. `rjbr.com`).
- On login, the domain part of the submitted email is used to find the tenant. If no tenant
  matches, the sign-in is rejected with "No organization is registered for that email domain".
- Every user has a `tenant_id`, so `admin@rjbr.com` and `admin2@rjbr.com` resolve to the
  same tenant and therefore the same data set.
- `SetCurrentTenant` middleware loads the authenticated user's tenant into the
  `TenantManager` singleton on each request.
- Any tenant-owned model uses the `BelongsToTenant` trait, which (a) auto-fills `tenant_id`
  on create and (b) adds a global scope so queries only return the current tenant's rows.
  To make a new model tenant-aware, add `tenant_id` to its migration and `use
  BelongsToTenant;` in the model.

> Today only `tenants` and `users` exist. The inventory models listed in
> [Next Steps](#next-steps) must each carry a `tenant_id`.

### 4. Day-to-day store workflow (the business process this app models)

```
Supplier ──> Purchase Order ──> Goods Received ──> Stock (Inventory)
                                                      │
                                                      ▼
                          Sale / Invoice ──> Stock Out (movement logged)
                                                      │
                                                      ▼
                    Dashboard + Reports (sales, valuation, low-stock alerts)
```

- **Suppliers** are the vendors you buy parts from.
- A **Purchase Order** records what you ordered; when it arrives, a **Stock In** movement
  increases the product's on-hand quantity.
- A **Sale** produces an invoice and a **Stock Out** movement, decreasing on-hand quantity.
- **Adjustments** correct the count after damage, loss, or a physical count.
- Every change is written to the **Stock Movements** ledger, giving a full audit trail.
- When on-hand drops to the **reorder point**, the item appears in **Low Stock** alerts on
  the dashboard so you know to reorder.
- **Reports** summarize sales, stock valuation, low stock, purchases, and supplier
  performance.

### 5. SKUs

A **SKU** (Stock Keeping Unit) is the unique code for a single trackable item, e.g.
`OIL-5W30-1L` or `BAT-NS60`. Each size/brand variant gets its own SKU because each is
counted separately. A simple `category-product-size` scheme is used throughout.

> This business has **one location**, so there are no per-branch/warehouse breakdowns.

---

## Pages

| Page              | Route              | What it shows                                    |
| ----------------- | ------------------ | ------------------------------------------------ |
| Login             | `/login`           | Sign-in form                                     |
| Dashboard         | `/dashboard`       | KPIs, sales trend, category split, low-stock     |
| Products          | `/products`        | Catalog: SKU, category, price, stock, status     |
| Inventory         | `/inventory`       | On-hand / reserved / available, reorder points   |
| Stock Movements   | `/stock-movements` | Audit ledger of stock in / out / adjustments     |
| Suppliers         | `/suppliers`       | Vendor directory and balances                    |
| Purchase Orders   | `/purchase-orders` | Orders placed with suppliers                     |
| Sales             | `/sales`           | Invoices and payment status                      |
| Reports           | `/reports`         | Report catalog with view/export actions          |
| Settings          | `/settings`        | Store profile, notifications, account            |

---

## Next Steps

To turn the static screens into a working system:

1. **Create Eloquent models + migrations** for `products`, `suppliers`, `purchase_orders`
   (+ items), `sales` (+ items), and `stock_movements`. Give each a `tenant_id` FK and
   `use BelongsToTenant;` so data stays isolated per business.
2. **Replace the placeholder arrays** in each controller with real queries
   (`Product::query()->...`).
3. **Add create/edit forms** (the "Add Product", "New Order", etc. buttons are placeholders).
4. **Move stock automatically**: increment/decrement `on_hand` and write a `stock_movements`
   row inside a database transaction whenever a purchase is received or a sale is made.
5. **Compute KPIs** on the dashboard from real tables instead of hardcoded numbers.
6. **Implement report exports** (CSV/PDF) behind the existing Export buttons.
7. **Keep it single-admin.** Each tenant is managed by one admin, so there are no
   role/permission layers or per-user attribution within a tenant. Add roles only if a
   tenant ever needs multiple permission levels.

---

## Testing & Linting

```bash
php artisan test              # run the test suite
php vendor/bin/pint           # format PHP (Laravel Pint)
php vendor/bin/pint --test    # check formatting without changing files
```

---

## License

This application is built on the Laravel framework, which is open-sourced software
licensed under the [MIT license](https://opensource.org/licenses/MIT).
