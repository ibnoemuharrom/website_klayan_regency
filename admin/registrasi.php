<?php include 'include/koneksi.php'; ?>
<!Doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ibnoemuharrom">
    <title>Registrasi - Klayan Regency</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300&display=swap" rel="stylesheet">
    <!-- my css -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- favicon -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/favicon/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/favicon/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/favicon/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/favicon/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="assets/favicon/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="assets/favicon/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="assets/favicon/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="assets/favicon/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="assets/favicon/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="assets/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="assets/favicon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="assets/favicon/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="assets/favicon/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="mstile-310x310.png" />

  </head>
  <body>

    <main>
      <div class="container">
        <div class="text-center mt-4">
          <a href="../index.php"><img class="img-fluid" src="assets/images/logo_login.png" alt="logo" width="200" height="200"></a>
          <h3 class="text-primary-regular">REGISTRASI ADMIN</h3>
        </div>
        <div class="row justify-content-center mt-4">
          <div class="col-md-5">
            <!-- alert -->
            <?php
            if (isset($_GET['failed'])) { ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert" role="alert">
              Registrasi admin gagal!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } ?>
            <form method="POST">
              <input type="hidden" name="id">
              <div class="mb-3">
                <label for="email" class="form-label text-primary-regular">Alamat Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Alamat Email">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label text-primary-regular">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="password">
              </div>
              <div class="mb-3">
                <label for="password1" class="form-label text-primary-regular">Ulangi Password</label>
                <input type="password" name="password1" class="form-control" id="password1" placeholder="Ulangi Password">
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label text-primary-regular">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap">
              </div>
              <button class="w-100 btn btn-md btn-success rounded-0" name="register" type="submit">Registrasi</button>
            </form>
            <?php
            if (isset($_POST['register'])) {
              $id = $_POST['id'];
              $nama = $_POST['nama'];
              $email = strtolower(stripcslashes($_POST['email']));
              $password = mysqli_real_escape_string($koneksi, $_POST['password']);
              $password1 = mysqli_real_escape_string($koneksi, $_POST['password1']);

              // cek password
              if ($password !== $password1) {
                echo "<script>alert('Password tidak sesuai.')</script>";
                return false;
              }

              // cek email
              $cek = mysqli_query($koneksi, "SELECT email FROM user WHERE email = '$email'");
              if (mysqli_fetch_assoc($cek)) {
                echo "<script>alert('Email sudah terdaftar.')</script>";
                return false;
              }

              // enkripsi password
              $password = password_hash($password, PASSWORD_DEFAULT);

              // tambah data
              $sql = mysqli_query($koneksi, "INSERT INTO user VALUES('$id','$email','$password','$nama')");
              if ($sql) {
                echo "<script>location='login.php?success';</script>";
              } else {
                echo "<script>location='register.php?failed';</script>";
              }
            }

            ?>
            <p class="mt-3 mb-3 text-primary-regular text-center">Sudah mempunyai akun? <a href="login.php" class="text-primary-regular text-decoration-none">Login.</a></p>
          </div>
        </div>
      </div>
    </main>

    <!-- Popper js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <!-- Bootstrap.min.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    
  </body>
</html>