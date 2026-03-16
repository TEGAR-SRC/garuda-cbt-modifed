<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

// Mendapatkan konfigurasi dari Environment Variable (Dokploy) atau Hardcoded Fallback
$db_host = getenv('DB_HOSTNAME') ?: 'db'; // Tuju ke service 'db' di network docker
$db_user = getenv('DB_USERNAME') ?: 'garuda_user';
$db_pass = getenv('DB_PASSWORD') ?: 'garuda_password';
$db_name = getenv('DB_DATABASE') ?: 'garuda_db';

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
