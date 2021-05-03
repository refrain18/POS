<?php
  // ! BUG: data response of html char is not working and returning empty string to json

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
    // Konversi request berformat JSON ke Array Assoc
    $q = json_decode($q, true);

    // Ekstraksi Req Array
    $bulan = isset($q['bulan']) && !empty($q['bulan']) ? $q['bulan'] : "";
    $tahun = isset($q['tahun']) && !empty($q['tahun']) ? $q['tahun'] : "";

    $stmt = "SELECT 
        a.produk_id, b.nama_produk, 
        (SELECT ROUND(AVG(harga), 0) FROM stok_masuk c WHERE c.produk_id = a.produk_id) as hrg_rata 
      FROM stok_masuk a JOIN produk_salon b ON a.produk_id = b.produk_id 
      WHERE YEAR(a.tanggal) = '$tahun' AND MONTHNAME(a.tanggal) = '$bulan' 
      GROUP BY a.produk_id ORDER BY a.produk_id ASC;
    ";

    $execQuery = mysqli_query($con, $stmt);
    
		if($execQuery){
      $no = 0;
      while ($row = mysqli_fetch_assoc($execQuery)) {
        $no++;
        $data .= "<tr><td>$no</td><td>$row[nama_produk]</td><td>$row[hrg_rata]</td><td><a class='tombol_detail' href='?mod=daftar_harga_produk_perbulan&hal=dh_detail&produk_id=$row[produk_id]'> Detail </a></td></tr>";
      }
      // var_dump($q, $stmt, $data);
      $status = true;
      $msg = "Data daftar rata-rata produk harian telah siap!";
		}else{
      $msg = "Query Gagal! ".mysqli_error($con);
		}
  }

  $html = htmlspecialchars($data);
	echo json_encode(
		array(
			'status' => $status,
			'message' => $msg,
      'data' => $html
		)
	);