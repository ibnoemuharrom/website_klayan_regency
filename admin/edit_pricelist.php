<?php

include 'include/koneksi.php';
session_start();

if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
  echo "<script>location='login.php';</script>";
}

// query data
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM daftar_harga WHERE id='$id'");
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
            <h1 class="h2"><i class="bi bi-file-image"></i> Edit Daftar Harga</h1>
          </div>

          <div class="row mt-3 mb-5">
            <div class="col-md-12">
              <div class="card border-left-primary shadow h-100">
              <h6 class="card-header">Edit Daftar Harga Klayan Regency</h6>
              <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" class="form-control" id="id" readonly="readonly" value="<?= $row['id']; ?>">
                  <div class="mb-3">
                    <p><label class="form-label">Preview File Brosur</label></p>
                    <iframe src="data_pdf/<?= $row['file']; ?>" frameborder="0" width="50%"></iframe>
                  </div>
                  <div class="mb-3">
                    <label for="file" class="form-label">File Brosur</label>
                    <input type="file" name="file" class="form-control" id="file">
                    <p class="text-small text-danger">*Ukuran file maksimal 2MB</p>
                  </div>
                  <button type="submit" class="btn btn-sm btn-success" name="save">Update Data</button>
                  <button type="reset" class="btn btn-sm btn-danger">Batal</button>
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

                    if (!empty($source)) {
                      move_uploaded_file($source, $folder.$nama_file);
                      $query = mysqli_query($koneksi, "UPDATE daftar_harga SET id='$id', file='$nama_file' WHERE id='$id'");
                    } else {
                      $query = mysqli_query($koneksi, "UPDATE daftar_harga SET id='$id' WHERE id='$id'");
                    }

                      if ($query) 
                        {
                            echo "<script>location='input_pricelist.php?update-success';</script>";
                        } else {
                            echo "<script>location='input_pricelist.php?update-failed';</script>";
                        }
                  }

                }

                ?>
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
