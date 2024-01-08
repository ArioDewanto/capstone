<?php
if (!isset($_SESSION)) {
  session_start();
}

// Fetch data from the 'pasien' table
$pasienQuery = "SELECT * FROM pasien";
$pasienResult = $mysqli->query($pasienQuery);

// Fetch the data as an associative array
$pasienData = $pasienResult->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Add your head section here -->

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">

  <!-- jQuery and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
</head>

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

                            <table class="table datatable" style="font-size: 13px; text-align:center;">
                                <thead>
                    <tr>
                      <th>#</th>
                      <th>No.RM</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>No Telepon</th>
                      <th>No KTP</th>
                      <th>No Antrian</th>
                      <th>Aksi</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $idjadwal= $_SESSION['jadwal_id'];
                  $idjadwaldokter=$_SESSION['id'];
                                   $result = mysqli_query(
                                    $mysqli,
                                    "SELECT pasien.*, daftar_poli.*
                                    FROM pasien
                                    INNER JOIN daftar_poli ON pasien.id = daftar_poli.id_pasien
                                    INNER JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id
                                    INNER JOIN dokter ON jadwal_periksa.id_dokter = jadwal_periksa.id_dokter
                                    WHERE jadwal_periksa.id = $idjadwal AND dokter.id = $idjadwaldokter ;
                                    "
                                );                                
                                    $no = 1;
                                    while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $no++ ?></th>
                                            <td><?php echo $data['no_rm'] ?></td>
                                            <td><?php echo $data['nama'] ?></td>
                                            <td><?php echo $data['alamat'] ?></td>
                                            <td><?php echo $data['no_hp'] ?></td>
                                            <td><?php echo $data['no_ktp'] ?></td>
                                            <td><?php echo $data['no_antrian'] ?></td>
                                            <td>
                                                <a class="btn btn-info rounded-pill" href="indexdokter.php?page=periksa&id=<?php echo $data['id']; ?>">Periksa</a>
                                                <?php if ($data['status_periksa'] == '0') : ?>
                                                    <a class="btn btn-warning rounded-pill mark-as-checked-btn">Belum</a>
                                                <?php else : ?>
                                                    <a class="btn btn-success rounded-pill ">Sudah</a>
                                                <?php endif; ?>
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
      </div>
    </section>
  </div>

  <!-- Modal for displaying details -->
  <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewModalLabel">View Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="viewModalBody">
          <!-- Details will be displayed here dynamically -->
        </div>
      </div>
    </div>
  </div>
</body>

</html>
