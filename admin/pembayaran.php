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

// sum pembayaran
$sql = mysqli_query($koneksi, "SELECT SUM(pembayaran) AS tot_pembayaran FROM pembayaran WHERE id_pembeli='$id_pembeli'");
while ($data_pembayaran = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
  $tot_pembayaran = $data_pembayaran['tot_pembayaran'];
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
            <h1 class="h2"><i class="bi bi-card-checklist"></i> Data Pembayaran</h1>
          </div>

          <a href="input_pembayaran.php?id_pembeli=<?= $row['id_pembeli']; ?>" class="btn btn-primary btn-sm">Input Pembayaran <i class="bi bi-journal-plus"></i></a>

          <div class="row my-3">
            <div class="col-md-12">
              <div class="card border-left-primary shadow h-100">
                <div class="card-header">Data Pembeli</div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-md">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>No. Handphone</th>
                          <th>Harga Rumah</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?= $row['nama']; ?></td>
                          <td><?= $row['no_hp']; ?></td>
                          <td>Rp <?= number_format($row['jumlah_pembayaran']); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row my-3">
            <div class="col-md-12">
              <div class="card border-left-primary shadow h-100">
                <h6 class="card-header">Data Pembayaran</h6>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-md">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Keterangan</th>
                          <th>Tanggal Pembayaran</th>
                          <th>Jumlah Pembayaran</th>
                          <th>Option</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $pembayaran = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_pembeli='$id_pembeli'");
                        while($data = mysqli_fetch_array($pembayaran, MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $data['keterangan']; ?></td>
                          <td><?= $data['tanggal']; ?></td>
                          <td>Rp <?= number_format($data['pembayaran']); ?></td>
                          <td>
                            <a href="bukti_pembayaran.php?id_pembayaran=<?= $data['id_pembayaran']; ?>" class="btn btn-sm btn-primary" target="_blank">Bukti <i class="bi bi-printer"></i></a>
                            <a href="edit_pembayaran.php?id_pembayaran=<?= $data['id_pembayaran']; ?>" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></a>
                            <a href="hapus_pembayaran.php?id_pembayaran=<?= $data['id_pembayaran']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data?');"><i class="bi bi-trash-fill"></i></a>
                          </td>
                        </tr>
                        <?php } ?>
                        <!-- total pembayaran -->
                        <tr>
                          <td colspan="3" class="text-center fw-bold">Total Pembayaran</td>
                          <td colspan="2" class="fw-bold">Rp <?= number_format($tot_pembayaran); ?></td>
                        </tr>
                        <!-- sisa pembayaran -->
                        <tr>
                          <td colspan="3" class="text-center fw-bold">Sisa Pembayaran</td>
                          <td colspan="2" class="fw-bold">
                            <?php
                            // saldo
                            $harga_rumah = $row['jumlah_pembayaran'];
                            $saldo = $harga_rumah - $tot_pembayaran;
                            ?>
                            Rp <?= number_format($saldo); ?>
                          </td>
                        </tr>
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
