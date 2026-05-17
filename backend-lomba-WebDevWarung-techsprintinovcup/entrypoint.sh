# #!/bin/sh

# # Buat file database jika belum ada di persistent disk
# if [ ! -f /var/www/database/persistence/database.sqlite ]; then
#     touch /var/www/database/persistence/database.sqlite
# fi

# # Jalankan migrasi
# php artisan migrate --force

# # Jalankan server
# # php artisan serve --host=0.0.0.0 --port=$PORT
# php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
#!/bin/sh

# Pastikan folder database ada (penting untuk SQLite)
mkdir -p /var/www/database/persistence
touch /var/www/database/persistence/database.sqlite

# 2. Hapus Cache Konfigurasi & Route (Sangat Penting!)
# Ini agar Laravel membaca ulang Model User yang sudah pakai users_
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# # Jalankan migrasi secara otomatis
# php artisan migrate --force

# 3. Create Storage Link (TAMBAHKAN DI SINI)
# Menggunakan --force untuk memastikan link dibuat ulang jika sudah ada link yang broken
php artisan storage:link --force

# # 2. Jalankan Seeder
# # Gunakan --force karena ini lingkungan production
# php artisan db:seed --force


# Jalankan migrasi ulang secara total (Fresh)
# Ini akan menghapus semua tabel dan membuat ulang sesuai kode terbaru (users_)
php artisan migrate:fresh --force --seed


# Jalankan server menggunakan port yang diberikan Render (default 10000)
php artisan serve --host=0.0.0.0 --port=10000