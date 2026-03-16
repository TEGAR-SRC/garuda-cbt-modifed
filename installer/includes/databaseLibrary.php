<?php

class Database {

    function create_database($data) {
        mysqli_report(MYSQLI_REPORT_OFF);
        $mysqli = @new mysqli($data['hostname'], $data['username'], $data['password'], '');
        if ($mysqli->connect_errno) {
            return "Koneksi Gagal: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        if (!$mysqli->query("CREATE DATABASE IF NOT EXISTS `" . $data['database'] . "`")) {
            $error = $mysqli->error;
            $mysqli->close();
            return "Gagal membuat database: " . $error;
        }
        
        while ($mysqli->next_result());
        $mysqli->close();
        return true;
    }

    function create_tables($data) {
        mysqli_report(MYSQLI_REPORT_OFF);
        $mysqli = @new mysqli($data['hostname'], $data['username'], $data['password'], $data['database']);
        if ($mysqli->connect_errno) {
            return "Koneksi Database Gagal: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        $query = $mysqli->query("SHOW TABLES LIKE 'users'");
        if ($query && $query->num_rows <= 0) {
            $sql = file_get_contents('../assets/app/db/master.sql');
            if (!$sql) {
                return "File master.sql tidak ditemukan atau kosong.";
            }

            if ($mysqli->multi_query($sql)) {
                do {
                    if ($result = $mysqli->store_result()) {
                        $result->free();
                    }
                } while ($mysqli->more_results() && $mysqli->next_result());
            }

            if ($mysqli->error) {
                $error = $mysqli->error;
                $mysqli->close();
                return "Gagal mengeksekusi query: " . $error;
            }
            $mysqli->close();
        }
        return true;
    }
}
