<?php

include 'include/koneksi.php';

$id_pembeli = $_GET['id_pembeli'];
$query = mysqli_query($koneksi, "DELETE FROM pembeli WHERE id_pembeli='$id_pembeli'");
if ($query) {
	echo "<script>location='pembeli.php';</script>";
} else {
	echo "<script>location='pembeli.php?delete-failed';</script>";
}

?>