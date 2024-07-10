<?php

$koneksi = mysqli_connect('localhost','root','','sppujikom');
if(isset($_POST['ubah'])){
            global $koneksi;
            $id = $_POST['id_tagihan'];
            $nis = $_POST['siswa'];
            $tahun = $_POST['tahunajaran'];
            $bulan = $_POST['bulan'];
            
            $tgl=date('Y-m-d H:i:s');
        
            $update = mysqli_query($koneksi,"UPDATE tagihan SET siswa_id='$nis',tahun_ajaran_id='$tahun',bulan='$bulan',dibuat_pada='$tgl' WHERE id_tagihan='$id'");
        
        
        if ($update) {
            echo"<script>
        
                alert('Data Berhasil di edit!');
                document.location.href = '../list_tagihan.php';
        
             </script>";
        }else{
        
        echo "data gagal di edit";
        }
        
        }