#!/bin/bash
set -e

# Path to database config
DB_CONFIG="/var/www/html/application/config/database.php"

echo "Running entrypoint script..."

# Replace placeholders with environment variables if they are set
if [ ! -z "$DB_HOSTNAME" ]; then
    echo "Updating DB_HOSTNAME to $DB_HOSTNAME"
    sed -i "s/%HOSTNAME%/$DB_HOSTNAME/g" $DB_CONFIG
fi

if [ ! -z "$DB_USERNAME" ]; then
    echo "Updating DB_USERNAME"
    sed -i "s/%USERNAME%/$DB_USERNAME/g" $DB_CONFIG
fi

if [ ! -z "$DB_PASSWORD" ]; then
    echo "Updating DB_PASSWORD"
    sed -i "s/%PASSWORD%/$DB_PASSWORD/g" $DB_CONFIG
fi

if [ ! -z "$DB_DATABASE" ]; then
    echo "Updating DB_DATABASE to $DB_DATABASE"
    sed -i "s/%DATABASE%/$DB_DATABASE/g" $DB_CONFIG
fi

# Ensure permissions
chown -R www-data:www-data /var/www/html
chmod -R 777 /var/www/html/application/config
chmod -R 777 /var/www/html/application/logs
chmod -R 777 /var/www/html/uploads
chmod -R 777 /var/www/html/backups

echo "Starting Apache..."
exec apache2-foreground
