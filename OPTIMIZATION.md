# Panduan Optimasi Performa

## Status Saat Ini

| Driver  | Development | Production (target) |
| ------- | ----------- | ------------------- |
| Cache   | `file`      | `redis`             |
| Session | `file`      | `redis`             |
| Queue   | `database`  | `redis`             |

---

## Cara Aktifkan Redis (Sangat Dianjurkan)

### 1. Install Redis di Windows

Cara termudah pakai **Memurai** (Redis untuk Windows, gratis untuk development):

1. Download dari https://www.memurai.com/get-memurai
2. Install, jalankan sebagai service
3. Cek: buka cmd → `redis-cli ping` → harus jawab `PONG`

Atau pakai **WSL2 + Ubuntu**:

```bash
sudo apt update && sudo apt install redis-server
sudo service redis-server start
redis-cli ping
```

### 2. Aktifkan Redis di `.env`

Setelah Redis berjalan, ganti di `.env`:

```env
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
CACHE_STORE=redis
```

### 3. Jalankan ulang cache

```bash
php artisan optimize
```

---

## Optimasi yang Sudah Diterapkan

### ✅ Laravel Framework Caches (`php artisan optimize`)

Aktif sekarang. Mengompilasi config, routes, dan Blade views ke PHP bytecode.

- Config: ~87ms → 0ms per request
- Routes: ~38ms → 0ms per request
- Views: compiled ke `storage/framework/views/`

**Penting**: Setelah mengubah file config/routes/views, jalankan ulang:

```bash
php artisan optimize
# Atau saat development (auto-reload):
php artisan optimize:clear
```

### ✅ N+1 Query Prevention (`AppServiceProvider`)

`Model::preventLazyLoading()` aktif di development — akan throw exception
jika ada relasi yang diakses tanpa eager load. Ini mencegah silent N+1 queries.

### ✅ Cache `pillars.all` di NewsController

Daftar pilar sangat jarang berubah. Di-cache 1 jam di Redis/file.
Invalidasi otomatis setiap 3600 detik.

### ✅ Cache `news.monitoring.counts` di NewsController

5 COUNT queries per kunjungan halaman monitoring → di-cache 30 detik.
Invalidasi otomatis saat: `store`, `update`, `destroy`, `review`, `resubmit`.

### ✅ Cache `news.related.{id}` di NewsController

`inRandomOrder()` adalah full table scan. Diganti dengan cache 10 menit
per berita. Hasil "acak" tetap terasa karena key cache berubah setiap
10 menit.

### ✅ Redis Connection Terpisah per Fungsi

`config/database.php` sudah punya 3 Redis database terpisah:

- `db:0` → queue jobs / data umum
- `db:1` → cache aplikasi
- `db:2` → sessions

Ini mencegah key tabrakan dan memudahkan flush per kategori.

---

## Optimasi Lanjutan (Opsional)

### Horizon (Queue Monitor)

Jika Queue sudah pindah ke Redis, aktifkan Horizon untuk monitoring:

```bash
composer require laravel/horizon
php artisan horizon:install
php artisan horizon
```

### Database Indexes

Pastikan migrasi punya index pada kolom yang sering di-WHERE/ORDER:

- `news.status` ✓ (gunakan di hampir semua query)
- `news.author_id`
- `donations.user_id`
- `donations.news_id`
- `donations.status`

Cek dengan:

```bash
php artisan db:show --counts
```

### Opcache (Production)

Tambahkan di `php.ini` untuk production:

```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0   ; matikan di production
```

### Vite Asset Optimization

Untuk production build:

```bash
npm run build
```

Ini menghasilkan assets ter-minify + versioned hash di `public/build/`.

---

## Perintah Berguna

```bash
# Rebuild semua cache (setelah deploy / ganti config)
php artisan optimize

# Hapus semua cache (saat debug)
php artisan optimize:clear

# Cek ukuran cache Redis
redis-cli info memory

# Flush hanya cache aplikasi (bukan session)
php artisan cache:clear

# Monitor query N+1 di Telescope (opsional)
composer require laravel/telescope --dev
php artisan telescope:install
```
