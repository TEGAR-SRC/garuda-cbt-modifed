#!/bin/bash
set -e

echo "Starting Garuda CBT Docker Entrypoint..."

# Path to files
DB_CONFIG="/var/www/html/application/config/database.php"
APACHE_ENV="/etc/apache2/envvars"

# 1. Inject to Apache envvars (The only way to be 100% sure PHP getenv() works)
echo "Injecting Environment Variables to Apache..."
[ ! -z "$DB_HOSTNAME" ] && echo "export DB_HOSTNAME=$DB_HOSTNAME" >> $APACHE_ENV
[ ! -z "$DB_USERNAME" ] && echo "export DB_USERNAME=$DB_USERNAME" >> $APACHE_ENV
[ ! -z "$DB_PASSWORD" ] && echo "export DB_PASSWORD=$DB_PASSWORD" >> $APACHE_ENV
[ ! -z "$DB_DATABASE" ] && echo "export DB_DATABASE=$DB_DATABASE" >> $APACHE_ENV

# 2. Hard-replace placeholders in database.php as safety backup
echo "Checking placeholders in $DB_CONFIG..."
if [ ! -z "$DB_HOSTNAME" ]; then
    sed -i "s/%HOSTNAME%/$DB_HOSTNAME/g" $DB_CONFIG
fi
if [ ! -z "$DB_USERNAME" ]; then
    sed -i "s/%USERNAME%/$DB_USERNAME/g" $DB_CONFIG
fi
if [ ! -z "$DB_PASSWORD" ]; then
    sed -i "s/%PASSWORD%/$DB_PASSWORD/g" $DB_CONFIG
fi
if [ ! -z "$DB_DATABASE" ]; then
    sed -i "s/%DATABASE%/$DB_DATABASE/g" $DB_CONFIG
fi

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
