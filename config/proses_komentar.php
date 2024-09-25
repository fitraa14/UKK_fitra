<?php
session_start();
include 'koneksi.php';

$fotoid = $_POST['fotoid'];
$userid = $_SESSION['userid'];
$isikomentar = $_POST['isikomentar'];
$tanggalkoemtar = date('Y-m-d');

$query = mysqli_query($koneksi, "INSERT INTO komentarfoto VALUES('','$fotoid','$userid','$isikomentar','$tanggalkoemtar')");

echo "<script>
location.href='../admin/index.php';
</script>";

?>