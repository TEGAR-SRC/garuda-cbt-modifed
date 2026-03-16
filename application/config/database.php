<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

// HARDCODE DATABASE LANGSUNG KE IP DOKPLOY
// Karena sanak pakai mode "Application", host 'db' tidak akan dikenal.
// Sanak WAJIB membuat database MySQL di tab "Databases" Dokploy,
// lalu ganti 'localhost' di bawah dengan "Internal Host" dari Dokploy.

$db['default'] = array(
    'dsn'	=> '',
    'hostname' => 'localhost', // GANTI INI DENGAN INTERNAL HOST DARI DOKPLOY
    'username' => 'root',      // GANTI DENGAN USER DB DOKPLOY
    'password' => '',          // GANTI DENGAN PASS DB DOKPLOY
    'database' => 'garuda_db', // GANTI DENGAN NAMA DB DOKPLOY
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
