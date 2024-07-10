<?php
// memanggil library FPDF
ob_start();
require('../pdf/fpdf.php');
include '../koneksi.php';
 
// intance object dan memberikan pengaturan halaman PDF
$pdf=new FPDF('L','mm','A4');
$pdf->AddPage();
 
$pdf->SetFont('Times','B',13);
$pdf->Cell(255,10,'RIWAYAT PEMBAYARAN SPP SISWA',0,0,'C');
 
$pdf->Cell(10,15,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(10,7,'NO',1,0,'C');
$pdf->Cell(20,7,'ID TAGIHAN' ,1,0,'C');
$pdf->Cell(20,7,'NIS',1,0,'C');
$pdf->Cell(42,7,'NAMA SISWA',1,0,'C');
$pdf->Cell(28,7,'NOMINAL BAYAR',1,0,'C');
$pdf->Cell(32,7,'NOMINAL TAGIHAN',1,0,'C');
$pdf->Cell(20,7,'METODE',1,0,'C');
$pdf->Cell(25,7,'KETERANGAN',1,0,'C');
$pdf->Cell(25,7,'BULAN',1,0,'C');
$pdf->Cell(32,7,'TANGGAL',1,0,'C');
$pdf->Cell(32,7,'ADMIN',1,0,'C');
 
 
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Times','',10);
$no=1;
$query = mysqli_query($koneksi,"SELECT *
     FROM pembayaran 
     INNER JOIN tagihan ON pembayaran.tagihan_id = tagihan.id_tagihan 
     INNER JOIN siswa ON tagihan.siswa_id = siswa.id
     INNER JOIN admin ON pembayaran.admin_id = admin.id");
     while($d = mysqli_fetch_array($query)){
  $pdf->Cell(10,6, $no++,1,0,'C');
  $pdf->Cell(20,6, $d['id_tagihan'],1,0,'C');
  $pdf->Cell(20,6, $d['nis'],1,0,'C');
  $pdf->Cell(42,6, $d['nama_siswa'],1,0,'C');  
  $pdf->Cell(28,6, 'Rp. '.number_format($d['nominal_bayar']),1,0,'C');
  $pdf->Cell(32,6, 'Rp. '.number_format($d['nominal_tagihan']),1,0,'C');
  $pdf->Cell(20,6, $d['metode_pembayaran'],1,0,'C');
  $pdf->Cell(25,6, $d['keterangan'],1,0,'C');
  $pdf->Cell(25,6, $d['bulan'],1,0,'C');
  $pdf->Cell(32,6, $d['dibuat_pada'],1,0,'C');
  $pdf->Cell(32,6, $d['nama'],1,1,'C');
}
$pdf->Output();
 ob_end_flush();
?>