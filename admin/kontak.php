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
            <h1 class="h2"><i class="bi bi-chat-left-text"></i> Kontak Masuk</h1>
          </div>

          <div class="row my-3">
            <div class="col-md-12">
              <div class="card border-left-primary shadow h-100">
                <h6 class="card-header">Data Rumah Klayan Regency</h6>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-md">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>No. HP / Whatsapp</th>
                          <th>Option</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM contact ORDER BY id DESC");
                        while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $row['nama']; ?></td>
                          <td><?= $row['email']; ?></td>
                          <td><?= $row['no_hp']; ?></td>
                          <td>
                            <!-- detail pesan -->
                            <button class="btn btn-sm btn-primary" role="button" data-bs-toggle="modal" data-bs-target="#previewpesan">
                              Detail <i class="bi bi-eyeglasses"></i>
                            </button>
                            <div class="modal fade" id="previewpesan" tabindex="-1" aria-labelledby="previewpesan" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Detail Pesan :</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <p><?= $row['pesan']; ?></p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-success rounded-0" data-bs-dismiss="modal">Close</button>
                                    <a href="https://wa.me/<?= $row['no_hp']; ?>" class="btn btn-outline-success rounded-0" target="_blank">Balas Pesan <i class="bi bi-whatsapp"></i></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- end detail pesan -->

                            <a href="hapus_kontak.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data?');"><i class="bi bi-trash-fill"></i></a>
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
