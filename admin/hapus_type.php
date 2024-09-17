<?php

include 'include/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM type WHERE id='$id'");
if ($query) {
	echo "<script>location='type.php';</script>";
} else {
	echo "<script>location='type.php?delete-failed';</script>";
}

?>