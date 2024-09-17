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
            <h1 class="h2"><i class="bi bi-person-plus"></i> Input Data Pembeli</h1>
          </div>

          <div class="row mt-3 mb-5">
            <div class="col-md-12">
              <!-- alert -->
              <?php
              if (isset($_GET['failed'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" role="alert">
                Data gagal disimpan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php } ?>
              <div class="card border-left-primary shadow h-100">
              <h6 class="card-header">Input Data Pembeli</h6>
              <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="number" name="id_pembeli" class="form-control" id="id" readonly="readonly" placeholder="ID Pembeli">
                  </div>
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                  </div>
                  <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="no_hp" class="form-label">No. Handphone</label>
                    <input type="number" name="no_hp" class="form-control" placeholder="No. Handphone">
                  </div>
                  <div class="mb-3">
                    <label for="jumlah_pembayaran" class="form-label">Harga Rumah</label>
                    <input type="number" name="jumlah_pembayaran" class="form-control" placeholder="Harga Rumah">
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
                    <label for="no_rumah" class="form-label">No Rumah</label>
                    <select name="no_rumah" class="form-control" id="no_rumah">
                      <option>- No Rumah -</option>
                      <?php
                      $data_rumah = mysqli_query($koneksi, "SELECT no_rumah FROM data_rumah");
                      while($data = mysqli_fetch_array($data_rumah, MYSQLI_ASSOC)) {
                        echo "<option value='$data[no_rumah]'>$data[no_rumah]</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="foto_ktp" class="form-label">Scan Foto KTP</label>
                    <input type="file" name="foto_ktp" class="form-control">
                    <p class="text-small text-danger">*Ukuran foto maksimal 2MB</p>
                  </div>
                  <div class="mb-3">
                    <label for="foto_kk" class="form-label">Scan Foto Kartu Keluarga</label>
                    <input type="file" name="foto_kk" class="form-control">
                    <p class="text-small text-danger">*Ukuran foto maksimal 2MB</p>
                  </div>
                  <div class="mb-3">
                    <label for="foto_suratnikah" class="form-label">Scan Foto Surat Nikah <small class="text-success">(Jika Ada)</small></label>
                    <input type="file" name="foto_suratnikah" class="form-control">
                    <p class="text-small text-danger">*Ukuran foto maksimal 2MB</p>
                  </div>
                  <div class="mb-3">
                    <label for="foto_npwp" class="form-label">Scan Foto NPWP</label>
                    <input type="file" name="foto_npwp" class="form-control">
                    <p class="text-small text-danger">*Ukuran foto maksimal 2MB</p>
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary" name="save">Simpan Data</button>
                  <button type="reset" class="btn btn-sm btn-danger">Batal</button>
                </form>
                <?php
                if (isset($_POST['save'])) {

                  $id_pembeli = $_POST['id_pembeli'];
                  $nama = $_POST['nama'];
                  $alamat = $_POST['alamat'];
                  $no_hp = $_POST['no_hp'];
                  $jumlah_pembayaran = $_POST['jumlah_pembayaran'];
                  $type_rumah = $_POST['type_rumah'];
                  $no_rumah = $_POST['no_rumah'];

                  $foto_ktp = $_FILES['foto_ktp']['name'];
                  $nama_foto_ktp = date('Ymd_His_').$foto_ktp;
                  $source_foto_ktp = $_FILES['foto_ktp']['tmp_name'];

                  $foto_kk = $_FILES['foto_kk']['name'];
                  $nama_foto_kk = date('Ymd_His_').$foto_kk;
                  $source_foto_kk = $_FILES['foto_kk']['tmp_name'];

                  $foto_suratnikah = $_FILES['foto_suratnikah']['name'];
                  $nama_foto_suratnikah = date('Ymd_His_').$foto_suratnikah;
                  $source_foto_suratnikah = $_FILES['foto_suratnikah']['tmp_name'];

                  $foto_npwp = $_FILES['foto_npwp']['name'];
                  $nama_foto_npwp = date('Ymd_His_').$foto_npwp;
                  $source_foto_npwp = $_FILES['foto_npwp']['tmp_name'];

                  $folder_foto = './data_scan/';

                  move_uploaded_file($source_foto_ktp, $folder_foto.$nama_foto_ktp);
                  move_uploaded_file($source_foto_kk, $folder_foto.$nama_foto_kk);
                  move_uploaded_file($source_foto_suratnikah, $folder_foto.$nama_foto_suratnikah);
                  move_uploaded_file($source_foto_npwp, $folder_foto.$nama_foto_npwp);

                  $query = mysqli_query($koneksi, "INSERT INTO pembeli(id_pembeli,nama,alamat,no_hp,jumlah_pembayaran,type_rumah,no_rumah,foto_ktp,foto_kk,foto_suratnikah,foto_npwp)VALUES('$id_pembeli','$nama','$alamat','$no_hp','$jumlah_pembayaran','$type_rumah','$no_rumah','$nama_foto_ktp','$nama_foto_kk','$nama_foto_suratnikah','$nama_foto_npwp')");

                    if ($query) 
                      {
                          echo "<script>location='pembeli.php?success';</script>";
                      } else {
                          echo "<script>location='input_pembeli.php?failed';</script>";
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
