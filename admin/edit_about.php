<?php

include 'include/koneksi.php';
session_start();

if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
  echo "<script>location='login.php';</script>";
}

// query data
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM about WHERE id='$id'");
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
            <h1 class="h2"><i class="bi bi-file"></i> Halaman About</h1>
          </div>

          <div class="row mt-3 mb-5">
            <div class="col-md-12">
              <div class="card border-left-primary shadow h-100">
              <h6 class="card-header">Edit Data Halaman About</h6>
              <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" class="form-control" id="id" readonly="readonly" value="<?= $row['id']; ?>">
                  <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control"><?= $row['deskripsi']; ?></textarea>
                  </div>
                  <div class="mb-3">
                    <div class="form-group">
                      <img src="page_img/<?php echo $row['image_about'];?>" class="img img-rounded" width="400px">
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="image_about" class="form-label">Image About</label>
                    <input type="file" name="image_about" class="form-control" id="image_about">
                    <p class="text-small text-danger">*Ukuran file maksimal 2MB</p>
                  </div>
                  <button type="submit" class="btn btn-sm btn-success" name="update">Update Data</button>
                </form>
                <?php

                  if (isset($_POST['update'])) 
                  {
                      $id = $_POST['id'];
                      $deskripsi = $_POST['deskripsi'];

                      $nama_file = $_FILES['image_about']['name'];
                      $nama_foto = date('YmdHis').$nama_file;
                      $source = $_FILES['image_about']['tmp_name'];
                      $folder = './page_img/';

                      if (!empty($source)) {
                        move_uploaded_file($source, $folder.$nama_foto);
                        $query = mysqli_query($koneksi, "UPDATE about SET id='$id', deskripsi='$deskripsi', image_about='$nama_foto' WHERE id='$id'");
                      } else {
                        $query = mysqli_query($koneksi, "UPDATE about SET id='$id', deskripsi='$deskripsi' WHERE id='$id'");
                      }

                        if ($query) 
                        {
                            echo "<script>location='page_about.php?update-success';</script>";
                        } else {
                            echo "<script>location='page_about.php?update-failed';</script>";
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
