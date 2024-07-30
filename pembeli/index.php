<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$sql = "SELECT * FROM pembeli";
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
     <nav class="navbar navbar-expand-lg bg-dark">
         <div class="container-fluid">
             <a href="../transaksi/index.php" class="navbar-brand fw-bold text-light">App Sayuran</a>

             <ul class="navbar-nav me-auto mt-1">
                 <li class="nav-item">
                     <a href="index.php" class="nav-link active text-light">Pembeli</a>
                 </li>
                 <li class="nav-item">
                     <a href="../barang/index.php" class="nav-link active text-light">Barang</a>
                 </li>
                 <li class="nav-item">
                     <a href="../supplier/index.php" class="nav-link active text-light">Supplier</a>
                 </li>
             </ul>
             <form  class="d-flex">
                 <a href="../logout.php" class="btn btn-outline-danger " onclick="return confirm('Apakah anda yakin ingin Logout?');">Logout</a>
             </form>
         </div>
     </nav>
     <div class="container">
         <h1 class="text-center mt-4 fw-bold">Data Pembeli</h1>
         <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah</button>

<div class="modal fade" id="modalTambah">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Tambah Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
          <form action="proses_tambah.php" method="post">
          <label for="" class="form-label">Nama Pembeli</label>
          <input type="text" name="nama_pembeli" id="" class="form-control" required><br>
          <label for="" class="form-label">No HP</label>
          <input type="number" name="no_hp" id="" class="form-control" required><br>

          <input type="submit" value="Simpan" class="btn btn-success" onclick="return confirm('Apakah Anda Yakin ingin tambah data?');">
      </form>
      </div>
      </div>
  </div>
</div>
<a href="cetak.php" class="btn btn-secondary" style="float: right;">Cetak</a>

         <table class="table table-striped mt-4 text-center">
             <tr>
                 <th>ID Pembeli</th>
                 <th>Nama Pembeli</th>
                 <th>No HP</th>
                 <th>Aksi</th>
             </tr>

             <?php 
             while($data = mysqli_fetch_assoc($query)) {
             ?>
                    <tr>
                        <td><?=$data['id_pembeli']?></td>
                        <td><?=$data['nama_pembeli']?></td>
                        <td><?=$data['no_hp']?></td>
                        <td>
                           
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?=$data['id_pembeli']?>">Edit</button>
                            <a href="hapus.php?id_pembeli=<?=$data['id_pembeli']?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin hapus data?');">Hapus</a>
                        </td>
                    </tr>
                                      
<div class="modal fade" id="modalEdit<?=$data['id_pembeli']?>">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title fs-5">Edit Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="proses_edit.php" method="post">
        <input type="hidden" name="id_pembeli" value="<?=$data['id_pembeli']?>">
        

            <label for="" class="form-label">Nama pembeli</label>
            <input type="text" name="nama_pembeli" id="" class="form-control" required value="<?=$data['nama_pembeli']?>"><br>
            <label for="" class="form-label">No HP</label>
            <input type="number" name="no_hp" id="" class="form-control" required value="<?=$data['no_hp']?>"><br>

            <input type="submit" value="Simpan" class="btn btn-success" onclick="return confirm('Apakah Anda Yakin ingin ubah data?');">
        </form>
        <?php }?>
    </div>
        </div>
    </div>
         </table>
     
     </div>

     <script src="../js/bootstrap.bundle.min.js"></script>
 </body>
 </html>