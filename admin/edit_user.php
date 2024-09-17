<?php

include 'include/koneksi.php';
session_start();

if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
  echo "<script>location='login.php';</script>";
}

// query data
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

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
            <h1 class="h2"><i class="bi bi-pencil-square"></i> Edit Data user</h1>
          </div>

          <div class="row mt-3 mb-5">
            <div class="col-md-12">
              <a href="user.php" class="btn btn-sm btn-light mb-3">Tambah User <i class="bi bi-plus"></i></a>
              <div class="card border-left-primary shadow h-100">
              <h6 class="card-header">Edit Data User</h6>
              <div class="card-body">
                <form method="post">
                  <input type="hidden" name="id" class="form-control" id="id" readonly="readonly" value="<?= $row['id']; ?>">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?= $row['email']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $row['nama']; ?>">
                  </div>
                  <button type="submit" class="btn btn-sm btn-success" name="save">Update Data</button>
                </form>
                <?php
                if (isset($_POST['save'])) {
                  $id = $_POST['id'];
                  $nama = $_POST['nama'];
                  $email = strtolower(stripcslashes($_POST['email']));

                  // update data
                  $sql = mysqli_query($koneksi, "UPDATE user SET id='$id', email='$email', nama='$nama' WHERE id='$id'");
                  if ($sql) {
                    echo "<script>location='edit_user.php?id=<?= $row[id]; ?></script>";
                    echo "<meta http-equiv='refresh' content='1'>";
                  } else {
                    echo "<script>location='edit_user.php?id=<?= $row[id]; ?></script>";
                  }
                }

                ?>
                </div>
              </div>
            </div>
          </div>

          <div class="row my-3">
            <div class="col-md-12">
              <!-- alert -->
              <?php
              if (isset($_GET['update-success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert" role="alert">
                Update data berhasil.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <?php
              if (isset($_GET['update-failed'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" role="alert">
                Update data gagal!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <?php
              if (isset($_GET['delete-failed'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" role="alert">
                Data gagal dihapus!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <div class="card border-left-primary shadow h-100">
                <h6 class="card-header">Hapus Akun</h6>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-md">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Email</th>
                          <th>Nama Lengkap</th>
                          <th>Option</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
                        while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $row['email']; ?></td>
                          <td><?= $row['nama']; ?></td>
                          <td>
                            <a href="hapus_user.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus akun?');"><i class="bi bi-trash-fill"></i></a>
                          </td>
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
