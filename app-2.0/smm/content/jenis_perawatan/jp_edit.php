<?php
   if(!defined('INDEX')) die("");

   $id = isset($_GET['jp_id']) && !empty($_GET['jp_id']) ? $_GET['jp_id'] : '';

   $query = mysqli_query($con, "SELECT * FROM jenis_perawatan WHERE jp_id='$id'");
   $data = mysqli_fetch_array($query);

   # params = 00:00:00
   function convertHoursToMinute($time){
      $time = explode(':', $time);
      return ($time[0]*60) + ($time[1]) + ($time[2]/60);
   }
?>

<h2 class="judul">Edit Jenis Perawatan</h2>
<form name="myForm" onsubmit="return confirm('Lanjutkan menyimpan data!')" method="post" action="?mod=jenis_perawatan&hal=jp_update">
   <input type="hidden" name="jp_id" value="<?= $data['jp_id'] ?>">
   <div class="form-group">
      <label for="nama_perawatan"><small style="color:red;">*</small>Nama Perawatan</label>   
      <div class="input">
         <input type="text" id="nama_perawatan" name="nama_perawatan" value="<?= $data['nama_perawatan'] ?>" required>
      </div> 
   </div>

   <div class="form-group">
      <label for="harga"><small style="color:red;">*</small>Harga</label>   
      <div class="input"><input type="number" id="harga" name="harga" value="<?= $data['harga'] ?>" required></div> 
   </div>

   <div class="form-group">
      <label for="waktu"><small style="color:red;">*</small>Waktu (Menit)</label>   
      <div class="input"><input type="number" id="waktu" name="waktu" min="0" max="999" value="<?= convertHoursToMinute($data['waktu']) ?>" required></div> 
   </div>

   <div class="form-group">
      <label for="komisi">Komisi</label>   
      <div class="input"><input type="number" id="komisi" name="komisi" min="0" value="<?= $data['komisi'] ?>"></div> 
   </div>
   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
   </div>
</form>