<div align="center">
  <h1>🚀 ERP - 3M Design Studio</h1>
  <p><strong>Modern Laravel ERP System for internal workflow, clients & order management</strong></p>

  <img src="https://img.shields.io/badge/Laravel-12.x-red.svg" alt="Laravel Version" />
  <img src="https://img.shields.io/badge/MySQL-8-blue.svg" alt="MySQL" />
  <img src="https://img.shields.io/badge/Blade-Bootstrap5-purple.svg" alt="Blade + Bootstrap" />
  <img src="https://img.shields.io/badge/Auth-Fortify-green.svg" alt="Laravel Fortify" />
  <img src="https://img.shields.io/badge/Role-Based%20Access-Enabled-brightgreen" />
  <!-- Auto Detect GitHub Actions (if pipeline exists) -->
</div>

---

## 📦 Fitur Utama

- 🧑‍💻 CRUD Pelanggan + Profil Detail
- 📸 Order Tracking (Before/After Photo)
- 🔐 Role-Based Access: `admin` & `pelanggan`
- 🚥 Status Order: `Proses`, `Selesai`, `Batal`
- 🧭 Breadcrumb Dinamis
- ⚡ SweetAlert2 Notifikasi + Toast
- 🧾 Auto Generate Kode Pelanggan
- 🌎 Struktur database siap internasionalisasi

---

## ⚙️ Stack Teknologi

| Layer      | Teknologi                            |
|------------|---------------------------------------|
| Backend    | Laravel 12 + PHP 8                   |
| Frontend   | Blade + Bootstrap 5 + Tailwind       |
| DBMS       | MySQL 8                              |
| Auth       | Laravel Fortify                      |
| Alert      | SweetAlert2                          |
| Tools      | Vite, Composer, npm                  |

---

## 🔧 Instalasi Lokal (XAMPP / Laragon)

```bash
git clone https://github.com/klometerz/ERP-3Mdesignstudio.git
cd ERP-3Mdesignstudio

composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
