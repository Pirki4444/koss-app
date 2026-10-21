# Sistem Informasi Kos-Kosan

Aplikasi web Sistem Informasi Kos-Kosan menggunakan framework Laravel (PHP) dengan database MySQL. Aplikasi ini dibuat untuk memenuhi tugas deployment Cloud Computing.

## 🚀 Fitur Utama

1. **Katalog Kamar** - Menampilkan informasi lengkap kamar (nomor, tipe, fasilitas, harga)
2. **Status Ketersediaan** - Menampilkan status kamar (Tersedia/Disewa)
3. **Pemesanan Sederhana** - Form pemesanan kamar dengan validasi lengkap

## 📋 Persyaratan Sistem

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js & NPM (opsional, untuk asset compilation)

## 🛠️ Instalasi

### 1. Clone atau Download Project

```bash
cd d:\KOS
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kos_kosan
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Buat Database

Buat database MySQL dengan nama `kos_kosan`:

```sql
CREATE DATABASE kos_kosan;
```

### 6. Jalankan Migration

```bash
php artisan migrate
```

### 7. Seed Data (Opsional)

Untuk mengisi data contoh:

```bash
php artisan db:seed
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## 🐳 Deployment dengan Docker

### Dockerfile

Buat file `Dockerfile` di root project:

```dockerfile
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory
COPY . /var/www

# Install dependencies
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

EXPOSE 9000
CMD ["php-fpm"]
```

### docker-compose.yml

```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: kos-app
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - ./:/var/www
    networks:
      - kos-network

  web:
    image: nginx:alpine
    container_name: kos-web
    restart: unless-stopped
    ports:
      - "8080:80"
    volumes:
      - ./:/var/www
      - ./docker/nginx:/etc/nginx/conf.d
    networks:
      - kos-network
    depends_on:
      - app

  db:
    image: mysql:8.0
    container_name: kos-db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: kos_kosan
      MYSQL_ROOT_PASSWORD: secret
      MYSQL_PASSWORD: secret
      MYSQL_USER: kos_user
    volumes:
      - dbdata:/var/lib/mysql
    ports:
      - "3307:3306"
    networks:
      - kos-network

networks:
  kos-network:
    driver: bridge

volumes:
  dbdata:
    driver: local
```

### Jalankan dengan Docker

```bash
docker-compose up -d
docker-compose exec app php artisan migrate --seed
```

## 📁 Struktur Database

### Tabel `rooms`
- `id` - Primary Key
- `room_number` - Nomor kamar (unique)
- `type` - Tipe kamar (Single, Double, Suite)
- `facilities` - Fasilitas kamar
- `price` - Harga sewa per bulan
- `status` - Status (Tersedia, Disewa)
- `description` - Deskripsi kamar

### Tabel `bookings`
- `id` - Primary Key
- `room_id` - Foreign Key ke tabel rooms
- `name` - Nama pemesan
- `contact` - Nomor kontak
- `duration_months` - Durasi sewa (bulan)
- `move_in_date` - Tanggal masuk
- `status` - Status pemesanan (Pending, Confirmed, Cancelled)
- `notes` - Catatan tambahan

## 🌐 Routes

- `GET /` - Halaman utama (daftar kamar)
- `GET /rooms` - Daftar semua kamar
- `GET /rooms/available` - Daftar kamar tersedia
- `GET /rooms/{room}` - Detail kamar
- `GET /bookings/create/{room}` - Form pemesanan kamar
- `POST /bookings` - Submit pemesanan
- `GET /bookings/success/{booking}` - Halaman sukses pemesanan
- `GET /bookings` - Daftar semua pemesanan (admin)

## 🎨 Teknologi yang Digunakan

- **Backend**: Laravel 10.x (PHP)
- **Database**: MySQL
- **Frontend**: Blade Templates dengan CSS inline
- **ORM**: Eloquent

## 📝 Catatan Pengembangan

- Kode telah dirancang dengan clean architecture
- Siap untuk di-kontainerisasi dengan Docker
- Validasi form di sisi server
- Menggunakan database transaction untuk data consistency
- Responsive design dengan CSS inline

## 👨‍💻 Developer

Dibuat untuk tugas Cloud Computing - Deployment Application

## 📄 License

Open-source untuk keperluan pendidikan
