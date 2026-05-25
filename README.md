# Manajemen Talenta Local Tools

Aplikasi Manajemen Talenta Local Tools adalah sistem pemetaan jabatan dan manajemen talenta ASN yang dikembangkan khusus untuk **Badan Kepegawaian dan Pengembangan Sumber Daya Manusia (BKPSDM) Kabupaten Karanganyar**.

Aplikasi ini dibangun menggunakan **CodeIgniter 4**, dengan antarmuka bergaya modern (Glassmorphism) menggunakan **Tailwind CSS**.

## Fitur Utama

### 1. Modul Pemetaan Jabatan
Modul ini digunakan untuk memetakan status seluruh jabatan secara otomatis berdasarkan data yang diimpor dari file Excel.
- **Import Data Excel:** Pengguna dapat mengunggah file `.xlsx` berdasarkan *template* yang disediakan.
- **Ekstrak & Penyimpanan Persisten:** Data yang diimpor diekstrak menggunakan pustaka `PhpSpreadsheet` dan disimpan dengan format `.json` (`writable/data/jabatan.json`) sehingga lebih ringan dan cepat diakses tanpa menggunakan sistem basis data relasional.
- **Deduplikasi Cerdas:** Apabila terdapat nama jabatan yang sama saat impor, sistem secara otomatis akan memperbarui data tersebut dengan versi terbaru, menghindari data ganda.
- **Kategorisasi Otomatis:**
  - **Terisi:** Jabatan yang saat ini diduduki oleh pegawai (NIP dan Nama Pegawai tersedia).
  - **Kosong:** Jabatan yang tidak memiliki NIP maupun Nama Pegawai.
  - **Akan Kosong:** Jabatan yang saat ini terisi, namun pejabatnya akan memasuki Batas Usia Pensiun (BUP) 58 tahun pada tahun berjalan, dihitung secara otomatis berdasarkan perhitungan Nomor Induk Pegawai (NIP).
- **Export Data:** Memungkinkan pengguna untuk mengunduh kembali data jabatan yang telah terpetakan menjadi file Excel lengkap dengan format warna otomatis.
- **Dashboard Real-time:** Menampilkan visualisasi ringkasan jumlah jabatan (total, terisi, kosong, dan akan kosong) serta mendukung pencarian secara *real-time*.

## Prasyarat Server (Server Requirements)

- PHP versi 8.2 atau yang lebih baru.
- Ekstensi PHP yang dibutuhkan:
  - `intl`
  - `mbstring`
  - `json`
  - `zip` (Wajib diaktifkan untuk fungsionalitas membaca dan membuat berkas Excel dengan PhpSpreadsheet).

## Panduan Instalasi (Setup)

1. **Clone repositori ini:**
   ```bash
   git clone git@github.com:HafidzFachrisyah/mantaKra.git
   ```

2. **Masuk ke direktori proyek:**
   ```bash
   cd mantaKra
   ```

3. **Install Dependensi:**
   Pastikan Anda sudah menginstall Composer di komputer/server Anda. Kemudian jalankan:
   ```bash
   composer install
   ```

4. **Pengaturan Lingkungan (Environment):**
   - Salin file `env` menjadi `.env`.
   - Ubah konfigurasi untuk mengaktifkan *development mode*:
     ```env
     CI_ENVIRONMENT = development
     ```
   - Sesuaikan konfigurasi `app.baseURL` dengan URL server lokal Anda, misal:
     ```env
     app.baseURL = 'http://localhost/manajementalenta/public/'
     ```

5. **Akses Aplikasi:**
   Buka browser dan akses melalui URL yang Anda tentukan di atas. Contoh:
   `http://localhost/manajementalenta/public/`

## Hak Cipta
Dikembangkan untuk **BKPSDM Kabupaten Karanganyar** &copy; 2026.
