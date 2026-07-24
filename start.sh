#!/bin/bash

# Railway dynamic port configuration
PORT=${PORT:-80}
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/*.conf

# Optimize configuration loading
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations automatically during startup
php artisan migrate --force

# Menjalankan worker antrian (queue) di background agar tidak memblokir Apache
php artisan queue:work --daemon &

# Menjalankan Apache di foreground (sebagai proses utama kontainer)
apache2-foreground
