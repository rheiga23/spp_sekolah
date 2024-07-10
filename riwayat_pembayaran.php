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
        <h1 class="text-center"> Riwayat Pembayaran </h1>

        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                Riwayat
            </div>
            <div class="card-body">
                <!-- Button trigger modal -->
                <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#cetakRiwayat">
                    CETAK RIWAYAT
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
                    <th >NO</th>
                    <th >ID Tagihan</th>
                    <th >NIS</th>
                    <th >Nama Siswa</th>
                    <th >Nominal Bayar</th>
                    <th >Nominal Tagihan</th>
                    <th >Metode Pembayaran</th>
                    <th >Bulan</th>
                    <th >Keterangan</th>
                    <th >Tanggal Bayar</th> 
                    <th >Nama Admin</th>    
                    <th >OPSI</th>
                    </tr>
                    <?php
                    require 'koneksi.php';
                    $query = mysqli_query($koneksi, "SELECT pembayaran.id, pembayaran.nominal_bayar, pembayaran.metode_pembayaran, pembayaran.dibuat_pada, pembayaran.admin_id, tagihan.bulan, tagihan.keterangan, tagihan.id_tagihan, tagihan.nominal_tagihan, admin.nama AS nama, siswa.nama_siswa, siswa.nis 
            FROM pembayaran 
            INNER JOIN tagihan ON pembayaran.tagihan_id = tagihan.id_tagihan
            INNER JOIN siswa ON tagihan.siswa_id = siswa.id 
            INNER JOIN admin ON pembayaran.admin_id = admin.id");

                    $no = 1;
                    while($d = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                    <td ><?php echo $no++; ?></td>
                <td><?php echo $d['id']; ?></td>
                <td><?php echo $d['nis']; ?></td>
                <td><?php echo $d['nama_siswa']; ?></td>
                <td>Rp.<?php echo number_format($d['nominal_bayar']); ?></td>
                <td>Rp.<?php echo number_format($d['nominal_tagihan']); ?></td>
                <td><?php echo $d['metode_pembayaran']; ?></td>
                <td><?php echo $d['bulan']; ?></td>
                <td><?php echo $d['keterangan']; ?></td>
                <td><?php echo $d['dibuat_pada']; ?></td>
                <td><?php echo $d['nama']; ?></td>

                <td>
                    <a href="" class="btn btn-warning"> Edit</a>
                    <a href="" class="btn btn-danger"> Hapus</a>
                </td>
                           
                        </tr>
                        <?php } ?>
                </table>
                
    <!-- Modal Tambah -->
                <form action="cetak/cetakriwayatsemua.php" method="post">
                    <div class="modal fade" id="cetakRiwayat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Lanjutkan Cetak</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                       LANJUTKAN CETAK
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

                   