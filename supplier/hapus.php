<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$id_supplier = $_GET['id_supplier'];
$sql = "DELETE  FROM supplier WHERE id_supplier = '$id_supplier'";
$query = mysqli_query($koneksi,$sql);
if($query) {
    echo '<script>alert("Data Berhasil Di hapus");window.location.href="index.php"</script>';
} else {
    echo '<script>alert("Data Gagal Di hapus");window.location.href="index.php"</script>';
}
?>