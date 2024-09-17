<?php

include 'include/koneksi.php';
session_start();

if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
  echo "<script>location='login.php';</script>";
}

// query data
$id_rumah = $_GET['id_rumah'];
$query = mysqli_query($koneksi, "SELECT * FROM data_rumah INNER JOIN type ON data_rumah.type_rumah = type.id WHERE id_rumah='$id_rumah'");
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
            <h1 class="h2"><i class="bi bi-house-fill"></i> Data Rumah</h1>
          </div>

          <div class="row mt-3 mb-5">
            <div class="col-md-12">
              <div class="card border-left-primary shadow h-100">
              <h6 class="card-header">Edit Data Rumah</h6>
              <div class="card-body">
                <form method="post">
                  <input type="hidden" name="id_rumah" class="form-control" id="id_rumah" readonly="readonly" value="<?= $row['id_rumah']; ?>">
                  <div class="mb-3">
                    <label for="no_rumah" class="form-label">Nomor Rumah</label>
                    <input type="text" name="no_rumah" class="form-control" id="no_rumah" value="<?= $row['no_rumah']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Type Rumah</label>
                    <select name="type_rumah" class="form-control" id="type_rumah">
                      <option value="<?= $row['id']; ?>"><?= $row['type_rumah']; ?></option>
                      <option>- Type Rumah -</option>
                      <?php
                      $data = mysqli_query($koneksi, "SELECT * FROM type");
                      while($data_type = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                        echo "<option value='$data_type[id]'>$data_type[type_rumah]</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control" id="status">
                      <option>- Status Rumah -</option>
                      <?php
                      if ($row['status'] == 'terjual') {
                        echo "
                        <option value='terjual' selected>Terjual</option>
                        <option value='belum_terjual'>Belum Terjual</option>";
                      } elseif ($row['status'] == 'belum_terjual') {
                        echo "
                        <option value='terjual'>Terjual</option>
                        <option value='belum_terjual' selected>Belum Terjual</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-sm btn-success" name="update">Update Data</button>
                </form>
                <?php
                if (isset($_POST['update'])) {
                  $query = mysqli_query($koneksi, "UPDATE data_rumah SET id_rumah='$_POST[id_rumah]', no_rumah='$_POST[no_rumah]', type_rumah='$_POST[type_rumah]', status='$_POST[status]' WHERE id_rumah='$id_rumah'");

                  if ($query) {
                    echo "<script>location='data_rumah.php?update-success';</script>";
                  } else {
                    echo "<script>location='data_rumah.php?update-failed';</script>";
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
