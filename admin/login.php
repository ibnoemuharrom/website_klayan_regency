<?php

include 'include/koneksi.php';
session_start();

if (isset($_SESSION['user']['id']) || !empty($_SESSION['user']['id'])) {
  echo "<script>location='dashboard.php';</script>";
}

?>
<!Doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ibnoemuharrom">
    <title>Login - Klayan Regency</title>

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
          <h3 class="text-primary-regular">KLAYAN REGENCY</h3>
        </div>
        <div class="row justify-content-center mt-4">
          <div class="col-md-5">
            <?php
            if (isset($_GET['success'])) { ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert" role="alert">
              Registrasi berhasil, silahkan login.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } ?>
            <?php
            if (isset($_GET['login-failed'])) { ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert" role="alert">
              Login gagal. Silahkan periksa data anda!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } ?>
            <form method="post">
              <div class="mb-3">
                <label for="email" class="form-label text-primary-regular">Alamat Email</label>
                <input type="email" name="email" class="form-control" placeholder="Alamat Email">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label text-primary-regular">Password</label>
                <input type="password" name="password" class="form-control" placeholder="password">
              </div>
              <button type="submit" class="w-100 btn btn-md btn-success rounded-0" name="login">Login</button>
            </form>
            <?php
            if (isset($_POST['login'])) {
              $email = $_POST['email'];
              $password = $_POST['password'];

              $query = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email'");
              $cek = mysqli_num_rows($query);
              $row = mysqli_fetch_array($query, MYSQLI_ASSOC);

              if ($cek === 1) {
                  if (password_verify($password, $row['password'])) {
                  $_SESSION['user']['id'] = $row['id'];
                  $_SESSION['user']['email'] = $row['email'];
                  $_SESSION['user']['nama'] = $row['nama'];

                  echo "<script>location='dashboard.php';</script>";
                } else {
                  echo "<script>location='login.php?login-failed';</script>";
                }

              }

            }

            ?>
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