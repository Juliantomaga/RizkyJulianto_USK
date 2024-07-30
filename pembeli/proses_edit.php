<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$id_pembeli = $_POST['id_pembeli'];
$nama_pembeli = $_POST['nama_pembeli'];
$no_hp = $_POST['no_hp'];


$sql2 = "UPDATE pembeli SET nama_pembeli = '$nama_pembeli', no_hp = '$no_hp' WHERE id_pembeli = '$id_pembeli'"; 
$query2 = mysqli_query($koneksi,$sql2);

if($query2) {
    echo '<script>alert("Data Berhasil Diubah");window.location.href="index.php"</script>';
} else {
    echo '<script>alert("Data Gagal Diubah");window.location.href="index.php"</script>';
}
?>