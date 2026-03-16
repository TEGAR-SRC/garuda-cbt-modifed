# 🦅 GarudaCBT (Modified Version)

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-8.1%20|%208.2%20|%208.3-blue.svg)](https://www.php.net/)
[![Docker Support](https://img.shields.io/badge/Docker-Ready-blue.svg)](https://www.docker.com/)

**GarudaCBT** adalah sistem Manajemen Ujian Berbasis Komputer (CBT) dan E-Learning modern yang dirancang khusus untuk institusi pendidikan di Indonesia. 

> [!NOTE]
> **Versi Modifikasi oleh Tegar Arrahman**
> Membawa berbagai perbaikan bug, dukungan Docker penuh, optimasi HTTPS (Proxy-Aware), dan peningkatan performa untuk pengalaman yang lebih stabil.

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

## 🐳 Deployment via Docker (Recommended)

Versi ini mendukung deployment cepat menggunakan Docker. Sangat cocok untuk dideploy di VPS menggunakan **Dokploy**, Coolify, atau Docker Compose manual.

### Environment Variables
Aplikasi akan secara otomatis membaca konfigurasi database dari environment variables berikut:

| Key | Default | Deskripsi |
| --- | --- | --- |
| `DB_HOSTNAME` | `db` | Hostname database (Service name) |
| `DB_USERNAME` | `garuda_user` | Username database |
| `DB_PASSWORD` | `garuda_password`| Password database |
| `DB_DATABASE` | `garuda_db` | Nama database |

### Cara Deploy (Docker Compose)
1.  Siapkan Docker & Docker Compose.
2.  Jalankan perintah:
    ```bash
    docker-compose up -d
    ```
3.  Akses aplikasi di `http://localhost:8080`.

### Tips Dokploy (HTTPS Fix)
Jika dideploy di belakang Reverse Proxy (Dokploy/Cloudflare), aplikasi sudah dilengkapi fitur **Proxy-Aware HTTPS**. Tidak akan ada lagi error *Mixed Content* karena base_url akan menyesuaikan secara otomatis.

---

## 🛠️ Persyaratan Sistem (Manual)
- **Server:** Apache atau Nginx
- **PHP:** v8.1 s/d v8.3 (Teruji Stabil)
- **Database:** MySQL 8.0 / MariaDB
- **Browser:** Google Chrome (Direkomendasikan)

---

## 📦 Instalasi Manual
1.  **Download:** Ambil direktori project ini dan ekstrak ke folder web server Anda.
2.  **Database:** Buat database baru di MySQL/phpMyAdmin.
3.  **Konfigurasi:** 
    *   Ubah file `application/config/database.php` dan sesuaikan dengan credentials Anda.
4.  **Akses:** Buka browser dan ikuti langkah instalasi di layar.

---

## 📝 Changelog (Modified by Tegar)
- ✅ **PHP 8.1+ Support:** Perbaikan berbagai fungsi deprecated di versi PHP terbaru.
- ✅ **Docker Entrypoint:** Otomatisasi setup permissions dan konfigurasi database.
- ✅ **Proxy-Aware HTTPS:** Mendukung `X-Forwarded-Proto` untuk deployment Cloudflare/Dokploy.
- ✅ **Session Fix:** Perbaikan error folder session pada environment containerized.
- ✅ **Installer Bypass:** Deteksi otomatis status instalasi pada Docker environment.

---

## 📜 Lisensi
Aplikasi ini bersifat **Open Source** di bawah lisensi **MIT**. Anda bebas menggunakan dan memodifikasi selama mencantumkan sumber asli.

---
*Dibuat dengan ❤️ oleh Tegar Arrahman untuk pendidikan Indonesia yang lebih baik.*
