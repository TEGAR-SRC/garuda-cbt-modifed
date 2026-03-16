<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

// Helper function to get DB settings from ANY source
function get_db_setting($env_key, $placeholder) {
    $val = getenv($env_key);
    if (!$val) $val = $_ENV[$env_key] ?? null;
    if (!$val) $val = $_SERVER[$env_key] ?? null;
    
    // If still empty or placeholder, try to return null so we can check it
    if (!$val || $val === $placeholder) return null;
    return $val;
}

$db_host = get_db_setting('DB_HOSTNAME', '%HOSTNAME%') ?: '%HOSTNAME%';
$db_user = get_db_setting('DB_USERNAME', '%USERNAME%') ?: '%USERNAME%';
$db_pass = get_db_setting('DB_PASSWORD', '%PASSWORD%') ?: '%PASSWORD%';
$db_name = get_db_setting('DB_DATABASE', '%DATABASE%') ?: '%DATABASE%';

$db['default'] = array(
    'dsn'	=> '',
    'hostname' => $db_host,
    'username' => $db_user,
    'password' => $db_pass,
    'database' => $db_name,
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
