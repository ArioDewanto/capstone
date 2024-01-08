<?php

include 'koneksi.php';

if (!isset($_SESSION)) {
    session_start();
}

$user_id = $_SESSION['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>AdminSCK</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/stylebot.css" rel="stylesheet">
    <title>Admin POLI</title>   <!--Judul Halaman-->
</head>

<body>
            <form method="POST" action="" name="myForm" onsubmit="return(validate());">
        
            <?php
            $hari = '';
            $jam_mulai = '';
            $jam_selesai = '';
            $id_dokter = '';
            $status = '';
            if (isset($_GET['id'])) {
                $ambil = mysqli_query($mysqli, "SELECT * FROM jadwal_periksa WHERE id='" . $_GET['id'] . "'");
                while ($row = mysqli_fetch_array($ambil)) {
                    $hari = $row['hari'];
                    $jam_mulai = $row['jam_mulai'];
                    $jam_selesai = $row['jam_selesai'];
                    $id_dokter = $row['id_dokter'];
                    $status = $row['status'];
                }
            ?>
                <input type="hidden" name="id" value="<?php echo
                $_GET['id'] ?>">
            <?php
            }
            ?>
            <main id="main" class="main" style="margin-top:50px">
                <section>
                <div class="pagetitle" style="margin-top:80px;">
                    <h1>Input Jadwal Periksa</h1>
                        <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="indexdokter.php?page=dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        </nav>
                </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            
                            <h5 class="card-title" style="text-align:center; padding:20px">Form Input Jadwal Periksa</h5>
                            <!-- Table with stripped rows -->
                            <div class="col">
                                <label for="inputIsi" class="form-label fw-bold">
                                    Hari
                                </label>
                                <select class="form-control" name="hari" id="inputIsi" placeholder="Nama" value="<?php echo $hari ?>">
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option> 
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                </select>
                            </div>
                            <div class="col mb-2">
                                <label for="inputTanggalAkhir" class="form-label fw-bold">
                                    Jam Mulai
                                </label>
                                <input type="time" class="form-control" name="jam_mulai" id="asal" placeholder="Masukkan Alamat" value="<?php echo $jam_mulai?>">
                            </div>
                            <div class="col mb-2">
                                <label for="inputTanggalAkhir" class="form-label fw-bold">
                                    Jam Selesai
                                </label>
                                <input type="time" class="form-control" name="jam_selesai" id="tujuan" placeholder="Masukkan No Handphone" value="<?php echo $jam_selesai?>">
                            </div>
                            <div class="col">
                                <label for="inputIsi" class="form-label fw-bold">
                                    Status
                                </label>
                                <select class="form-control" name="status" id="inputIsi" placeholder="Status" value="<?php echo $status ?>">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option> 
                                </select>
                            </div>
                            <div class="col" style="text-align:right; padding:20px">
                                <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
                            </div>
                            </form>
                            </div>
                            </div>
                        </div>
                        </div>
                </section>
        </main>
        <?php
                if (isset($_POST['simpan'])) {
                    if (isset($_POST['id'])) {
                        $ubah = mysqli_query($mysqli, "UPDATE jadwal_periksa SET 
                                                        hari = '" . $_POST['hari'] . "',
                                                        jam_mulai = '" . $_POST['jam_mulai'] . "',
                                                        jam_selesai = '" . $_POST['jam_selesai'] . "',
                                                        status = '" . $_POST['status'] . "'
                                                        WHERE
                                                        id = '" . $_POST['id'] . "'");
                    } else {
                        $tambah = mysqli_query($mysqli, "INSERT INTO jadwal_periksa(id_dokter,hari,jam_mulai,jam_selesai,status) 
                                                        VALUES ( 
                                                            '" . $user_id. "',
                                                            '" . $_POST['hari'] . "',
                                                            '" . $_POST['jam_mulai'] . "',
                                                            '" . $_POST['jam_selesai'] . "',
                                                            '" . $_POST['status'] . "'
                                                            )");
                    }
                    echo '<script>alert("Data berhasil disimpan!");</script>';
                    echo "<script>document.location='indexdokter.php?page=inputjadwalperiksa';</script>";
                }

                if (isset($_GET['aksi'])) {
                    if ($_GET['aksi'] == 'hapus') {
                        $hapus = mysqli_query($mysqli, "DELETE FROM jadwal_periksa WHERE id = '" . $_GET['id'] . "'");
                    }

                    echo "<script> 
                            document.location='indexdokter.php?page=inputjadwalperiksa';
                            </script>";
                }
                ?>

    </div>
<script>
    function myFunction() {
        var x = document.getElementById("id_booking");
        x.value = x.value.toUpperCase();
    }
</script>
</body>
</html>