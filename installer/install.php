<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$db_config_path = '../application/config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST) {

    require_once('includes/taskCoreClass.php');
    require_once('includes/databaseLibrary.php');

    $core = new Core();
    $database = new Database();

    $message = '';
    if ($core->checkEmpty($_POST) == true) {
        $res_db = $database->create_database($_POST);
        $res_table = ($res_db === true) ? $database->create_tables($_POST) : $res_db;

        if ($res_db !== true) {
            $message = $core->show_message('error', "ERROR#001<br>" . $res_db);
        } else if ($res_table !== true) {
            $message = $core->show_message('error', "ERROR#002<br>" . $res_table);
        } else if ($core->checkFile() == false) {
            $message = $core->show_message('error', "ERROR#003<br>File application/config/database.php tidak ditemukan");
        } else if ($core->write_db_config($_POST) == false) {
            $message = $core->show_message('error', "ERROR#004<br>Tidak bisa menulis konfigurasi database. Silakan ganti permission chmod application/config/database.php menjadi 777");
        }
    } else {
        $message = $core->show_message('error',
            "ERROR#005<br>Gagal membuat database, pastikan semua parameter diisi dengan benar.");
    }

    echo $message;
}
