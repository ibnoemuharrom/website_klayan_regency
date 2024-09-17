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
            <h1 class="h2"><i class="bi bi-house"></i> Dashboard</h1>
          </div>

          <div class="alert alert-success" id="alert-green" role="alert">
            Selamat Datang, <strong><?php echo $_SESSION['user']['nama']; ?></strong> <i class="bi bi-person-fill"></i>
          </div>

          <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2 bg-go-primary">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                  Jumlah Pembeli
                              </div>
                              <div class="h5 mb-0 font-weight-bold text-white">5</div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2 bg-go-primary">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                  Jumlah Rumah
                              </div>
                              <?php
                              $data_rumah = mysqli_query($koneksi, "SELECT * FROM data_rumah");
                              $jumlah_rumah = mysqli_num_rows($data_rumah);
                              ?>
                              <div class="h5 mb-0 font-weight-bold text-white"><?= $jumlah_rumah; ?></div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2 bg-go-primary">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                  Rumah Terjual
                              </div>
                              <?php
                              $data_terjual = mysqli_query($koneksi, "SELECT * FROM data_rumah WHERE status='terjual'");
                              $jumlah_terjual = mysqli_num_rows($data_terjual);
                              ?>
                              <div class="h5 mb-0 font-weight-bold text-white"><?= $jumlah_terjual; ?></div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2 bg-go-primary">
                  <div class="card-body">
                      <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                  Belum Terjual
                              </div>
                              <?php
                              $data_belum_terjual = mysqli_query($koneksi, "SELECT * FROM data_rumah WHERE status='belum_terjual'");
                              $jumlah_belum_terjual = mysqli_num_rows($data_belum_terjual);
                              ?>
                              <div class="h5 mb-0 font-weight-bold text-white"><?= $jumlah_belum_terjual; ?></div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>

          <div class="row my-3">
            <div class="col-md-12">
              <div class="card border-left-primary shadow h-100">
                <div class="card-header">
                  <span class="text-primary-bold">Data Rumah <i class="bi bi-house-fill"></i></span>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">No. Rumah</th>
                          <th scope="col">Type Rumah</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM data_rumah INNER JOIN type ON data_rumah.type_rumah = type.id ORDER BY data_rumah.id_rumah LIMIT 5");
                        while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $row['no_rumah']; ?></td>
                          <td><?= $row['type_rumah']; ?></td>
                          <td>
                          <?php
                          if ($row['status'] == 'terjual') {
                            echo "<p class='text-success'>Rumah Terjual</p>";
                          } else {
                            echo "<p class='text-danger'>Belum Terjual</p>";
                          }
                          ?>
                          </td>
                          <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="data_rumah.php" class="text-primary-bold text-decoration-none">Lihat Selengkapnya..</a>
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
