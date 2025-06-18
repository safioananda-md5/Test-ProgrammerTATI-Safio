<p align="center">
  <img src="https://pttati.co.id/assets/img/LOGO%20TATI%201.jpg" alt="PT. TATI Logo" width="200"/>
</p>

<h1 align="center">🇮🇩 Wilayah Indonesia API Seeder</h1>

<p align="center">
  <i>Repository ini saya kerjakan sebagai bagian dari tes/interview magang di <strong>PT. TATI</strong>.</i>
</p>

---

## 🚀 Deskripsi Singkat

Project ini berisi sistem backend sederhana berbasis Laravel yang digunakan untuk:

- Mengambil data **Provinsi**, **Kabupaten/Kota**, **Kecamatan**, hingga **Desa** dari API [wilayah.id](https://wilayah.id)
- Memasukkan data ke dalam database dengan struktur relasional
- Otomatisasi seeding data dari endpoint API publik menggunakan Laravel Controller
- Manajemen data wilayah secara efisien dan terstruktur

---

## 🔧 Fitur Utama

- ✅ Integrasi dengan API `wilayah.id`
- ✅ Seeder otomatis hingga level desa
- ✅ Validasi dan pengecekan data sebelum insert
- ✅ Laravel Artisan support
- ✅ Friendly error handling
- ✅ Siap di-deploy

---

## 📁 Struktur Data

- **Provinces**  
- **Regencies** (Kabupaten/Kota)  
- **Districts** (Kecamatan)  
- **Villages** (Desa)

---

## ⚙️ Instalasi

```bash
git clone https://github.com/namamu/repo-wilayah-indonesia.git
cd repo-wilayah-indonesia
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
