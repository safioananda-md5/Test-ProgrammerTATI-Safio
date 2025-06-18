<p align="center">
  <img src="https://pttati.co.id/assets/img/LOGO%20TATI%201.jpg" alt="PT. TATI Logo" width="200"/>
</p>

<h1 align="center">TUGAS WEBSITE KEPEGAWAIAN HINGGA API</h1>

<p align="center">
  <i>Repository ini saya kerjakan sebagai bagian dari tes/seleksi magang di <strong>PT. TATI</strong>.</i>
</p>

---

## 🚀 Deskripsi Singkat

Project ini berisi sistem backend serta frontend sederhana berbasis Laravel 12 yang digunakan untuk:

- Melakukan input dan pencatatan log harian.
- Melakukan verifikasi terhadap setiap log harian yang telah diinput.
- Mengambil data provinsi melalui integrasi API publik.
- Mengelola data provinsi dengan fitur lengkap API (Create, Read, Update, Delete).
- Menghitung tingkat kinerja pegawai berdasarkan indikator hasil kerja dan perilaku.
- Mengimplementasikan perulangan berbasis logika pengujian.

---

## 🔧 Fitur Utama

- 📋 Input Log Harian
- ✅ Verifikasi Log Harian oleh Admin
- 🌐 Integrasi dengan API `wilayah.id`
- 🛠️ CRUD Data Provinsi
- 📊 Penilaian Kinerja Otomatis
- 🔁 Perulangan dan Logika Pengujian
- 📤 AJAX + SweetAlert Integrasi
- 📦 Import Data via Postman / API

---

## ⚙️ Instalasi

website-kepegawaian
```bash
git clone https://github.com/safioananda-md5/Test-ProgrammerTATI-Safio.git
cd website-kepegawaian
php artisan migrate --seed
php artisan serve
```

website-kepegawaian
```bash
git clone https://github.com/safioananda-md5/Test-ProgrammerTATI-Safio.git
cd wilayah-indonesia
php artisan migrate
https://127.0.0.1/Test-ProgrammerTATI-Safio/wilayah-indonesia/public/api (untuk postman)
/reset-database - mengisi/ reset database
/provinsi - menampilkan daftar provinsi
/provinsi/{{province_code}} - menampilkan detail provinsi
post - /provinsi - menambah provinsi baru
put - /provinsi/{{province_code}} - mengupdate provinsi
delete - /provinsi/{{province_code}} - menghapus provinsi
```

predikat-pegawai
```bash
git clone https://github.com/safioananda-md5/Test-ProgrammerTATI-Safio.git
cd predikat-pegawai
php artisan migrate --seed
php artisan serve
```

fungsi-helloworld
```bash
git clone https://github.com/safioananda-md5/Test-ProgrammerTATI-Safio.git
cd fungsi-helloworld
php artisan serve
```
