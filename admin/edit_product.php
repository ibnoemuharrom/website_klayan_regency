<?php

include 'include/koneksi.php';
session_start();

if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
  echo "<script>location='login.php';</script>";
}

// query data
$id_produk = $_GET['id_produk'];
$query = mysqli_query($koneksi, "SELECT * FROM produk INNER JOIN type ON produk.type_rumah = type.id WHERE id_produk='$id_produk'");
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
            <h1 class="h2"><i class="bi bi-box"></i> Produk Klayan Regency</h1>
          </div>

          <div class="row mt-3 mb-5">
            <div class="col-md-12">
              <!-- alert -->
              <?php
              if (isset($_GET['success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert" role="alert">
                Data berhasil disimpan.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <?php
              if (isset($_GET['failed'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" role="alert">
                Data gagal disimpan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <?php
              if (isset($_GET['update-success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert" role="alert">
                Update data berhasil.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <?php
              if (isset($_GET['update-failed'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" role="alert">
                Update data gagal!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <div class="card border-left-primary shadow h-100">
              <h6 class="card-header">Update Produk</h6>
              <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id_produk" class="form-control" id="id" value="<?= $row['id_produk']; ?>">
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?= $row['judul']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi"><?= $row['deskripsi']; ?></textarea>
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
                    <label for="type_rumah" class="form-label">Harga</label>
                    <input type="text" name="harga" class="form-control" value="<?= $row['harga']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Luas Bangunan M<sup>2</sup></label>
                    <input type="text" name="lb" class="form-control" value="<?= $row['lb']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Luas Tanah M<sup>2</sup></label>
                    <input type="text" name="lt" class="form-control" value="<?= $row['lt']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Jumlah Kamar Tidur</label>
                    <input type="text" name="jumlah_kt" class="form-control" value="<?= $row['jumlah_km']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Jumlah Kamar Mandi</label>
                    <input type="text" name="jumlah_km" class="form-control" value="<?= $row['jumlah_kt']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Jumlah Carport</label>
                    <input type="text" name="carport" class="form-control" value="<?= $row['carport']; ?>">
                  </div>
                  <div class="mb-3">
                    <img src="product_img/<?= $row['foto']; ?>" alt="images" width="400" class="img-thumbnail">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Foto Rumah</label>
                    <input type="file" name="foto" class="form-control">
                    <p class="text-small text-danger">*Ukuran file maksimal 2MB</p>
                  </div>
                  <div class="mb-3">
                    <img src="product_img/<?= $row['foto_denah']; ?>" alt="images" width="400" class="img-thumbnail">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Foto Denah Rumah</label>
                    <input type="file" name="foto_denah" class="form-control">
                    <p class="text-small text-danger">*Ukuran file maksimal 2MB</p>
                  </div>
                  <button type="submit" class="btn btn-sm btn-success" name="update">Update Data</button>
                  <button type="reset" class="btn btn-sm btn-danger">Batal</button>
                </form>
                <?php
                if (isset($_POST['update'])) {

                  $foto = $_FILES['foto']['name'];
                  $nama_foto = date('Ymd_His_').$foto;
                  $source_foto = $_FILES['foto']['tmp_name'];

                  $foto_denah = $_FILES['foto_denah']['name'];
                  $nama_foto_denah = date('Ymd_His_').$foto_denah;
                  $source_foto_denah = $_FILES['foto_denah']['tmp_name'];

                  $folder_foto = './product_img/';

                  if (!empty($source_foto && $source_foto_denah)) {

                    move_uploaded_file($source_foto, $folder_foto.$nama_foto);
                    move_uploaded_file($source_foto_denah, $folder_foto.$nama_foto_denah);

                    $query = mysqli_query($koneksi, " UPDATE produk SET id_produk='$_POST[id_produk]', judul='$_POST[judul]', deskripsi='$_POST[deskripsi]', type_rumah='$_POST[type_rumah]', harga='$_POST[harga]', lb='$_POST[lb]', lt='$_POST[lt]', jumlah_kt='$_POST[jumlah_kt]', jumlah_km='$_POST[jumlah_km]', carport='$_POST[carport]', foto='$nama_foto', foto_denah='$nama_foto_denah' WHERE id_produk='$id_produk'");

                  } elseif (!empty($source_foto)) {

                    move_uploaded_file($source_foto, $folder_foto.$nama_foto);

                    $query = mysqli_query($koneksi, " UPDATE produk SET id_produk='$_POST[id_produk]', judul='$_POST[judul]', deskripsi='$_POST[deskripsi]', type_rumah='$_POST[type_rumah]', harga='$_POST[harga]', lb='$_POST[lb]', lt='$_POST[lt]', jumlah_kt='$_POST[jumlah_kt]', jumlah_km='$_POST[jumlah_km]', carport='$_POST[carport]', foto='$nama_foto' WHERE id_produk='$id_produk'");

                  } elseif (!empty($source_foto_denah)) {

                    move_uploaded_file($source_foto_denah, $folder_foto.$nama_foto_denah);

                    $query = mysqli_query($koneksi, " UPDATE produk SET id_produk='$_POST[id_produk]', judul='$_POST[judul]', deskripsi='$_POST[deskripsi]', type_rumah='$_POST[type_rumah]', harga='$_POST[harga]', lb='$_POST[lb]', lt='$_POST[lt]', jumlah_kt='$_POST[jumlah_kt]', jumlah_km='$_POST[jumlah_km]', carport='$_POST[carport]', foto_denah='$nama_foto_denah' WHERE id_produk='$id_produk'");

                  } else {
                    
                    $query = mysqli_query($koneksi, " UPDATE produk SET id_produk='$_POST[id_produk]', judul='$_POST[judul]', deskripsi='$_POST[deskripsi]', type_rumah='$_POST[type_rumah]', harga='$_POST[harga]', lb='$_POST[lb]', lt='$_POST[lt]', jumlah_kt='$_POST[jumlah_kt]', jumlah_km='$_POST[jumlah_km]', carport='$_POST[carport]' WHERE id_produk='$id_produk'");
                  }

                    if ($query) 
                      {
                          echo "<script>location='product.php?success';</script>";
                      } else {
                          echo "<script>location='product.php?failed';</script>";
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
