<?php
   if(!defined('INDEX')) die("");
?>
<!-- Modal -->
<div id="modal">
   <h1>Pilih SOP!</h1>
   <form name="sopForm" id="sop-form" onsubmit="return validateSopForm(this);"  method="" action="" enctype="multipart/form-data">

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

      // Set Time Zone    
      ini_set('date.timezone', 'Asia/Jakarta');
      $current_timestamp = date("Y-m-d");

      ?>

      <!-- Hidden Input -->
      <input type="hidden" name="time_stamp" value="<?php echo $current_timestamp; ?>">
      <input type="hidden" name="id_user" value="<?php echo $ID_CURRENT_USER; ?>">
      <input type="hidden" id="modal_user_id" name="id_user" value="">

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
            <input type="text" id="totalSopTimeEst" name="totalSopTimeEst" value="00:00:00" disabled>
         </div> 
      </div>
      <div class="form-group">
         <input type="submit" value="Start" class="tombol start close-button">
      </div>
   </form>
</div>

<h1>Selamat Datang di Standard Operating Procedure</h1>
<h3 class="judul">Anda login sebagai <?= ucfirst($level) ?> </h3>

<?php
   // $query = "SELECT nama FROM pegawai WHERE status = 'on'";
   $query_getUsers = "SELECT user_id, username FROM user WHERE level IN ('owner', 'clusterx')";
   $execQuery1 = mysqli_query($con, $query_getUsers) OR die('Terjadi kesalahan pada server: '.mysqli_error($con));
   $execQuery2 = mysqli_query($con, $query_getUsers) OR die('Terjadi kesalahan pada server: '.mysqli_error($con));
   //$i=0;
?>
<div data-tabs>
   <?php while($resQuery = mysqli_fetch_assoc($execQuery1)) : ;?>
      <div><?php echo ucfirst($resQuery['username']);//$i++; ?></div>
   <?php endwhile; ?>
</div>

<div data-panes>
   <?php while($resQuery = mysqli_fetch_assoc($execQuery2)) ://for($j=0;$j<$i;$j++) : ;?>
      <div>
         <div id="<?php echo "_$resQuery[user_id]";?>">
            <div class="flex-container">
               <div class="flex-item" style="align-self: baseline;">
                  <p>Jenis Perawatan : </p><br>
                  <p><span id="hasilDurasiSop">00:00</span> S/D <span>00:00</span></p><br>
                  <button id="startSopBtn" class="tombol edit" onclick="modalTrigger(); sendTabIdsToCurrentModal(<?php echo $resQuery['user_id'];?>);" type="button">Start</button>
                  <button id="stopSopBtn" class="tombol hapus" onclick="stopSop(<?php echo $resQuery['user_id'];?>);" type="button" disabled>Stop</button>
               </div>
               
               <?php 
                  // $notif = isset($_GET['notif']) ? $_GET['notif'] : false;
                  // if($notif == 'tipefile') { echo "<div class='notif' id='notif'>Tipe file tidak didukung!</div>"; }
                  // elseif($notif == 'ukuranfile') { echo "<div class='notif' id='notif'>Ukuran file tidak boleh lebih dari 3MB</div>"; }
                  // elseif($notif == 'tipefilec'){ echo "<div class='notif' id='notif'>Tipe file tidak didukung!</div>"; }
                  // elseif ($notif == 'ukuranfilec') { echo "<div class='notif' id='notif'>Ukuran file tidak boleh lebih dari 3MB</div>"; }
               ?>

            </div>
            <table class="table">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Foto Pegawai</th>
                     <th>Foto Bukti Struk</th>
                     <th>Hasil Rundown</th>
                     <th>Komisi</th>
                     <th>Keterangan</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $execQuery_getSop = mysqli_query($con, "SELECT sop.*, pegawai.nama, jenis_perawatan.nama_perawatan, sop.komisi 
                        FROM sop JOIN pegawai ON sop.pegawai_id = pegawai.pegawai_id JOIN jenis_perawatan ON sop.jp_id = jenis_perawatan.jp_id 
                        WHERE sop.tanggal = '$current_timestamp' 
                        ORDER BY id_sop DESC LIMIT 3");
                     $no = 0;
                  ?>
                  <?php if (mysqli_num_rows($execQuery) <= 0 ) : ?>
                     <?php while($data = mysqli_fetch_array($execQuery_getSop)) : ?>
                     <tr>
                        <td><?= ++$no ?></td>
                        <td><?= $data['foto_pegawai'] ?></td>
                        <td><?= $data['foto_customer'] ?></td>
                        <td><?= $data['hasil_rundown'] ?></td>
                        <td><?= $data['keterangan'] ?></td>
                        <td><?= $data['komisi'] ?></td>
                     </tr>
                     <?php endwhile; ?>
                  <?php else : ?>
                     <tr>
                        <td colspan="6"><center>Belum ada SOP tersimpan pada record hari ini!</center></td>
                     </tr>
                  <?php endif; ?>
               </tbody>
            </table>

         </div>
      </div>
   <?php endwhile;//endfor; ?>
</div>

<script src="js/tabbisCaller.js" defer></script>