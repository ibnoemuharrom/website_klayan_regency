<?php

include 'include/koneksi.php';
session_start();

if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
  echo "<script>location='login.php';</script>";
}

// query data
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM type WHERE id='$id'");
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
            <h1 class="h2"><i class="bi bi-house"></i> Type Rumah</h1>
          </div>

          <div class="row mt-3 mb-5">
            <div class="col-md-12">
              <div class="card border-left-primary shadow h-100">
              <h6 class="card-header">Edit Data Type Rumah</h6>
              <div class="card-body">
                <form method="post">
                  <input type="hidden" name="id" class="form-control" id="id" readonly="readonly" value="<?= $row['id']; ?>">
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Type Rumah</label>
                    <input type="text" name="type_rumah" class="form-control" id="type_rumah" value="<?= $row['type_rumah'] ?>">
                  </div>
                  <button type="submit" class="btn btn-sm btn-success" name="update">Update Data</button>
                </form>
                <?php
                if (isset($_POST['update'])) {
                  $query = mysqli_query($koneksi, "UPDATE type SET id='$_POST[id]', type_rumah='$_POST[type_rumah]' WHERE id='$id'");
                  if ($query) {
                    echo "<script>location='type_rumah.php?update-success';</script>";
                  } else {
                    echo "<script>location='type_rumah.php?update-failed';</script>";
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
