<?php

$koneksi = mysqli_connect('localhost','root','','sppujikom');

function tagihan(){
    global $koneksi;
    $siswa = $_POST['nis'];
    $tahun = $_POST['tahun_ajaran'];
    $bulan = $_POST['bulan'];
    $keterangan = "Belum Lunas";
    $nominal = "500000";
    $tgl=date('Y-m-d H:i:s');
    
    
    
    // menginput data ke database
    $tambah = mysqli_query($koneksi,"INSERT INTO tagihan VALUES('','$siswa','$tahun','$bulan','$keterangan','$nominal','$tgl')");
    
    if ($tambah) {
        echo"<script>
    
            alert('Data Berhasil Ditambahkan!');
            document.location.href = '../spprega/list_tagihan.php';
    
         </script>";
    }else{
    
    echo "data gagal ditambahkan";
    }
    }



    function bayar(){
        global $koneksi;
        $tagih = $_POST['tagihan_id'];
        $bayar = $_POST['nominal_bayar'];
        $tagihan = $_POST['nominal_tagihan'];
        $met = $_POST['metode_pembayaran'];
        $idadmin = $_POST['admin_id'];
        $tgl=date('Y-m-d H:i:s');
        
        // rumus untuk mengurangi nominal tagihan berdasarkan noinal yang sudah dibayarkan
        $hasil = $tagihan - $bayar;
        
        if ($bayar >=$tagihan) {
            $ket = "Lunas";
        }elseif ($bayar < $tagihan) {
            $ket = "Belum Lunas";
        }
        
        // menginput data ke database
        $tambah = mysqli_query($koneksi,"INSERT INTO pembayaran VALUES('','$tagih','$bayar','$met','$tgl','$idadmin')");
        
        //merubah data pada atribut nominal_bayar dan keterangan
        $update	=mysqli_query($koneksi,"UPDATE tagihan SET nominal_tagihan='$hasil', keterangan='$ket' WHERE id_tagihan='$tagih'");
        if ($tambah) {
            echo"<script>
        
                alert('Pembayaran Berhasil!');
                document.location.href = 'list_tagihan.php';
        
             </script>";
        }else{
        
        echo "Pembayaran Gagal!";
        }
        }

        function edittagihan(){
            global $koneksi;
            $id = $_POST['id_tagihan'];
            $nis = $_POST['siswa'];
            $tahun = $_POST['tahunajaran'];
            $bulan = $_POST['bulan'];
            
            $tgl=date('Y-m-d H:i:s');
        
            $update = mysqli_query($koneksi,"UPDATE tagihan SET siswa_id='$nis',tahun_ajaran_id='$tahun',bulan='$bulan',tanggal='$tgl' WHERE id_tagihan='$id'");
        
        
        if ($update) {
            echo"<script>
        
                alert('Data Berhasil di edit!');
                document.location.href = '../list_tagihan.php';
        
             </script>";
        }else{
        
        echo "data gagal di edit";
        }
        
        }
        
?>        