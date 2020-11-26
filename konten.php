<?php
   if(!defined('INDEX')) die("");

   $halaman = array("dashboard",
      "pos", "pos_tambah", "pos_insert", 
      "pos_edit", "pos_update", "pos_hapus",
      "laporan_harian", "laporan_bulanan");

   if(isset($_GET['hal'])) $hal = $_GET['hal'];
   else $hal = "dashboard";

   foreach($halaman as $h){
      if($hal == $h){
         include "content/$h.php";
         break;
      }
   }
?>
