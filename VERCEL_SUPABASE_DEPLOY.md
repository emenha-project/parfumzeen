# 🚀 Panduan Lengkap: Integrasi Supabase & Deployment ke Vercel

Panduan ini memandu Anda langkah-demi-langkah mulai dari setup database di **Supabase**, menghubungkan repositori ke **GitHub**, hingga tayang di **Vercel**.

---

## 1. Setup Database di Supabase (PostgreSQL)

1. Buka [https://supabase.com](https://supabase.com) dan buat akun / login.
2. Klik **New Project**, tentukan:
   - **Name**: `zeen-parfum-db`
   - **Database Password**: Buat password yang kuat dan catat baik-baik.
   - **Region**: Pilih yang terdekat dengan Indonesia (misal: `Singapore (ap-southeast-1)`).
3. Tunggu 1-2 menit hingga status database menjadi **Active**.
4. Masuk ke menu **Project Settings** (ikon gerigi di kiri bawah) > **Database**.
5. Gulir ke bagian **Connection string**:
   - Pilih tab **URI** atau **Parameters**.
   - Supabase menggunakan port `6543` untuk Transaction Pooler atau `5432` untuk direct connection.
   - Catat:
     - Host: misal `aws-0-ap-southeast-1.pooler.supabase.com`
     - Database: `postgres`
     - User: `postgres.[PROJECT_REF]`
     - Password: `[PASSWORD_ANDA]`
     - Port: `6543`

---

## 2. Inisialisasi Repository GitHub

Buka terminal di direktori proyek:
```bash
cd C:\Users\LENOV\.gemini\antigravity\scratch\zeen-parfum

# Inisialisasi git
git init
git add .
git commit -m "feat: inisialisasi e-commerce zeen parfum"

# Hubungkan ke repository GitHub Anda (buat repository baru di github.com)
git branch -M main
git remote add origin https://github.com/USERNAME_ANDA/zeen-parfum.git
git push -u origin main
```

---

## 3. Deploy ke Vercel

1. Buka [https://vercel.com](https://vercel.com) dan login menggunakan akun GitHub Anda.
2. Klik tombol **Add New...** > **Project**.
3. Cari dan pilih repository **zeen-parfum**, lalu klik **Import**.
4. Di bagian **Configure Project**:
   - **Framework Preset**: biarkan `Other` (karena konfigurasi sudah ditangani oleh `vercel.json`).
   - Buka bagian **Environment Variables**, masukkan variabel berikut:

| Key | Value Contoh | Deskripsi |
| :--- | :--- | :--- |
| `APP_NAME` | `ZEEN PARFUM` | Nama Brand |
| `APP_ENV` | `production` | Mode Produksi |
| `APP_KEY` | `base64:7K5vP4L9d1M6zQ2b8N0wX4jK1lE9rT3vS8uI2oP6mQ4=` | Enkripsi Key Laravel |
| `APP_DEBUG` | `false` | Keamanan produksi |
| `APP_URL` | `https://zeen-parfum.vercel.app` | URL domain Vercel Anda |
| `DB_CONNECTION` | `pgsql` | Driver PostgreSQL |
| `DB_HOST` | `aws-0-ap-southeast-1.pooler.supabase.com` | Host Supabase Anda |
| `DB_PORT` | `6543` | Port Supabase Pooler |
| `DB_DATABASE` | `postgres` | Nama DB Supabase |
| `DB_USERNAME` | `postgres.YOUR_PROJECT_REF` | User DB Supabase |
| `DB_PASSWORD` | `PASSWORD_SUPABASE_ANDA` | Password DB Supabase |
| `DB_SSLMODE` | `require` | SSL Wajib di Supabase |

5. Klik **Deploy**.
6. Vercel akan otomatis menjalankan build dan meluncurkan website Anda dengan domain `https://zeen-parfum.vercel.app`.

---

## 4. Menjalankan Migrasi ke Supabase

Untuk mengisi tabel dan data parfum awal ke database Supabase Anda, jalankan perintah berikut dari komputer lokal:
1. Ganti sementara nilai `DB_...` di file `.env` lokal Anda dengan data Supabase Anda.
2. Jalankan perintah migrasi:
   ```bash
   php artisan migrate --seed
   ```
3. Semua produk (Noir Absolu, Santal Impérial, Fleur Blanche, dll.) beserta piramida aromanya akan otomatis terisi ke database Supabase Anda!
