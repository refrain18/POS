<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "SELECT * FROM payment WHERE payment_id='$_GET[payment_id]'");
   $data = mysqli_fetch_array($query);
?>

<script>
function validateForm() {
  var y = document.forms["myForm"]["jumlah"].value;

  if (y == 0 || y == "") {
    alert("QTY TIDAK BOLEH 0 ATAU KOSONG");
    return false;
  }
}
</script>

<h2 class="judul">Edit POS</h2>
<form name="myForm" onsubmit="return validateForm()" method="post" action="?mod=transaksi&hal=pos_update">
   <input type="hidden" name="payment_id" value="<?= $data['payment_id'] ?>">

   <div class="form-group">
      <label for="namaproduk"><small style="color:red;">*</small>Nama Produk</label>   
      <div class="input">
         <input type="text" id="namaproduk" name="namaproduk" value="<?= $data['nama_produk'] ?>" required>
      </div> 
   </div>

   <div class="form-group">
      <label for="harga"><small style="color:red;">*</small>Harga</label>   
      <div class="input"><input type="number" id="harga" name="harga" value="<?= $data['harga'] ?>" required></div> 
   </div>

   <div class="form-group">
      <label for="diskon">Diskon (Persen)</label>   
      <div class="input"><input type="number" id="diskon" name="diskon" min="0" max="100" value="<?= $data['diskon'] ?>"></div> 
   </div>

   <div class="form-group">
      <label for="jumlah"><small style="color:red;">*</small>QTY</label>
      <div class="input"><input type="number" id="jumlah" name="jumlah" min="1" onkeyup="//validasi()" value="<?= $data['qty'] ?>"></div> 
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