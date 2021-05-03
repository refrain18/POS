<?php
   if(!defined('INDEX')) die("");

   ini_set('date.timezone', 'Asia/Jakarta');
   $waktu = date("Y-m-d");
?>
<h2 class="judul">Tambah Produk Salon Mumtaza</h2>
<form name="myForm" onsubmit="return confirm('Lanjutkan menyimpan data?');" method="post" action="?mod=daftar_produk&hal=dp_insert" enctype="multipart/form-data">
   <div class="form-group">
      <label for="harga">Tanggal</label>   
      <div class="input"><input type="text" id="nama_produk" name="nama_produk" value="<?= $waktu ?>" disabled></div> 
   </div>
   <div class="form-group">
      <label for="harga"><small style="color:red;">*</small>Nama Produk</label>   
      <div class="input"><input type="text" id="nama_produk" name="nama_produk" required></div> 
   </div>       
   <div class="form-group">
      <label for="harga"><small style="color:red;">*</small>Stok</label>   
      <div class="input"><input type="number" id="stok" name="stok" min="1" max="999" required></div> 
   </div>

   <div class="form-group">
      <label for="diskon"><small style="color:red;">*</small>Harga</label>   
      <div class="input"><input type="number" id="harga" name="harga" required></div> 
   </div>

   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
   </div>
</form>