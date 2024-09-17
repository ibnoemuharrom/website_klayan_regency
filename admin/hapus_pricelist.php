<?php

include 'include/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM daftar_harga WHERE id='$id'");
if ($query) {
	echo "<script>location='input_pricelist.php';</script>";
} else {
	echo "<script>location='input_pricelist.php?delete-failed';</script>";
}

?>