<?php
include 'admin/include/koneksi.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klayan Regency</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- style -->
    <link rel="stylesheet" href="admin/assets/css/home_style.css">
    <!-- sweetalert -->
    <link rel="stylesheet" href="admin/assets/css/sweetalert.css">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <!-- favicon -->
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="admin/assets/favicon/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="admin/assets/favicon/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="admin/assets/favicon/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="admin/assets/favicon/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="admin/assets/favicon/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="admin/assets/favicon/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="admin/assets/favicon/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="admin/assets/favicon/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="admin/assets/favicon/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="admin/assets/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="admin/assets/favicon/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="admin/assets/favicon/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="admin/assets/favicon/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="mstile-310x310.png" />
  </head>
  <body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-success navbar-dark shadow-sm fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="admin/assets/images/logo.png" alt="logo" width="220" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            <a class="nav-link" href="#about">About</a>
            <a class="nav-link" href="#product">Produk</a>
            <a class="nav-link" href="#contact">Contact</a>
            <a class="nav-link" href="#offer">Pricelist</a>
            <a class="nav-link" href="admin/login.php"><i class="bi bi-box-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </nav>
    <!-- end navbar -->

    <!-- jumbotron -->
    <?php
    $jumbotron = mysqli_query($koneksi, "SELECT * FROM header");
    $row = mysqli_fetch_array($jumbotron, MYSQLI_ASSOC);
    ?>
    <div class="jumbotron mt-5" id="jumbotron">
      <div class="container">
        <div class="row justify-content-between align-items-center">
          <div class="col-md-7 mb-4">
            <h1 class="display-6 text-success">Perumahan Klayan Regency</h1>
            <p class="lead"><?= $row['deskripsi']; ?></p>
            <!-- modal brosur -->
            <?php
            $modalbrosur = mysqli_query($koneksi, "SELECT * FROM brosur");
            $rowmodalbrosur = mysqli_fetch_array($modalbrosur, MYSQLI_ASSOC);
            ?>
             <button class="btn btn-success rounded-0" role="button" data-bs-toggle="modal" data-bs-target="#modalbrosur">
              Dapatkan Brosur <i class="bi bi-file-earmark-richtext"></i>
            </button>
            <div class="modal fade" id="modalbrosur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Brosur Perumahan Klayan Regency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <embed src="admin/data_pdf/<?= $rowmodalbrosur['file']; ?>" width="100%" height="100%">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success rounded-0" data-bs-dismiss="modal">Close</button>
                    <a href="admin/data_pdf/<?= $rowmodalbrosur['file']; ?>" target="_blank Unit" download="Brosur Rumah Klayan Regency.pdf" class="btn btn-outline-success rounded-0">Download</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- end modal brosur -->
            <a href="https://wa.me/+6281320015010/?text=Saya%20tertarik%20ingin%20bertanya%20tentang%20rumah%20yang%20dijual%20di%20Perumahan%20Klayan%20Regency" class="btn btn-outline-success rounded-0" target="_blank">Whatsapp <i class="bi bi-whatsapp"></i></a>
          </div>
          <div class="col-md-5">
            <img src="admin/page_img/<?= $row['image_header']; ?>" class="img-fluid" alt="images">
          </div>
        </div>
      </div>
    </div>
    <!-- end jumbotron -->

    <!-- question -->
    <section id="question" class="bg-success my-5">
      <div class="container text-white">
        <div class="row pt-5">
          <div class="col text-center">
            <h3>Kenapa Harus Klayan Regency ?</h3>
            <p>- Hunian Nyaman Keluarga, Lokasi Strategis -</p>
          </div>
        </div>
        <div class="row text-center pt-4 pb-5">
          <div class="col-md-3">
            <h3 class="display-5"><i class="bi bi-house-heart-fill"></i></h3>
            <p class="fw-semibold">Desain Modern dan Minimalis</p>
            <p>Perumahan Klayan Regency merupakan hunian ekslusif serta mempunyai desain yang modern dan minimalis serta dilengkapi dengan fasilitas terbaik demi kemudahan dan kenyaman anda.</p>
          </div>
          <div class="col-md-3">
            <h3 class="display-5"><i class="bi bi-pin-map-fill"></i></h3>
            <p class="fw-semibold">Lokasi Strategis</p>
            <p>Lokasi strategis dan mudah dijangkau serta dekat dengan fasilitas umum seperti sekolah, rumah sakit, pasar tradisional, pertamina hingga pusat perbelanjaan.</p>
          </div>
          <div class="col-md-3">
            <h3 class="display-5"><i class="bi bi-water"></i></h3>
            <p class="fw-semibold">Lokasi Bebas Banjir</p>
            <p>Lingkungan sekitar perumahan Klayan Regency masih memiliki serapan air yang sangat baik saat hujan turun, kondisi seperti ini yang menjadikan perumahan klayan regency bebas banjir.</p>
          </div>
          <div class="col-md-3">
            <h3 class="display-5"><i class="bi bi-shield-fill-check"></i></h3>
            <p class="fw-semibold">Harga Terjangkau</p>
            <p>Perumahan Klayan Regency menawarkan harga yang sangat terjangkau, persyaratan dan proses yang cukup mudah, serta menggunakan sistem pembayaran bank syariah dan bebas riba.</p>
          </div>
        </div>
      </div>
    </section>
    <!-- end question -->

    <!-- about -->
    <?php
    $about = mysqli_query($koneksi, "SELECT * FROM about");
    $row = mysqli_fetch_array($about, MYSQLI_ASSOC);
    ?>
    <section id="about">
      <div class="container my-5">
        <div class="text-center">
          <h3 class="text-success">Tentang Klayan Rengency</h3>
        </div>
        <div class="row pt-4 align-items-center">
          <div class="col-md-5 mb-3">
            <img src="admin/page_img/<?= $row['image_about']; ?>" class="img-fluid" alt="images">
          </div>
          <div class="col-md-7">
            <p class="lead"><?= $row['deskripsi']; ?></p>
            <h3 class="mb-3 text-success"><i class="bi bi-quote"></i> Hunian Nyaman keluarga, Lokasi Strategis </h3>
            <a class="btn btn-success rounded-0" href="https://wa.me/+6281320015010/?text=Saya%20tertarik%20ingin%20bertanya%20tentang%20rumah%20yang%20dijual%20di%20Perumahan%20Klayan%20Regency" target="_blank" role="button">Whatsapp <i class="bi bi-whatsapp"></i></a>
          </div>
        </div>
      </div>
    </section>
    <!-- end about -->

    <!-- facilities -->
    <section id="facilities" class="bg-success my-5">
      <div class="container text-white">
        <div class="row pt-5">
          <div class="col text-center">
            <h3>Fasilitas Terdekat</h3>
          </div>
        </div>
        <div class="row pt-4 pb-5">
          <div class="col-md-4">
            <h3 class="display-6"><i class="bi bi-hospital-fill"></i></h3>
            <p class="fw-semibold">Rumah Sakit</p>
            <p>Perumahan Klayan Regency memiliki jarak yang dekat dengan Rumah Sakit Pertamina Cirebon (1.4 KM) dan LMC Klinik Medical Center (1.7 KM)</p>
          </div>
          <div class="col-md-4">
            <h3 class="display-6"><i class="bi bi-bank2"></i></h3>
            <p class="fw-semibold">Sekolah</p>
            <p>Perumahan Klayan Regency memiliki jarak yang dekat dengan SD Negri 4 Klayan (450 M) dan SMK Patriot Kota Cirebon (1.4 KM)</p>
          </div>
          <div class="col-md-4">
            <h3 class="display-6"><i class="bi bi-speedometer2"></i></h3>
            <p class="fw-semibold">Transportasi</p>
            <p>Perumahan Klayan Regency memiliki jarak dengan transportasi umum seperti Stasiun Kejaksan (3.6 M) dan Stasiun Prujakan (6.0 KM)</p>
          </div>
          <div class="col-md-4">
            <h3 class="display-6"><i class="bi bi-shop"></i></h3>
            <p class="fw-semibold">Pusat Belanja</p>
            <p>Perumahan Klayan Regency memiliki jarak dengan pusat perbelanjaan seperti pasar tradisional villa intan (1.2 KM) dan Grage Mall Cirebon (4.6 KM)</p>
          </div>
          <div class="col-md-4">
            <h3 class="display-6"><i class="bi bi-shop-window"></i></h3>
            <p class="fw-semibold">Rumah Makan</p>
            <p>Perumahan Klayan Regency memiliki jarak dengan rumah makan ayam penyet surabaya klayan (1.2 KM) dan rumah makan Mekar Sari (2.8 KM)</p>
          </div>
          <div class="col-md-4">
            <h3 class="display-6"><i class="bi bi-sunrise"></i></h3>
            <p class="fw-semibold">Tempat Wisata</p>
            <p>Perumahan Klayan Regency memiliki jarak dengan wisata religi Makam Sunan Gunung Jati (2.6 KM) dan Alun - alun kejaksan kota cirebon (3.9 KM)</p>
          </div>
        </div>
      </div>
    </section>
    <!-- end facilities -->

    <!-- product -->
    <section id="product">
      <div class="container my-5">
        <div class="row py-4">
          <div class="col text-center">
            <h3 class="text-success">Produk Klayan Regency</h3>
          </div>
        </div>
        <div class="row">
          <?php
          $produk = mysqli_query($koneksi, "SELECT * FROM produk INNER JOIN type ON produk.type_rumah = type.id");
          while($rowproduk = mysqli_fetch_array($produk, MYSQLI_ASSOC)) {
          ?>
          <div class="col-md-4 mb-3">
            <div class="card shadow-sm rounded-0">
              <img src="admin/product_img/<?= $rowproduk['foto']; ?>" class="card-img-top rounded-0" alt="images">
              <div class="card-body">
                <h5 class="card-title"><?= $rowproduk['judul']; ?></h5>
                <p class="card-text"><?= $rowproduk['deskripsi']; ?></p>
                <a href="https://wa.me/+6281320015010/?text=Saya%20tertarik%20ingin%20bertanya%20tentang%20<?= $rowproduk['judul']; ?>%20yang%20dijual%20di%20Perumahan%20Klayan%20Regency" target="_blank" class="btn btn-success rounded-0"><i class="bi bi-whatsapp"></i> Whatsapp</a>
                <!-- modal detail rumah -->
                <button class="btn btn-outline-success rounded-0" role="button" data-bs-toggle="modal" data-bs-target="#modalproduct">
                  Detail Unit <i class="bi bi-arrow-right"></i>
                </button>
                <div class="modal fade" id="modalproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Perumahan Klayan Regency</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-6">
                            <img src="admin/product_img/<?= $rowproduk['foto']; ?>" alt="images" class="img-fluid mb-3">
                          </div>
                          <div class="col-md-6">
                            <h3><?= $rowproduk['judul']; ?></h3>
                            <p><?= $rowproduk['deskripsi']; ?></p>
                            <div class="row">
                              <div class="col-md-6">
                                <p><i class="bi bi-arrows-fullscreen"></i> LT : <?= $rowproduk['lt']; ?> M<sup>2</sup></p>
                                <p><i class="bi bi-water"></i> Kamar Mandi : <?= $rowproduk['jumlah_km']; ?></p>
                                <p><i class="bi bi-shop-window"></i> Carport : <?= $rowproduk['carport']; ?></p>
                              </div>
                              <div class="col-md-6">
                                <p><i class="bi bi-building"></i> LB : <?= $rowproduk['lb']; ?> M<sup>2</sup></p>
                                <p><i class="bi bi-inbox"></i> Kamar Tidur : <?= $rowproduk['jumlah_km']; ?></p>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12 mt-3">
                            <p>Denah Rumah :</p>
                            <div class="row justify-content-center">
                              <div class="col-md-10">
                                <img src="admin/product_img/<?= $rowproduk['foto_denah']; ?>" class="img-fluid" alt="images">
                              </div>
                            </div>      
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-success rounded-0" data-bs-dismiss="modal">Close</button>
                        <a href="https://wa.me/+6281320015010/?text=Saya%20tertarik%20ingin%20bertanya%20tentang%20rumah%20yang%20dijual%20di%20Perumahan%20Klayan%20Regency" target="_blank" class="btn btn-outline-success rounded-0">Whatsapp <i class="bi bi-whatsapp"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end modal detail rumah -->
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <!-- end product -->


    <!-- location -->
    <section id="location" class="bg-success my-5">
      <div class="container text-white">
        <div class="row pt-5">
          <div class="col text-center">
            <h3>Lokasi & Akses Klayan Regency</h3>
          </div>
        </div>
        <div class="row align-items-center justify-content-center py-5">
          <div class="col-md-5 mb-3">
            <p>Perumahan Klayan Regency terletak di Jalan Raya Klayan Kecamatan Gunung Jati Kabupaten Cirebon. Klayan Regency dapat dijangkau dari Kota Cirebon dan Kota Indramayu.</p>
            <p>Silahkan klik tombol dibawah untuk melihat google maps Perumahan Klayan Regency.</p>
            <a href="https://www.google.co.id/maps/place/Perumahan+Klayan+Regency+2/@-6.6792386,108.5483388,17z/data=!3m1!4b1!4m5!3m4!1s0x2e6ee3f9349f21c7:0x23ac54581a07165c!8m2!3d-6.6792317!4d108.5505249" class="btn btn-pricelist rounded-0 text-white" target="_blank">Google Maps <i class="bi bi-pin-map"></i></a>
          </div>
          <div class="col-md-4 mb-3">
            <img src="admin/assets/images/denah.png" class="img-fluid" alt="images">
          </div>
        </div>
      </div>
    </section>
    <!-- end location -->

    <!-- contact -->
    <section id="contact">
      <div class="container my-5">
        <div class="row justify-content-center">
          <div class="col-md-9">
            <h3 class="text-success text-center">Tim Marketing Siap Membantu</h3>
            <p class="text-center">Membeli properti merupakan keputusan finansial paling penting dalam hidup, Tim marketing Perumahan Klayan Regency selalu siap membantu setiap langkahnya. Isi formulir berikut, kami akan menghubungi anda kembali.</p>
            <form method="post">
              <input type="hidden" name="id">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Alamat Email">
              </div>
              <div class="mb-3">
                <label for="No_hp" class="form-label">No Telepon / Whatsapp</label>
                <input type="number" name="no_hp" class="form-control" id="No_hp" placeholder="No Telepon">
              </div>
              <div class="mb-3">
                <label for="Pesan" class="form-label">Pesan</label>
                <textarea class="form-control" name="pesan" id="Pesan" placeholder="Pesan ..."></textarea>
              </div>
              <button type="submit" class="btn btn-success rounded-0" name="save">Kirim Pesan</button>
              <button type="reset" class="btn btn-danger rounded-0">Batal <i class="bi bi-x"></i></button>
            </form>
            <?php
            if (isset($_POST['save'])) {
              $contact = mysqli_query($koneksi, "INSERT INTO contact(id,nama,email,no_hp,pesan)VALUES('$_POST[id]','$_POST[nama]','$_POST[email]','$_POST[no_hp]','$_POST[pesan]')");
              if ($contact) {
                  echo "
                      <script type='text/javascript'>
                      setTimeout(function () { 
                              
                        swal({
                                  title: 'Pesan Anda Terkirim.',
                                  text: 'Tim marketing kami akan segera menghubungi anda.',
                                  type: 'success',
                                  timer: 15000,
                                  showConfirmButton: true
                              });   
                      },10);  
                      window.setTimeout(function(){ 
                        window.location.replace('index.php');
                      } ,2000); 
                        </script>";
                } else {
                  echo "
                      <script type='text/javascript'>
                      setTimeout(function () { 
                              
                        swal({
                                  title: 'Pesan Tidak Terkirim!.',
                                  type: 'error',
                                  timer: 5000,
                                  showConfirmButton: true
                              });   
                      },10);  
                      window.setTimeout(function(){ 
                        window.location.replace('index.php');
                      } ,2000); 
                        </script>";
                }
            }

            ?>
          </div>
        </div>
      </div>
    </section>
    <!-- end contact -->

    <!-- offer -->
    <section id="offer">
      <div class="container mt-5">
        <div class="row py-5">
          <div class="col text-center text-white">
            <h3>DAPATKAN SEGERA RUMAH IMPIAN ANDA!</h3>
            <p>Dengan Harga Penawaran Terbaik, serta Berbagai Promo Yang Tersedia.</p>
            <a href="https://wa.me/+6281320015010/?text=Saya%20tertarik%20ingin%20bertanya%20tentang%20rumah%20yang%20dijual%20di%20Perumahan%20Klayan%20Regency" target="_blank" class="btn btn-success rounded-0">Whatsapp <i class="bi bi-whatsapp"></i></a>
            <!-- modal pricelist -->
            <?php
            $modalharga = mysqli_query($koneksi, "SELECT * FROM daftar_harga");
            $rowmodalharga = mysqli_fetch_array($modalharga, MYSQLI_ASSOC);
            ?>
            <button class="btn btn-pricelist rounded-0 text-white" role="button" data-bs-toggle="modal" data-bs-target="#modalpricelist">
              Pricelist Perumahan <i class="bi bi-download"></i>
            </button>
            <div class="modal fade" id="modalpricelist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:black;">Daftar Harga Klayan Regency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <embed src="admin/data_pdf/<?= $rowmodalharga['file']; ?>" width="100%" height="100%">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-0" data-bs-dismiss="modal">Close</button>
                    <a href="admin/data_pdf/<?= $rowmodalharga['file']; ?>" target="_blank" download="Pricelist Rumah Klayan Regency.pdf" class="btn btn-outline-primary rounded-0">Download</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- end modal pricelist -->
          </div>
        </div>
      </div>
    </section>
    <!-- end offer -->

    <!-- footer -->
    <footer id="footer" class="bg-success">
      <div class="container py-4">
        <div class="row text-white">
          <p class="text-center">&copy; 2022 Perumahan Klayan Regency. All Right Reserved</p>
        </div>
      </div>
    </footer>
    <!-- end footer -->

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <!-- sweetalert js -->
    <script src="admin/assets/js/sweetalert.min.js"></script>
  </body>
</html>