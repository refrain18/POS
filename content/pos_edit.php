<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "SELECT * FROM payment WHERE payment_id='$_GET[payment_id]'");
   $data = mysqli_fetch_array($query);
?>

<h2 class="judul">Edit POS</h2>
<form method="post" action="?hal=pos_update">
   <input type="hidden" name="payment_id" value="<?= $data['payment_id'] ?>">

   <div class="form-group">
      <label for="namaproduk">Nama Produk</label>   
      <div class="input">
         <input type="text" id="namaproduk" name="namaproduk" value="<?= $data['nama_produk'] ?>">
      </div> 
   </div>

   <div class="form-group">
      <label for="harga">Harga</label>   
      <div class="input"><input type="number" id="harga" name="harga" value="<?= $data['harga'] ?>"></div> 
   </div>

   <div class="form-group">
      <label for="diskon">Diskon</label>   
      <div class="input"><input type="number" id="diskon" name="diskon" value="<?= $data['diskon'] ?>"></div> 
   </div>

   <div class="form-group">
      <label for="jumlah">Jumlah</label>   
      <div class="input"><input type="number" id="jumlah" name="jumlah" value="<?= $data['qty'] ?>"></div> 
   </div>

   <div class="form-group">
        <label>Jenis Transaksi</label>
        <span>
              <input type="radio" name="jenistransaksi" value="debet" <?php if($data['jenis_transaksi'] == "debet"){ echo "checked='true'"; }?> disabled/>Debet
              <input type="radio" name="jenistransaksi" value="kredit"  <?php if($data['jenis_transaksi'] == "kredit"){ echo "checked='true'"; }?> disabled/>Kredit
        </span>
    </div>
   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
   </div>
</form>