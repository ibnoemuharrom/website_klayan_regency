<?php

include 'include/koneksi.php';
session_start();

if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
  echo "<script>location='login.php';</script>";
}

// query data
$id_pembayaran = $_GET['id_pembayaran'];
$query = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_pembayaran='$id_pembayaran'");
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
            <h1 class="h2"><i class="bi bi-person-plus"></i> Edit Data Pembayaran</h1>
          </div>

          <div class="row mt-3 mb-5">
            <div class="col-md-12">
              <div class="card border-left-primary shadow h-100">
              <h6 class="card-header">Input Data Pembeli</h6>
              <div class="card-body">
                <form method="post">
                  <div class="row"> 
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="id" class="form-label">ID Pembayaran</label>
                        <input type="number" name="id_pembayaran" class="form-control" id="id" readonly="readonly" value="<?= $row['id_pembayaran']; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="id_pembeli" class="form-label">ID Pembeli</label>
                        <input type="number" name="id_pembeli" class="form-control" id="id_pembeli" readonly="readonly" value="<?= $row['id_pembeli']; ?>">
                      </div>
                    </div>
                  </div>                  
                  <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan Pembayaran</label>
                    <input type="text" name="keterangan" class="form-control" value="<?= $row['keterangan']; ?>">
                    <small class="text-success">Contoh: Angsuran Pembayaran Ke-1</small>
                  </div>
                  <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Pembayaran</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $row['tanggal']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="pembayaran" class="form-label">Jumlah Pembayaran</label>
                    <input type="number" name="pembayaran" class="form-control" value="<?= $row['pembayaran']; ?>">
                  </div>
                  <button type="submit" class="btn btn-sm btn-success" name="edit">Edit Pembayaran</button>
                  <button type="reset" class="btn btn-sm btn-danger">Batal</button>
                </form>
                <?php
                if (isset($_POST['edit'])) {

                  $id_pembayaran = $_POST['id_pembayaran'];
                  $id_pembeli = $_POST['id_pembeli'];
                  $keterangan = $_POST['keterangan'];
                  $tanggal = $_POST['tanggal'];
                  $pembayaran = $_POST['pembayaran'];

                  $query = mysqli_query($koneksi, "UPDATE pembayaran SET id_pembayaran='$id_pembayaran', id_pembeli='$id_pembeli', keterangan='$keterangan', tanggal='$tanggal', pembayaran='$pembayaran' WHERE id_pembayaran='$id_pembayaran'");

                    if ($query) 
                      {
                          echo "<script>location='pembeli.php?update-payment-success';</script>";
                      } else {
                          echo "<script>location='pembeli.php?update-payment-failed';</script>";
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
