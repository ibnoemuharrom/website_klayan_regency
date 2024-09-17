<?php

include 'include/koneksi.php';

$id_pembayaran = $_GET['id_pembayaran'];
$query = mysqli_query($koneksi, "DELETE FROM pembayaran WHERE id_pembayaran='$id_pembayaran'");
if ($query) {
	echo "<script>location='pembeli.php?delete-payment-success';</script>";
} else {
	echo "<script>location='pembeli.php?delete-payment-failed';</script>";
}

?>