<?php

include 'include/koneksi.php';

$id_rumah = $_GET['id_rumah'];
$query = mysqli_query($koneksi, "DELETE FROM data_rumah WHERE id_rumah='$id_rumah'");
if ($query) {
	echo "<script>location='data_rumah.php';</script>";
} else {
	echo "<script>location='data_rumah.php?delete-failed';</script>";
}

?>