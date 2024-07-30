<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$id_pembeli = $_GET['id_pembeli'];
$sql = "DELETE  FROM pembeli WHERE id_pembeli = '$id_pembeli'";
$query = mysqli_query($koneksi,$sql);
if($query) {
    echo '<script>alert("Data Berhasil DiHapus");window.location.href="index.php"</script>';
} else {
    echo '<script>alert("Data Gagal DiHapus");window.location.href="index.php"</script>';
}
?>