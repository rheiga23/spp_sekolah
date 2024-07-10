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
    <h1 class="text-center"> LAPORAN BELUM LUNAS </h1>

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            DATA BELUM LUNAS
        </div>
        <div class="card-body">
            <!-- Button trigger modal -->
            <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
  <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#cetakBelumlunas">
                CETAK
            </button>
  </div>
</nav>
            
            <table class="table table-bordered table-striped table-hover">
                <tr>
            <th>NO</th>
            <th>ID Tagihan</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Program Studi</th>
            <th>Tahun Ajaran</th>
            <th>Bulan</th>
            <th>Keterangan</th> 
            <th>Tanggal</th>
                </tr>
                <?php

                    require 'koneksi.php';
                    $no=1;
                    $query = mysqli_query($koneksi,"SELECT tagihan.id_tagihan, tagihan.bulan, 
                    tagihan.keterangan, tagihan.nominal_tagihan, tagihan.dibuat_pada, 
                    tagihan.siswa_id, siswa.nama_siswa,siswa.nis, tahun_ajaran.tahun_ajaran, 
                    tagihan.dibuat_pada, kelas.nama_kelas, program_studi.nama_prodi, tahun_ajaran.tahun_ajaran 
                    FROM tagihan 
                    INNER JOIN siswa ON tagihan.siswa_id = siswa.id 
                    INNER JOIN kelas ON siswa.kelas_id = kelas.kelas_id 
                    INNER JOIN program_studi ON siswa.program_studi_id = program_studi.program_studi_id
                    INNER JOIN tahun_ajaran ON tagihan.tahun_ajaran_id = tahun_ajaran.id 
                    WHERE tagihan.keterangan = 'Belum Lunas'");
                    while($d = mysqli_fetch_array($query)){
                    ?>

                    <tr>
                    <td ><?php echo $no++; ?></td>
                    <td ><?php echo $d['id_tagihan']; ?></td>
                    <td ><?php echo $d['nis']; ?></td>
                    <td ><?php echo $d['nama_siswa']; ?></td>
                    <td ><?php echo $d['nama_kelas']; ?></td>
                    <td ><?php echo $d['nama_prodi']; ?></td>
                    <td ><?php echo $d['tahun_ajaran']; ?></td>
                    <td ><?php echo $d['bulan']; ?></td>
                    <td ><?php echo $d['keterangan']; ?></td>
                    <td ><?php echo $d['dibuat_pada']; ?></td>
                    </tr>
                <?php } ?>
            </table>

<!-- Modal Tambah -->
<form action="cetaklaporan/cetakbelumlunas.php" method="post">
                    <div class="modal fade" id="cetakBelumlunas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Lanjutkan Cetak</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                       LANJUTKAN CETAK YANG BELUM LUNAS
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" name="bsubmit" class="btn btn-primary">Cetak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

    <!-- Modal Akhir Tambah -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
<?php require 'template/footer.php'; ?>
