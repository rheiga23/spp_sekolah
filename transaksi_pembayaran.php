<?php require 'template/header.php';?>
<?php 
require 'proses/proses.php';
if (isset($_POST['simpan'])) {
    bayar();
}
?>
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
    <h1 class="text-center"> FORM TRANSAKSI</h1>

    <div class="card mt-3">
  <div class="card-header bg-primary text-white">
    TRANSAKSI
  </div>
 
  
<?php
require 'koneksi.php';

$id_tagihan = $_GET['id_tagihan'];
$query = mysqli_query($koneksi,"SELECT * FROM tagihan WHERE id_tagihan='$id_tagihan'");
while($d = mysqli_fetch_array($query)){
    ?>
    
    <form action="" method="POST">
    <div class="card-body">
  <label>Tagihan ID :<?php echo $d['id_tagihan']?> </label>
  
      <input type="hidden" class="form-control" name="tagihan_id" value="<?php echo $d['id_tagihan']?>" required autofocus><br>
    
      <label>Nominal Tagihan :</label>
      <input type="text" class="form-control" name="nominal_tagihan" value="<?= $d['nominal_tagihan'];?>" readonly>

      <div class="modal-body">
      <label  class="form-label">Nominal Pembayaran :</label>
      <input type="text" class="form-control" name="nominal_bayar" placeholder="Masukan Nominal Pembayaran "><br>

      <label for="metode_pembayaran">Metode Pembayaran :</label><br>
      <input type="radio" name="metode_pembayaran" value="tunai"> TUNAI <br>
      <input type="radio" name="metode_pembayaran" value="mbanking"> MBANKING <br>
      <input type="radio" name="metode_pembayaran" value="ewalet"> E WALLET <br>
    
      <input type="hidden" name="admin_id" value="<?= $_SESSION['id'];?>">
<br>
<button type="submit" name="simpan" class="btn btn-success" data-bs-toggle="modal"> Bayar </button>
</form>   
<?php } ?>

</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
<?php require 'template/footer.php'; ?>