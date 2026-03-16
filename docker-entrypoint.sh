#!/bin/bash
set -e

echo "Starting Garuda CBT Docker Entrypoint..."

# Path to files
DB_CONFIG="/var/www/html/application/config/database.php"

# 1. Fallback defaults if env vars are empty
# Siapa tahu sanak lupa isi di Dokploy, kita kasih default dari compose
# 1. Fallback defaults if env vars are empty
# Default to 'garuda-db' which matches the container_name in docker-compose.yml
DB_HOSTNAME=${DB_HOSTNAME:-"garuda-db"}
DB_USERNAME=${DB_USERNAME:-"garuda_user"}
DB_PASSWORD=${DB_PASSWORD:-"garuda_password"}
DB_DATABASE=${DB_DATABASE:-"garuda_db"}

echo "Using Database Host: $DB_HOSTNAME"
echo "Using Database Name: $DB_DATABASE"

# Connectivity check (Optional but helpful for logs)
if command -v getent > /dev/null; then
    if getent hosts $DB_HOSTNAME > /dev/null; then
        echo "✅ Database host '$DB_HOSTNAME' resolved successfully."
    else
        echo "❌ Database host '$DB_HOSTNAME' could not be resolved. Check your Docker network."
    fi
fi
# 2. Hard-replace placeholders in database.php
# Use a temporary file to avoid issues if sed fails
sed -e "s/%HOSTNAME%/$DB_HOSTNAME/g" \
    -e "s/%USERNAME%/$DB_USERNAME/g" \
    -e "s/%PASSWORD%/$DB_PASSWORD/g" \
    -e "s/%DATABASE%/$DB_DATABASE/g" \
    $DB_CONFIG > "$DB_CONFIG.tmp" && mv "$DB_CONFIG.tmp" "$DB_CONFIG"

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
