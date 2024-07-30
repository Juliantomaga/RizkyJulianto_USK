<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$id_pembeli = $_POST['id_pembeli'];
$id_barang = $_POST['id_barang'];
$jumlah = $_POST['jumlah'];
$tgl_transaksi = $_POST['tgl_transaksi'];

$sql  = "SELECT * FROM barang WHERE id_barang = '$id_barang'";
$query = mysqli_query($koneksi,$sql);

while($barang = mysqli_fetch_assoc($query)) {
    $stok  = $barang['stok']; 
    if($jumlah > $stok) {
        echo '<script>alert("Jumlah Melebihi Stok yang ada!!");window.location.href="index.php"</script>';
    } else{
        $sql2 = "INSERT INTO transaksi(id_pembeli,id_barang,jumlah,tgl_transaksi) VALUES ('$id_pembeli', '$id_barang','$jumlah','$tgl_transaksi')"; 
        $query2 = mysqli_query($koneksi,$sql2);
        
        if($query2) {
            echo '<script>alert("Data Berhasil ditambahkan");window.location.href="index.php"</script>';
        } else {
            echo '<script>alert("Data Gagal ditambahkan");window.location.href="index.php"</script>';
        }
    }
}
?>