<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Tambah Stok Keluar Produk Salon Mumtaza</h2>
<form name="myForm" onsubmit="return validateForm()" method="post" action="?hal=sk_insert" enctype="multipart/form-data">

   <?php
      
    //   $notif = isset($_GET['notif']) ? $_GET['notif'] : false;

    //   if($notif == 'tipefile') {
    //      echo "<div class='notif' id='notif'>Tipe file tidak didukung!</div>";
    //   }elseif($notif == 'ukuranfile') {
    //      echo "<div class='notif' id='notif'>Ukuran file tidak boleh lebih dari 1MB</div>";
    //   }

   ?>
     <div class="form-group">
      <label for="nama_produk">Nama Produk</label>   
      <div class="input"><select name="produk_id">
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
            </select></div> 
   </div>
   <div class="form-group">
      <label for="stok_keluar">Junlah Stok Keluar</label>   
      <div class="input"><input type="number" id="stok" name="stok" onkeyup="validasi()" required></div> 
   </div>
   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
   </div>
</form>