<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

// Redundant detection for safety
function get_db_safe($env_key, $constant_name, $placeholder) {
    if (defined($constant_name)) return constant($constant_name);
    $val = getenv($env_key);
    if (!$val) $val = $_ENV[$env_key] ?? null;
    if (!$val) $val = $_SERVER[$env_key] ?? null;
    return ($val && $val !== $placeholder) ? $val : $placeholder;
}

$db['default'] = array(
    'dsn'	=> '',
    'hostname' => get_db_safe('DB_HOSTNAME', 'TEMP_DB_HOST', '%HOSTNAME%'),
    'username' => get_db_safe('DB_USERNAME', 'TEMP_DB_USER', '%USERNAME%'),
    'password' => get_db_safe('DB_PASSWORD', 'TEMP_DB_PASS', '%PASSWORD%'),
    'database' => get_db_safe('DB_DATABASE', 'TEMP_DB_NAME', '%DATABASE%'),
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
