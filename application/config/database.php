<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'	=> '',
    'hostname' => getenv('DB_HOSTNAME') ?: getenv('DB_HOST') ?: getenv('MYSQL_HOST') ?: '%HOSTNAME%',
    'username' => getenv('DB_USERNAME') ?: getenv('DB_USER') ?: getenv('MYSQL_USER') ?: '%USERNAME%',
    'password' => getenv('DB_PASSWORD') ?: getenv('DB_PASS') ?: getenv('MYSQL_PASSWORD') ?: '%PASSWORD%',
    'database' => getenv('DB_DATABASE') ?: getenv('DB_NAME') ?: getenv('MYSQL_DATABASE') ?: '%DATABASE%',
    'port'     => getenv('DB_PORT') ?: getenv('MYSQL_PORT') ?: 3306,
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
