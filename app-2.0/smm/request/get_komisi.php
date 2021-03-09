<?php
	include "../library/config.php";
  
	$q = isset($_GET['q']) && !empty($_GET['q']) ? $_GET['q'] : false;
  
  // Set Time Zone    
  ini_set('date.timezone', 'Asia/Jakarta');
  $current_timestamp = date("Y-m-d");

  // Default Response
	$status = false;
	$msg = 'Error pada server tidak diketahui!';
  $data = '';

  // Error Handling - Cek Request
	if (!$q) {
		$status = true;
		$msg = 'Request tidak valid!';
	}

  if (!$status) {
    //* TODO: Buat query untuk mengambil total komisi berdasar rentang tanggal dan user
    // Konversi request berformat JSON ke Array Assoc
    $q = json_decode($q, true);

    // Ekstraksi Req Array
    $tglAwal = isset($q['tglAwal']) && !empty($q['tglAwal']) ? $q['tglAwal'] : "";
    $tglAkhir = isset($q['tglAkhir']) && !empty($q['tglAkhir']) ? $q['tglAkhir'] : "";
    $idUser = isset($q['idUser']) && !empty($q['idUser']) ? $q['idUser'] : "";

    $query = "SELECT SUM(komisi) as total_komisi FROM sop WHERE (tanggal BETWEEN '$tglAwal' AND '$tglAkhir') AND pegawai_id = '$idUser';";

    $execQuery_getKomisi = mysqli_query($con, $query);

		if($execQuery_getKomisi){
      $status = true;
      $msg = "Data Total Komisi telah di load!";
      $data = mysqli_fetch_assoc($execQuery_getKomisi);
		}else{
      $msg = "Query Gagal! ".mysqli_error($con);
		}
  }

	echo json_encode(
		array(
			'status' => $status,
			'message' => $msg,
      'data' => $data['total_komisi']
		)
	);