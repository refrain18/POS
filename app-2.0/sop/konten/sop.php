<?php
   if(!defined('INDEX')) die("");
?>
<!-- Modal -->
<div id="modal">
   <h1>Pilih SOP!</h1>
   <form name="sopForm" id="sop-form" onsubmit="return validateSopForm(this);"  method="post" action="?hal=sop_timer" enctype="multipart/form-data">

      <?php 
      $notif = isset($_GET['notif']) ? $_GET['notif'] : false;

      if($notif == 'tipefile') {
            echo "<div class='notif' id='notif'>Tipe file tidak didukung!</div>";
      }elseif($notif == 'ukuranfile') {
            echo "<div class='notif' id='notif'>Ukuran file tidak boleh lebih dari 3MB</div>";
      }elseif($notif == 'tipefilec'){
         echo "<div class='notif' id='notif'>Tipe file tidak didukung!</div>";
      }elseif ($notif == 'ukuranfilec') {
         echo "<div class='notif' id='notif'>Ukuran file tidak boleh lebih dari 3MB</div>";
      }

      $query = "SELECT jp_id, nama_perawatan FROM jenis_perawatan";
      $execQuery = mysqli_query($con, $query) OR die('Terjadi kesalahan pada server: '.mysqli_error($con));
      ?>

      <div class="form-group">
         <label for="foto_pegawai">Upload Foto Clusterx: </label>
         <div class="input"><input type="file" id="fp" name="fp" required></div> 
      </div>
      <div class="form-group">
         <label for="pilih_jk">Jenis Perawatan: </label>
         <div class="input-checkbox">
            <?php while($resQueryInLoop = mysqli_fetch_assoc($execQuery)) : ?>
               <span>
                  <input type="checkbox" class="sop_checkbox" onclick="timeEstCalc($(this).parent().parent().parent().parent());" name="pilihan_jenis_perawatan" value="<?php echo $resQueryInLoop['jp_id'];?>"><?php echo " $resQueryInLoop[nama_perawatan]"; ?>
               </span><br>
               <?php endwhile; ?>
            </div> 
      </div>
      <div class="form-group" id="timeResWrapper">
         <label for="time">Time : </label>   
         <div class="input">
            <input type="text" id="totalSopTime" name="timeSop" value="00:00" disabled>
         </div> 
      </div>
      <div class="form-group">
         <input type="submit" value="Start" class="tombol start">
      </div>
   </form>
</div>

<h1>Selamat Datang di Standard Operating Procedure</h1>
<h3 class="judul">Anda login sebagai <?= ucfirst($level) ?> </h3>

<?php
   $query = "SELECT nama FROM pegawai WHERE status = 'on'";
   $execQuery = mysqli_query($con, $query) OR die('Terjadi kesalahan pada server: '.mysqli_error($con));
   $i=0;
?>
<div data-tabs>
   <?php while($resQuery = mysqli_fetch_assoc($execQuery)) : ;?>
      <div><?php echo $resQuery['nama'];$i++; ?></div>
   <?php endwhile; ?>
</div>

<div data-panes>
   <?php for($j=0;$j<$i;$j++) : ;?>
      <div>
         <p>Jenis Perawatan : </p><br>
         <p><span>00:00</span> S/D <span>00:00</span></p><br>
         <button class="tombol edit" onclick="modalTrigger();" type="button">Start</button>
         <button class="tombol hapus" type="button">Stop</button>

      </div>
   <?php endfor; ?>
</div>

<script src="js/tabbisCaller.js" defer></script>