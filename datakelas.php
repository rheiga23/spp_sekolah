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
    <h1 class="text-center"> FORM KELAS</h1>

    <div class="card mt-3">
  <div class="card-header bg-primary text-white">
    DATA KELAS
  </div>
  <div class="card-body">
     
     <!-- Button trigger modal -->
     
     <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
  <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahKelas">
  Tambah Kelas
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
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php
require 'koneksi.php';

// Pemrosesan pencarian
if(isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    // Query untuk mencari data kelas berdasarkan kata kunci pencarian
    $query = mysqli_query($koneksi, "SELECT * FROM kelas WHERE nama_kelas LIKE '%$keyword%'");
} else {
    // Jika tidak ada pencarian, ambil semua data kelas
    $query = mysqli_query($koneksi, "SELECT * FROM kelas");
}

$no = 1;
while($d = mysqli_fetch_array($query)) {
?>

        <tr>
                <td><?=  $no++; ?></td>
                <td><?=  $d['nama_kelas']?></td>
                <td><?=  $d['dibuat_pada']?></td>
              
                <td>
                <button type="button" class="btn btn-warning mb-3" data-bs-toggle="modal" data-bs-target="#editKelas<?php echo $d['kelas_id']; ?>">
                 Edit
                </button>
                <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" 
                data-bs-target="#hapusKelas<?php echo $d['kelas_id']; ?>">
                 Hapus
                </button>
                
              </td>
            </tr>
            <?php } ?>
    </table>

<!-- Modal Tambah -->
  <form action="proses/aksikelas.php" method="POST">
  <div class="modal fade" id="tambahKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">TAMBAH KELAS</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="mb-3">
                  <label  class="form-label">Kelas :</label>
                  <input type="text" class="form-control" name="nama_kelas" placeholder="Masukan Kelas Baru">
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="btambah" class="btn btn-primary">Kirim</button>
        </div>
      </div>
    </div>
  </div>
  </form>
<!-- Modal Akhir Tambah -->

<!-- Modal Hapus -->
        <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM kelas");
            while ($d = mysqli_fetch_array($query)) {
                ?>
                    <div class="modal fade" id="hapusKelas<?php echo $d['kelas_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">KONFIRMASI TAHUN AJARAN</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="proses/hapuskelas.php" method="POST">
                                <input type="hidden" name="kelas_id" value="<?php echo $d['kelas_id']; ?>">
                                <div class="modal-body">
                                    <h5>Apakah Anda Ingin Menghapus Data Ini ? <br>
                                        <span class="text-danger"> No.<?php echo $no ;?> Kelas <?php echo $d['nama_kelas']; ?></span>
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
<!-- Modal Akhir Hapus -->

<!-- Modal UPDATE -->
  <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM kelas");
            while ($d = mysqli_fetch_array($query)) {
                ?>
    <div class="modal fade" id="editKelas<?php echo $d['kelas_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">FORM EDIT KELAS</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="proses/editkelas.php" method="POST">
          <input type="hidden" name="kelas_id" value="<?php echo $d['kelas_id']; ?>">

          <div class="modal-body">
          <div class="mb-3">
                    <label  class="form-label">Nama Kelas :</label>
                    <input type="text" class="form-control" name="nama_kelas" value="<?php echo $d['nama_kelas'];?>">
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
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
<?php require 'template/footer.php'; ?>