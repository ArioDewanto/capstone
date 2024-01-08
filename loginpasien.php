<?php
include 'koneksi.php';

session_start();

// Redirect to the dashboard if the user is already logged in
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['submit'])) {
    $username = $_POST['nama'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM pasien WHERE nama=? AND password=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['id'] = $row['id'];
            header("Location: dashpasien.php?page=pendaftaranpoli"); // Redirect to admin dashboard
            exit;
    }

    $stmt->close();
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
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Log In</h2>
          <form action="" method="POST" class="login-email">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
              
              <div class="form-outline mb-4">
                  <input type="text" id="form3Example1" class="form-control" name="nama" > 
                  <label class="form-label" for="form3Example1">Username</label>
                </div>
              </div>
            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" id="form3Example4" class="form-control" name="password" >
              <label class="form-label" for="form3Example4">Password</label>
            </div>

       

            <!-- Submit button -->
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Login</button> 
          
       

            <!-- Register buttons -->
            <div class="text-center">
            <p class="login-register-text">Don't have an account? <a href="registerpasien.php">Register Here</a>.</p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->
</body>
</html>