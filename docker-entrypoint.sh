#!/bin/bash
set -e

echo "Starting Garuda CBT Docker Entrypoint..."

# Path to files
DB_CONFIG="/var/www/html/application/config/database.php"

# 1. Fallback defaults if env vars are empty
# Siapa tahu sanak lupa isi di Dokploy, kita kasih default dari compose
DB_HOSTNAME=${DB_HOSTNAME:-"garuda-db"}
DB_USERNAME=${DB_USERNAME:-"garuda_user"}
DB_PASSWORD=${DB_PASSWORD:-"garuda_password"}
DB_DATABASE=${DB_DATABASE:-"garuda_db"}

echo "Using Database Host: $DB_HOSTNAME"

# 2. Hard-replace placeholders in database.php
# Kita ganti paksa tulisan %HOSTNAME% di file jadi isi variabelnya
sed -i "s/%HOSTNAME%/$DB_HOSTNAME/g" $DB_CONFIG
sed -i "s/%USERNAME%/$DB_USERNAME/g" $DB_CONFIG
sed -i "s/%PASSWORD%/$DB_PASSWORD/g" $DB_CONFIG
sed -i "s/%DATABASE%/$DB_DATABASE/g" $DB_CONFIG

# 3. Create Session directory if not exists
mkdir -p /var/www/html/application/cache/sessions
chmod -R 777 /var/www/html/application/cache/sessions

# 4. Fix Permissions
echo "Setting permissions..."
chown -R www-data:www-data /var/www/html
chmod -R 777 /var/www/html/application/config
chmod -R 777 /var/www/html/application/logs
chmod -R 777 /var/www/html/uploads
chmod -R 777 /var/www/html/backups

echo "Preparation complete. Launching Apache..."
exec apache2-foreground
