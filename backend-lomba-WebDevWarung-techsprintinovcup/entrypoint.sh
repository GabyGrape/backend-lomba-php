#!/bin/sh

# Buat file database jika belum ada di persistent disk
if [ ! -f /var/www/database/persistence/database.sqlite ]; then
    touch /var/www/database/persistence/database.sqlite
fi

# Jalankan migrasi
php artisan migrate --force

# Jalankan server
# php artisan serve --host=0.0.0.0 --port=$PORT
php artisan serve --host=0.0.0.0 --port=${PORT:-10000}