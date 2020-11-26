<?php
   if(!defined('INDEX')) die("");
?>

<h2 class="judul">Tambah Transaksi</h2>
<form method="post" action="?hal=pos_insert" enctype="multipart/form-data">

   <?php
      
      $notif = isset($_GET['notif']) ? $_GET['notif'] : false;

      if($notif == 'tipefile') {
         echo "<div class='notif' id='notif'>Tipe file tidak didukung!</div>";
      }elseif($notif == 'ukuranfile') {
         echo "<div class='notif' id='notif'>Ukuran file tidak boleh lebih dari 1MB</div>";
      }

   ?>
   <div class="form-group">
      <label for="namaproduk">Nama Produk</label>   
      <div class="input"><input type="text" id="namaproduk" name="namaproduk"></div> 
   </div>

   <div class="form-group">
      <label for="harga">Harga</label>   
      <div class="input"><input type="number" id="harga" name="harga"></div> 
   </div>

   <div class="form-group">
      <label for="diskon">Diskon</label>   
      <div class="input"><input type="number" id="diskon" name="diskon"></div> 
   </div>

   <div class="form-group">
      <label for="jumlah">Jumlah</label>   
      <div class="input"><input type="number" id="jumlah" name="jumlah"></div> 
   </div>

   <script type="text/javascript">
            function run(){
                var cb = document.getElementById("cb");
                
                if(document.getElementById("cekboxoff").checked == true){
                    cb.disabled = true;
                }else if(document.getElementById("cekboxon").checked == true){
                    cb.disabled = false;
                }
                
            }
        </script> 
   <div class="form-group">
        <label>Jenis Transaksi</label>
        <span>
              <input type="radio" name="jenistransaksi" id="cekboxoff" onclick="run();" value="debet" required/>Debet
              <input type="radio" name="jenistransaksi" id="cekboxon" onclick="run();" value="kredit"  />Kredit
        </span>
    </div>

    <div class="form-group">
      <label for="bukti_pembayaran">Struk Pembayaran</label>   
      <div class="input"><input type="file" id="cb" name="file"></div> 
   </div>

   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
   </div>
   
</form>