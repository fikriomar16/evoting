# Simulasi E-Voting

## Tentang E-Voting
> Project ini dibuat untuk dapat melakukan simulasi pemungutan suara secara elektronik/online
> Dibuat dengan framework Laravel 8, dan Bootstrap untuk css

## Fitur
- [x] Register Akun Pemilih
- [x] Login Akun
- [x] Multi Auth (User, Admin & Super Admin)
- [ ] Lupa Password
- [x] Ajax DataTable
- [x] Ajax CRUD
- [x] Reset Data
- [x] Set Konfigurasi (Tanggal Mulai Vote, Tanggal Berakhir Vote, dll)
- [x] WYSIWYG Editor
- [x] Upload Image File
- [x] Set Aktif/Nonaktif User oleh Admin
- [x] Tambah Admin oleh Super Admin

### Catatan
- Cek file ```php.ini``` untuk set ukuran upload maksimal
- Cek ```browscap.ini``` beserta path untuk data user agent
- Cek .env untuk konfigurasi web app ketika deploy
- Jalankan ```php artisan key:generate``` setelah atur .env
- Cek permission folder
- Jalankan ```composer install``` setelah upload hosting untuk mendownload vendor