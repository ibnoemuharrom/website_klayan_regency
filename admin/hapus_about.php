<?php

include 'include/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM about WHERE id='$id'");
if ($query) {
	echo "<script>location='about.php';</script>";
} else {
	echo "<script>location='about.php?delete-failed';</script>";
}

?>