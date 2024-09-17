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
            <h1 class="h2"><i class="bi bi-file-image"></i> Input Brosur</h1>
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
              <h6 class="card-header">Input Brosur Klayan Regency</h6>
              <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="number" name="id" class="form-control" id="id" readonly="readonly" placeholder="ID">
                  </div>
                  <div class="mb-3">
                    <label for="file" class="form-label">File Brosur</label>
                    <input type="file" name="file" class="form-control" id="file">
                    <p class="text-small text-danger">*Ukuran file maksimal 2MB</p>
                  </div>
                  <?php
                  $tb_brosur = mysqli_query($koneksi, "SELECT * FROM brosur");
                  $cek = mysqli_num_rows($tb_brosur);

                  // cek jika data lebih dari sama dengan 1 maka form disabled
                  if ($cek >= 1) { ?>
                  <button type="submit" class="btn btn-sm btn-primary" name="save" disabled="disabled">Simpan Data</button>
                  <button type="reset" class="btn btn-sm btn-danger" disabled="disabled">Batal</button>
                  <?php } else { ?>
                  <button type="submit" class="btn btn-sm btn-primary" name="save">Simpan Data</button>
                  <button type="reset" class="btn btn-sm btn-danger">Batal</button>
                  <?php } ?>
                </form>
                <?php
                if (isset($_POST['save'])) {

                  // cek tipe file pdf
                  $type_file = $_FILES['file']['type'];

                  if ($type_file == "application/pdf") {

                    $id = $_POST['id'];
                    $file = $_FILES['file']['name'];

                    $generate = date('Ymd_His_').rand(1111,9999);
                    $nama_file = $generate.".pdf";
                    $source = $_FILES['file']['tmp_name'];
                    $folder = './data_pdf/';

                    move_uploaded_file($source, $folder.$nama_file);
                    $query = mysqli_query($koneksi, "INSERT INTO brosur(id,file)VALUES('$id','$nama_file')");
                    if ($query) 
                      {
                          echo "<script>location='input_brosur.php?success';</script>";
                      } else {
                          echo "<script>location='input_brosur.php?failed';</script>";
                      }
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
                <h6 class="card-header">Data Brosur</h6>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-md">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>File</th>
                          <th>Option</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM brosur");
                        while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $row['file']; ?></td>
                          <td>
                            <!-- modal brosur -->
                            <button class="btn btn-sm btn-primary" role="button" data-bs-toggle="modal" data-bs-target="#previewbrosur">
                              Preview <i class="bi bi-eyeglasses"></i>
                            </button>
                            <div class="modal fade" id="previewbrosur" tabindex="-1" aria-labelledby="previewbrosur" aria-hidden="true">
                              <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="previewbrosur">Brosur Perumahan [ <?= $row['file']; ?> ]</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <embed src="data_pdf/<?= $row['file']; ?>" width="100%" height="100%">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary rounded-0" data-bs-dismiss="modal">Close</button>
                                    <a href="admin/assets/data/Daftar_Harga.pdf" target="_blank" download="Pricelist Rumah Klayan Regency.pdf" class="btn btn-outline-primary rounded-0">Download</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- end modal brosur -->
                            <a href="edit_brosur.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></a>
                            <a href="hapus_brosur.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data?');"><i class="bi bi-trash-fill"></i></a>
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
