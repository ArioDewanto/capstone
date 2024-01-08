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

  <title>AdminSCK</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Or for RTL support -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> 
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
            <main id="main" class="main" style="margin-top:50px">
                <section>
                <div class="pagetitle" style="margin-top:80px;">
                    <h1>Input Data Periksa</h1>
                        <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        </nav>
            
                        
                        <form class="form-horizontal" method="POST" action="" name="myForm" onsubmit="return validateForm();">
                        <!-- PHP code to retrieve data if ID is set -->
                        <?php
                        $id_daftar_poli = '';
                        $tgl_periksa = '';
                        $catatan = '';
                        $obat = [];
                        if (isset($_GET['id'])) {
                            $ambil = mysqli_query($mysqli, "SELECT * FROM periksa WHERE id='" . $_GET['id'] . "'");
                            while ($row = mysqli_fetch_array($ambil)) {
                                $id_daftar_poli = $row['id_daftar_poli'];
                                $tgl_periksa = $row['tgl_periksa'];
                                $catatan = $row['catatan'];
                                $detail_periksa = mysqli_query($mysqli, "SELECT * FROM detail_periksa WHERE id_periksa='" . $_GET['id'] . "'");
                                while ($row = mysqli_fetch_array($detail_periksa)) {
                                    $obat[] = $row['id_obat'];
                                }
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
                            
                            <h5 class="card-title" style="text-align:center; padding:20px">Form Data Periksa</h5>
                            <!-- Table with stripped rows -->
                            <div class="col">
                            <label for="inputPasien" class="form-label fw-bold">Pasien</label>
                            <div>
                                <select class="form-control" name="id_pasien" readonly disabled>
                                    <option hidden>Pilih Pasien</option>
                                    <?php
                                        $selected = $_GET['id']; // Assuming 'id_pasien' is the parameter name in your GET request

                                        $pasien = mysqli_query($mysqli, "SELECT pasien.*, daftar_poli.* FROM pasien LEFT JOIN daftar_poli ON pasien.id = daftar_poli.id_pasien");
                                        while ($data = mysqli_fetch_array($pasien)) {
                                            $id_pasien = $data['id'];
                                            $nama_pasien = $data['nama'];

                                            // Check if the current option is the selected one
                                            $is_selected = ($id_pasien == $selected) ? 'selected="selected"' : '';

                                            // Output the option tag
                                            echo '<option value="' . $id_pasien . '" ' . $is_selected . '>' . $nama_pasien . '</option>';
                                        }
                                        ?>
                                </select>
                            </div>
                            </div>
                                <div class="col mb-2">
                                <label for="inputTanggal" class="form-label fw-bold">Hari Periksa</label>
                                <div>
                                    <input type="datetime-local" class="form-control" name="tgl_periksa" id="inputTanggal"
                                        placeholder="Tanggal Periksa" value="<?php echo $tgl_periksa ?>">
                                </div>
                            </div>
                            <div class="col mb-2">
                                <label for="inputCatatan" class="form-label fw-bold">Catatan</label>
                                <div>
                                    <input type="text" class="form-control" name="catatan" id="inputCatatan" placeholder="Catatan"
                                        value="<?php echo $catatan ?>">
                                </div>
                            </div>
                            <div class="col mb-2">
                                <label for="inputObat" class="form-label fw-bold">Obat</label>
                                <select class="form-select" id="multiple-select-field" name="obat[]" multiple="multiple">
                                <?php 
                                    $obatQuery = "SELECT * FROM obat";
                                    $obat = $mysqli->query($obatQuery);
                                    while ($row = $obat->fetch_assoc()) {
                                    echo '<option value="'.$row['harga'].'" harga="'.$row['id'].'">'.$row['nama_obat'].'</option>';
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="col mb-2">
                                <label for="inputCatatan" class="form-label fw-bold">Biaya Dokter</label>
                                <div>
                                <input type="text" class="form-control" name="hargadokter" id="hargadokter" value="Rp.150.000" readonly>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <label for="inputCatatan" class="form-label fw-bold">Harga</label>
                                <div>
                                <input type="text" class="form-control" name="harga" id="harga" readonly>
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
                        $status = '1'; // Ubah menjadi string
                        $statusupdate = mysqli_query($mysqli, "UPDATE daftar_poli SET 
                                                                status_periksa = '" . $status . "'
                                                                WHERE
                                                                id = '" . $_POST['id'] . "'");
                
                        $catatan = $_POST['catatan'];
                        $tgl_periksa = $_POST['tgl_periksa'];
                        $harga = $_POST['harga'];
                
                        $tambah = mysqli_query($mysqli, "INSERT INTO periksa(id_daftar_poli, tgl_periksa, catatan, biaya_periksa) 
                                                        VALUES ( 
                                                            '" . $_POST['id'] . "',
                                                            '" . $tgl_periksa . "',
                                                            '" . $catatan . "',
                                                            '" . $harga . "'
                                                            )");
                    }
                    echo '<script>alert("Data berhasil disimpan!");</script>';
                    echo "<script>document.location='indexdokter.php?page=riwayatpasien';</script>";
                }
                
                if (isset($_GET['aksi'])) {
                    if ($_GET['aksi'] == 'hapus') {
                        $hapus = mysqli_query($mysqli, "DELETE FROM pasien WHERE id = '" . $_GET['id'] . "'");
                    }
                
                    echo "<script> 
                            document.location='indexdokter.php?page=dataperiksa';
                            </script>";
                }    
                ?>

    </div>
    <script>
    $( '#multiple-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    closeOnSelect: false,} );

    $(document).ready(function() {
      $('#multiple-select-field').change(function() {
        var Stdid = $('#multiple-select-field').val();

        console.log(Stdid);

        var counter = 0
        var hargadokter =150000
        Stdid.forEach(element => {
          var harga = parseInt(element);
          counter = counter + harga + hargadokter
          console.log(counter);
        });

        document.getElementById('harga').value = counter
        
      });
    });
    </script>
</body>
</html>