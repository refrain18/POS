<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Detail Harga Produk Salon Mumtaza Perbulan</h2>
<div class="label_123">
    <label class="l_nama_produk" for="">Nama Produk :</label>
    <br>
    <label class="l_bulan" for="">Bulan :</label>
    <label class="l_tahun" for="">Tahun :</label>

</div>
<a class="cetak" href="?hal=dh_cetak_detail">Cetak</a>
<br>
<!-- <a class="cetak" href="?hal=cetak_pg">Cetak</a> -->
</br>
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Hari/Tanggal</th>
         <th>Harga</th>
         <th>Jumlah Kenaikan/Turun</th>
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
         <td></td>
     </tr>
<?php
   //}
?>
   </tbody>
</table>