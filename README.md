# KPM Group — Company Profile Website
### PT. Kurniawan Power Mandiri

> Laravel 11 · Blade · Vite · Tailwind CSS · Filament Admin

---

## Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel 11 (PHP 8.2+) |
| Frontend | Blade + Tailwind CSS v3 + Alpine.js |
| Build Tool | Vite |
| Admin Panel | Filament v3 |
| Animation | AOS.js (scroll) |
| Database | MySQL / SQLite |

---

## Struktur Halaman

| Halaman | URL | Deskripsi |
|---------|-----|-----------|
| Home | `/` | Hero, Stats, Company Intro, Services, CTA |
| About | `/about` | Profil, Visi-Misi, Timeline, Dokumen Resmi |
| Services | `/services` | 5 divisi dengan accordion detail |
| Contact | `/contact` | Semua channel kontak + Google Maps |
| Admin | `/admin` | Filament CMS (login required) |

---

## Instalasi

### 1. Clone & Setup Project

```bash
# Jika menggunakan template ini
cp -r kpm-group/ /var/www/html/kpm-group
cd kpm-group

# Atau buat project Laravel baru dulu
composer create-project laravel/laravel kpm-group
cd kpm-group
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Filament

```bash
composer require filament/filament:"^3.2" -W
php artisan filament:install --panels
```

### 4. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:
```dotenv
DB_DATABASE=kpm_group
DB_USERNAME=root
DB_PASSWORD=your_password

KPM_WHATSAPP=6281234567890
KPM_EMAIL=info@kpmgroup.co.id
KPM_INSTAGRAM_URL=https://instagram.com/kpmgroup
KPM_TIKTOK_URL=https://tiktok.com/@kpmgroup
KPM_MAPS_EMBED_URL=https://maps.google.com/...
```

### 5. Database Setup

```bash
php artisan migrate
php artisan db:seed
```

### 6. Install Node & Build Assets

```bash
npm install
npm run build
# atau untuk development:
npm run dev
```

### 7. Storage Link

```bash
php artisan storage:link
```

### 8. Buat Admin User

```bash
php artisan make:filament-user
```

Atau via tinker:
```bash
php artisan tinker
\App\Models\User::create([
    'name'     => 'Admin KPM',
    'email'    => 'admin@kpmgroup.co.id',
    'password' => bcrypt('password'),
]);
```

### 9. Jalankan Server

```bash
php artisan serve
# Buka: http://localhost:8000
# Admin: http://localhost:8000/admin
```

---

## Upload Gambar & Aset

Letakkan file berikut di `public/images/`:

| File | Keterangan |
|------|------------|
| `kpm-logo.png` | Logo KPM (berwarna, untuk navbar solid) |
| `kpm-logo-white.png` | Logo KPM (putih, untuk footer) |
| `hero-bg.jpg` | Background hero section (1920×1080) |
| `about-visual.jpg` | Foto visual section About (800×600) |
| `thumb-construction.jpg` | Thumbnail divisi Construction (400×400) |
| `thumb-engineering.jpg` | Thumbnail divisi Engineering (400×400) |
| `thumb-rd.jpg` | Thumbnail divisi R&D (400×400) |
| `thumb-farm.jpg` | Thumbnail divisi Farm (400×400) |

---

## Konfigurasi Kontak (config/kpm.php)

Semua info kontak ada di `config/kpm.php` dan bisa di-override via `.env`:

```php
KPM_WHATSAPP=6281234567890       // Format: 62 + nomor (tanpa +)
KPM_WHATSAPP_DISPLAY=812-XXXX-XXXX
KPM_EMAIL=info@kpmgroup.co.id
KPM_ADDRESS=Jl. ..., Lampung
KPM_INSTAGRAM_URL=https://instagram.com/username
KPM_INSTAGRAM_HANDLE=username
KPM_TIKTOK_URL=https://tiktok.com/@username
KPM_MAPS_EMBED_URL=https://google.com/maps/embed?pb=...
```

### Cara Mendapatkan Google Maps Embed URL:
1. Buka Google Maps → cari lokasi kantor
2. Klik "Share" → "Embed a map"
3. Copy URL dari `src="..."` dalam kode embed
4. Tempel di `.env` sebagai `KPM_MAPS_EMBED_URL`

---

## Admin Panel (Filament)

Akses: `http://yourdomain.com/admin`

### Fitur Admin:
- **Layanan & Divisi** — tambah/edit/hapus layanan, atur urutan
- **Dokumen Resmi** — upload Akta Notaris, SBU, NPWP, NIB, dll.
- **Dashboard** — quick stats & link cepat ke halaman website

