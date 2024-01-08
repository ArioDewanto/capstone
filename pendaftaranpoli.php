<?php

include 'koneksi.php';
if (!isset($_SESSION['nama']) || !isset($_SESSION['id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: loginpasien.php");
    exit();
}
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
  <link href="../../assets/img/favicon.png" rel="icon">
  <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/css/style.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/stylebot.css" rel="stylesheet">
    <title>Admin POLI</title>   <!--Judul Halaman-->
</head>

<body>
            <div class="row justify-content-center">
                <section>
                <div class="pagetitle" style="margin-top:20px;">
                    <h1>Pendaftaran Poli</h1>

                        <form class="form-horizontal" method="POST" action="" name="myForm" onsubmit="return validateForm();">
                        <!-- PHP code to retrieve data if ID is set -->
                        <?php
                        $no_rm = '';
                        $nama = $_SESSION['nama'];
                        
                        $query = "SELECT no_rm FROM pasien WHERE nama = ?";
                        $stmt = $mysqli->prepare($query);
                        $stmt->bind_param("s", $nama);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if (!$result) {
                            die("Query error: " . $mysqli->error);
                        }
                        
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $no_rm = $row['no_rm'];
                        }
                        
                        $stmt->close();
                        $id_pass = $_SESSION['id'];
                        $id_pasien = '';
                        $id_jadwal = '';
                        $tgl_periksa = '';
                        $keluhan = '';
                        $no_antrian = '';
                        if (isset($_GET['id'])) {
                            $ambil = mysqli_query($mysqli, "SELECT * FROM daftar_poli WHERE id='" . $_GET['id'] . "'");
                            while ($row = mysqli_fetch_array($ambil)) {
                                $id_pasien = $row['id_pasien'];
                                $id_jadwal = $row['id_jadwal'];
                                $tgl_periksa = $row['tgl_periksa'];
                                $keluhan = $row['keluhan'];
                                $no_antrian = $row['no_antrian'];
                            }
                            ?>
                            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                            <?php
                            }
                            ?>
                </div><!-- End Page Title -->
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            
                            <h5 class="card-title" style="text-align:center; padding:20px">Form Pendaftaran Poli</h5>
                            <!-- Table with stripped rows -->
                            <div class="col">
                            <label for="inputPasien" class="form-label fw-bold">No Rekam Medis</label>
                            <input type="text" name="no_rm" class="form-control" required value="<?= $no_rm ?>" readonly>
                            </div>
                            <div class="col mb-2">
                            <label for="inputDokter" class="form-label fw-bold">Pilih Poli</label>
                            <div>
                                <select class="form-select" id="poliPilihan" aria-label="State" name="poliPilihan" required>
                                    <option selected disabled>Buka untuk memilih Poli</option>
                                    <?php
                                    $sql = "SELECT * FROM poli";
                                    $result = $mysqli->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=" . $row['id'] . ">" . $row['nama_poli'] . "</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                            </div>
                            <div class="col mb-2">
                            <label for="inputDokter" class="form-label fw-bold">Hari Periksa</label>
                            <select class="form-select" id="jadwalPilihan" aria-label="State" name="jadwalPilihan" required>
                                <option selected disabled>Buka untuk memilih Jadwal</option>
                            </select>
                            </div>
                            <div class="col mb-2">
                                <label for="inputCatatan" class="form-label fw-bold">Keluhan</label>
                                <div>
                                    <input type="text" class="form-control" name="keluhan" id="inputCatatan" placeholder="Keluhan"
                                        value="<?php echo $keluhan ?>">
                                </div>
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
                        $ubah = mysqli_query($mysqli, "UPDATE daftar_poli SET 
                                                        id_pasien = '" . $_POST['id_pasien'] . "',
                                                        id_jadwal = '" . $_POST['id_jadwal'] . "',
                                                        keluhan = '" . $_POST['keluhan'] . "',
                                                        no_antrian = '" . $_POST['no_antrian'] . "'
                                                        WHERE
                                                        id = '" . $_POST['id'] . "'");
                    } else {
                        $keluhan = $_POST['keluhan'];
                        $poli = $_POST['poliPilihan'];
                        $jadwal = $_POST['jadwalPilihan'];
                        $id_pasien = $_SESSION['id_pasien'];
                        $cekAntrian = "SELECT no_antrian FROM daftar_poli WHERE id_jadwal='$jadwal' AND no_antrian != 0";
                        $antrian = $mysqli->query($cekAntrian);
                        $antrian = mysqli_num_rows($antrian);
                        $tambah = mysqli_query($mysqli, "INSERT INTO daftar_poli(id_pasien,id_jadwal,keluhan,no_antrian) 
                                                        VALUES ( 
                                                            '" . $id_pass . "',
                                                            '" . $jadwal. "',
                                                            '" . $_POST['keluhan'] . "',
                                                            '" . $antrian+1 . "'
                                                            )");

                    }
                    echo '<script>alert("Data berhasil disimpan!");</script>';
                    echo "<script>document.location='dashpasien.php?page=pendaftaranpoli';</script>";
                }

                if (isset($_GET['aksi'])) {
                    if ($_GET['aksi'] == 'hapus') {
                        $hapus = mysqli_query($mysqli, "DELETE FROM daftar_poli WHERE id = '" . $_GET['id'] . "'");
                    }

                    echo "<script> 
                            document.location='index.php?page=datadokter';
                            </script>";
                }
                ?>

    </div>
    <script>
    $(document).ready(function() {
      $('#poliPilihan').change(function() {
        var Stdid = $('#poliPilihan').val();
        console.log('tes');

        $.ajax({
          type: 'POST',
          url: 'dashpasien.php?page=pendaftaranpoli',
          data: {
            id: Stdid
          },
          success: function(data) {
            $('#jadwalPilihan').html(data);
          }
        });
      });
    });
  </script>

  <!-- FETCHING THE AJAX -->
  <?php
  if (isset($_POST['id'])) {
    $getPoliId = $_POST['id'];
    $sqlJadwal = "SELECT id, hari, jam_mulai, jam_selesai, id_dokter, status FROM jadwal_periksa WHERE id_dokter IN (SELECT id FROM dokter WHERE id_poli = $getPoliId) AND status != 1";
    $result = mysqli_query($mysqli, $sqlJadwal);

    $out = '';
    while ($row = mysqli_fetch_assoc($result)) {
      $out .=  "<option value=" . $row['id'] . ">" . $row['hari'] . " | " . $row['jam_mulai'] . " - " . $row['jam_selesai'] . "</option>";
    }
    echo $out;
  }
  ?>
  <script src="../../assets/assjs/jquery.min.js"></script>
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.min.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>
</body>
</html>