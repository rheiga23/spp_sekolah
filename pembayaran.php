<?php require 'template/header.php'; ?>
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
    <h1 class="text-center">PEMBAYARAN</h1>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            PEMBAYARAN
        </div>
        <div class="card-body">
            <!-- Button trigger modal -->
            <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <!--search-->
    <form action="" method="" class="d-none d-sm-inline-block form-inline mr-0 ml-md-auto my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" name="keyword" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>


  </div>
</nav>
            
            <table class="table table-bordered table-striped table-hover">
                <tr>
            <th>NO</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Tahun Ajaran</th> 
            <th>Bulan</th>
            <th>Keterangan</th>  
            <th>Nominal Tagihan</th>  
            <th>Tanggal dibuat</th>  
            <th>OPSI</th>
                </tr>

                <?php
require 'koneksi.php';

// Pemrosesan pencarian
if(isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    // Query untuk mencari data tagihan berdasarkan kata kunci pencarian
    $query = mysqli_query($koneksi, "SELECT * FROM tagihan
    INNER JOIN siswa ON tagihan.siswa_id = siswa.id
    INNER JOIN tahun_ajaran ON tagihan.tahun_ajaran_id = tahun_ajaran.id 
    WHERE tagihan.keterangan = 'Belum Lunas' AND (siswa.nis LIKE '%$keyword%' OR siswa.nama_siswa LIKE '%$keyword%' OR tahun_ajaran.tahun_ajaran LIKE '%$keyword%' OR tagihan.bulan LIKE '%$keyword%' OR tagihan.keterangan LIKE '%$keyword%' OR tagihan.nominal_tagihan LIKE '%$keyword%' OR tagihan.dibuat_pada LIKE '%$keyword%')");
} else {
    // Jika tidak ada pencarian, ambil semua data tagihan yang belum lunas
    $query = mysqli_query($koneksi, "SELECT * FROM tagihan
    INNER JOIN siswa ON tagihan.siswa_id = siswa.id
    INNER JOIN tahun_ajaran ON tagihan.tahun_ajaran_id = tahun_ajaran.id 
    WHERE tagihan.keterangan = 'Belum Lunas'");
}

$no = 1;
while($d = mysqli_fetch_array($query)) {
?>

                    <tr>
                    <td ><?php echo $no++; ?></td>
                    <td ><?php echo $d['id_tagihan']; ?></td>
                    <td ><?php echo $d['nama_siswa']; ?></td>
                    <td ><?php echo $d['tahun_ajaran']; ?></td>
                    <td ><?php echo $d['bulan']; ?></td>
                    <td ><?php echo  $d['keterangan']; ?></td>
                    <td >Rp.<?php echo number_format($d['nominal_tagihan']); ?></td>
                    <td ><?php echo $d['dibuat_pada']; ?></td>
                        
                        <td>
                    <!-- Button trigger modal -->
                    <a href="transaksi_pembayaran.php?id_tagihan=<?php echo $d['id_tagihan']?>" class="btn btn-primary">Bayar</a> 
                        </td>
                    </tr>
                <?php } ?>
            </table>

        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
<?php require 'template/footer.php'; ?>
