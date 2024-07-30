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

$sql_supplier = "SELECT * FROM supplier";
$query_supplier  = mysqli_query($koneksi,$sql_supplier);
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
     </nav>
     <div class="container">
         <h1 class="text-center mt-4 fw-bold">Data Barang</h1>
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
            <label for="" class="form-label">Nama Supplier</label>
            <select name="id_supplier" id="" class="form-control" >
                <?php 
                while($supplier = mysqli_fetch_assoc($query_supplier)) {

                    $id_supplier = $supplier['id_supplier'];
                    $nama_supplier = $supplier['nama_supplier'];
                    echo "<option value='$id_supplier'>$nama_supplier</option>";
                }
                ?>
            </select><br>


            <label for="" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" id="" class="form-control" ><br>
            <label for="" class="form-label">Stok</label>
            <input type="number" name="stok" id="" class="form-control" ><br>
            <label for="" class="form-label">Harga Perkilo</label>
            <input type="number" name="harga_perkilo" id="" class="form-control" ><br>

            <input type="submit" value="Simpan" class="btn btn-success" onclick="return confirm('Apakah Anda Yakin ingin tambah data?');">
        </form>
                </div>
      </div>
  </div>
</div>
<a href="cetak.php" class="btn btn-secondary" style="float: right;">Cetak</a>

         <table class="table table-striped mt-4 text-center">
             <tr>
                 <th>ID Barang</th>
                 <th>Nama Supplier</th>
                 <th>Nama Barang</th>
                 <th>Stok</th>
                 <th>Harga Perkilo</th>
                 <th>Aksi</th>
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
                        <td>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit<?=$data['id_barang']?>">Edit</button>
                            <a href="hapus.php?id_barang=<?=$data['id_barang']?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin hapus data?');">Hapus</a>
                        </td>
                    </tr>
                    <div class="modal fade" id="modalEdit<?=$data['id_barang']?>">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title fs-5">Edit Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="proses_edit.php" method="post">
            <input type="hidden" name="id_barang" value="<?=$data['id_barang']?>">
            <label for="" class="form-label">Nama Supplier</label>
            <select name="id_supplier" id="" class="form-control" >
                <?php 
                mysqli_data_seek($query_supplier,0);
                while($supplier = mysqli_fetch_assoc($query_supplier)) {

                    $id_supplier = $supplier['id_supplier'];
                    $nama_supplier_lama = $data['nama_supplier'];
                    $nama_supplier = $supplier['nama_supplier'];
                    echo "<option value='$id_supplier'";
                    if($nama_supplier == $nama_supplier_lama) {
                        echo "selected";
                    }

                    echo ">$nama_supplier</option>";
                }
                ?>
            </select><br>
           

            <label for="" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" id="" class="form-control"  value="<?=$data['nama_barang']?>"><br>
            <label for="" class="form-label">Stok</label>
            <input type="number" name="stok" id="" class="form-control"  value="<?=$data['stok']?>"><br>
            <label for="" class="form-label">Harga Perkilo</label>
            <input type="number" name="harga_perkilo" id="" class="form-control"  value="<?=$data['harga_perkilo']?>"><br>

            <input type="submit" value="Simpan" class="btn btn-success" onclick="return confirm('Apakah Anda Yakin ingin ubah data?');">
        </form>
        <?php }?>
    </div>
        </div>
    </div>
         </table>

        <script src ="../js/bootstrap.bundle.min.js"></script>
     </div>
 </body>
 </html>l