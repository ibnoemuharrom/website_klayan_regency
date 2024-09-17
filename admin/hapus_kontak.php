<?php

include 'include/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM contact WHERE id='$id'");
if ($query) {
	echo "<script>location='kontak.php';</script>";
} else {
	echo "<script>location='kontak.php?delete-failed';</script>";
}

?>