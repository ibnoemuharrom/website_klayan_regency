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
            <h1 class="h2"><i class="bi bi-file"></i> Halaman About</h1>
          </div>

          <div class="row mt-3 mb-5">
            <div class="col-md-12">
              <!-- alert -->
              <?php
              if (isset($_GET['success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert" role="alert">
                Data berhasil disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <?php
              if (isset($_GET['failed'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" role="alert">
                Data gagal disimpan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
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
            <div class="card border-left-primary shadow h-100">
              <h6 class="card-header">Input Data Halaman About</h6>
              <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="number" name="id" class="form-control" id="id" readonly="readonly" placeholder="ID">
                  </div>
                  <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="image_about" class="form-label">Image About</label>
                    <input type="file" name="image_about" class="form-control" id="image_about">
                    <p class="text-small text-danger">*Ukuran file maksimal 2MB</p>
                  </div>
                  <?php
                  $tb_about = mysqli_query($koneksi, "SELECT * FROM about");
                  $cek = mysqli_num_rows($tb_about);

                  // cek jika data lebih dari sama dengan 1 maka button disabled
                  if ($cek >= 1) { ?>
                  <button type="submit" class="btn btn-sm btn-primary" name="save" disabled="disabled">Simpan Data</button>
                  <button type="reset" class="btn btn-sm btn-danger" disabled="disabled">Batal</button>
                  <?php } else { ?>
                  <button type="submit" class="btn btn-sm btn-primary" name="save">Simpan Data</button>
                  <button type="reset" class="btn btn-sm btn-danger">Batal</button>
                  <?php } ?>
                </form>
                <?php

                  if (isset($_POST['save'])) 
                  {
                      $id = $_POST['id'];
                      $deskripsi = $_POST['deskripsi'];

                      $nama_file = $_FILES['image_about']['name'];
                      $nama_foto = date('YmdHis').$nama_file;
                      $source = $_FILES['image_about']['tmp_name'];
                      $folder = './page_img/';

                      move_uploaded_file($source, $folder.$nama_foto);

                      $query = mysqli_query($koneksi,"INSERT INTO about(id,deskripsi,image_about)VALUES
                          ('$id','$deskripsi','$nama_foto')");
                      if ($query) 
                      {
                          echo "<script>location='page_about.php?success';</script>";
                      } else {
                          echo "<script>location='page_about.php?failed';</script>";
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
                <h6 class="card-header">Data Halaman About</h6>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-md">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Deskripsi</th>
                          <th>Option</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM about");
                        while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $row['deskripsi']; ?></td>
                          <td>
                            <a href="edit_about.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-success mb-1"><i class="bi bi-pencil-square"></i></a>
                            <a href="hapus_about.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data?');"><i class="bi bi-trash-fill"></i></a>
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
