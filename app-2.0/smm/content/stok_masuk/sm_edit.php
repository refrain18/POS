<?php
   if(!defined('INDEX')) die("");

   $id = isset($_GET['stok_masuk_id']) && !empty($_GET['stok_masuk_id']) ? $_GET['stok_masuk_id'] : '';

   $query = mysqli_query($con, "SELECT stok_masuk.stok_masuk_id, stok_masuk.harga, stok_masuk.stok, stok_masuk.produk_id, produk_salon.nama_produk FROM stok_masuk JOIN produk_salon ON stok_masuk.produk_id = produk_salon.produk_id WHERE stok_masuk_id='$id' ORDER BY stok_masuk_id ASC");

   $data = mysqli_fetch_array($query);

   $produk_id = $data['produk_id'];
?>

<h2 class="judul">Edit Stok Masuk Produk Salon Mumtaza</h2>
<form name="myForm" onsubmit="return confirm('Lanjutkan menyimpan data!')" method="post" action="?mod=stok_masuk&hal=sm_update">

<input type="hidden" name="stok_masuk_id" value="<?= $data['stok_masuk_id'] ?>">
<div class="form-group">
        <label for="nama_produk"><small style="color:red;">*</small>Nama Produk</label>   
        <div class="input">
            <select name="produk_id" required>
                <?php
                    $query = mysqli_query($con, "SELECT produk_id, nama_produk FROM produk_salon ORDER BY produk_id ASC");
                    while($row=mysqli_fetch_assoc($query)){
                        if($produk_id == $row['produk_id']) {
                            echo "<option value='$row[produk_id]' selected='true'>$row[nama_produk]</option>";
                        }else{
                            echo "<option value='$row[produk_id]'>$row[nama_produk]</option>";
                        }
                    }
                ?>
            </select>
        </div> 
   </div> 
   <div class="form-group">
      <label for="harga"><small style="color:red;">*</small>Harga Satuan</label>   
      <div class="input"><input type="number" id="harga" name="harga" value="<?= $data['harga'] ?>" required></div> 
   </div>       
   <div class="form-group">
      <label for="stok_masuk"><small style="color:red;">*</small>Jumlah Stok Masuk</label>   
      <div class="input"><input type="number" id="stok" name="stok" value="<?= $data['stok'] ?>" required></div> 
   </div>
   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol edit">
   </div>
</form>