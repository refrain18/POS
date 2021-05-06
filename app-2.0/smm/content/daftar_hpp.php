<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Daftar Harga Produk Salon Mumtaza Perbulan</h2>
<br>
<div>
<form action="">   
<label class="label_bulan" for="">Bulan</label>
<select class="select_bulan" name="bulan" id="bulan">
    <option value="januari">Januari</option>
    <option value="februari">Februari</option>
    <option value="maret">Maret</option>
    <option value="april">April</option>
    <option value="mei">Mei</option>
    <option value="juni">Juni</option>
    <option value="juli">Juli</option>
    <option value="agustus">Agustus</option>
    <option value="september">September</option>
    <option value="oktober">Oktober</option>
    <option value="november">November</option>
    <option value="desember">Desember</option>
</select>

<label class="label_tahun" for="">Tahun</label>
<select class="select_tahun" name="tahun" id="tahun">
    <option value="2020">2020</option>
    <option value="2021">2021</option>
</select>
</form>
</div>
<a class="cetak" href="?hal=dh_cetak">Cetak</a>
<br>
<!-- <a class="cetak" href="?hal=cetak_pg">Cetak</a> -->
</br>
</br>
<table class="table">
   <thead>
      <tr>
         <th>No</th>
         <th>Nama Produk</th>
         <th>Rata - Rata Harga Perbulan</th>
         <th>Aksi</th>
      </tr>
   </thead>
   <tbody>
<?php
   $query = mysqli_query($con, "SELECT produk_salon.*, stok_masuk.harga FROM produk_salon JOIN stok_masuk ON produk_salon.produk_id = stok_masuk.produk_id ORDER BY produk_id ASC");
   $no = 0;
   while($data = mysqli_fetch_array($query)){
      $no++;


?>
      <tr>
         <td><?= $no ?></td>
         <td><?= $data['nama_produk'] ?></td>
         <td></td>
         <td>
            <a class="tombol_detail" href="?hal=dh_detail&produk_id=<?= $data['produk_id'] ?>"> Detail </a>
         </td>
     </tr>
<?php
   }
?>
   </tbody>
</table>