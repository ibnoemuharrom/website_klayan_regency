<?php

include 'include/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM header WHERE id='$id'");
if ($query) {
	echo "<script>location='header.php';</script>";
} else {
	echo "<script>location='header.php?delete-failed';</script>";
}

?>