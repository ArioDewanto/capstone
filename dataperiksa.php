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
                <div class="pagetitle" style="margin-top:80px">
                    <h1>Data Periksa</h1>
                        <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="indexadmin.php?page=dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                </div><!-- End Page Title -->
                    <div class="row" style="text-align:center;">
                        <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title" style="text-align:center; padding:20px" >Data Periksa</h5>
                            <!-- Table with stripped rows -->

                            <table class="table datatable" style="font-size: 14px; text-align:center;">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Handphone</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = mysqli_query(
                                        $mysqli,"SELECT * FROM pasien"
                                        );
                                    $no = 1;
                                    while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $no++ ?></th>
                                            <td><?php echo $data['nama'] ?></td>
                                            <td><?php echo $data['alamat'] ?></td>
                                            <td><?php echo $data['no_hp'] ?></td>
                                            <td>
                                                <a class="btn btn-info rounded-pill " href="indexadmin.php?page=periksa&id=<?php echo $data['id'] ?>">Ubah</a>
                                                <a class="btn btn-danger rounded-pill " href="indexadmin.php?page=periksa&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        </div>
                </section>
            </main>    
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