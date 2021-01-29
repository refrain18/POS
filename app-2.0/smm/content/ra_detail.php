<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Detail Rekap Absensi Pegawai</h2>
<div class="label_123">
    <label class="l_nama_produk" for="">Nama Pegawai :</label>
    <br>
    <label class="l_bulan" for="">Masuk :</label>
    <label class="l_tahun" for="">Absen :</label>
    <label class="l_sakit" for="">Sakit :</label>
    <label class="l_izin" for="">Izin :</label>

</div>
<a class="cetak" href="?hal=ra_cetak_detail">Cetak</a>
<br>
<!-- <a class="cetak" href="?hal=cetak_pg">Cetak</a> -->
</br>
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Hari/Tanggal</th>
         <th>Keterangan</th>
      </tr>
   </thead>
   <tbody>
<?php
//    $query = mysqli_query($con, "SELECT produk_salon.*, stok_masuk.harga FROM produk_salon JOIN stok_masuk ON produk_salon.produk_id = stok_masuk.produk_id ORDER BY produk_id ASC");
//    $no = 0;
//    while($data = mysqli_fetch_array($query)){
//       $no++;


?>
      <tr>
         <td></td>
         <td></td>
         <td></td>
     </tr>
<?php
   //}
?>
   </tbody>
</table>