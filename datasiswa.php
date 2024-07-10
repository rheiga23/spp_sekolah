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
    <h1 class="text-center"> FORM SISWA </h1>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            DATA SISWA
        </div>
        <div class="card-body">
            <!-- Button trigger modal -->
            <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
  <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahSiswa">
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
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Kelas </th>
                    <th>Program studi</th>
                    <th>Aksi</th>
                </tr>

                <?php
require 'koneksi.php';

// Pemrosesan pencarian
if(isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    // Query untuk mencari data siswa berdasarkan kata kunci pencarian
    $tampil = mysqli_query($koneksi, "SELECT * FROM siswa 
    INNER JOIN kelas ON siswa.kelas_id = kelas.kelas_id
    INNER JOIN program_studi ON siswa.program_studi_id = program_studi.program_studi_id
    WHERE nama_siswa LIKE '%$keyword%' OR nama_kelas LIKE '%$keyword%' OR nama_prodi LIKE '%$keyword%'");
} else {
    // Jika tidak ada pencarian, ambil semua data siswa
    $tampil = mysqli_query($koneksi, "SELECT * FROM siswa 
    INNER JOIN kelas ON siswa.kelas_id = kelas.kelas_id
    INNER JOIN program_studi ON siswa.program_studi_id = program_studi.program_studi_id");
}

$no = 1;
while($d = mysqli_fetch_array($tampil)) :
?>

                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['nis']?></td>
                        <td><?= $d['nama_siswa']?></td>
                        <td><?= $d['nama_kelas']?></td>
                        <td><?= $d['nama_prodi']?></td>
                        <td>
                            <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editSisiwa<?php echo $d['id']; ?>">Edit</a>
                            <a href="" class="btn btn-danger" data-bs-toggle="modal" 
                            data-bs-target="#hapusSiswa<?php echo $d['id']; ?>">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>

<!-- Modal Tambah -->
            <form action="proses/aksisiswa.php" method="post">
                <div class="modal fade" id="tambahSiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">TAMBAH SISWA</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label  class="form-label">Nis :</label>
                                    <input type="number" class="form-control" name="nis" placeholder="Masukan Nis ">

                                    <label  class="form-label">Nama Siswa :</label>
                                    <input type="text" class="form-control" name="nama_siswa" placeholder="Masukan nama ">

                                    <label  class="form-label">Kelas ID:</label>
                                    <select class="form-select form-select-sm" name ="kelas_id"aria-label=".form-select-sm example">
                                    <option class="text-center"selected>-- PILIH KELAS --</option>
                                    <?php
                                        $query = "SELECT * FROM kelas";
                                        $data = mysqli_query($koneksi, $query);
                                        while($d = mysqli_fetch_array($data)){
                                        ?>
                                        <option value="<?php echo $d['kelas_id'];?>"><?php echo $d['nama_kelas'];?></option>
                                        <?php } ?>
                                  </select>

                                    <label for="form-label">Program Studi</label>
                                    <select class="form-select form-select-sm" name="program_studi_id"aria-label=".form-select-sm example">
                                    <option class="text-center"selected>-- PILIH KELAS --</option>
                                    <?php
                                        $query = "SELECT * FROM program_studi";
                                        $data = mysqli_query($koneksi, $query);
                                        while($a = mysqli_fetch_array($data)){
                                        ?>
                                        <option value="<?php echo $a['program_studi_id'];?>"><?php echo $a['nama_prodi'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" name="bsubmit" class="btn btn-primary">Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
<!-- Modal Akhir Tambah -->


<!-- Modal Hapus -->
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM siswa");
            while ($d = mysqli_fetch_array($query)) {
                ?>
                <div class="modal fade" id="hapusSiswa<?php echo $d['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Siswa</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="proses/hapussiswa.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
                                <div class="modal-body">
                                    <h5>Apakah Anda Ingin Menghapus Data Ini ? <br>
                                        <span class="text-danger">Siswa NIS <?php echo $d['nis'];?> NAMA <?php echo $d['nama_siswa']; ?></span>
                                    </h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="bhapus" class="btn btn-danger">Ya, Hapus Aja!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php $no++;
            } ?>
<!-- Modal Akhir Hapus -->

<!-- Modal UPDATE -->
    <?php
            $tampil = mysqli_query($koneksi, "SELECT * FROM siswa 
            INNER JOIN kelas ON siswa.kelas_id = kelas.kelas_id
            INNER JOIN program_studi ON siswa.program_studi_id = program_studi.program_studi_id");
            while($d = mysqli_fetch_array($tampil)) {
                ?>
    <div class="modal fade" id="editSisiwa<?php echo $d['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">FORM EDIT SISWA</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="proses/editsiswa.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $d['id']; ?>">

          <div class="modal-body">
          <div class="mb-3">
                    <label  class="form-label">NIS :</label>
                    <input type="number" class="form-control" name="nis" value="<?php echo $d['nis'];?>" required>
          </div>
          <div class="mb-3">
                    <label  class="form-label">Nama Siswa :</label>
                    <input type="text" class="form-control" name="nama_siswa" value="<?php echo $d['nama_siswa'];?>">
          </div>
          <label  class="form-label">Kelas ID:</label>
                <select class="form-select form-select-sm" name ="kelas_id"aria-label=".form-select-sm example">
                    <option class="text-center"selected>--PILIH--</option>
                        <?php
                            $query = "SELECT * FROM kelas";
                            $data = mysqli_query($koneksi, $query);
                             while($d = mysqli_fetch_array($data)){
                            ?>
                        <option value="<?php echo $d['kelas_id'];?>"><?php echo $d['nama_kelas'];?></option>
                            <?php } ?>
                </select>
            
                <label for="form-label">Program Studi</label>
                                    <select class="form-select form-select-sm" name="program_studi_id"aria-label=".form-select-sm example">
                                    <option class="text-center"selected>--PILIH--</option>
                                    <?php
                                        $query = "SELECT * FROM program_studi";
                                        $data = mysqli_query($koneksi, $query);
                                        while($d = mysqli_fetch_array($data)){
                                        ?>
                                        <option value="<?php echo $d['program_studi_id'];?>"><?php echo $d['nama_prodi'];?></option>
                                        <?php } ?>
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
    <?php $no++;
            } ?>
<!-- Modal Akhir UPDATE -->

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
<?php require 'template/footer.php'; ?>
