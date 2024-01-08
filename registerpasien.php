<?php

include 'koneksi.php';



if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['submit'])) {
	$username = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$no_hp = $_POST['no_hp'];
	$no_ktp = $_POST['alamat'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$yearMonth = date('Ym');

       
        $queryCounter = "SELECT MAX(SUBSTRING(no_rm, 8)) AS max_counter FROM pasien WHERE no_rm LIKE '$yearMonth%'";
        $resultCounter = $mysqli->query($queryCounter);

        if ($resultCounter === false) {
            die("Query error: " . $mysqli->error);
        }

        $counter = 1;
        if ($resultCounter->num_rows > 0) {
            $row = $resultCounter->fetch_assoc();
            $counter = (int)$row['max_counter'] + 1;
        }

        $paddedCounter = str_pad($counter, 3, '0', STR_PAD_LEFT);

     
        $no_rm = $yearMonth . '-' . $paddedCounter;
		$sql = "SELECT * FROM pasien WHERE nama='$username'";
		$result = mysqli_query($mysqli, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO pasien (nama, password, alamat, no_ktp, no_hp, no_rm) 
			VALUES ('$username', '$password', '$alamat', '$no_ktp', '$no_hp', '$no_rm')";
			$result = mysqli_query($mysqli, $sql);
			if ($result) {
				echo "<script>alert('Pendaftaran Berhasil'); 
				document.location='loginpasien.php';</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Username Already Exists.')</script>";
		}

	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	

<!-- Bootstrap Online -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">   <!-- Gunakan salah satu cara saja -->

    <!-- Load JS online -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>   
    <!-- cukup gunakan salah satu saja -->

<section class="vh-100" style="background-color: #eee;">
 
<!-- Section: Design Block -->
<section class="text-center">
  <!-- Background image -->
  <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
  <!-- Background image -->

  <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form action="" method="POST" class="mx-1 mx-md-4">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text"  name="nama" class="form-control" require  />
                      <label class="form-label" for="form3Example1c">Your Name</label>
                    </div>
                  </div>

				  
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text"  name="alamat" class="form-control" require  />
                      <label class="form-label" for="form3Example1c">Alamat</label>
                    </div>
                  </div>

				  
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text"  name="no_hp" class="form-control" require  />
                      <label class="form-label" for="form3Example1c">No Hp</label>
                    </div>
                  </div>

				  
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text"  name="no_ktp" class="form-control" require  />
                      <label class="form-label" for="form3Example1c">No KTP</label>
                    </div>
                  </div>

                  

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4c" class="form-control" name="password"  required>
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4cd" class="form-control"  name="cpassword" required>
                      <label class="form-label" for="form3Example4cd">Repeat your password</label>
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button name="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>
					<p class="login-register-text">Have an account? <a href="loginpasien.php">Login Here</a></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
