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
            <h1 class="h2"><i class="bi bi-people-fill"></i> Data Pembeli</h1>
          </div>

          <div class="row my-3">
            <div class="col-md-12">
              <a href="input_pembeli.php" class="btn btn-primary btn-sm mb-3">Tambah Data Pembeli <i class="bi bi-plus"></i></a>
              <?php
              if (isset($_GET['success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show my-3" role="alert" role="alert">
                Data berhasil disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <?php
              if (isset($_GET['update-success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show my-3" role="alert" role="alert">
                Update data berhasil.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <?php
              if (isset($_GET['update-failed'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show my-3" role="alert" role="alert">
                Update data gagal!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <?php
              if (isset($_GET['delete-payment-success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show my-3" role="alert" role="alert">
                Pembayaran berhasil di hapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <?php
              if (isset($_GET['delete-payment-failed'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show my-3" role="alert" role="alert">
                Pembayaran gagal dihapus!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <?php
              if (isset($_GET['update-payment-success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show my-3" role="alert" role="alert">
                Pembayaran berhasil di update.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <?php
              if (isset($_GET['update-payment-failed'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show my-3" role="alert" role="alert">
                Pembayaran gagal diupdate!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <div class="card border-left-primary shadow h-100">
                <h6 class="card-header">Data Pembeli Klayan Regency</h6>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-md">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>No. HP</th>
                          <th>Jumlah Pembayaran</th>
                          <th>Type Rumah</th>
                          <th>No. Rumah</th>
                          <th>Option</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM pembeli INNER JOIN type ON pembeli.type_rumah = type.id");
                        while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $row['nama']; ?></td>
                          <td><?= $row['no_hp']; ?></td>
                          <td>Rp. <?= number_format($row['jumlah_pembayaran']); ?></td>
                          <td><?= $row['type_rumah']; ?></td>
                          <td><?= $row['no_rumah']; ?></td>
                          <td>
                            <a href="pembayaran.php?id_pembeli=<?= $row['id_pembeli']; ?>" class="btn btn-sm btn-success">Pembayaran <i class="bi bi-card-checklist"></i></a>
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                              Option
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="detail_pembeli.php?id_pembeli=<?= $row['id_pembeli']; ?>"><i class="bi bi-eyeglasses"></i> Detail</a></li>
                              <li><a class="dropdown-item" href="bukti_pemesanan.php?id_pembeli=<?= $row['id_pembeli']; ?>" target="_blank"><i class="bi bi-files"></i> Surat Pemesanan</a></li>
                              <li><a class="dropdown-item" href="edit_pembeli.php?id_pembeli=<?= $row['id_pembeli']; ?>"><i class="bi bi-pencil-square"></i> Update</a></li>
                              <li><a class="dropdown-item" href="hapus_pembeli.php?id_pembeli=<?= $row['id_pembeli']; ?>" onclick="return confirm('Apakah yakin ingin menghapus data?');"><i class="bi bi-trash-fill"></i> Hapus</a></li>
                            </ul>
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
