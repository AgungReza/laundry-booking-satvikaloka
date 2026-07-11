# Sistem Manajemen Booking Mesin Laundry

Aplikasi web untuk mengelola booking mesin laundry berbasis **CodeIgniter 4**, **Tailwind CSS**, dan **MySQL/MariaDB**.

Fitur utama:
- Login dan register customer
- 1 akun admin utama
- Booking mesin laundry
- Booking multi-mesin dalam satu transaksi
- Tarif mesin per jam
- Durasi fleksibel
- Buffer antar-booking 15 menit
- Deadline upload bukti pembayaran 60 menit
- Upload bukti transfer manual
- Verifikasi pembayaran oleh admin
- CRUD mesin laundry
- CRUD add on
- Laporan pendapatan, pengeluaran, dan laba bersih

---

## 1. Kebutuhan Sebelum Menjalankan Project

Pastikan perangkat sudah memiliki:

1. **PHP** versi yang didukung CodeIgniter 4
2. **Composer**
3. **MySQL / MariaDB**
4. **Laragon / XAMPP** untuk Windows
5. **Browser**
6. **Code editor**, misalnya Visual Studio Code

Rekomendasi untuk Windows:

```text
Laragon
PHP 8.3
MySQL / MariaDB
Composer
```

---

## 2. Letakkan Project di Folder Server Lokal

Jika menggunakan Laragon, letakkan project di folder:

```text
C:\laragon\www\edwin\laundry-booking
```

Masuk ke folder project menggunakan PowerShell:

```powershell
cd C:\laragon\www\edwin\laundry-booking
```

---

## 3. Install Dependency Composer

Jalankan perintah berikut:

```powershell
composer install
```

Jika sudah pernah install tetapi masih error autoload, jalankan:

```powershell
composer dump-autoload
```

---

## 4. Buat File `.env`

Jika belum ada file `.env`, salin dari `env` atau `.env.example`, lalu ubah namanya menjadi:

```text
.env
```

Isi file `.env` untuk Windows / Laragon:

```env
CI_ENVIRONMENT=development

app.baseURL='http://localhost:8080/'
app.appTimezone='Asia/Jakarta'
app.forceGlobalSecureRequests=false
app.CSPEnabled=false

database.default.hostname=localhost
database.default.database=laundry_booking
database.default.username=root
database.default.password=
database.default.DBDriver=MySQLi
database.default.DBPrefix=
database.default.port=3306

encryption.key=

session.driver='CodeIgniter\Session\Handlers\FileHandler'
session.savePath=null

logger.threshold=4

ADMIN_EMAIL=admin@laundry.test
ADMIN_PASSWORD=Admin12345
ADMIN_NAME="Admin Laundry"
```

Catatan penting:

```env
ADMIN_NAME="Admin Laundry"
```

Harus menggunakan tanda kutip karena memiliki spasi.

---

## 5. Buat Database

Buka Laragon, lalu klik:

```text
Start All
```

Kemudian buka database manager / phpMyAdmin, lalu buat database baru:

```text
laundry_booking
```

Atau jalankan SQL berikut:

