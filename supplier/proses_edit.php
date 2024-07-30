<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$id_supplier = $_POST['id_supplier'];
$nama_supplier = $_POST['nama_supplier'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];


$sql2 = "UPDATE supplier SET nama_supplier = '$nama_supplier', no_hp = '$no_hp', alamat='$alamat' WHERE id_supplier = '$id_supplier'"; 
$query2 = mysqli_query($koneksi,$sql2);

if($query2) {
    echo '<script>alert("Data Berhasil Diubah");window.location.href="index.php"</script>';
} else {
    echo '<script>alert("Data gagal Diubah");window.location.href="index.php"</script>';
}
?>