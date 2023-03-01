# Aplikasi Kasir (Point Of Sale)
Aplikasi sistem penjualan berbasis web menggunakan framework codeigniter 4.

## Persyaratan
 - Semua persyaratan mengacu ke dokumentasi codeigniter 4. [Dokumentasi](https://codeigniter.com/user_guide/intro/requirements.html)

## Cara Install
 - Download project ini. `git clone https://github.com/sejator/posci4.git`
 - Masuk ke direktori `cd posci4`
 - Jalankan `composer update` untuk mendownload dependensinya.
 - Ganti nama file `env.sampel` menjadi `.env`
 - Ubah kofigurasi databasenya :
    - `database.default.hostname = localhost`
    - `database.default.database = posci4`
    - `database.default.username = root`
    - `database.default.password = root`
    - `database.default.DBDriver = MySQLi`
 - Buat nama database `posci4` kemudian import file `posci4-01-03-2023.sql`
 - Jalankan aplikasi `php spark serve` kemudian buka urlnya `http://localhost:8080/`
 - Akun untuk login :
    - Username : superadmin / admin / kasir
    - Password : 123456