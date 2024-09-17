<?php
include 'include/koneksi.php';

session_start();
// destroy
session_destroy();

echo "<script>location='login.php';</script>";

?>