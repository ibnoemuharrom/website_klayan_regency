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
$id_pembayaran = $_GET['id_pembayaran'];
$query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN pembeli ON pembayaran.id_pembeli = pembeli.id_pembeli WHERE id_pembayaran='$id_pembayaran'");
$row = mysqli_fetch_array($query, MYSQLI_ASSOC);


// fungsi terbilang
function penyebut($nilai) {
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " ". $huruf[$nilai];
  } else if ($nilai <20) {
    $temp = penyebut($nilai - 10). " belas";
  } else if ($nilai < 100) {
    $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " seratus" . penyebut($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " seribu" . penyebut($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
  }     
  return $temp;
}

function terbilang($nilai) {
  if($nilai<0) {
    $hasil = "minus ". trim(penyebut($nilai));
  } else {
    $hasil = trim(penyebut($nilai));
  }         
  return $hasil;
}

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bukti Pembayaran</title>
  <style>
  .nominal {
    background-color: green;
    color: white;
  }
  </style>
</head>
<body>
    <table width="100%" align="center">
      <!-- header -->
      <tr>
        <td width="50%">
          <p>
            PERUMAHAN KLAYAN REGENCY<br>
            <small>Jl. Raya Klayan Gang. Gunung Laya Kota Cirebon.</small>
            <small>Email : klayanregnecy@gmail.com</small>
            <small>No. HP : 081320015010</small>
          </p>
        </td>
        <td width="50%" align="right" colspan="2">
          <p><b><u>KWITANSI PEMBAYARAN</u></b></p>
          <p>Nomor Kwitansi : '.$row["id_pembayaran"].'</p>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <br><br>
        </td>
      </tr>
      <!-- isi -->
      <tr>
        <td>Telah Diterima Dari</td>
        <td colspan="2">: '.$row["nama"].'</td>
      </tr>
      <tr>
        <td>Sejumlah Uang</td>
        <td colspan="2">: '.ucwords(terbilang($row["pembayaran"])).' Rupiah</td>
      </tr>
      <tr>
        <td>Untuk Pembayaran</td>
        <td colspan="2">: '.$row["keterangan"].'</td>
      </tr>
      <tr>
        <td colspan="3">
          <br>
        </td>
      </tr>
      <!-- footer -->
      <tr>
        <td width="50%">
          <h2 class="nominal" align="center">Rp '.number_format($row["pembayaran"]).'</h2>
          <table border="1">
            <td align="center">
              <p>Pembayaran dengan Bilyet atau Cheque akan dianggap sah setelah dapat dicairkan.</p>
            </td>
          </table>
        </td>
        <td width="50%" align="center" colspan="2">
          <p><b>Cirebon, '.$row["tanggal"].'</b></p>
          <br><br><br>
          <p><u>Ike Supriyati</u></p>
        </td>
      </tr>
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
$dompdf->stream("Bukti-pembayaran", array("Attachment"=>0));

?>