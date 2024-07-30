<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$nama_pembeli = $_POST['nama_pembeli'];
$no_hp = $_POST['no_hp'];


$sql2 = "INSERT INTO pembeli(nama_pembeli,no_hp) VALUES ('$nama_pembeli','$no_hp')"; 
$query2 = mysqli_query($koneksi,$sql2);

if($query2) {
    echo '<script>alert("Data Berhasil Ditambahkan");window.location.href="index.php"</script>';
} else {
    echo '<script>alert("Data Gagal Ditambahkan");window.location.href="index.php"</script>';
}
?>