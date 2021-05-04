<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Tambah Jenis Perawatan</h2>
<form name="myForm" onsubmit="return confirm('Lanjutkan menyimpan data!');" method="post" action="?mod=jenis_perawatan&hal=jp_insert" enctype="multipart/form-data">

   <div class="form-group">
      <label for="nama_perawatan"><small style="color:red;">*</small>Nama Perawatan</label>   
      <div class="input"><input type="text" id="nama_perawatan" name="nama_perawatan" required></div> 
   </div>

   <div class="form-group">
      <label for="harga"><small style="color:red;">*</small>Harga</label>   
      <div class="input"><input type="number" id="harga" name="harga" min="0" required></div> 
   </div>

   <div class="form-group">
      <label for="waktu"><small style="color:red;">*</small>Waktu (Menit)</label>   
      <div class="input"><input type="number" id="waktu" name="waktu" min="1" max="999" required></div>
   </div>

   <div class="form-group">
      <label for="komisi">Komisi</label>   
      <div class="input"><input type="number" id="komisi" name="komisi" min="0"></div> 
   </div>
   <div class="form-group">
      <input type="submit" value="Tambah" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
   </div>
   
</form>