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

        // Try to make file/dir writable using multiple methods
        if (file_exists($output_path)) {
            @chmod($output_path, 0777);
            @shell_exec("chmod 777 " . realpath($output_path));
        } else {
            @chmod(dirname($output_path), 0777);
            @shell_exec("chmod 777 " . realpath(dirname($output_path)));
        }

        if (@file_put_contents($output_path, $new)) {
            @chmod($output_path, 0777);
            return true;
        } else {
            // Last ditch effort: try to write via shell if allowed
            $new_escaped = escapeshellarg($new);
            @shell_exec("echo $new_escaped > " . realpath($output_path));
            if (file_exists($output_path) && filesize($output_path) > 0) {
                return true;
            }
            return false;
        }
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
