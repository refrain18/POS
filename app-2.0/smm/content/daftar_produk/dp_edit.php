<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "SELECT * FROM produk_salon WHERE produk_id='$_GET[produk_id]'");
   $data = mysqli_fetch_array($query);
?>

<h2 class="judul">Edit Produk Salon Mumtaza</h2>
<form name="myForm" onsubmit="return confirm('Lanjutkan menyimpan data!');" method="post" action="?mod=daftar_produk&hal=dp_update">
<input type="hidden" name="produk_id" value="<?= $data['produk_id'] ?>">

   <div class="form-group">
      <label for="harga">Nama Produk</label>   
      <div class="input"><input type="text" id="nama_produk" name="nama_produk" value="<?= $data['nama_produk'] ?>" required></div> 
   </div>       
   <div class="form-group">
      <label for="harga">Stok</label>   
      <div class="input"><input type="number" id="stok" name="stok" min="1" max="999" value="<?= $data['stok'] ?>" required></div> 
   </div>

   <div class="form-group">
      <label for="diskon">Harga</label>   
      <div class="input"><input type="number" id="harga" name="harga" value="<?= $data['harga'] ?>" required></div> 
   </div>
   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
   </div>
</form>