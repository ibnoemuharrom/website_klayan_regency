<?php

include 'include/koneksi.php';
session_start();

if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
  echo "<script>location='login.php';</script>";
}

// query data
$id_pembeli = $_GET['id_pembeli'];
$query = mysqli_query($koneksi, "SELECT * FROM pembeli INNER JOIN type ON pembeli.type_rumah = type.id WHERE id_pembeli='$id_pembeli'");
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
            <h1 class="h2"><i class="bi bi-pencil-square"></i> Edit Data Pembeli</h1>
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
              <h6 class="card-header">Edit Data Pembeli</h6>
              <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id_pembeli" class="form-control" id="id" readonly="readonly" value="<?= $row['id_pembeli']; ?>">
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= $row['nama']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control"><?= $row['alamat']; ?></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="no_hp" class="form-label">No. Handphone</label>
                    <input type="number" name="no_hp" class="form-control" value="<?= $row['no_hp']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran</label>
                    <input type="number" name="jumlah_pembayaran" class="form-control" value="<?= $row['jumlah_pembayaran']; ?>">
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
                    <label for="no_rumah" class="form-label">No Rumah</label>
                    <select name="no_rumah" class="form-control" id="no_rumah">
                      <option value="<?= $row['no_rumah']; ?>"><?= $row['no_rumah']; ?></option>
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
                    <img src="data_scan/<?= $row['foto_ktp']; ?>" alt="images" width="300" class="img-thumbnail">
                  </div>
                  <div class="mb-3">
                    <label for="foto_ktp" class="form-label">Scan Foto KTP</label>
                    <input type="file" name="foto_ktp" class="form-control">
                    <p class="text-small text-danger">*Ukuran foto maksimal 2MB</p>
                  </div>
                  <div class="mb-3">
                    <img src="data_scan/<?= $row['foto_kk']; ?>" alt="images" width="300" class="img-thumbnail">
                  </div>
                  <div class="mb-3">
                    <label for="foto_kk" class="form-label">Scan Foto Kartu Keluarga</label>
                    <input type="file" name="foto_kk" class="form-control">
                    <p class="text-small text-danger">*Ukuran foto maksimal 2MB</p>
                  </div>
                  <div class="mb-3">
                    <img src="data_scan/<?= $row['foto_suratnikah']; ?>" alt="images" width="300" class="img-thumbnail">
                  </div>
                  <div class="mb-3">
                    <label for="foto_suratnikah" class="form-label">Scan Foto Surat Nikah <small class="text-success">(Jika Ada)</small></label>
                    <input type="file" name="foto_suratnikah" class="form-control">
                    <p class="text-small text-danger">*Ukuran foto maksimal 2MB</p>
                  </div>
                  <div class="mb-3">
                    <img src="data_scan/<?= $row['foto_npwp']; ?>" alt="images" width="300" class="img-thumbnail">
                  </div>
                  <div class="mb-3">
                    <label for="foto_npwp" class="form-label">Scan Foto NPWP</label>
                    <input type="file" name="foto_npwp" class="form-control">
                    <p class="text-small text-danger">*Ukuran foto maksimal 2MB</p>
                  </div>
                  <button type="submit" class="btn btn-sm btn-success" name="update">Update Data</button>
                  <button type="reset" class="btn btn-sm btn-danger">Batal</button>
                </form>
                <?php
                if (isset($_POST['update'])) {

                  $id_pembeli = $_POST['id_pembeli'];
                  $nama = $_POST['nama'];
                  $alamat = $_POST['alamat'];
                  $no_hp = $_POST['no_hp'];
                  $jumlah_pembayaran = $_POST['jumlah_pembayaran'];
                  $type_rumah = $_POST['type_rumah'];
                  $no_rumah = $_POST['no_rumah'];

                  // foto ktp
                  $foto_ktp = $_FILES['foto_ktp']['name'];
                  $nama_foto_ktp = date('Ymd_His_').$foto_ktp;
                  $source_foto_ktp = $_FILES['foto_ktp']['tmp_name'];

                  // foto kk
                  $foto_kk = $_FILES['foto_kk']['name'];
                  $nama_foto_kk = date('Ymd_His_').$foto_kk;
                  $source_foto_kk = $_FILES['foto_kk']['tmp_name'];

                  // foto surat nikah
                  $foto_suratnikah = $_FILES['foto_suratnikah']['name'];
                  $nama_foto_suratnikah = date('Ymd_His_').$foto_suratnikah;
                  $source_foto_suratnikah = $_FILES['foto_suratnikah']['tmp_name'];

                  // foto npwp
                  $foto_npwp = $_FILES['foto_npwp']['name'];
                  $nama_foto_npwp = date('Ymd_His_').$foto_npwp;
                  $source_foto_npwp = $_FILES['foto_npwp']['tmp_name'];

                  $folder_foto = './data_scan/';

                  if (!empty($source_foto_ktp && $source_foto_kk && $source_foto_suratnikah && $source_foto_npwp)) {

                    move_uploaded_file($source_foto_ktp, $folder_foto.$nama_foto_ktp);
                    move_uploaded_file($source_foto_kk, $folder_foto.$nama_foto_kk);
                    move_uploaded_file($source_foto_suratnikah, $folder_foto.$nama_foto_suratnikah);
                    move_uploaded_file($source_foto_npwp, $folder_foto.$nama_foto_npwp);

                    $query = mysqli_query($koneksi, "UPDATE pembeli SET id_pembeli='$id_pembeli', nama='$nama', alamat='$alamat', no_hp='$no_hp', jumlah_pembayaran='$jumlah_pembayaran', type_rumah='$type_rumah', no_rumah='$no_rumah', foto_ktp='$nama_foto_ktp', foto_kk='$nama_foto_kk', foto_suratnikah='$nama_foto_suratnikah', foto_npwp='$nama_foto_npwp' WHERE id_pembeli='$id_pembeli'");

                  } elseif (!empty($source_foto_ktp)) {

                    move_uploaded_file($source_foto_ktp, $folder_foto.$nama_foto_ktp);

                    $query = mysqli_query($koneksi, "UPDATE pembeli SET id_pembeli='$id_pembeli', nama='$nama', alamat='$alamat', no_hp='$no_hp', jumlah_pembayaran='$jumlah_pembayaran', type_rumah='$type_rumah', no_rumah='$no_rumah', foto_ktp='$nama_foto_ktp' WHERE id_pembeli='$id_pembeli'");

                  } elseif (!empty($source_foto_kk)) {

                    move_uploaded_file($source_foto_kk, $folder_foto.$nama_foto_kk);

                    $query = mysqli_query($koneksi, "UPDATE pembeli SET id_pembeli='$id_pembeli', nama='$nama', alamat='$alamat', no_hp='$no_hp', jumlah_pembayaran='$jumlah_pembayaran', type_rumah='$type_rumah', no_rumah='$no_rumah', foto_kk='$nama_foto_kk' WHERE id_pembeli='$id_pembeli'");

                  } elseif (!empty($source_foto_suratnikah)) {

                    move_uploaded_file($source_foto_suratnikah, $folder_foto.$nama_foto_suratnikah);

                    $query = mysqli_query($koneksi, "UPDATE pembeli SET id_pembeli='$id_pembeli', nama='$nama', alamat='$alamat', no_hp='$no_hp', jumlah_pembayaran='$jumlah_pembayaran', type_rumah='$type_rumah', no_rumah='$no_rumah', foto_suratnikah='$nama_foto_suratnikah' WHERE id_pembeli='$id_pembeli'");

                  } elseif (!empty($source_foto_npwp)) {

                    move_uploaded_file($source_foto_npwp, $folder_foto.$nama_foto_npwp);

                    $query = mysqli_query($koneksi, "UPDATE pembeli SET id_pembeli='$id_pembeli', nama='$nama', alamat='$alamat', no_hp='$no_hp', jumlah_pembayaran='$jumlah_pembayaran', type_rumah='$type_rumah', no_rumah='$no_rumah', foto_npwp='$nama_foto_npwp' WHERE id_pembeli='$id_pembeli'");
                  } else {

                    $query = mysqli_query($koneksi, "UPDATE pembeli SET id_pembeli='$id_pembeli', nama='$nama', alamat='$alamat', no_hp='$no_hp', jumlah_pembayaran='$jumlah_pembayaran', type_rumah='$type_rumah', no_rumah='$no_rumah' WHERE id_pembeli='$id_pembeli'");
                  }

                    if ($query) 
                      {
                          echo "<script>location='pembeli.php?update-success';</script>";
                      } else {
                          echo "<script>location='input_pembeli.php?update-failed';</script>";
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
