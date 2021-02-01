<?php

include "../lib/config.php";

session_start();

if (isset($_SESSION['sopArr'])) {
  $sopArr = $_SESSION['sopArr'];
} else {
  echo "<meta http-equiv='refresh' content='1; url=?hal=sop'>";
}

// Default Response
$status = false;
$message = "Kesalahan Tidak Diketahui";

if (!$status) {
  $query = "SELECT waktu FROM jenis_perawatan WHERE jp_id = '$sopArr[id_jenis_perawatan]'";
  $execQuery = mysqli_query($con, $query);
  $queryResult = mysqli_fetch_assoc($execQuery);

  $status = true;
  if($execQuery){
      $message = "Query Sukses!";
  }else{
      $message = "Query Gagal! ".mysqli_error($con);
  }
}

// Mengirim Response
echo json_encode(
  array(
    "status" => $status,
    "message" => $message,
    "data" => $queryResult['waktu']
  )
);