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
              <h6 class="card-header">Input Produk</h6>
              <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="number" name="id_produk" class="form-control" id="id" readonly="readonly" placeholder="ID Produk">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" placeholder="Judul">
                  </div>
                  <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Type Rumah</label>
                    <select name="type_rumah" class="form-control" id="type_rumah">
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
                    <input type="text" name="harga" class="form-control" placeholder="Harga Rumah">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Luas Bangunan M<sup>2</sup></label>
                    <input type="text" name="lb" class="form-control" placeholder="Luas Bangunan">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Luas Tanah M<sup>2</sup></label>
                    <input type="text" name="lt" class="form-control" placeholder="Luas Tanah">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Jumlah Kamar Tidur</label>
                    <input type="text" name="jumlah_kt" class="form-control" placeholder="Jumlah Kamar Tidur">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Jumlah Kamar Mandi</label>
                    <input type="text" name="jumlah_km" class="form-control" placeholder="Jumlah Kamar Mandi">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Jumlah Carport</label>
                    <input type="text" name="carport" class="form-control" placeholder="Jumlah Carport">
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Foto Rumah</label>
                    <input type="file" name="foto" class="form-control">
                    <p class="text-small text-danger">*Ukuran file maksimal 2MB</p>
                  </div>
                  <div class="mb-3">
                    <label for="type_rumah" class="form-label">Foto Denah Rumah</label>
                    <input type="file" name="foto_denah" class="form-control">
                    <p class="text-small text-danger">*Ukuran file maksimal 2MB</p>
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary" name="save">Simpan Data</button>
                  <button type="reset" class="btn btn-sm btn-danger">Batal</button>
                </form>
                <?php
                if (isset($_POST['save'])) {

                  $foto = $_FILES['foto']['name'];
                  $nama_foto = date('Ymd_His_').$foto;
                  $source_foto = $_FILES['foto']['tmp_name'];

                  $foto_denah = $_FILES['foto_denah']['name'];
                  $nama_foto_denah = date('Ymd_His_').$foto_denah;
                  $source_foto_denah = $_FILES['foto_denah']['tmp_name'];

                  $folder_foto = './product_img/';

                  move_uploaded_file($source_foto, $folder_foto.$nama_foto);
                  move_uploaded_file($source_foto_denah, $folder_foto.$nama_foto_denah);

                  $query = mysqli_query($koneksi, "INSERT INTO produk(id_produk,judul,deskripsi,type_rumah,harga,lb,lt,jumlah_kt,jumlah_km,carport,foto,foto_denah)VALUES('$_POST[id_produk]','$_POST[judul]','$_POST[deskripsi]','$_POST[type_rumah]','$_POST[harga]','$_POST[lb]','$_POST[lt]','$_POST[jumlah_kt]','$_POST[jumlah_km]','$_POST[carport]','$nama_foto','$nama_foto_denah')");

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

          <div class="row my-3">
            <div class="col-md-12">
              <div class="card border-left-primary shadow h-100">
                <h6 class="card-header">Data Produk</h6>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-md">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Judul</th>
                          <th>Type Rumah</th>
                          <th>Harga</th>
                          <th>LT</th>
                          <th>LB</th>
                          <th>KT</th>
                          <th>KM</th>
                          <th>Carport</th>
                          <th>Option</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM produk INNER JOIN type ON produk.type_rumah = type.id");
                        while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $row['judul']; ?></td>
                          <td><?= $row['type_rumah']; ?></td>
                          <td>Rp. <?= number_format($row['harga']); ?></td>
                          <td><?= $row['lb']; ?> M<sup>2</sup></td>
                          <td><?= $row['lt']; ?> M<sup>2</sup></td>
                          <td><?= $row['jumlah_kt']; ?> Unit</td>
                          <td><?= $row['jumlah_km']; ?> Unit</td>
                          <td><?= $row['carport']; ?> Unit</td>
                          <td>
                            <a href="edit_product.php?id_produk=<?= $row['id_produk']; ?>" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></a>
                            <a href="hapus_product.php?id_produk=<?= $row['id_produk']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data?');"><i class="bi bi-trash-fill"></i></a>
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
