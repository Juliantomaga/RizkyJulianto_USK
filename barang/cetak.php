<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$sql = "SELECT barang.id_barang,supplier.nama_supplier,barang.nama_barang,barang.stok,barang.harga_perkilo
        FROM barang
        INNER JOIN supplier ON barang.id_supplier = supplier.id_supplier ORDER BY barang.id_barang";
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
             <a href="../transaksi/index.php" class="navbar-brand fw-bold text-light">App Sayuran</a>

             <ul class="navbar-nav me-auto mt-1">
                 <li class="nav-item">
                     <a href="../pembeli/index.php" class="nav-link active text-light">Pembeli</a>
                 </li>
                 <li class="nav-item">
                     <a href="index.php" class="nav-link active text-light">Barang</a>
                 </li>
                 <li class="nav-item">
                     <a href="../supplier/index.php" class="nav-link active text-light">Supplier</a>
                 </li>
             </ul>
             <form  class="d-flex">
                 <a href="../logout.php" class="btn btn-outline-danger " onclick="return confirm('Apakah anda yakin ingin Logout?');">Logout</a>
             </form>
         </div>
     </nav> -->
     <div class="container">
         <h1 class="text-center mt-4">Data Barang</h1>
         <table class="table table-striped mt-4 text-center">
             <tr>
                 <th>ID Barang</th>
                 <th>Nama Supplier</th>
                 <th>Nama Barang</th>
                 <th>Stok</th>
                 <th>Harga Perkilo</th>
             </tr>

             <?php 
             while($data = mysqli_fetch_assoc($query)) {
             ?>
                    <tr>
                        <td><?=$data['id_barang']?></td>
                        <td><?=$data['nama_supplier']?></td>
                        <td><?=$data['nama_barang']?></td>
                        <td><?=$data['stok']?></td>
                        <td><?=$data['harga_perkilo']?></td>
                        <!-- <td>
                            <a href="edit.php?id_barang=<?=$data['id_barang']?>" class="btn btn-warning">Edit</a>|
                            <a href="hapus.php?id_barang=<?=$data['id_barang']?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin hapus data?');">Hapus</a>
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
    window.onafterprint=function() {
        history.back();
    }
</script>
 </body>
 </html>l