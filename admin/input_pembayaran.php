<?php

include 'include/koneksi.php';
session_start();

if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
  echo "<script>location='login.php';</script>";
}

// query data
$id_pembeli = $_GET['id_pembeli'];
$query = mysqli_query($koneksi, "SELECT * FROM pembeli WHERE id_pembeli='$id_pembeli'");
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
            <h1 class="h2"><i class="bi bi-person-plus"></i> Input Data Pembayaran</h1>
          </div>

          <div class="row mt-3 mb-5">
            <div class="col-md-12">
              <!-- alert -->
              <?php
              if (isset($_GET['failed'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" role="alert">
                Data gagal disimpan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <div class="card border-left-primary shadow h-100">
              <h6 class="card-header">Input Data Pembeli</h6>
              <div class="card-body">
                <form method="post">
                  <div class="mb-3">
                    <label for="id" class="form-label">ID Pembayaran</label>
                    <input type="number" name="id_pembayaran" class="form-control" id="id" readonly="readonly" placeholder="ID Pembayaran">
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="id_pembeli" class="form-label">ID Pembeli</label>
                        <input type="number" name="id_pembeli" class="form-control" id="id_pembeli" readonly="readonly" value="<?= $row['id_pembeli']; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" readonly="readonly" value="<?= $row['nama']; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label class="form-label">Harga Rumah</label>
                        <input class="form-control" readonly="readonly" value="Rp. <?= number_format($row['jumlah_pembayaran']); ?>">
                      </div>
                    </div>  
                  </div>                  
                  <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan Pembayaran</label>
                    <input type="text" name="keterangan" class="form-control" placeholder="Keterangan Pembayaran">
                    <small class="text-success">Contoh: Angsuran Pembayaran Ke-1</small>
                  </div>
                  <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Pembayaran</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="pembayaran" class="form-label">Jumlah Pembayaran</label>
                    <input type="number" name="pembayaran" class="form-control" placeholder="Jumlah Pembayaran">
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary" name="save">Simpan Pembayaran</button>
                  <button type="reset" class="btn btn-sm btn-danger">Batal</button>
                </form>
                <?php
                if (isset($_POST['save'])) {

                  $id_pembayaran = $_POST['id_pembayaran'];
                  $id_pembeli = $_POST['id_pembeli'];
                  $keterangan = $_POST['keterangan'];
                  $tanggal = $_POST['tanggal'];
                  $pembayaran = $_POST['pembayaran'];

                  $query = mysqli_query($koneksi, "INSERT INTO pembayaran(id_pembayaran,id_pembeli,keterangan,tanggal,pembayaran)VALUES('$id_pembayaran','$id_pembeli','$keterangan','$tanggal','$pembayaran')");

                    if ($query) 
                      {
                          echo "<script>location='pembayaran.php?id_pembeli=$row[id_pembeli]';</script>";
                      } else {
                          echo "<script>location='input_pembayaran.php?failed';</script>";
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
