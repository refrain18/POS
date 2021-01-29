<?php
   if(!defined('INDEX')) die("");
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
<h2 class="judul">Tambah Gaji Pegawai</h2>
<form name="myForm" onsubmit="return validateForm()" method="post" action="?hal=gp_insert" enctype="multipart/form-data">

   <?php
      
    //   $notif = isset($_GET['notif']) ? $_GET['notif'] : false;

    //   if($notif == 'tipefile') {
    //      echo "<div class='notif' id='notif'>Tipe file tidak didukung!</div>";
    //   }elseif($notif == 'ukuranfile') {
    //      echo "<div class='notif' id='notif'>Ukuran file tidak boleh lebih dari 1MB</div>";
    //   }

   ?>
   <div class="form-group">
      <label >Periode</label>   
      <div class="#"><input type="date" id="awal" name="awal"/>S/D
      <input  type="date" id="akhir" name="akhir" onkeyup="validasi()"></div>
   </div>
   <div class="form-group">
      <label for="nama_pegawai">Nama Pegawai</label>   
      <div class="input"><select name="nama">
                <?php
                    $query = mysqli_query($con, "SELECT pegawai_id, nama FROM pegawai ORDER BY pegawai_id ASC");
                    while($row=mysqli_fetch_assoc($query)){
                        if($pegawai_id == $row['pegawai_id']) {
                            echo "<option value='$row[pegawai_id]' selected='true'>$row[nama]</option>";
                        }else{
                            echo "<option value='$row[pegawai_id]'>$row[nama]</option>";
                        }
                    }
                ?>
            </select></div> 
   </div>       
   <div class="form-group">
      <label >Gaji Pokok</label>   
      <div class="input"><input type="number" id="gajipokok" name="gajipokok" onkeyup="sum();" required></div> 
   </div>

   <div class="form-group">
      <label >Tunjangan</label>   
      <div class="input"><input type="number" id="tunjangan" name="tunjangan" onkeyup="sum();" required></div> 
   </div>

   <div class="form-group">
      <label >Loyalitas</label>   
      <div class="input"><input type="number" id="loyalitas" name="loyalitas" onkeyup="sum();" required></div> 
   </div>
   <div class="form-group">
      <label >Kedisiplinan</label>   
      <div class="input"><input type="number" id="kedisiplinan" name="kedisiplinan" onkeyup="sum();" required></div> 
   </div>
   <div class="form-group">
      <label >Transport + Uang Makan</label>   
      <div class="input"><input type="number" id="transport_umakan" name="transport_umakan" onkeyup="sum();" required></div> 
   </div>
   <div class="form-group">
      <label >Total Gaji</label>   
      <div class="input"><input type="number" id="totalgaji" name="totalgaji" onkeyup="kurangin();" readonly></div> 
   </div>
   <div class="form-group">
      <label >Tidak Piket & Telponan</label>   
      <div class="input"><input type="tpi_tel" id="tpi_tel" name="tpi_tel" onkeyup="kurangin();"></div> 
   </div>
   <div class="form-group">
      <label >Total Terima</label>   
      <div class="input"><input type="number" id="totalterima" name="totalterima" readonly></div> 
   </div>
    <!-- <div class="form-group">
      <label for="bukti_pembayaran">Struk Pembayaran</label>   
      <div class="input"><input type="file" id="cb" name="file"></div> 
   </div> -->

   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
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