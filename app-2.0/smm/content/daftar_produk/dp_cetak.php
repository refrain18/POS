<?php 
// include autoloader
require_once '../../library/dompdf/autoload.inc.php';

include_once("../../library/config.php");
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

ini_set('date.timezone', 'Asia/Jakarta');
$waktu = date("Y-m-d H:i:s");

// Get Filter
// $thn = isset($_GET["q"]) && !empty($_GET["q"]) ? $_GET["q"] : false;
// Style Laporan
$style = '
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">';

// Header laporan default
$isiLaporan = '<center><h3>Laporan Daftar Produk</h3></center><br><hr></br>';

// Blok pengolahan konten laporan
$isiLaporan .= "
  <small>
    <b>Di cetak pada:</b> $waktu
  </small>
";

$query = "SELECT * FROM produk_salon ORDER BY produk_id ASC";
$execQuery = mysqli_query($con, $query) OR die("Terjadi Kesalahan pada Query: ".mysqli_error($con));

$no = 0;
$table_data = '';
while($row=mysqli_fetch_assoc($execQuery)){
  $no++;
  $nama = $row['nama_produk'];
  $stok = $row['stok'];
  $harga = $row['harga'];

  $table_data .= "
    <tr>
      <td>$no</td>
      <td>$nama</td>
      <td>$stok</td>
      <td>$harga</td>
    </tr>
  ";
}

  $isiLaporan .= '
    <div class="table-responsive">
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <th scope="col" style="width: 25px">No</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Stok</th>
            <th scope="col">Harga</th>
          </tr>
        </thead>
        <tbody>
          '.$table_data.'
        </tbody>
      </table>
    </div>'
  ;

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
$dompdf->stream("laporan_daftar_produk.pdf", ['Attachment' => 0]);

?>