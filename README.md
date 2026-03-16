# 🦅 GarudaCBT (Modified Version)

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%20|%208.0%20|%208.3-blue.svg)](https://www.php.net/)

**GarudaCBT** adalah sistem Manajemen Ujian Berbasis Komputer (CBT) dan E-Learning modern yang dirancang khusus untuk institusi pendidikan di Indonesia. Versi modifikasi ini membawa berbagai perbaikan bug dan peningkatan performa untuk pengalaman yang lebih stabil.

---

## 🚀 Fitur Utama

### 1. 📊 Data Master
*   **Manajemen Sekolah:** Tahun Pelajaran, Jurusan, Kelas/Rombel.
*   **Manajemen User:** Siswa, Guru, dan Administrator dengan kontrol akses yang ketat.
*   **Mata Pelajaran:** Pengaturan Mapel dan Ekstrakurikuler yang fleksibel.

### 2. 📝 E-Learning & Tugas
*   **Materi Digital:** Berbagi materi dalam berbagai format (teks/file).
*   **Manajemen Tugas:** Memberikan tugas secara online kepada siswa.
*   **Jadwal KBM:** Pengaturan jadwal pelajaran harian yang terintegrasi.
*   **Presensi:** Kehadiran siswa otomatis/manual per mata pelajaran.

### 3. 🎯 Sistem Ujian (CBT)
*   **Variasi Soal:** Mendukung Pilihan Ganda (PG), PG Kompleks, Menjodohkan, Isian Singkat, dan Essai.
*   **Keamanan Tinggi:** 
    *   Pengacakan soal dan opsi jawaban per siswa.
    *   Deteksi pindah tab (Anti-Cheat).
    *   Sistem Token dinamis.
*   **Analisis Soal:** Laporan mendalam mengenai tingkat kesulitan dan validitas soal.

### 4. 📒 Rapor & Administrasi
*   **Olah Nilai:** Perhitungan nilai otomatis berdasarkan bobot.
*   **Buku Induk:** Cetak buku induk siswa langsung dari sistem.
*   **Rapor PTS/PAS:** Digenerate secara otomatis sesuai kurikulum.

---

## 🛠️ Persyaratan Sistem
- **Server:** Apache atau Nginx
- **PHP:** v7.4 s/d v8.3 (Teruji Stabil)
- **Database:** MySQL / MariaDB
- **Browser:** Google Chrome (Direkomendasikan)

---

## 📦 Instalasi
1.  **Download:** Ambil direktori project ini dan ekstrak ke folder `htdocs` (XAMPP) atau `www` (Laragon).
2.  **Database:** Buat database baru di MySQL/phpMyAdmin.
3.  **Konfigurasi:** 
    *   Ubah file `application/config/database.php` dan sesuaikan dengan username & password MySQL Anda.
4.  **Akses:** Buka browser dan arahkan ke alamat instalasi (contoh: `http://localhost/garuda-cbt`).
5.  **Setup:** Ikuti langkah yang muncul di layar untuk proses instalasi awal.

*Tutorial lengkap dapat dilihat di [Official Wiki](https://github.com/TEGAR-SRC/garuda-cbt-modifed/wiki).*

---

## 🔄 Cara Update
1.  Backup source code dan database lama Anda.
2.  Ganti folder code lama dengan code terbaru dari repository ini.
3.  Sesuaikan kembali konfigurasi database di `application/config/database.php`.
4.  Masuk ke menu **PENGATURAN -> Database -> Update** untuk memperbarui struktur tabel.

---

## 📝 Changelog (v1.5.3 FIXED)
- ✅ **Optimasi PHP:** Dukungan penuh untuk PHP 8.x.
- ✅ **Fitur Foto:** Import Guru dan update foto siswa per-kelas masal.
- ✅ **Keamanan:** Perbaikan logout admin otomatis setelah ganti password.
- ✅ **Ujian:** Perbaikan bug zoom soal, rekap nilai 0, dan koreksi isian singkat.
- ✅ **Template:** Header jawaban essai di sisi siswa kini bisa di-custom.
- ✅ **Equation:** Dukungan LaTeX untuk rumus matematika yang lebih rapi.

---

## 📢 Kontribusi & Dukungan
Jika Anda menemukan bug atau ingin berdiskusi, silakan bergabung dengan komunitas kami:
*   [Group Telegram GarudaCBT](http://t.me/garudacbt)
*   [Dokumentasi Online](https://github.com/TEGAR-SRC/garuda-cbt-modifed)

---

## 📜 Lisensi
Aplikasi ini bersifat **Open Source** di bawah lisensi **MIT**. Anda bebas menggunakan dan memodifikasi selama mencantumkan sumber asli. Kami tidak bertanggung jawab atas penyalahgunaan atau modifikasi pihak ketiga.

---
*Dibuat dengan ❤️ untuk pendidikan Indonesia yang lebih baik.*
