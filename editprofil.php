<?php

include 'koneksi.php';
if (!isset($_SESSION)) {
    session_start();
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>AdminPoli</title>
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
</head>
<body>



            <main id="main" class="main" style="margin-top:50px">
                <section class="section">
                <div class="pagetitle" style="margin-top:80px;">
                    <h1>Data Pasien</h1>
                        <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="indexadmin.php?page=dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        </nav>
                </div><!-- End Page Title -->
                    <div class="row" style="text-align:center;">
                        <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title" style="text-align:center; padding:20px" >Data Dokter</h5>
                            <!-- Table with stripped rows -->


                            <form method="POST" action="" name="myForm" onsubmit="return(validate());">
       
            <?php
            $nama = '';
            $alamat = '';
            $no_hp = '';
            if (isset($_GET['id'])) {
                $ambil = mysqli_query($mysqli, "SELECT * FROM dokter WHERE id='" . $_GET['id'] . "'");
                while ($row = mysqli_fetch_array($ambil)) {
                    $nama = $row['nama'];
                    $no_hp = $row['no_hp'];
                    $alamat = $row['alamat'];
                }
            ?>
                <input type="hidden" name="id" value="<?php echo
                $_GET['id'] ?>">
            <?php
            }
            ?>
            <div class="col">
                <label for="inputIsi" class="form-label fw-bold">
                    Nama
                </label>
                <input type="text" class="form-control" name="nama" id="inputIsi" placeholder="Nama" value="<?php echo $nama ?>">
            </div>
            <div class="col">
                <label for="inputTanggalAwal" class="form-label fw-bold">
                    Alamat
                </label>
                <input type="text" class="form-control" name="alamat" id="inputTanggalAwal" placeholder="Alamat" value="<?php echo $alamat ?>">
            </div>
            <div class="col mb-2">
                <label for="inputTanggalAkhir" class="form-label fw-bold">
                    NoHP
                </label>
                <input type="text" class="form-control" name="no_hp" id="inputTanggalAkhir" placeholder="NoHP" value="<?php echo $no_hp?>">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan" >Simpan</button>
                <a class="btn btn-info rounded-pill px-3" href="indexdokter.php?page=editprofil&id=<?php echo $row['id'] ?>">Ubah</a>
            
            </div>
        </form>


<?php
            if (isset($_POST['simpan'])) {
                    if (isset($_POST['id'])) {
                        $ubah = mysqli_query($mysqli, "UPDATE dokter SET 
                                                        nama = '" . $_POST['nama'] . "',
                                                        alamat = '" . $_POST['alamat'] . "',
                                                        no_hp = '" . $_POST['no_hp'] . "'
                                                        WHERE
                                                        id = '" . $_POST['id'] . "'");
                    } else {
                        $tambah = mysqli_query($mysqli, "INSERT INTO dokter(nama,poli,no_hp) 
                                                        VALUES ( 
                                                            '" . $_POST['nama'] . "',
                                                            '" . $_POST['alamat'] . "',
                                                            '" . $_POST['no_hp'] . "'
                                                            )");
                    }

                    echo "<script> 
                            document.location='indexdokter.php?page=editprofil';
                            </script>";
                }

                ?>
            <?php 
            if (isset($_GET['aksi'])) {
                    if ($_GET['aksi'] == 'hapus') {
                        $hapus = mysqli_query($mysqli, "DELETE FROM dokter WHERE id = '" . $_GET['id'] . "'");
                        echo '<script>alert("Data berhasil dihapus!");</script>';
                        echo "<script> document.location='indexdokter.php?page=editprofil';</script>";
                    }
                }
                ?>   
            <script>
                let myTable = document.querySelector("#myTable");
                let dataTable = new DataTable(myTable);
            </script>
              <!-- Vendor JS Files -->
            <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
            <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="assets/vendor/chart.js/chart.umd.js"></script>
            <script src="assets/vendor/echarts/echarts.min.js"></script>
            <script src="assets/vendor/quill/quill.min.js"></script>
            <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
            <script src="assets/vendor/tinymce/tinymce.min.js"></script>
            <script src="assets/vendor/php-email-form/validate.js"></script>

            <!-- Template Main JS File -->
            <script src="assets/js/main.js"></script>
</body>
</html>