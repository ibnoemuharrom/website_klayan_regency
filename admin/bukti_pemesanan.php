<?php

include 'include/koneksi.php';
require_once 'assets/dompdf/autoload.inc.php';
session_start();

if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
  echo "<script>location='login.php';</script>";
}

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

// query data
$id_pembeli = $_GET['id_pembeli'];
$query = mysqli_query($koneksi, "SELECT * FROM pembeli INNER JOIN type ON pembeli.type_rumah = type.id WHERE id_pembeli='$id_pembeli'");
$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bukti Pemesanan</title>
</head>
<body>
    <h3><center>Surat Bukti Pemesanan Rumah</center></h3>
    <br>
    <p>Saya yang bertanda tangan dibawah ini :
    <table class="table table-striped table-advance table-hover">
      <tbody>
        <tr>
          <td> Nama</td>
          <td>:</td>
          <td>'.$row['nama'].'</td>
        </tr>
        <tr>
          <td> Alamat</td>
          <td>:</td>
          <td>'.$row['alamat'].'</td>
        </tr>
        <tr>
          <td> No. Handphone</td>
          <td>:</td>
          <td>'.$row['no_hp'].'</td>
        </tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr>
        <td colspan="3">Dengan ini memesan untuk membeli sebidang tanah dan bangunan di atasnya yang terletak di perumahan Klayan regency.
        </td>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr>
          <td> Lokasi</td>
          <td>:</td>
          <td>Jl. Raya Klayan Desa Klayan Kecamatan Gunung Jati Kabupaten Cirebon</td>
        </tr>
        <tr>
          <td> Nomor Rumah</td>
          <td>:</td>
          <td>'.$row['no_rumah'].'</td>
        </tr>
        <tr>
          <td> Type Rumah</td>
          <td>:</td>
          <td>'.$row['type_rumah'].'</td>
        </tr>
        <tr>
          <td> Harga Jual</td>
          <td>:</td>
          <td> Rp.'.number_format($row['jumlah_pembayaran']).'</td>
        </tr>
        <tr><td><br></td></tr>
        <tr><td><br></td></tr>
        <tr><td><br></td></tr>
        <tr>
        <td width="50%" align="center" colspan="2">
          <p><b>Pembeli</b></p>
          <br><br><br>
          <p><u>'.$row['nama'].'</u></p>
        </td>
        <td width="50%" align="center" colspan="2">
          <p><b>Penjual</b></p>
          <br><br><br>
          <p><u>Ike Supriyati</u></p>
        </td>
      </tr>
      </tbody>
    </table>
</body>
</html>
';

// function call html file
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'potrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Bukti-pemesanan", array("Attachment"=>0));

?>