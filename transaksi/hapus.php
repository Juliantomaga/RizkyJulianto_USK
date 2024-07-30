<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$id_transaksi = $_GET['id_transaksi'];
$sql = "DELETE  FROM transaksi WHERE id_transaksi = '$id_transaksi'";
$query = mysqli_query($koneksi,$sql);
if($query) {
    echo '<script>alert("Data Berhasil Di hapus");window.location.href="index.php"</script>';
} else {
    echo '<script>alert("Data gagal dihapus);window.location.href="index.php"</script>';
}
?>