<?php

include 'include/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM user WHERE id='$id'");
if ($query) {
	echo "<script>location='logout.php';</script>";
}

?>