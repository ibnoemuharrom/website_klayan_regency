<?php

include 'include/koneksi.php';
session_start();

if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
  echo "<script>location='login.php';</script>";
}

?>

<!doctype html>
<html lang="en">
  <!-- head -->
  <?php include 'include/head.php'; ?>
  <!-- end head -->
  <body>
    <!-- header navbar -->
    <?php include 'include/header.php'; ?>
    <!-- end header navbar -->

    <!-- container-fluid -->
    <div class="container-fluid">
      <div class="row">
        <!-- sidebar -->
        <?php include 'include/sidebar.php'; ?>
        <!-- end sidebar -->

        <!-- main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><i class="bi bi-person"></i> Data user</h1>
          </div>

          <div class="row mt-3 mb-5">
            <div class="col-md-12">
              <!-- alert -->
              <?php
              if (isset($_GET['success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert" role="alert">
                Registrasi berhasil.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <?php
              if (isset($_GET['failed'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" role="alert">
                Registrasi gagal!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <div class="card border-left-primary shadow h-100">
              <h6 class="card-header">Input Data User</h6>
              <div class="card-body">
                <form method="post">
                  <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="number" name="id" class="form-control" id="id" readonly="readonly" placeholder="ID">
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Ulangi Password</label>
                    <input type="password" name="password1" class="form-control" id="password" placeholder="Ulangi Password">
                  </div>
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap">
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary" name="save">Simpan Data</button>
                  <button type="reset" class="btn btn-sm btn-danger">Batal</button>
                </form>
                <?php
                if (isset($_POST['save'])) {
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
                    echo "<script>location='user.php?success';</script>";
                  } else {
                    echo "<script>location='user.php?failed';</script>";
                  }
                }

                ?>
                </div>
              </div>
            </div>
          </div>

          <div class="row my-3">
            <div class="col-md-12">
              <div class="card border-left-primary shadow h-100">
                <h6 class="card-header">Data Akun</h6>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-md">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Email</th>
                          <th>Nama Lengkap</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM user");
                        while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $row['email']; ?></td>
                          <td><?= $row['nama']; ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
        <!-- end main content -->
      </div>
    </div>
    <!-- end container-fluid -->


    <!-- js -->
    <?php include 'include/script.php'; ?>

  </body>
</html>
