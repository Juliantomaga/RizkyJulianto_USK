<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$sql = "SELECT transaksi.id_transaksi, pembeli.nama_pembeli,barang.nama_barang,transaksi.jumlah,transaksi.tgl_transaksi
        FROM transaksi
        INNER JOIN pembeli ON transaksi.id_pembeli = pembeli.id_pembeli
        INNER JOIN barang ON transaksi.id_barang = barang.id_barang ORDER BY transaksi.id_transaksi";
        $query = mysqli_query($koneksi,$sql);
?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
     <title>Document</title>
 </head>
 <body>
     <!-- <nav class="navbar navbar-expand-lg bg-dark">
         <div class="container-fluid">
             <a href="" class="navbar-brand fw-bold text-light">App Sayuran</a>

             <ul class="navbar-nav me-auto mt-1">
                 <li class="nav-item">
                     <a href="" class="nav-link active text-light">Pembeli</a>
                 </li>
                 <li class="nav-item">
                     <a href="" class="nav-link active text-light">Barang</a>
                 </li>
                 <li class="nav-item">
                     <a href="" class="nav-link active text-light">Supplier</a>
                 </li>
             </ul>
             <form  class="d-flex">
                 <a href="" class="btn btn-outline-danger ">Logout</a>
             </form>
         </div>
     </nav> -->
     <div class="container">
         <h1 class="text-center mt-4">Data Transaksi</h1>
         <table class="table table-striped mt-4 text-center">
             <tr>
                 <th>ID Transaksi</th>
                 <th>Nama Pembeli</th>
                 <th>Nama Barang</th>
                 <th>Jumlah</th>
                 <th>Tanggal Transaksi</th>
             </tr>

             <?php 
             while($data = mysqli_fetch_assoc($query)) {
             ?>
                    <tr>
                        <td><?=$data['id_transaksi']?></td>
                        <td><?=$data['nama_pembeli']?></td>
                        <td><?=$data['nama_barang']?></td>
                        <td><?=$data['jumlah']?></td>
                        <td><?=$data['tgl_transaksi']?></td>
                        <!-- <td>
                            <a href="edit.php?id_transaksi=<?=$data['id_transaksi']?>" class="btn btn-warning">Edit</a>|
                            <a href="hapus.php?id_transaksi=<?=$data['id_transaksi']?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin hapus data?');">Hapus</a>
                        </td> -->
                    </tr>
             <?php }?>
         </table>
         <!-- <a href="tambah.php" class="btn btn-primary
         ">Tambah</a>
         <a href="cetak.php" class="btn btn-secondary">Cetak</a> -->
     </div>

     <script>
         window.print();
         window.onafterprint=function(){
             history.back();
         }
     </script>
 </body>
 </html>l