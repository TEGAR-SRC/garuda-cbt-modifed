<?php
$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") || (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && $_SERVER["HTTP_X_FORWARDED_PROTO"] == "https") ? "https" : "http");
$base_url .= "://" . $_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$base_url = str_replace('installer/', '', $base_url);

// Check existing config
$db_file = '../application/config/database.php';
$is_configured = false;
$existing_db = '';
$db = ['default' => []];

if (file_exists($db_file)) {
    $content = file_get_contents($db_file);
    $fields = ['hostname', 'username', 'password', 'database'];
    foreach ($fields as $field) {
        if (preg_match("/'$field'\s*=>\s*'([^']*)'/", $content, $matches)) {
            $db['default'][$field] = $matches[1];
        } else {
            $db['default'][$field] = '';
        }
    }
    
    if (!empty($db['default']['database'])) {
        $is_configured = true;
        $existing_db = $db['default']['database'];
    }
}

$is_writable = is_writable($db_file) || is_writable(dirname($db_file));
$permission_info = substr(sprintf('%o', fileperms($db_file)), -3);
?>

<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Garuda CBT Installer</title>

    <link rel="shortcut icon" href="<?= $base_url ?>assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= $base_url ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>assets/adminlte/dist/css/adminlte.min.css">

    <script src="<?= $base_url ?>assets/plugins/jquery/jquery.min.js"></script>

    <style>
        .gradient {
            background: linear-gradient(90deg, #6A21EA 0%, #F524EF 100%);
        }
    </style>
<body id="page-top">
<section class="d-flex align-items-center gradient">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 aos-init aos-animate" data-aos="fade-up">
                <div class="text-center text-md-left">
                    <div class="mb-3 text-white">
                        <img style="width:100px; height:auto;" src="<?= $base_url ?>assets/img/garuda_white.svg"><span class="h1 align-bottom">aruda</span>
                        <span class="h1 align-bottom"> CBT</span>
                    </div>
                    <div class="h2 text-white">
                        <b>G</b>abungan <b>A</b>plikasi <b>R</b>apor,<br><b>U</b>jian dan e-learning
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch hero-img aos-init aos-animate pt-5" data-aos="fade-up">
                <div class="card" style="background-color: rgba(255,255,255,.7);">
                    <div class="card-body">
                        <?php if ($is_configured) : ?>
                            <div class="alert alert-success">
                                <h5><i class="icon fas fa-check"></i> Database Terdeteksi!</h5>
                                Konfigurasi database untuk <b><?= $existing_db ?></b> sudah tersedia. Sanak bisa mencoba langsung masuk ke aplikasi jika instalasi database sudah selesai sebelumnya.
                                <div class="mt-3">
                                    <a href="<?= $base_url ?>" class="btn btn-success btn-block btn-lg"><b>MASUK KE APLIKASI (SKIP)</b></a>
                                </div>
                                <hr>
                                <p class="text-sm">Atau sanak bisa isi ulang form di bawah jika ingin mengganti database atau memperbaiki tabel yang rusak.</p>
                                <div class="text-right">
                                    <small class="text-muted">Modified by Tegar</small>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!$is_writable) : ?>
                            <div class="alert alert-danger">
                                <h5><i class="icon fas fa-exclamation-triangle"></i> Masalah Izin File!</h5>
                                <p>File <code>application/config/database.php</code> tidak dapat ditulis (Izin saat ini: <b><?= $permission_info ?></b>).</p>
                                <p class="text-sm">Silakan jalankan perintah ini di terminal server sanak agar otomatis berhasil:</p>
                                <code class="p-2 d-block bg-dark text-white rounded mb-2">chmod -R 777 application/config application/logs uploads backups</code>
                                <p class="text-xs mb-0">Atau minta bantuan saya untuk memperbaikinya lewat skrip otomatis.</p>
                            </div>
                        <?php endif; ?>
                        <form action="#" id="create" method="post" accept-charset="utf-8">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="input-nama-db">Host Name</label>
                                    <input type="text" class="form-control db" id="input-nama-host" name="hostname" value="<?= isset($db['default']['hostname']) ? $db['default']['hostname'] : '' ?>" placeholder="localhost" required="">
                                </div>
                                <div class="form-group col-12" required="">
                                    <label for="input-nama-db">Host Username</label>
                                    <input type="text" class="form-control db" id="input-user-host" name="username" value="<?= isset($db['default']['username']) ? $db['default']['username'] : '' ?>" placeholder="Host Username">
                                </div>
                                <div class="form-group col-12" required="">
                                    <label for="input-nama-db">Host Password</label>
                                    <input type="text" class="form-control" id="input-pass-host" value="<?= isset($db['default']['password']) ? $db['default']['password'] : '' ?>" name="password" placeholder="Host Password">
                                    <small class="form-text text-muted">Kosongkan jika tidak menggunakan password.
                                    </small>
                                </div>
                                <div class="form-group col-12" required="">
                                    <label for="input-nama-db">Nama Database</label>
                                    <input type="text" class="form-control db" id="input-nama-db" name="database" value="<?= isset($db['default']['database']) ? $db['default']['database'] : '' ?>" placeholder="Nama Database">
                                    <small class="form-text text-muted">Jangan gunakan spasi.</small>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap align-items-center justify-content-end">
                                <button type="submit" id="install-db" class="btn-primary btn">INSTALL / UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-default-info align-content-center mt-4" role="alert" style="background-color: rgba(255,255,255,.7);">
            <i><b>A. Update Aplikasi</b></i>
            <ul>
                <li>
                    Isi kolom di atas, sesuaikan dengan pengaturan localhost/mySql dan nama database yang sudah ada,
                    lalu klik [INSTALL / UPDATE].
                </li>
            </ul>
            <br>
            <i><b>B. Install Otomatis</b></i>
            <ul>
                <li>
                    Isi kolom di atas, sesuaikan dengan pengaturan localhost/mySql, isi nama database, lalu klik
                    [INSTALL / UPDATE
                </li>
                <li>
                    Lanjutkan proses instalasi di halaman selanjutnya
                </li>
            </ul>
            <br>
            <i><b>C. Install Manual</b></i>
            <br>Jika ingin menginstall manual, lakukan langkah dibawah ini:
            <ol>
                <li>
                    Buat database baru di <b>phpmyadmin</b>
                </li>
                <li>
                    IMPORT file database di dalam folder /assets/app/db/master.sql
                </li>
                <li>
                    Buka file <b>database.php</b> di dalam folder /application/config/
                </li>
                <li>
                    Ganti baris kode dibawah ini:
                    <pre style="white-space: pre-line">
                        <code><span class="badge badge-light">'hostname' =&gt; '',</span></code>
                        <code><span class="badge badge-light">'username' =&gt; '',</span></code>
                        <code><span class="badge badge-light">'password' =&gt; '',</span></code>
                        <code><span class="badge badge-light">'database' =&gt; '',</span></code>
                    </pre>
                    menjadi:
                    <br>
                    <pre style="white-space: pre-line">
                        <code><span class="badge badge-light">'hostname' =&gt; 'localhost', </span>
                            <span class="badge badge-light">'username' =&gt; '',  </span> // default xampp tidak menggunakan username, laragon menggunakan username = root
                            <span class="badge badge-light">'password' =&gt; '',  </span> // default xampp dan laragon tidak menggunakan password
                            <span class="badge badge-light">'database' =&gt; 'nama_database', </span> // sesuaikan dengan nama database yang dibuat
                        </code>
                    </pre>
                </li>
                <li>
                    Refresh halaman ini atau klik
                    <a class="btn btn-success" href="<?= $base_url ?>" style="text-decoration: none">Tombol ini</a>
                </li>
            </ol>
        </div>
        <div class="text-center text-white-50 mt-4">
            <small>Modified by Tegar</small>
        </div>
    </div>
</section>
<section class="gradient">
    <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
                <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
                <path d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z" opacity="0.100000001"></path>
                <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"></path>
            </g>
            <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                <path d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"></path>
            </g>
        </g>
    </svg>
</section>

<script>
    $(document).ready(function () {
        $('#create').submit(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            console.log("data:", $(this).serialize());

            swal.fire({
                title: "Checking database",
                text: "Silahkan tunggu....",
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    swal.showLoading();
                }
            });

            var $form = $(this);
            var data = getFormData($form);
            console.log(data);

            $.ajax({
                url: 'install.php',
                method: 'POST',
                data: data,
                success: function (response) {
                    console.log(response);
                    const isSuccess = response.trim() == '';
                    swal.close();
                    swal.fire({
                        title: isSuccess ? "Sukses" : "Gagal!",
                        html: isSuccess ? "Database berhasil diinstall" : response,
                        icon: isSuccess ? "success" : "error",
                        allowOutsideClick: false,
                        showCancelButton: false,
                        allowEscapeKey: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    }).then(result => {
                        if (result.value) {
                            if (isSuccess) window.location.href = '<?= $base_url ?>';
                        }
                    });
                },
                error: function (xhr, error, status) {
                    swal.close();
                    Swal.fire({
                        title: "ERROR",
                        html: 'Gagal inisialisasi database',
                        icon: "error"
                    });
                    console.log(xhr.responseText);
                }
            });
        });
    });

    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }
</script>

<script src="<?= $base_url ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>

    <div class="text-center text-white-50 mt-3 pb-3">
        <small>Modified by Tegar</small>
    </div>
</body>
</html>
