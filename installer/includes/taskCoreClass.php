<?php

class Core {
    function checkEmpty($data) {
        if (!empty($data['hostname']) && !empty($data['username']) && !empty($data['database'])) {
            return true;
        } else {
            return false;
        }
    }

    function show_message($type, $message) {
        return $message;
    }

    function getAllData($data) {
        return $data;
    }

    function write_db_config($data) {
        $template_path = '../assets/app/db/database.php';
        $output_path = '../application/config/database.php';

        $database_file = @file_get_contents($template_path);
        if (!$database_file) return false;

        $new = str_replace("%HOSTNAME%", $data['hostname'], $database_file);
        $new = str_replace("%USERNAME%", $data['username'], $new);
        $new = str_replace("%PASSWORD%", $data['password'], $new);
        $new = str_replace("%DATABASE%", $data['database'], $new);

        if (file_exists($output_path)) {
            $existing_content = @file_get_contents($output_path);
            // Jika isinya sudah benar (sama dengan yang mau ditulis), tidak perlu tulis ulang
            if ($existing_content === $new) {
                return true;
            }
            @unlink($output_path);
        }

        if (@file_put_contents($output_path, $new)) {
            @chmod($output_path, 0777);
            return true;
        }
        
        // Backup method: shell echo
        $new_escaped = escapeshellarg($new);
        @shell_exec("echo $new_escaped > " . realpath($output_path));
        
        $check = @file_get_contents($output_path);
        if ($check && (strpos($check, $data['database']) !== false || $check === $new)) {
            @chmod($output_path, 0777);
            return true;
        }
        return false;
    }

    function checkFile() {
        $output_path = '../application/config/database.php';

        if (file_exists($output_path)) {
            return true;
        } else {
            return false;
        }
    }
}