```sql
CREATE DATABASE laundry_booking CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

## 6. Jalankan Migration

Setelah database dibuat, jalankan:

```powershell
php spark migrate
```

Migration akan membuat tabel-tabel utama, seperti:

- `users`
- `machines`
- `bookings`
- `booking_machines`
- `payments`
- `bank_accounts`
- `expenses`
- `settings`
- `addons`
- `booking_addons`

---

## 7. Jalankan Seeder

Jalankan seeder berikut satu per satu:

```powershell
php spark db:seed AdminSeeder
php spark db:seed SettingSeeder
php spark db:seed BankAccountSeeder
php spark db:seed DummyMachineSeeder
php spark db:seed DummyAddonSeeder
```

Fungsi seeder:

| Seeder | Fungsi |
|---|---|
| `AdminSeeder` | Membuat akun admin utama |
| `SettingSeeder` | Membuat pengaturan default aplikasi |
| `BankAccountSeeder` | Membuat rekening tujuan transfer |
| `DummyMachineSeeder` | Membuat data contoh mesin laundry |
| `DummyAddonSeeder` | Membuat data contoh add on |

---

## 8. Pengaturan Penting Sistem

Pengaturan utama yang digunakan:

```text
payment_deadline_minutes = 60
booking_buffer_minutes = 15
app_timezone = Asia/Jakarta
```

Artinya:

- Customer punya waktu **60 menit** untuk upload bukti pembayaran.
- Setelah mesin selesai digunakan, ada jeda **15 menit** sebelum bisa dibooking lagi.
- Semua waktu menggunakan zona waktu **WIB / Asia/Jakarta**.

---

## 9. Jalankan Website

Jalankan server lokal CodeIgniter:

```powershell
php spark serve
```

Buka browser:

```text
http://localhost:8080
```

---

## 10. Login Admin

Gunakan akun admin default berikut:

```text
Email    : admin@laundry.test
Password : Admin12345
```

Setelah login, admin dapat mengakses:

```text
http://localhost:8080/admin/dashboard
```

---

## 11. Akses Customer

Customer dapat daftar melalui halaman register:

```text
http://localhost:8080/register
```

Setelah login, customer diarahkan ke dashboard customer:

```text
http://localhost:8080/customer/dashboard
```

---

## 12. Alur Penggunaan Admin

Sebelum customer melakukan booking, admin sebaiknya mengecek bagian berikut:

1. Login sebagai admin
2. Cek data mesin di menu **Mesin**
3. Pastikan status mesin adalah `available`
4. Pastikan tarif per jam sudah benar
5. Cek rekening bank di menu **Bank Account**
6. Cek add on di menu **Add On**
7. Cek laporan dan expense jika diperlukan

---

## 13. Alur Penggunaan Customer

Alur customer:

1. Register akun
2. Login
3. Buka halaman booking
4. Pilih tanggal dan jam mulai
5. Pilih mesin
6. Pilih durasi penggunaan
7. Pilih add on jika diperlukan
8. Konfirmasi booking
9. Transfer pembayaran
10. Upload bukti pembayaran sebelum 60 menit
11. Menunggu verifikasi admin

---

## 14. Verifikasi Pembayaran

Admin membuka menu pembayaran:

```text
/admin/payments
```

Admin dapat:

- Approve pembayaran
- Reject pembayaran
- Melihat bukti transfer
- Mengubah status booking menjadi confirmed setelah pembayaran valid

---

## 15. Auto Cancel Booking

Booking dengan status `pending_payment` akan dibatalkan jika customer tidak upload bukti dalam 60 menit.

Jalankan manual:

```powershell
php spark booking:auto-cancel
```

Untuk production, command ini sebaiknya dijalankan otomatis menggunakan cron job atau task scheduler.

---

## 16. Jika Ingin Reset Database

Gunakan perintah ini hanya jika ingin menghapus ulang semua tabel dan data:

```powershell
php spark migrate:refresh
```

Lalu jalankan ulang semua seeder:

```powershell
php spark db:seed AdminSeeder
php spark db:seed SettingSeeder
php spark db:seed BankAccountSeeder
php spark db:seed DummyMachineSeeder
php spark db:seed DummyAddonSeeder
```

Peringatan:

```text
migrate:refresh akan menghapus data lama.
Gunakan hanya saat development.
```

---

## 17. Troubleshooting

### Error: `.env` gagal dibaca karena ADMIN_NAME

Jika muncul error terkait `.env`, pastikan:

```env
ADMIN_NAME="Admin Laundry"
```

Bukan:

```env
ADMIN_NAME=Admin Laundry
```

---

### Error: `BaseController.php` tidak ditemukan

Pastikan file berikut ada:

```text
app\Controllers\BaseController.php
```

Jika hilang, ambil ulang dari project CodeIgniter 4 baru.

---

### Error: `The error view file was not specified`

Pastikan folder error bawaan CI4 ada:

```text
app\Views\errors\html\error_exception.php
app\Views\errors\cli\error_exception.php
```

Jika belum ada, copy dari project CodeIgniter 4 baru.

---

### Error: `"auth,role" filter must have a matching alias defined`

Di `app/Config/Routes.php`, jangan gunakan:

```php
['filter' => 'auth,role:admin']
```

Gunakan:

```php
['filter' => ['auth', 'role:admin']]
```

Untuk customer:

```php
['filter' => ['auth', 'role:customer']]
```

---

### Pastikan Alias Filter Ada

Di `app/Config/Filters.php`, pastikan ada:

```php
'auth'  => \App\Filters\AuthFilter::class,
'role'  => \App\Filters\RoleFilter::class,
'guest' => \App\Filters\GuestFilter::class,
```

---

## 18. Struktur Folder Penting

```text
app/
├── Controllers/
│   ├── Auth/
│   ├── Admin/
│   ├── Customer/
│   └── BaseController.php
├── Models/
├── Services/
├── Filters/
├── Database/
│   ├── Migrations/
│   └── Seeds/
└── Views/

public/
writable/
.env
composer.json
spark
```

---

## 19. Catatan Keamanan

Sebelum upload ke GitHub, pastikan file berikut tidak ikut dicommit:

```text
.env
writable/uploads/
```

Gunakan file contoh seperti:

```text
.env.example
```

Jangan upload password database atau akun admin asli ke repository publik.

---

## 20. Ringkasan Perintah Instalasi

Jalankan dari folder project:

```powershell
cd C:\laragon\www\edwin\laundry-booking

composer install
composer dump-autoload

php spark migrate

php spark db:seed AdminSeeder
php spark db:seed SettingSeeder
php spark db:seed BankAccountSeeder
php spark db:seed DummyMachineSeeder
php spark db:seed DummyAddonSeeder

php spark serve
```

Buka:

```text
http://localhost:8080
```

Login admin:

```text
Email    : admin@laundry.test
Password : Admin12345
```
