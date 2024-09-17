<?php

include 'include/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM brosur WHERE id='$id'");
if ($query) {
	echo "<script>location='input_brosur.php';</script>";
} else {
	echo "<script>location='input_brosur.php?delete-failed';</script>";
}

?>