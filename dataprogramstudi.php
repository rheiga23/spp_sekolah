<?php require 'template/header.php';?>

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
    <h1 class="text-center"> FORM PROGRAM STUDI </h1>

    <div class="card mt-3">
  <div class="card-header bg-primary text-white">
    DATA PROGRAM STUDI
  </div>
  <div class="card-body">
     <!-- Button trigger modal -->
     <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
  <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahStudi">
  Tambah Data
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
            <th>No</th>
            <th>Prodi</th>
            <th>Tanggal</th>
           
            <th>Aksi</th>
        </tr>
        <?php
require 'koneksi.php';

// Pemrosesan pencarian
if(isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    // Query untuk mencari data program studi berdasarkan kata kunci pencarian
    $query = mysqli_query($koneksi, "SELECT * FROM program_studi WHERE nama_prodi LIKE '%$keyword%'");
} else {
    // Jika tidak ada pencarian, ambil semua data program studi
    $query = mysqli_query($koneksi, "SELECT * FROM program_studi");
}

$no = 1;
while($d = mysqli_fetch_array($query)) {
?>


        <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['nama_prodi'];?></td>
                <td><?= $d['dibuat_pada'];?></td>
              
                <td>
                <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#editProdi<?php echo $d['program_studi_id']; ?>">
                            Edit
                        </button>
                        <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#hapusProdi<?php echo $d['program_studi_id']; ?>">
                            Hapus
                        </button>
                </td>
            </tr>
           <?php } ?>
    </table>

       

<!-- Modal TAMBAH -->
    <form action="proses/aksiprogram.php" method="POST">
      <div class="modal fade" id="tambahStudi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">FORM TAMBAH PROGRAMSTUDI</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="mb-3">
                    <label  class="form-label">Nama Prodi :</label>
                    <input type="text" class="form-control" name="nama_prodi" placeholder="Masukan Programstudi Baru">
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="bsubmit" class="btn btn-primary">Understood</button>
          </div>
        </div>
      </div>
    </div>
    </form>
<!-- Modal Akhir TAMBAH -->

<!-- Modal HAPUS -->
        <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM program_studi");
            while ($d = mysqli_fetch_array($query)) {
                ?>
                    <div class="modal fade" id="hapusProdi<?php echo $d['program_studi_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">KONFIRMASI TAHUN AJARAN</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="proses/hapusprodi.php" method="POST">
                                <input type="hidden" name="program_studi_id" value="<?php echo $d['program_studi_id']; ?>">
                                <div class="modal-body">
                                    <h5>Apakah Anda Ingin Menghapus Data Ini ? <br>
                                        <span class="text-danger"> No<?php echo $no ;?>-<?php echo $d['nama_prodi']; ?></span>
                                    </h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="bhapus" class="btn btn-danger">Ya, Hapus Aja!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <?php $no++;
            } ?>
          </div>
<!-- Modal Akhir HAPUS -->

<!-- Modal UPDATE -->
        <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM program_studi");
            while ($d = mysqli_fetch_array($query)) {
                ?>
    <div class="modal fade" id="editProdi<?php echo $d['program_studi_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">FORM EDIT PROGRAMSTUDI</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="proses/editprogram.php" method="POST">
          <input type="hidden" name="program_studi_id" value="<?php echo $d['program_studi_id']; ?>">

          <div class="modal-body">
          <div class="mb-3">
                    <label  class="form-label">Nama Prodi :</label>
                    <input type="text" class="form-control" name="nama_prodi" value="<?php echo $d['nama_prodi'];?>">
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="edit" class="btn btn-primary">Selesai</button>
          </div>
        </div>
      </div>
    </div>
    </form>
    <?php $no++;
            } ?>
<!-- Modal Akhir UPDATE -->
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
<?php require 'template/footer.php'; ?>