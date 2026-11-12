# ⚜️ ZEEN PARFUM — Luxury Haute Parfumerie E-Commerce

**ZEEN PARFUM** adalah platform e-commerce parfum mewah (*Haute Parfumerie*) dengan konsep desain minimalis, elegan, dan profesional yang terinspirasi oleh visual dan pengalaman belanja **Sephora Indonesia** ([sephora.co.id](https://www.sephora.co.id/)).

Proyek ini dibangun menggunakan **Laravel 11**, mendukung database modern **Supabase (PostgreSQL)**, dan telah dikonfigurasi siap *deploy* tanpa hambatan di **Vercel Serverless** serta **GitHub Actions**.

---

## ✨ Fitur Utama

### 1. Desain Visual Terinspirasi Sephora Indonesia
- **Minim Tulisan, Banyak Visual & Ilustrasi**: Menonjolkan estetika botol parfum bernilai seni tinggi, foto editorial resolusi tinggi, dan ikonografi piramida aroma.
- **Monokrom Mewah (Black & White)**: Palet warna hitam pekat (`#0A0A0A`), putih bersih, aksen sampanye/emas lembut, tipografi *Serif* mewah (*Playfair Display*) dipadukan dengan *Sans-Serif* modern (*Plus Jakarta Sans*).
- **Banner Ticker Promo Sephora**: Free Ongkir se-Indonesia (min. Rp 500.000), 100% Original & Terdaftar BPOM, serta bonus 2 Sample Discovery Vial di setiap pesanan.
- **Shop by Olfactory Family (Famille Olfactive)**: Ubin visual interaktif untuk kategori *Woody & Oud*, *Warm Amber & Vanilla*, *Floral & Solar*, serta *Fresh & Aquatic*.
- **Piramida Aroma (Olfactory Pyramid)**: Pembagian visual *Top Notes* (kesan awal), *Heart Notes* (jiwa parfum), dan *Base Notes* (aroma menetap) dilengkapi meteran *Longevity* (ketahanan) & *Sillage* (jejak wangi).
- **Drawer Keranjang Interaktif (Slide-out Mini Bag)**: Tas belanja geser di sisi kanan dengan kalkulasi otomatis subtotal dan status gratis ongkir.

### 2. Sistem Pembayaran Fleksibel (QRIS & Transfer Bank)
- **QRIS Dinamis / Instan**:
  - Tampilan kode QRIS resmi dengan logo ZEEN.
  - Dapat di-scan oleh seluruh e-wallet Indonesia (GoPay, OVO, Dana, ShopeePay, LinkAja) serta Mobile Banking (BCA Mobile, Livin' by Mandiri, BRImo, BNI Mobile).
  - Dilengkapi *countdown timer* 15 menit dan tombol **"Simulasi Bayar Sekarang" (Instant Demo Pay)** untuk verifikasi otomatis status `PAID`.
- **Transfer Bank & Virtual Account**:
  - Mendukung bank utama: **BCA**, **Bank Mandiri**, **BNI**, dan **BRI**.
  - Fitur 1-Click Copy nomor Virtual Account dan nominal tepat.
  - Formulir simulasi upload bukti transfer.
- **Faktur / Invoice Resmi**: Tampilan receipt siap cetak (*Print/Save PDF*) dengan rincian lengkap pesanan.

---

## 🚀 Panduan Menjalankan Secara Lokal (Local Development)

### Prasyarat
- PHP >= 8.2 (dengan extension `pdo_sqlite` untuk lokal, dan `pdo_pgsql` untuk Supabase)
- Composer
- Node.js (opsional, Tailwind CSS dimuat via CDN yang telah dioptimasi)

### Langkah-langkah
1. **Masuk ke folder proyek**:
   ```bash
   cd zeen-parfum
   ```

2. **File Environment (`.env`)**:
   File `.env` sudah dikonfigurasi dengan SQLite secara default agar dapat langsung dijalankan tanpa perlu setup database MySQL/Postgres lokal terlebih dahulu:
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

3. **Migrasi Database & Seeder**:
   Jalankan migrasi untuk mengisi katalog parfum lengkap, piramida aroma, dan ulasan terverifikasi:
   ```bash
   php artisan migrate:fresh --seed
   ```

4. **Jalankan Server Lokal**:
   ```bash
   php artisan serve
   ```
   Buka browser di: **`http://127.0.0.1:8000`**

---

## 🗄️ Menghubungkan ke Database Supabase (PostgreSQL)

Proyek ini telah dikonfigurasi untuk kompatibel 100% dengan **Supabase PostgreSQL**.

1. Buat project baru di [Supabase Dashboard](https://supabase.com).
2. Masuk ke **Project Settings** > **Database**.
3. Di bagian **Connection String**, pilih mode **URI** atau **Transaction Pooler** (port `6543`).
4. Buka file `.env` di proyek Anda, sesuaikan bagian Supabase:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=aws-0-ap-southeast-1.pooler.supabase.com
   DB_PORT=6543
   DB_DATABASE=postgres
   DB_USERNAME=postgres.YOUR_PROJECT_REF
   DB_PASSWORD=YOUR_SUPABASE_DB_PASSWORD
   DB_SSLMODE=require
   ```
5. Jalankan migrasi ke Supabase:
   ```bash
   php artisan migrate --seed
   ```

---

## ☁️ Panduan Deploy ke Vercel & GitHub

Proyek ini sudah dilengkapi konfigurasi serverless khusus Laravel:
- `vercel.json` (routing, caching, environment runtime)
- `api/index.php` (adapter serverless AWS Lambda / Vercel dengan storage `/tmp`)
- `.github/workflows/deploy.yml` (CI/CD GitHub Actions)

### Cara 1: Deploy Langsung via GitHub & Vercel Dashboard (Paling Mudah)
1. **Push ke GitHub**:
   ```bash
   git init
   git add .
   git commit -m "feat: Zeen Parfum initial release"
   git branch -M main
   git remote add origin https://github.com/USERNAME/zeen-parfum.git
   git push -u origin main
   ```
2. Buka [Vercel Dashboard](https://vercel.com) > **Add New Project**.
3. Pilih repository **zeen-parfum** dari akun GitHub Anda.
4. Pada bagian **Environment Variables**, tambahkan:
   - `APP_NAME`: `ZEEN PARFUM`
   - `APP_ENV`: `production`
   - `APP_KEY`: `base64:7K5vP4L9d1M6zQ2b8N0wX4jK1lE9rT3vS8uI2oP6mQ4=`
   - `APP_DEBUG`: `false`
   - `APP_URL`: `https://your-vercel-domain.vercel.app`
   - `DB_CONNECTION`: `pgsql`
   - `DB_HOST`: Host Supabase Anda
   - `DB_PORT`: `6543`
   - `DB_DATABASE`: `postgres`
   - `DB_USERNAME`: Username Supabase Anda
   - `DB_PASSWORD`: Password database Supabase Anda
   - `DB_SSLMODE`: `require`
5. Klik **Deploy**. Website ZEEN PARFUM Anda langsung online dalam hitungan detik!

---

## 📂 Struktur Direktori Proyek

```
zeen-parfum/
├── api/
│   └── index.php                 # Serverless Entrypoint untuk Vercel
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php     # Halaman utama dengan estetika Sephora
│   │   ├── ProductController.php  # Katalog, filter aroma, detail produk
│   │   ├── CartController.php     # Tas belanja & slide drawer
│   │   ├── CheckoutController.php # Formulir checkout resmi
│   │   └── PaymentController.php  # Pembayaran QRIS & Transfer Bank
│   └── Models/                   # Category, Product, Order, OrderItem, Review
├── config/
│   └── database.php              # Konfigurasi PostgreSQL Supabase & SQLite
├── database/
│   ├── migrations/               # Skema tabel database
│   └── seeders/                  # Seeder katalog parfum, piramida wangi & review
├── resources/views/
│   ├── layouts/app.blade.php     # Master layout Sephora monokrom
│   └── pages/
│       ├── home.blade.php        # Editorial Hero, Olfactory Family, Bestsellers
│       ├── cart.blade.php        # Rincian tas belanja & free shipping meter
│       ├── checkout.blade.php    # Checkout & opsi metode bayar
│       ├── payment.blade.php     # Layar QRIS & Virtual Account Bank
│       ├── invoice.blade.php     # Faktur pesanan siap cetak PDF
│       ├── atelier.blade.php     # Filosofi racikan 35% Extrait de Parfum
│       └── contact.blade.php     # Konsultasi WhatsApp & butik fisik
├── vercel.json                   # Konfigurasi deployment Vercel
└── README.md
```

---

## 📞 Dukungan
Dikembangkan dengan standar kualitas wewangian tinggi untuk **ZEEN PARFUM INDONESIA**.

