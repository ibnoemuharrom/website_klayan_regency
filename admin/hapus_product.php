<?php

include 'include/koneksi.php';

$id_product = $_GET['id_product'];
$query = mysqli_query($koneksi, "DELETE FROM product WHERE id_product='$id_product'");
if ($query) {
	echo "<script>location='product.php';</script>";
} else {
	echo "<script>location='product.php?delete-failed';</script>";
}

?>