<?php
   if(!defined('INDEX')) die("");

   $query = mysqli_query($con, "SELECT gaji.*, pegawai.nama FROM gaji JOIN pegawai ON gaji.pegawai_id = pegawai.pegawai_id WHERE gaji_id='$_GET[gaji_id]'");
   $data = mysqli_fetch_array($query);
?>

<script>
function validateForm() {
  var x = document.forms["myForm"]["awal"].value;
  var y = document.forms["myForm"]["akhir"].value;
  if (x > y) {
    alert("periode akhir tidak boleh sebelum periode awal");
    return false;
  }
}
</script>

<h2 class="judul">Edit Gaji Pegawai</h2>
<form name="myForm" onsubmit="return validateForm()" method="post" action="?mod=gaji_pegawai&hal=gp_update">
   <input type="hidden" name="gaji_id" value="<?= $data['gaji_id'] ?>">

   <div class="form-group">
      <label for="namaproduk">Periode</label>   
      <div class="#"><input type="date" id="awal" name="awal" value="<?= $data['periode_awal'] ?>" readonly />S/D
      <input  type="date" id="akhir" name="akhir" value="<?= $data['periode_akhir'] ?>" onkeyup="validasi()" readonly></div>
   </div>
   <div class="form-group">
      <label for="harga">Nama Pegawai</label>   
      <div class="input"><input type="text" id="nama" name="nama" value="<?= $data['nama'] ?>" readonly></div> 
   </div>    
   <div class="form-group">
      <label for="harga">Gaji Pokok</label>   
      <div class="input"><input type="number" id="gajipokok" name="gajipokok" onkeyup="sum();" value="<?= $data['gaji_pokok'] ?>"></div> 
   </div>

   <div class="form-group">
      <label for="diskon">Tunjangan</label>   
      <div class="input"><input type="number" id="tunjangan" name="tunjangan" onkeyup="sum();" value="<?= $data['tunjangan'] ?>"></div> 
   </div>

   <div class="form-group">
      <label for="jumlah">Loyalitas</label>   
      <div class="input"><input type="number" id="loyalitas" name="loyalitas" onkeyup="sum();" value="<?= $data['loyalitas'] ?>"></div> 
   </div>
   <div class="form-group">
      <label for="jumlah">Kedisiplinan</label>   
      <div class="input"><input type="number" id="kedisiplinan" name="kedisiplinan" onkeyup="sum();" value="<?= $data['kedisiplinan'] ?>"></div> 
   </div>
   <div class="form-group">
      <label for="jumlah">Transport + Uang Makan</label>   
      <div class="input"><input type="number" id="transport_umakan" name="transport_umakan" onkeyup="sum();" value="<?= $data['transport_umakan'] ?>"></div> 
   </div>
   <div class="form-group">
      <label for="jumlah">Total Gaji</label>   
      <div class="input"><input type="number" id="totalgaji" name="totalgaji" onkeyup="kurangin();" value="<?= $data['total_gaji'] ?>" readonly></div> 
   </div>
   <div class="form-group">
      <label for="jumlah">Tidak Piket & Telponan</label>   
      <div class="input"><input type="number" id="tpi_tel" name="tpi_tel" onkeyup="kurangin();" value="<?= $data['tpi_tel'] ?>"></div> 
   </div>
   <div class="form-group">
      <label for="jumlah">Total Terima</label>   
      <div class="input"><input type="number" id="totalterima" name="totalterima" value="<?= $data['total_terima'] ?>" readonly></div> 
   </div>
   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
   </div>

   <script>
    function sum() {
      var txtFirstNumberValue = document.getElementById('gajipokok').value;
      var txtSecondNumberValue = document.getElementById('tunjangan').value;
      var txtThirthNumberValue = document.getElementById('loyalitas').value;
      var txtFourthNumberValue = document.getElementById('kedisiplinan').value;
      var txtFifthNumberValue = document.getElementById('transport_umakan').value;
      var result = parseFloat(txtFirstNumberValue) + parseFloat(txtSecondNumberValue) + 
                   parseFloat(txtThirthNumberValue) + parseFloat(txtFourthNumberValue) +
                   parseFloat(txtFifthNumberValue);
      if (!isNaN(result)) {
         document.getElementById('totalgaji').value = result;
      }
}
   function kurangin() {
      var txtFirstNumberValue = document.getElementById('totalgaji').value;
      var txtSecondNumberValue = document.getElementById('tpi_tel').value;
      var result = parseFloat(txtFirstNumberValue) - parseFloat(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('totalterima').value = result;
      }
   }
</script>

</form>