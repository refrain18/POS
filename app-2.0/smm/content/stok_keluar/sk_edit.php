<?php
   if(!defined('INDEX')) die("");

   $id = isset($_GET['sk_id']) && !empty($_GET['sk_id']) ? $_GET['sk_id'] : '';

   $query = mysqli_query($con, "SELECT stok_keluar.sk_id, stok_keluar.stok, stok_keluar.produk_id, produk_salon.nama_produk FROM stok_keluar JOIN produk_salon ON stok_keluar.produk_id = produk_salon.produk_id WHERE sk_id='$id' ORDER BY sk_id ASC");

   $data = mysqli_fetch_array($query);
   $produk_id = $data['produk_id'];
?>

<h2 class="judul">Edit Stok Keluar Produk Salon Mumtaza</h2>
<form name="myForm" onsubmit="return confirm('Lanjutkan menyimpan data?')" method="post" action="?mod=stok_keluar&hal=sk_update">
        <input type="hidden" name="sk_id" value="<?= $data['sk_id'] ?>">
        <div class="form-group">
            <label for="nama_produk"><small style="color:red;">*</small>Nama Produk</label>   
            <div class="input">
            <select name="produk_id" disabled>
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
        <label for="stok_keluar"><small style="color:red;">*</small>Jumlah Stok Keluar</label>   
        <div class="input"><input type="number" id="stok" name="stok" min="1" value="<?= $data['stok'] ?>" required></div> 
    </div>
    <div class="form-group">
        <input type="submit" value="Edit" class="tombol edit">
    </div>
</form>