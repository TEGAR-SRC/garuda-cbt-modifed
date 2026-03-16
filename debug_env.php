<?php
echo "<h3>Environment Debug</h3>";
echo "DB_HOSTNAME (getenv): " . getenv('DB_HOSTNAME') . "<br>";
echo "DB_HOSTNAME (ENV): " . ($_ENV['DB_HOSTNAME'] ?? 'not set') . "<br>";
echo "DB_HOSTNAME (SERVER): " . ($_SERVER['DB_HOSTNAME'] ?? 'not set') . "<br>";

echo "<h3>All Server Vars</h3>";
echo "<pre>";
print_r($_SERVER);
echo "</pre>";

echo "<h3>All Env Vars</h3>";
echo "<pre>";
print_r($_ENV);
echo "</pre>";

echo "<h3>PHP Info</h3>";
phpinfo();
