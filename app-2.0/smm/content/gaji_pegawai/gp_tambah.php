<?php
   if(!defined('INDEX')) die("");
?>
<script>
	function validateForm(context) {
		let conf = confirm('Submit data?');
		if (!conf) {
			return false;	
		}
		let form = context;
		let tglAwal = form.awal.value;
		let tglAkhir = form.akhir.value;
		let gajiPokok = form.gajipokok.value;
		let tunjangan = form.tunjangan.value;
		let loyalitas = form.loyalitas.value;
		let kedisiplinan = form.kedisiplinan.value;
		let transportDanMakan = form.transport_umakan.value;
		let sanksi = form.sanksi.value;

		if (tglAwal > tglAkhir) {
			alert("Periode akhir tidak boleh sebelum Periode awal");
			return false;
		}
		if (
			!gajiPokok.match(/^[0-9]+$/) || !tunjangan.match(/^[0-9]+$/) || 
			!loyalitas.match(/^[0-9]+$/) || !kedisiplinan.match(/^[0-9]+$/) || 
			!transportDanMakan.match(/^[0-9]+$/) || !sanksi.match(/^[0-9]+$/)
		) {
			alert("Input Gaji Pokok, Tunjangan, Loyalitas, Kedisiplinan, Transport dan Sanksi harus bernilai numerik!");
			return false;
		}
		return true;
	}

	function getKomisi(input, context) {
		let form = context[0];
		let tglAwal = form.awal.value;
		let tglAkhir = form.akhir.value;
		let idUser = form.nama.value;

      // Cek jika semua parameter sudah siap
      if (tglAwal != '' && tglAkhir != '' && idUser != '') {
         if (tglAwal <= tglAkhir) {
            let url = 'request/get_komisi.php'
            let req = `q={"tglAwal": "${tglAwal}", "tglAkhir": "${tglAkhir}", "idUser": ${idUser}}`;
            console.log('Activated');
            $.ajax({
               url: url,
               method: "GET",
               data: req,
               processData: false,
               contentType: false,
               dataType: "json",
               cache: false,
               success: function (res) {
                  if (res.status) {
                     form.komisi.value = res.data != null ? res.data : 0;
                     sumGaji(context);
                  }
               },
               error: function (res) {
                  alert(`Terjadi kesalahan pada server!\n${res.message}`);
               }
            });
         }
      }

		// debug
		console.log(form, input.value);
      console.log(tglAwal, tglAkhir, idUser);
	}

   function sumGaji(context) {
      let form = context[0];

      let gajiPokok = form.gajipokok.value;
      let tunjangan = form.tunjangan.value;
      let loyalitas = form.loyalitas.value;
      let kedisiplinan = form.kedisiplinan.value;
      let transportDanUangMakan = form.transport_umakan.value;
      let komisi = form.komisi.value;
      let sanksi = form.sanksi.value;
      
      let totalGaji = 0;

      if (gajiPokok != '' && tunjangan != '' && loyalitas != '' && kedisiplinan != '' && transportDanUangMakan != '' && komisi != '' && sanksi != '') {
         totalGaji = parseInt(gajiPokok) + parseInt(tunjangan) + parseInt(loyalitas) + parseInt(kedisiplinan) + parseInt(transportDanUangMakan) + parseInt(komisi);
         // Update input Total gaji dan Total terima pada Form
         form.totalgaji.value = parseInt(totalGaji);
         form.totalterima.value = parseInt(totalGaji) - parseInt(sanksi);
         
      }
   }
</script>
<h2 class="judul">Tambah Gaji Pegawai</h2>
<form name="myForm" onsubmit="return validateForm(this)" method="post" action="?mod=gaji_pegawai&hal=gp_insert" enctype="multipart/form-data">
	 <div class="form-group">
			<label >Periode</label>   
			<div class="#">
				<input type="date" id="awal" name="awal" onchange="getKomisi(this, $(this).parent().parent().parent())" required /> S/D 
				<input  type="date" id="akhir" name="akhir" onchange="getKomisi(this, $(this).parent().parent().parent())" required />
	 		</div>
   </div>
   <div class="form-group">
      <label for="nama_pegawai">Nama Pegawai</label>   
      <div class="input">
				<select name="nama" onchange="getKomisi(this, $(this).parent().parent().parent());">
					<?php
                  $query = mysqli_query($con, "SELECT pegawai_id, nama FROM pegawai ORDER BY pegawai_id ASC") OR die("Terjadi kesalahan query: ".mysqli_error(con));
                  while($row=mysqli_fetch_assoc($query)){
                     echo "<option value='$row[pegawai_id]'>$row[nama]</option>";
                  }
					?>
				</select>
			</div> 
   </div>       
   <div class="form-group">
      <label >Gaji Pokok</label>   
      <div class="input"><input type="number" id="gajipokok" name="gajipokok" min="0" value="0" onkeyup="sumGaji($(this).parent().parent().parent());" required></div> 
   </div>
   <div class="form-group">
      <label >Tunjangan</label>   
      <div class="input"><input type="number" id="tunjangan" name="tunjangan" min="0" value="0" onkeyup="sumGaji($(this).parent().parent().parent());" required></div> 
   </div>
   <div class="form-group">
      <label >Loyalitas</label>   
      <div class="input"><input type="number" id="loyalitas" name="loyalitas" min="0" value="0" onkeyup="sumGaji($(this).parent().parent().parent());" required></div> 
   </div>
   <div class="form-group">
      <label >Kedisiplinan</label>   
      <div class="input"><input type="number" id="kedisiplinan" name="kedisiplinan" min="0" value="0" onkeyup="sumGaji($(this).parent().parent().parent());" required></div> 
   </div>
   <div class="form-group">
      <label >Transport + Uang Makan</label>   
      <div class="input"><input type="number" id="transport_umakan" name="transport_umakan" min="0" value="0" onkeyup="sumGaji($(this).parent().parent().parent());" required></div> 
   </div>
   <div class="form-group">
      <label >Komisi</label>   
      <div class="input"><input type="number" id="komisi" name="komisi" value="0" onchange="sumGaji($(this).parent().parent().parent());" readonly></div> 
   </div>
   <div class="form-group">
      <label >Total Gaji</label>   
      <div class="input"><input type="number" id="totalgaji" name="totalgaji" value="0" onchange="sumGaji($(this).parent().parent().parent());" readonly></div> 
   </div>
   <div class="form-group">
      <label >Tidak Piket & Telponan</label>   
      <div class="input"><input type="number" id="tpi_tel" name="sanksi" min="0" value="0" onkeyup="sumGaji($(this).parent().parent().parent());"></div> 
   </div>
   <div class="form-group">
      <label >Total Terima</label>   
      <div class="input"><input type="number" id="totalterima" name="totalterima" value="0" readonly></div> 
   </div>
   <div class="form-group">
      <input type="submit" value="Simpan" class="tombol simpan">
      <input type="reset" value="reset" class="tombol reset">
   </div>
</form>