# CV Mediatama - Content Access Management System

Sistem manajemen akses konten video berbasis Laravel. Customer dapat mengajukan akses untuk menonton video, lalu Admin menyetujui atau menolak pengajuan tersebut dengan batas waktu akses.

## Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel 12, PHP 8.2+ |
| Frontend | Tailwind CSS v4, Alpine.js |
| Build | Vite 7 |
| Database | MySQL |
| PDF | barryvdh/laravel-dompdf |
| Payment | Midtrans PHP |

## Fitur Utama

### Autentikasi & Profil
- Login dengan email/password (session-based)
- Role-based access control (`admin` / `customer`)
- Edit profil (nama, email, password)

### Manajemen Konten (Admin)
- CRUD konten video (judul, deskripsi, file upload)
- Format video: mp4, webm, mkv, avi, mov (max 100MB)
- Pagination 10 item per halaman

### Sistem Pengajuan Akses
- **Customer**: ajukan akses ke konten video, lihat riwayat pengajuan
- **Admin**: approve (set tanggal expired) atau reject pengajuan
- Filter pengajuan berdasarkan status (pending/approved/rejected)
- Validasi otomatis: akses expired = tidak bisa tonton

### Manajemen User (Admin)
- CRUD user, assign role, aktifkan/nonaktifkan akun

## Alur Pengajuan

```
Customer ajukan akses → Status: PENDING
         ↓
Admin review pengajuan
         ↓
   ┌─────┴─────┐
APPROVE      REJECT
(set expired)
   ↓
Customer bisa tonton video
sampai tanggal expired
```

## Instalasi

### 1. Clone & Install Dependencies

```bash
git clone <repository-url>
cd cv-mediatama
composer install
npm install
```

### 2. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` sesuai database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cv_mediatama
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Setup Database & Storage

```bash
php artisan migrate
php artisan db:seed       # (opsional) data sample
php artisan storage:link
```

### 4. Jalankan Aplikasi

```bash
# Cara cepat (Laravel server + Vite + Queue)
composer run dev

# Atau manual di 2 terminal:
php artisan serve    # Terminal 1
npm run dev          # Terminal 2
```

Buka http://localhost:8000

## Struktur Database

### users
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| name | string | Nama lengkap |
| email | string | Email (unique) |
| password | string | Hash password |
| role | enum | `admin` / `customer` |
| is_active | boolean | Status aktif |
| deactivated_at | timestamp | Waktu nonaktif |

### kontens
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| title | string | Judul konten |
| description | text | Deskripsi (opsional) |
| file_path | string | Path file video |
| thumbnail_path | string | Path thumbnail (opsional) |

### pengajuan
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | bigint | Primary key |
| user_id | FK | Relasi ke users |
| konten_id | FK | Relasi ke kontens |
| status | enum | `pending` / `approved` / `rejected` |
| expired_at | timestamp | Batas waktu akses (opsional) |

## Struktur Route

### Guest
| Method | URL | Fungsi |
|--------|-----|--------|
| GET | `/signin` | Halaman login |
| POST | `/signin` | Proses login |

### Customer (`/customer`)
| Method | URL | Fungsi |
|--------|-----|--------|
| GET | `/konten` | Daftar konten |
| GET | `/konten/{id}` | Detail & tonton video |
| POST | `/konten/{id}/pengajuan` | Ajukan akses |
| GET | `/konten/riwayat-pengajuan` | Riwayat pengajuan |

### Admin (`/admin`)
| Method | URL | Fungsi |
|--------|-----|--------|
| GET | `/konten` | Kelola konten |
| POST | `/konten` | Simpan konten baru |
| GET | `/konten/{id}/edit` | Edit konten |
| PUT | `/konten/{id}` | Update konten |
| DELETE | `/konten/{id}` | Hapus konten |
| GET | `/pengajuan` | Daftar pengajuan masuk |
| PUT | `/pengajuan/{id}/approve` | Approve pengajuan |
| PUT | `/pengajuan/{id}/reject` | Reject pengajuan |

### Umum (auth)
| Method | URL | Fungsi |
|--------|-----|--------|
| GET | `/profile` | Halaman profil |
| PUT | `/profile` | Update profil |
| GET | `/user/monitoring` | Daftar user |
| POST | `/logout` | Logout |

## Struktur Menu

```
ADMIN
├── Dashboard
├── User Management
└── Konten
    ├── Kelola Konten
    └── Pengajuan Akses

CUSTOMER
├── Dashboard
└── Konten
    ├── Daftar Konten
    └── Riwayat Pengajuan
```

## Struktur Project

```
app/
├── Helpers/MenuHelper.php          # Menu navigasi per role
├── Http/
│   ├── Controllers/
│   │   ├── Auth/AuthController.php # Login/logout
│   │   ├── DashboardController.php # Dashboard
│   │   ├── KontenController.php    # CRUD konten + view per role
│   │   ├── PengajuanController.php # Pengajuan akses
│   │   ├── UserController.php      # Manajemen user
│   │   └── ProfileController.php   # Edit profil
│   └── Middleware/
│       └── RoleMiddleware.php      # Cek role user
├── Models/
│   ├── User.php                    # isAdmin(), isCustomer()
│   ├── Konten.php                  # hasMany Pengajuan
│   └── Pengajuan.php               # isValid(), belongsTo User/Konten
└── Services/
    ├── AuthService.php             # Validasi login
    └── UserService.php             # Validasi user CRUD

resources/views/pages/
├── admin/
│   ├── index.blade.php             # Dashboard admin
│   ├── konten/                     # CRUD views konten
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   ├── show.blade.php
│   │   ├── edit.blade.php
│   │   └── request.blade.php       # Pengajuan masuk
│   └── master/users/               # User management views
├── customer/
│   ├── index.blade.php             # Dashboard customer
│   ├── konten/
│   │   ├── index.blade.php         # Daftar konten (card)
│   │   └── show.blade.php          # Detail & tonton video
│   └── riwayat-pengajuan.blade.php # Riwayat pengajuan
└── auth/
    └── signin.blade.php            # Halaman login
```

## Build Production

```bash
npm run build

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

Update `.env`:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=
```

## Troubleshooting

| Masalah | Solusi |
|---------|--------|
| Class not found | `composer dump-autoload` |
| Video tidak muncul | `php artisan storage:link` |
| Permission error | `chmod -R 775 storage bootstrap/cache` |
| Cache error | `php artisan optimize:clear` |
| NPM error | Hapus `node_modules` lalu `npm install` |
