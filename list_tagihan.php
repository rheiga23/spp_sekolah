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
    <h1 class="text-center">SISWA LIST TAGIHAN</h1>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            DATA TAGIHAN SISWA
        </div>
        <div class="card-body">
            <!-- Button trigger modal -->
            <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
  <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahTagihan">
                Tambah Tagihan
            </button>
            
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
            <th>Tagihan ID</th>
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
                    <td><?php echo $d['id_tagihan'];?></td>
                    <td ><?php echo $d['nis']; ?></td>
                    <td ><?php echo $d['nama_siswa']; ?></td>
                    <td ><?php echo $d['tahun_ajaran']; ?></td>
                    <td ><?php echo $d['bulan']; ?></td>
                    <td ><?php echo  $d['keterangan']; ?></td>
                    <td >Rp.<?php echo number_format($d['nominal_tagihan']); ?></td>
                    <td ><?php echo $d['dibuat_pada']; ?></td>
                        
                        <td>
                            <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editTagihan<?php echo $d['id_tagihan'];?>">
                                Edit
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusTagihan<?= $d['id_tagihan'] ?>">
                                Hapus
                                </button>
                            
                        </td>
                    </tr>
                <?php } ?>
            </table>
        
            
<!-- FORM Modal Tambah TAGIHAN-->
            <?php 
            require "proses/proses.php";
            if (isset($_POST['simpan'])) {
                tagihan();
            }

             ?>
 <form action="" method="post">
                <div class="modal fade" id="tambahTagihan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">TAMBAH TAGIHAN</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    
                                    <label  class="form-label">Nama :</label>
                                    <select class="form-select form-select-sm" name ="nis"aria-label=".form-select-sm example">
                                    <option class="text-center"selected>-- PILIH NAMA--</option>
                                    <?php
                                        $query = "SELECT * FROM siswa";
                                        $data = mysqli_query($koneksi, $query);
                                        while($d = mysqli_fetch_array($data)){
                                        ?>
                                        <option value="<?php echo $d['id'];?>"><?php echo $d['nama_siswa'];?></option>
                                        <?php } ?>
                                  </select>

                                    <label for="form-label">Tahun Ajaran</label>
                                    <select class="form-select form-select-sm" name="tahun_ajaran"aria-label=".form-select-sm example">
                                    <option class="text-center"selected>-- PILIH TAHUN --</option>
                                    <?php
                                        $query = "SELECT * FROM tahun_ajaran ORDER BY tahun_ajaran";
                                        $data = mysqli_query($koneksi, $query);
                                        while($a = mysqli_fetch_array($data)){
                                        ?>
                                        <option value="<?php echo $a['id'];?>"><?php echo $a['tahun_ajaran'];?></option>
                                        <?php } ?>
                                    </select>

                                    <label for="form-label">Bulan</label>
                                    <select class="form-select form-select-sm" name="bulan"aria-label=".form-select-sm example">
                                    <option class="text-center"selected>-- PILIH BULAN --</option>
                                            <option value="Januari">Januari</option>
                                            <option value="Februari">Februari</option>
                                            <option value="Maret">Maret</option>
                                            <option value="April">April</option>
                                            <option value="Mei">Mei</option>
                                            <option value="Juni">Juni</option>
                                            <option value="Juli">Juli</option>
                                            <option value="Agustus">Agustus</option>
                                            <option value="September">September</option>
                                            <option value="Oktober">Oktober</option>
                                            <option value="November">November</option>
                                            <option value="Desember">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" name="simpan" class="btn btn-primary">Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
<!-- Modal Akhir Tambah -->


<!-- Modal UPDATE -->
<?php
require 'koneksi.php';

$query = mysqli_query($koneksi,"SELECT * FROM tagihan");
while($d = mysqli_fetch_array($query)):
?>
    <div class="modal fade" id="editTagihan<?php echo $d['id_tagihan'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">FORM EDIT TAGIHAN</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="proses/edittagihan.php" method="POST">
          <input type="hidden" name="id_tagihan" value="<?php echo $d['id_tagihan']; ?>">

          <div class="modal-body">
          <div class="mb-3">
          <label  class="form-label">Nama :</label>
                <select class="form-select form-select-sm" name ="siswa"aria-label=".form-select-sm example">
                <option class="text-center"selected>--PILIH--</option>
                <?php 
                $data = mysqli_query($koneksi,"select * from siswa ");
                    while($d = mysqli_fetch_array($data)){
                ?>
                    <option value="<?php echo $d['id'];?>"><?php echo $d['nis'];?>(<?php echo $d['nama_siswa'];?>)</option>

                <?php } ?>
                </select>
          </div>
          <div class="mb-3">
          <label  class="form-label">Tahun Ajaran:</label>
                <select class="form-select form-select-sm" name="tahunajaran" aria-label=".form-select-sm example">
                <option class="text-center"selected>--PILIH--</option>
                <?php 
                $data = mysqli_query($koneksi,"select * from tahun_ajaran ");
                    while($d = mysqli_fetch_array($data)){
                ?>
                    <option value="<?php echo $d['id'];?>"><?php echo $d['tahun_ajaran'];?></option>

                <?php } ?>
                </select>
          </div>
                <label  class="form-label">Bulan :</label>
                <select class="form-select form-select-sm" name="bulan" aria-label=".form-select-sm example">
    <option class="text-center" selected>--PILIH--</option>
    <?php 
    $bulan = array(
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    );

    // Loop untuk menampilkan setiap opsi bulan
    foreach ($bulan as $bln) {
        // Periksa apakah bulan saat ini sama dengan bulan yang akan ditampilkan
        $selected = ($d['bulan'] == $bln) ? 'selected' : '';

        // Tampilkan opsi bulan
        echo "<option value='$bln' $selected>$bln</option>";
    }
    ?>
</select>
            
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
    </form>
    <?php endwhile; ?>
<!-- Modal Akhir UPDATE -->

<!-- Pop Up Lanjutkan Hapus -->
 <?php

 require 'koneksi.php';
 $query = mysqli_query($koneksi, "SELECT * FROM tagihan
  INNER JOIN siswa ON tagihan.siswa_id = siswa.id");
  while($d = mysqli_fetch_array($query)) :
 ?>
 <form action="proses/hapustagihan.php" method="POST">
 <div class="modal fade" id="hapusTagihan<?= $d['id_tagihan'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Peringatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="id_tagihan" value="<?php echo $d['id_tagihan']; ?>">
      <h5>
        <span class="text-danger">Nama :<?php echo $d['nama_siswa'];?></span><br>
        <span class="text">YAKIN INGIN MENGHAPUS DATA INI..!</span>
      </h5>                                          

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button  type="submit" name="hapus" class="btn btn-primary">Hapus !</button>
      </div>
    </div>
  </div>
    </div>
    </form>
    <?php  endwhile; ?>
<!-- Pop Up Lanjutkan Hapus -->


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
<?php require 'template/footer.php'; ?>
