<?php 
// include autoloader
require_once '../../library/dompdf/autoload.inc.php';

include_once("../../library/config.php");
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

// Get Filter
$thn = isset($_GET["q"]) && !empty($_GET["q"]) ? $_GET["q"] : false;

// Style Laporan
$style = '
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">';

// Header laporan default
$isiLaporan = '<center><h3>Laporan Gaji Pegawai</h3></center><br><hr></br>';

// Blok pengolahan konten laporan
$isiLaporan .= "
  <p>
    <b>Tahun :</b> ".ucfirst($thn)."
  </p>
";

$query = "SELECT 
    gaji.*, pegawai.nama, sum(sop.komisi) as komisi 
  FROM 
    gaji LEFT JOIN pegawai ON gaji.pegawai_id = pegawai.pegawai_id LEFT JOIN sop ON pegawai.pegawai_id = sop.pegawai_id 
  WHERE YEAR(periode_awal) = '$thn' 
  GROUP BY gaji_id ORDER BY gaji_id;
";

$execQuery = mysqli_query($con, $query) OR die("Terjadi Kesalahan pada Query: ".mysqli_error($con));
$no = 0;

$order = '';
while($row=mysqli_fetch_assoc($execQuery)){
  $no++;
  $periode = date('d F Y',strtotime($row['periode_awal'])) ."&nbsp;<br>s/d<br>&nbsp;". date('d F Y',strtotime($row['periode_akhir']));
  $nama = $row['nama'];
  $gajiPokok = $row['gaji_pokok'];
  $tunjangan = $row['tunjangan'];
  $loyalitas = $row['loyalitas'];
  $kedisiplinan = $row['kedisiplinan'];
  $transport_uang_makan = $row['transport_umakan'];
  $komisi = $row['komisi'] !== null ? $row['komisi'] : 0;
  $total_gaji = $row['total_gaji'];
  $sanksi = $row['tpi_tel'];
  $total_terima = $row['total_terima'];

  $order .= "
    <tr>
      <td>$no</td>
      <td>$periode</td>
      <td>$nama</td>
      <td>$gajiPokok</td>
      <td>$tunjangan</td>
      <td>$loyalitas</td>
      <td>$kedisiplinan</td>
      <td>$transport_uang_makan</td>
      <td>$komisi</td>
      <td>$total_gaji</td>
      <td>$sanksi</td>
      <td>$total_terima</td>
    </tr>
  ";
}

  $isiLaporan .= '
    <table class="table-bordered table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Periode</th>
          <th scope="col">Nama</th>
          <th scope="col">Gaji Pokok</th>
          <th scope="col">Tunjangan</th>
          <th scope="col">Loyalitas</th>
          <th scope="col">Kedisiplinan</th>
          <th scope="col">Transport + Uang Makan</th>
          <th scope="col">Komisi</th>
          <th scope="col">Total Gaji</th>
          <th scope="col">Tidak Piket & Telpon</th>
          <th scope="col">Total Terima</th>
        </tr>
      </thead>
      <tbody>
        '.$order.'
      </tbody>
    </table>';

$dompdf->loadHtml('
  <html>
    <head>
      <title>Cetak Laporan</title>
      '.$style.'
      <style>
        table {
          font-size: 13px;
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
$dompdf->stream("laporan_gaji_pegawai_$thn.pdf", ['Attachment' => 0]);

?>