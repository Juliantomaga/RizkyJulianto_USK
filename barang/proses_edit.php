<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$id_barang = $_POST['id_barang'];
$id_supplier = $_POST['id_supplier'];
$nama_barang = $_POST['nama_barang'];
$stok = $_POST['stok'];
$harga_perkilo = $_POST['harga_perkilo'];

$sql2 = "UPDATE barang SET id_supplier = '$id_supplier', nama_barang = '$nama_barang', stok='$stok',harga_perkilo='$harga_perkilo' WHERE id_barang = '$id_barang'"; 
$query2 = mysqli_query($koneksi,$sql2);

if($query2) {
    echo '<script>alert("Data Berhasil Diubah");window.location.href="index.php"</script>';
} else {
    echo '<script>alert("Data Gagal Diubah");window.location.href="index.php"</script>';
}
?>