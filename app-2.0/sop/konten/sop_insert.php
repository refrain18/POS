<?php
   if(!defined('INDEX')) die("");

   $now = date("Y-m-d H:i:s");
   $pegawai_id = $_POST['pegawai_id'];
   $jp_id = $_POST['jp_id'];
   

   if(!empty($_FILES["fp"]["name"])){
      $nama_file = $_FILES["fp"]["name"];
      $tipefile = $_FILES["fp"]["type"];
      $ukuranfile = $_FILES["fp"]["size"];
      if($tipefile != "image/jpeg" and $tipefile != "image/jpg" and $tipefile != "image/png"){
          header("location: ?hal=sop_tambah&id_sop=$id_sop&notif=tipefile");
          die();
      }elseif ($ukuranfile >= 3000000) {
          header("location: ?hal=sop_tambah&id_sop=$id_sop&notif=ukuranfile");
          die();
      }else{
          move_uploaded_file($_FILES["file"]["tmp_name"], "gambar/foto_pegawai/".$f_pegawai);
      }
   }

   if(!empty($_FILES["fc"]["name"])){
    $nama_file = $_FILES["fc"]["name"];
    $tipefile = $_FILES["fc"]["type"];
    $ukuranfile = $_FILES["fc"]["size"];
    if($tipefile != "image/jpeg" and $tipefile != "image/jpg" and $tipefile != "image/png"){
        header("location: ?hal=sop_tambah&id_sop=$id_sop&notif=tipefilec");
        die();
    }elseif ($ukuranfile >= 3000000) {
        header("location: ?hal=sop_tambah&id_sop=$id_sop&notif=ukuranfilec");
        die();
    }else{
        move_uploaded_file($_FILES["file"]["tmp_name"], "gambar/foto_customer/".$f_customer);
    }
 }
   $query = mysqli_query($con, "INSERT INTO sop SET
      waktu = '$now',
      pegawai_id = '$pegawai_id',
      jp_id = '$jp_id',
      foto_pegawai = '$f_pegawai',
      foto_customer = '$f_customer'
   ");

   if($query){
      echo "Data berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='1; url=?hal=sop_rundown'>";
   }else{
      echo "Tidak dapat menyimpan data!<br>";
      echo mysqli_error($con);
   }
?>