<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$nama_supplier = $_POST['nama_supplier'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];


$sql2 = "INSERT INTO supplier(nama_supplier,alamat,no_hp) VALUES ('$nama_supplier','$alamat','$no_hp')"; 
$query2 = mysqli_query($koneksi,$sql2);

if($query2) {
    echo '<script>alert("Data Berhasil DiTambahkan");window.location.href="index.php"</script>';
} else {
    echo '<script>alert("Data Gagal DiTambahkan");window.location.href="index.php"</script>';
}
?>