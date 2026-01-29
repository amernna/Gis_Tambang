# GIS Tambang (Mining GIS Application)

Aplikasi Sistem Informasi Geografis (GIS) untuk manajemen dan monitoring area tambang. Aplikasi ini dibangun menggunakan CodeIgniter 3 dan menyediakan fitur untuk mengelola data aktivitas tambang, lokasi lahan, dan informasi pengguna.

## Fitur Utama

- **Manajemen Data Tambang**: Kelola informasi mengenai area dan lokasi tambang
- **Tracking Aktivitas**: Monitor aktivitas tambang secara real-time
- **Manajemen Pengguna**: Sistem authentication dan manajemen user
- **Dashboard**: Visualisasi data dengan tampilan yang user-friendly
- **Responsive Design**: Interface yang responsif menggunakan Bootstrap
- **Geolocation Features**: Integrasi dengan peta dan fitur geolokasi

## Persyaratan Sistem

- **PHP**: 5.6 atau lebih tinggi
- **Database**: MySQL 5.5+
- **Web Server**: Apache atau Nginx
- **Composer**: Untuk dependency management

## Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/amernna/Gis_Tambang.git
cd Gis_Tambang
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Konfigurasi Database

#### a. Buat Database
```sql
CREATE DATABASE gis_tambang;
```

#### b. Edit File Konfigurasi Database
Buka file `application/config/database.php` dan sesuaikan konfigurasi:
```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '', // Sesuaikan password database Anda
    'database' => 'gis_tambang',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```

### 4. Setup Database
```bash
php index.php migrate
```

### 5. Akses Aplikasi
Buka browser dan akses:
```
http://localhost/gis-tambang
```

## Cara Menggunakan Aplikasi

### Login
1. Buka aplikasi di browser
2. Masukkan username dan password
3. Klik tombol **Login**
4. Anda akan diarahkan ke dashboard utama

### Dashboard
Dashboard menampilkan ringkasan data dengan visual yang menarik:
- Jumlah aktivitas terkini
- Data tambang aktif
- Statistik pengguna
- Peta lokasi tambang

### Manajemen Aktivitas

#### Melihat Daftar Aktivitas
1. Klik menu **Aktivitas** di sidebar
2. Daftar aktivitas akan ditampilkan dalam bentuk tabel
3. Gunakan fitur search untuk mencari aktivitas tertentu

#### Menambah Aktivitas Baru
1. Klik tombol **Tambah Aktivitas**
2. Isi form dengan data berikut:
   - Nama Aktivitas
   - Deskripsi
   - Tanggal Mulai
   - Status
   - Lokasi/Koordinat
3. Klik **Simpan**

#### Edit Aktivitas
1. Di halaman daftar aktivitas, klik tombol **Edit** pada aktivitas yang ingin diubah
2. Ubah data sesuai kebutuhan
3. Klik **Simpan**

#### Hapus Aktivitas
1. Di halaman daftar aktivitas, klik tombol **Hapus** pada aktivitas yang ingin dihapus
2. Konfirmasi penghapusan
3. Aktivitas akan dihapus dari sistem

### Manajemen Tambang (Lahan)

#### Melihat Data Tambang
1. Klik menu **Lahan/Tambang** di sidebar
2. Lihat peta dan data detail tambang

#### Menambah Data Tambang Baru
1. Klik tombol **Tambah Tambang**
2. Isi informasi:
   - Nama Lokasi
   - Alamat
   - Koordinat GPS (Latitude/Longitude)
   - Luas Area
   - Jenis Tambang
   - Informasi Kontak
3. Klik **Simpan**

#### Update Koordinat
1. Gunakan peta interaktif untuk menentukan lokasi
2. Klik pada peta untuk memilih koordinat
3. Sistem akan otomatis mengisi latitude dan longitude

### Manajemen Pengguna

#### Melihat Daftar Pengguna (Admin Only)
1. Klik menu **Pengguna** di sidebar
2. Tampilkan semua user terdaftar

#### Tambah Pengguna Baru (Admin Only)
1. Klik tombol **Tambah Pengguna**
2. Isi data:
   - Username (unik)
   - Email
   - Password
   - Role (Admin/User)
   - Status
3. Klik **Simpan**

#### Edit Profil User
1. Klik menu **Profil** di navbar
2. Ubah informasi pribadi:
   - Nama Lengkap
   - Email
   - Password (opsional)
3. Klik **Simpan Perubahan**

### Logout
1. Klik icon user di top-right navbar
2. Pilih **Logout**
3. Anda akan diarahkan ke halaman login

## Struktur Folder

```
Gis_Tambang/
├── application/
│   ├── config/          # File konfigurasi
│   ├── controllers/     # Controller files
│   ├── models/         # Model database
│   ├── views/          # View templates
│   ├── helpers/        # Helper functions
│   └── language/       # Language files
├── system/             # CodeIgniter system files
├── template/           # Template assets (CSS, JS, images)
├── gambar/            # Upload directory for images
├── index.php          # Entry point
└── README.md          # File ini
```

## Teknologi yang Digunakan

- **Framework**: CodeIgniter 3
- **Frontend**: Bootstrap 4
- **Database**: MySQL
- **Maps**: Library pemetaan (Google Maps/Leaflet)
- **Charts**: Admin LTE Dashboard
- **jQuery**: DOM manipulation dan AJAX

## Default Credentials

> **PENTING**: Ubah password default setelah login pertama!

| Username | Password | Role  |
|----------|----------|-------|
| admin    | admin    | Admin |

## Troubleshooting

### Masalah Koneksi Database
- Pastikan MySQL service sudah berjalan
- Verifikasi username dan password database
- Cek file `application/config/database.php`

### Error 404 pada route
- Pastikan `mod_rewrite` Apache diaktifkan
- Cek file `.htaccess` di root folder
- Perbarui base URL di `application/config/config.php`

### Upload gambar tidak berjalan
- Pastikan folder `gambar/` sudah ada dan writable
- Ubah permission folder: `chmod 777 gambar/`

### Session timeout
- Edit `application/config/config.php` untuk mengubah session timeout
- Default: 7200 detik (2 jam)

## Kontribusi

Untuk berkontribusi, silakan:
1. Fork repository ini
2. Buat branch baru (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## Lisensi

Project ini dilisensikan di bawah lisensi MIT. Lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.

## Kontak & Support

Untuk pertanyaan atau support, silakan hubungi:
- **Email**: amernna@example.com
- **GitHub**: https://github.com/amernna/Gis_Tambang

## Catatan Keamanan

- **Jangan** expose database credentials di kode public
- Selalu gunakan HTTPS di production
- Update CodeIgniter dan dependencies secara berkala
- Implementasi rate limiting untuk authentication
- Gunakan prepared statements untuk mencegah SQL Injection

---

**Dikembangkan dengan ❤️ untuk manajemen tambang yang lebih baik**

Last Updated: January 2026
