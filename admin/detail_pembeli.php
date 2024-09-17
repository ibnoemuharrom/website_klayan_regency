<?php

include 'include/koneksi.php';
session_start();

if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
  echo "<script>location='login.php';</script>";
}

// query data
$id_pembeli = $_GET['id_pembeli'];
$query = mysqli_query($koneksi, "SELECT * FROM pembeli INNER JOIN type ON pembeli.type_rumah = type.id WHERE id_pembeli='$id_pembeli'");
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
            <h1 class="h2"><i class="bi bi-people-fill"></i> Detail Data Pembeli</h1>
          </div>

          <div class="row my-3">
            <div class="col-md-12">
              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th> Nama</th>
                    <td>:</td>
                    <td> <?php echo $row['nama']; ?></td>
                  </tr>
                  <tr>
                    <th> Alamat</th>
                    <td>:</td>
                    <td> <?php echo $row['alamat']; ?></td>
                  </tr>
                  <tr>
                    <th> No. Handphone</th>
                    <td>:</td>
                    <td> <?php echo $row['no_hp']; ?></td>
                  </tr>
                  <tr>
                    <th> Jumlah Pembayaran</th>
                    <td>:</td>
                    <td> Rp. <?php echo number_format($row['jumlah_pembayaran']); ?></td>
                  </tr>
                  <tr>
                    <th> Type Rumah</th>
                    <td>:</td>
                    <td> <?php echo $row['type_rumah']; ?></td>
                  </tr>
                  <tr>
                    <th> Nomor Rumah</th>
                    <td>:</td>
                    <td> <?php echo $row['no_rumah']; ?></td>
                  </tr>
                  <tr>
                    <th> Scan Foto KTP</th>
                    <td>:</td>
                    <td> <img src="data_scan/<?= $row['foto_ktp']; ?>" alt="images" width="300" class="img-thumbnail"></td>
                  </tr>
                  <tr>
                    <th> Scan Foto Kartu Keluarga</th>
                    <td>:</td>
                    <td> <img src="data_scan/<?= $row['foto_kk']; ?>" alt="images" width="300" class="img-thumbnail"></td>
                  </tr>
                  <tr>
                    <th> Scan Foto Surat Nikah</th>
                    <td>:</td>
                    <td> <img src="data_scan/<?= $row['foto_suratnikah']; ?>" alt="images" width="300" class="img-thumbnail"></td>
                  </tr>
                  <tr>
                    <th> Scan Foto NPWP</th>
                    <td>:</td>
                    <td> <img src="data_scan/<?= $row['foto_npwp']; ?>" alt="images" width="300" class="img-thumbnail"></td>
                  </tr>
                </tbody>
              </table>
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
