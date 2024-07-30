<?php 
session_start();
if(!isset($_SESSION['login'])) {
    header("location:../login.php?pesan=AndaHarusLogin!!");
}
include "../koneksi.php";
$sql = "SELECT transaksi.id_transaksi, pembeli.id_pembeli,barang.id_barang, pembeli.nama_pembeli,barang.nama_barang,transaksi.jumlah,transaksi.tgl_transaksi
        FROM transaksi
        INNER JOIN pembeli ON transaksi.id_pembeli = pembeli.id_pembeli
        INNER JOIN barang ON transaksi.id_barang = barang.id_barang ORDER BY transaksi.id_transaksi";
        $query = mysqli_query($koneksi,$sql);

$sql_pembeli = "SELECT * FROM pembeli";
$query_pembeli  = mysqli_query($koneksi,$sql_pembeli);
$sql_barang = "SELECT * FROM barang";
$query_barang  = mysqli_query($koneksi,$sql_barang);
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
         <div class="container-fluid ">
             <a href="" class="navbar-brand fw-bold text-light">App Sayuran</a>

             <ul class="navbar-nav me-auto mt-1">
                 <li class="nav-item">
                     <a href="../pembeli/index.php" class="nav-link active text-light">Pembeli</a>
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
         <h1 class="text-center mt-4 fw-bold">Data Transaksi</h1>
         
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
                  <select name="id_pembeli" id="" class="form-control" required>
                      <?php 
                      while($pembeli = mysqli_fetch_assoc($query_pembeli)) {
                          $id_pembeli = $pembeli['id_pembeli'];
                          $nama_pembeli = $pembeli['nama_pembeli'];
                          echo "<option value='$id_pembeli'>$nama_pembeli</option>";
                      }
                      ?>
                  </select><br>
                  <label for="" class="form-label">Nama Barang</label>
                  <select name="id_barang" id="" class="form-control" required>
                      <?php 
                      while($barang = mysqli_fetch_assoc($query_barang)) {
      
                          $id_barang = $barang['id_barang'];
                          $nama_barang = $barang['nama_barang'];
                          echo "<option value='$id_barang'>$nama_barang</option>";
                      }
                      ?>
                  </select><br>
      
                  <label for="" class="form-label">Jumlah</label>
                  <input type="number" name="jumlah" id="" class="form-control" required><br>
                  <label for="" class="form-label">Tanggal Transaksi</label>
                  <input type="date" name="tgl_transaksi" id="tanggal" class="form-control" required readonly><br>
      
                  <input type="submit" value="Simpan" class="btn btn-success" onclick="return confirm('Apakah Anda Yakin ingin tambah data?');">
                </form>
                </div>
      </div>
  </div>
</div>
<a href="cetak.php" class="btn btn-secondary" style="float: right;">Cetak</a>
      
         <table class="table table-striped mt-4">
             <tr>
                 <th>ID Transaksi</th>
                 <th>Nama Pembeli</th>
                 <th>Nama Barang</th>
                 <th>Jumlah</th>
                 <th>Tanggal Transaksi</th>
                 <th>Aksi</th>
             </tr>

             <?php 
             while($data = mysqli_fetch_assoc($query)) {?>
                    <tr>
                        <td><?=$data['id_transaksi']?></td>
                        <td><?=$data['nama_pembeli']?></td>
                        <td><?=$data['nama_barang']?></td>
                        <td><?=$data['jumlah']?></td>
                        <td><?=$data['tgl_transaksi']?></td>
                        <td>
                            
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?=$data['id_transaksi']?>">Edit</button>
                            <a href="hapus.php?id_transaksi=<?=$data['id_transaksi']?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin hapus data?');">Hapus</a>
                        </td>
                    </tr>
                            
<div class="modal fade" id="modalEdit<?=$data['id_transaksi']?>">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title fs-5">Edit Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="proses_edit.php" method="post">
                  <input type="hidden" name="id_transaksi" value="<?=$data['id_transaksi']?>">
                  <label for="" class="form-label">Nama Pembeli</label>
                  <select name="id_pembeli" id="" class="form-control" required>
                  <?php 
                  mysqli_data_seek($query_pembeli,0);
                while($pembeli = mysqli_fetch_assoc($query_pembeli)) {

                    $id_pembeli = $pembeli['id_pembeli'];
                    $nama_pembeli_lama = $data['nama_pembeli'];
                    $nama_pembeli = $pembeli['nama_pembeli'];
                    echo "<option value='$id_pembeli'";
                    if($nama_pembeli == $nama_pembeli_lama) {
                        echo "selected";
                    }

                    echo ">$nama_pembeli</option>";
                }
                ?>
            </select><br>
                  <label for="" class="form-label">Nama Barang</label>
                  <select name="id_barang" id="" class="form-control" required>
                      <?php 
                       mysqli_data_seek($query_barang,0);
                      while($barang = mysqli_fetch_assoc($query_barang)) {
      
                          $id_barang = $barang['id_barang'];
                          $nama_barang = $barang['nama_barang'];
                          $nama_barang_lama = $data['nama_barang'];
                          echo "<option value='$id_barang'";
                          if($nama_barang == $nama_barang_lama) {
                              echo "selected";      
                          }           
                          echo ">$nama_barang</option>";
                      }
                      ?>
                  </select><br>
      
                  <label for="" class="form-label">Jumlah</label>
                  <input type="number" name="jumlah" id="" class="form-control" required value="<?=$data['jumlah']?>" ><br>
                  <label for="" class="form-label">Tanggal Transaksi</label>
                  <input type="date" name="tgl_transaksi" class="form-control" required value="<?=$data['tgl_transaksi']?>" readonly><br>
                  
                  
                  <input type="submit" value="Simpan" class="btn btn-success"  onclick="return confirm('Apakah Anda Yakin ingin ubah data?');">
                </div>
                
            </form>
            <?php }?>
            </div>
        </div>
                    </div>

   

         </table>

        
         
         
       
         
     </div>
     
     
     <script src="../js/bootstrap.bundle.min.js"></script>


     <script>
         document.getElementById('tanggal').valueAsDate = new Date();
     </script>
 </body>
 </html>