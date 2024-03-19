
# Admin Barcode 

## Cara Menjalankan Aplikasi

Aplikasi ini menggunakan Laravel 7.4 dan Composer.

- Masuk ke dalam folder project melalui cmd lalu ketik:
```bash
  composer install
```
- Cek apakah ada file .env di dalam folder project. Jika tidak ada, copy file .env.example lalu paste menjadi file .env baru.

- Jika file .env baru dibuat, jalankan perintah:
```bash
  php artisan key:generate
```

- Buat database MySQL baru dengan nama 'qr' (Jika ingin membuat dengan nama baru sesuaikan dengan value DB_DATABASE di file .env)

- Jalankan migrasi data dengan perintah:
```bash
  php artisan migrate:fresh --seed
```

- Jalankan perintah npm untuk build UI:
```bash
  npm install
  npm run dev
```

- Jalankan project dengan perintah:
```bash
  php artisan serve
```

## FAQ

#### Barcode tidak muncul:

Jika barcode tidak muncul, enable gd extension di file php.ini (https://www.geeksforgeeks.org/how-to-install-php-gd-in-windows/)

#### Error saat menjalankan composer install:

Coba jalankan perintah ini:
```bash
  composer install --ignore-platform-req=ext-gd --ignore-platform-req=ext-zip
```


