<?php
// include autoloader
require_once '../lib/dompdf/autoload.inc.php';

include_once("../lib/config.php");
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

// Get Filter
$bln = isset($_GET["q"]) && !empty($_GET["q"]) ? $_GET["q"] : false;

// Cek validitas value GET query
if ( !$bln || (date_parse($bln)['error_count'] != 0) ) {
  echo "<meta http-equiv='refresh' content='1; url=../index.php?hal=rekap_bulanan'>";
  die();
}

// Style Laporan
$style = '
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">';
  // <link rel="stylesheet" href="../css/style.css">';

// Header laporan default
$isiLaporan = '<center><h2>Laporan SOP Bulanan Salon Mumtaza</h2></center><br><hr><br>';

$query = "SELECT 
    a.tanggal, COUNT(id_sop) as total_sop,
    (SELECT COUNT(hasil_rundown) FROM sop b WHERE MONTHNAME(b.tanggal) = MONTHNAME(a.tanggal) AND b.hasil_rundown = 'Terpenuhi') as total_completed, 
    (SELECT COUNT(hasil_rundown) FROM sop c WHERE MONTHNAME(c.tanggal) = MONTHNAME(a.tanggal) AND c.hasil_rundown != 'Terpenuhi') as total_incompleted 
  FROM sop a WHERE MONTHNAME(a.tanggal) = '$bln' GROUP BY MONTHNAME(a.tanggal);
";

$execQuery = mysqli_query($con, $query) OR die("Terjadi Kesalahan pada Query: ".mysqli_error($con));
$resQuery = mysqli_fetch_assoc($execQuery);

$isiLaporan .= "
  <p>
    <b>Bulan :</b> ".ucfirst($bln)."
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Grand Total SOP :</b> $resQuery[total_sop]
  </p>
  <p>
    <b>Grand Total Rundown Complete :</b> $resQuery[total_completed]
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Grand Total Rundown Incomplete :</b> $resQuery[total_incompleted]
  </p>
";

$query = "SELECT 
  a.tanggal, COUNT(a.id_sop) as total_sop, 
  (SELECT COUNT(hasil_rundown) FROM sop b WHERE b.tanggal = a.tanggal AND b.hasil_rundown = 'Terpenuhi') as total_completed, 
  (SELECT COUNT(hasil_rundown) FROM sop c WHERE c.tanggal = a.tanggal AND c.hasil_rundown != 'Terpenuhi') as total_incompleted 
  FROM sop a WHERE MONTHNAME(a.tanggal) = '$bln' GROUP BY a.tanggal ORDER BY a.tanggal
";

$execQuery = mysqli_query($con, $query);
$no = 0;
$tbody = '';
while($data = mysqli_fetch_array($execQuery)){
  $no++;
  $tbody .= "
    <tr>
      <td>$no</td>
      <td>".date('d-m-Y', strtotime($data['tanggal']))."</td>
      <td>$data[total_sop]</td>
      <td>$data[total_completed]</td>
      <td>$data[total_incompleted]</td>
    </tr>
  ";
}

$isiLaporan .= "
  <table class='table table-sm'>
    <thead>
      <tr>
        <th scope='col'>No</th>
        <th scope='col'>Tanggal</th>
        <th scope='col'>Total SOP</th>
        <th scope='col'>Total Completed</th>
        <th scope='col'>Total Incompleted</th>
      </tr>
    </thead>
    <tbody>
      $tbody
    </tbody>
  </table>"
;

$dompdf->loadHtml('
  <html>
    <head>
      <title>Cetak Laporan</title>
      '.$style.'
      <style>
        #tabel-laporan {
          font-size: 10pt;
          margin: 20px 0px;
        }
      </style>
    </head>
    <body>
      '.$isiLaporan.'
    </body>
  </html>'
);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream('laporan_sop_bulanan_pertahun.pdf', ['Attachment' => 0]);