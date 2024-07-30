<?php
session_start(); 
include "koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM user WHERE username='$username'AND password=md5('$password')";
$query = mysqli_query($koneksi,$sql);

   
if(mysqli_num_rows($query) > 0) {
    echo '<script>alert("Anda Berhasil Login");window.location.href="transaksi/index.php"</script>';
    $_SESSION['login'] = "$username";
} else {    
    echo '<script>alert("Anda Gagal Login");window.location.href="login.php"</script>';
}
?>