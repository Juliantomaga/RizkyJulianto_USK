<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$id_barang = $_GET['id_barang'];
$sql = "DELETE  FROM barang WHERE id_barang = '$id_barang'";
$query = mysqli_query($koneksi,$sql);
if($query) {
    echo '<script>alert("Data Berhasil DIHapus");window.location.href="index.php"</script>';
} else {
    echo '<script>alert("Data Gagal DiHapus");window.location.href="index.php"</script>';
}
?>