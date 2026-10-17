# Stockly - Inventory Management System

Stockly adalah aplikasi web manajemen inventaris (stok barang) untuk mencatat kategori dan produk, memantau jumlah stok, dan melihat produk dengan stok rendah. Aplikasi ini dibuat sebagai proyek akhir magang.

## Fitur

**Admin**
- Login dan logout
- Dashboard: ringkasan (total kategori, produk, stok), grafik stok per kategori, dan daftar produk stok rendah
- CRUD kategori
- CRUD produk
- Melihat stok dan produk dengan stok rendah (stok 5 atau kurang)

**User**
- Register, login, dan logout
- Dashboard ringkasan dan produk terbaru
- Melihat daftar produk (dengan pencarian dan filter kategori)
- Melihat detail produk

**Umum**
- Hak akses berbasis peran (Role-Based Access Control): halaman admin hanya bisa dibuka oleh admin
- Tampilan responsif untuk HP dan desktop
- Validasi form dan perlindungan CSRF

## Teknologi

- Laravel (PHP)
- MySQL
- Blade
- Tailwind CSS
- Laravel Breeze (autentikasi)
- Vite

## Kebutuhan Sistem

- PHP 8.3 atau lebih baru
- Composer
- Node.js dan npm
- MySQL (bisa memakai Laragon atau XAMPP)
- Git

## Cara Instalasi

1. **Clone repository**

```bash
   git clone https://github.com/nazlaamelia-glitch/stockly.git
   cd stockly
```

2. **Pasang dependensi PHP dan JavaScript**

```bash
   composer install
   npm install
```

3. **Buat file `.env`**

```bash
   cp .env.example .env
   php artisan key:generate
```

   Di Windows (Command Prompt), gunakan `copy .env.example .env`.

4. **Atur koneksi database di file `.env`**

   Buat database kosong bernama `stockly` di MySQL, lalu pastikan bagian database di `.env` seperti ini (hapus tanda `#` di depan baris jika ada):

```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=stockly
   DB_USERNAME=root
   DB_PASSWORD=
```

   Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan pengaturan MySQL kamu.

5. **Jalankan migrasi dan isi data contoh**

```bash
   php artisan migrate
   php artisan db:seed --class=DemoSeeder
```

   Seeder membuat akun demo, beberapa kategori, dan produk contoh.

6. **Build tampilan (Tailwind CSS)**

```bash
   npm run build
```

   Untuk pengembangan, bisa memakai `npm run dev`.

7. **Jalankan aplikasi**

```bash
   php artisan serve
```

   Buka `http://127.0.0.1:8000` di browser.

## Akun Demo

Akun ini dibuat oleh seeder dan hanya untuk percobaan lokal.

| Peran | Email | Password |
|---|---|---|
| Admin | `admin@stockly.test` | `admin12345` |
| User | `test@example.com` | `password123` |

Akun baru yang mendaftar lewat halaman Register otomatis berperan sebagai **User**. Akun admin hanya dibuat lewat seeder atau database, bukan lewat form.

## Struktur Database

- `users`: id, name, email, password, role, timestamps
- `categories`: id, name, description, timestamps
- `products`: id, category_id, name, description, stock, price, timestamps

Relasi: satu kategori memiliki banyak produk (`Category hasMany Product`), dan setiap produk milik satu kategori (`Product belongsTo Category`). Kategori yang masih memiliki produk tidak bisa dihapus.

## Hak Akses

| Halaman | Admin | User | Tamu |
|---|---|---|---|
| Dashboard admin, kelola kategori dan produk (`/admin/...`) | Ya | Tidak (403) | Tidak (diarahkan ke login) |
| Dashboard user, daftar dan detail produk (`/user/...`) | Ya | Ya | Tidak (diarahkan ke login) |

## Struktur Folder Penting

```
app/Http/Controllers/Admin/   Controller untuk admin (dashboard, kategori, produk)
app/Http/Controllers/User/    Controller untuk user (dashboard, daftar produk)
app/Http/Middleware/          AdminMiddleware (pembatas akses admin)
app/Models/                   User, Category, Product
database/migrations/          Struktur tabel
database/seeders/             DemoSeeder (data contoh)
resources/views/admin/        Tampilan admin
resources/views/user/         Tampilan user
resources/views/components/   Komponen tampilan (kartu ringkasan)
routes/web.php                Daftar route
```

## Catatan

File `.env` tidak ikut diunggah ke repository karena berisi pengaturan lokal. Buat sendiri dari `.env.example` seperti pada langkah instalasi.

## Pembuat

Nazla Amelia Omarni