### Upload Dokumen:
1. Login admin → klik "Dokumen Resmi" → "Tambah Dokumen"
2. Isi nama & kategori (Akta Notaris / SBU / dll.)
3. Upload file (PDF atau gambar JPG/PNG, maks 10MB)
4. Aktifkan toggle "Tampilkan di Website"
5. Simpan → dokumen otomatis muncul di halaman About

---

## Struktur Folder

```
kpm-group/
├── app/
│   ├── Filament/
│   │   ├── Resources/
│   │   │   ├── DocumentResource.php
│   │   │   └── ServiceResource.php
│   │   └── Widgets/
│   │       ├── KpmStatsWidget.php
│   │       └── QuickLinksWidget.php
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   ├── AboutController.php
│   │   ├── ServicesController.php
│   │   └── ContactController.php
│   ├── Models/
│   │   ├── Document.php
│   │   └── Service.php
│   └── Providers/Filament/
│       └── AdminPanelProvider.php
│
├── config/
│   └── kpm.php                  ← semua config kontak & sosmed
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   ├── css/
│   │   ├── app.css              ← entry point, mengimport semua
│   │   ├── components/          ← _buttons, _cards, _navbar, dll.
│   │   ├── pages/               ← _home, _about, _services, _contact
│   │   └── utilities/           ← _typography, _animations, _spacing
│   │
│   ├── js/
│   │   └── app.js               ← Alpine.js init
│   │
│   └── views/
│       ├── layouts/app.blade.php
│       ├── components/
│       │   ├── navbar.blade.php
│       │   ├── footer.blade.php
│       │   ├── hero.blade.php
│       │   ├── service-card.blade.php
│       │   ├── cta-section.blade.php
│       │   ├── whatsapp-float.blade.php
│       │   └── seo-meta.blade.php
│       ├── pages/
│       │   ├── home.blade.php
│       │   ├── about.blade.php
│       │   ├── services.blade.php
│       │   └── contact.blade.php
│       └── partials/
│           ├── home/
│           ├── about/
│           └── services/
│
├── routes/web.php
├── .env.example
├── tailwind.config.js
├── vite.config.js
└── composer.json
```

---

## Design System

### Warna

| Variabel | HEX | Penggunaan |
|----------|-----|------------|
| `gold` (DEFAULT) | `#C88719` | Aksen utama, CTA, highlight |
| `gold-600` | `#a96d12` | Hover state tombol |
| `charcoal` | `#1C1C1E` | Background dark, teks heading |
| `charcoal-500` | `#71717a` | Teks body, deskripsi |

### Typography

| Font | Weight | Digunakan pada |
|------|--------|----------------|
| Cormorant Garamond | 400–700 | Semua heading (h1–h3) |
| DM Sans | 300–700 | Body, UI labels, navigasi |
| JetBrains Mono | 400–500 | Label mono, metadata, tahun |

### Utility Classes

```css
.section-pad          /* py-24 md:py-32 */
.container-kpm        /* max-w-7xl mx-auto px-5 sm:px-8 */
.heading-section      /* font-display bold responsive */
.label-mono           /* font-mono gold uppercase tracking */
.btn-primary          /* tombol gold */
.btn-outline          /* tombol border putih */
.btn-whatsapp         /* tombol WhatsApp hijau */
.service-card         /* card layanan dengan hover effects */
.contact-card         /* card kontak */
.doc-card             /* card dokumen */
```

---

## Deployment (Production)

```bash
# Optimize semua
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Build assets production
npm run build

# Permissions
chmod -R 755 storage bootstrap/cache
```

### Nginx Config (contoh):
```nginx
server {
    listen 80;
    server_name kpmgroup.co.id www.kpmgroup.co.id;
    root /var/www/kpm-group/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

---

## Checklist Before Go-Live

- [ ] Ganti logo di `public/images/kpm-logo.png`
- [ ] Update nomor WhatsApp di `.env` → `KPM_WHATSAPP`
- [ ] Update semua URL sosmed di `.env`
- [ ] Embed Google Maps URL kantor di `.env`
- [ ] Upload foto hero, about, thumbnail divisi
- [ ] Upload Akta Notaris & SBU via admin panel
- [ ] Buat akun admin production
- [ ] Set `APP_ENV=production` & `APP_DEBUG=false`
- [ ] Jalankan `php artisan optimize`
- [ ] Setup SSL (Let's Encrypt)

---

*KPM Group Company Profile — Laravel 11*
*Built with ❤ for PT. Kurniawan Power Mandiri*
