<?php
   if(!defined('INDEX')) die("");

   $halaman = array("sop","rekap_harian","rekap_bulanan",
    "sop_tambah","sop_insert","sop_lihat","sop_hapus","sop_rundown",
    "rh_cetak","rh_detail","rh_cetak_detail","rb_cetak",
    "rb_detail","rb_cetak_detail");

   if(isset($_GET['hal'])) $hal = $_GET['hal'];
   else $hal = "sop";

   foreach($halaman as $h){
      if($hal == $h){
         include "konten/$h.php";
         break;
      }
   }
?>
