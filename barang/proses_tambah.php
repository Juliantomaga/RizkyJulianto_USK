<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$id_supplier = $_POST['id_supplier'];
$nama_barang = $_POST['nama_barang'];
$stok = $_POST['stok'];
$harga_perkilo = $_POST['harga_perkilo'];

$sql2 = "INSERT INTO barang(id_supplier,nama_barang,stok,harga_perkilo) VALUES ('$id_supplier', '$nama_barang','$stok','$harga_perkilo')"; 
$query2 = mysqli_query($koneksi,$sql2);

if($query2) {
    echo '<script>alert("Data Berhasil DiTambahkan");window.location.href="index.php"</script>';
} else {
    echo '<script>alert("Data Gagal DiTambahkan");window.location.href="index.php"</script>';
}
?>