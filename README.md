<div align="center">
  <h1>🚀 ERP - 3M Design Studio</h1>
  <p><strong>Laravel-based ERP System to manage clients, orders, and internal workflows</strong></p>

  <img src="https://img.shields.io/badge/Laravel-12.x-red.svg" />
  <img src="https://img.shields.io/badge/MySQL-8-blue.svg" />
  <img src="https://img.shields.io/badge/Blade-Bootstrap5-purple.svg" />
  <img src="https://img.shields.io/badge/Auth-Fortify-green.svg" />
  <img src="https://img.shields.io/badge/Role--Based%20Access-Enabled-brightgreen" />
</div>

---

## 🇬🇧 English

### 📦 Features

- Client CRUD & Profile
- Order Management (with before/after images)
- Role-Based Access (`admin`, `client`)
- Dynamic breadcrumbs
- SweetAlert2 for alert and toast
- Multi-status orders: `In Progress`, `Completed`, `Canceled`
- Auto-generated client code
- International-ready database structure

---

### ⚙️ Tech Stack

| Layer      | Tech                                  |
|------------|----------------------------------------|
| Backend    | Laravel 12 + PHP 8                    |
| Frontend   | Blade + Bootstrap 5                   |
| Database   | MySQL 8                               |
| Auth       | Laravel Fortify                       |
| Alerts     | SweetAlert2                           |

---

### 🚀 Local Installation

```bash
git clone https://github.com/USERNAME/ERP-3Mdesignstudio.git
cd ERP-3Mdesignstudio

composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate
php artisan migrate --seed

php artisan serve
