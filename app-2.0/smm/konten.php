<?php
   if(!defined('INDEX')) die("");

   $halamanArr = array(
      "dashboard",
      "pos", "pos_tambah", "pos_insert", 
      "pos_edit", "pos_update", "pos_hapus",
      "data_pegawai", "tambah_pg", "insert_pg", 
      "edit_pg", "update_pg", "hapus_pg",
      "laporan_harian", "laporan_bulanan",
      "gaji_pegawai","gp_tambah","gp_insert",
      "gp_edit","gp_update","gp_hapus","gp_cetak",
      "daftar_produk","dp_tambah","dp_insert",
      "dp_edit","dp_update","dp_hapus",
      "daftar_hpp","dh_detail","dh_cetak",
      "dh_cetak_detail","jenis_perawatan",
      "jp_tambah","jp_insert","jp_edit",
      "jp_update","jp_hapus","absen_pegawai",
      "ap_tambah","ap_insert","ap_edit",
      "ap_update","ap_hapus","rekap_absen",
      "ra_cetak","ra_detail","ra_cetak_detail",
      "kinerja","k_tambah","k_insert",
      "k_edit","k_update","k_hapus","rekap_kinerja",
      "rk_cetak","rk_detail","rk_cetak_detail",
      "stok_masukM","sm_tambah","sm_insert","sm_edit",
      "sm_update","sm_hapus","rekap_sm","rsm_cetak",
      "rsm_detail","rsm_cetak_detail","stok_keluarM",
      "sk_tambah","sk_insert","sk_edit","sk_update",
      "sk_hapus","rekap_sk","rsk_cetak","rsk_detail",
      "rsk_cetak_detail"
   );

   $maintenanceArr = array(
      "gp_edit","gp_update","gp_hapus","gp_cetak",
      "rekap_sm", "rekap_sk", "kinerja","daftar_produk","dp_tambah","dp_insert",
      "dp_edit","dp_update","dp_hapus",
      "daftar_hpp","dh_detail","dh_cetak",
      "dh_cetak_detail","absen_pegawai",
      "ap_tambah","ap_insert","ap_edit",
      "ap_update","ap_hapus","rekap_absen",
      "ra_cetak","ra_detail","ra_cetak_detail",
      "kinerja","k_tambah","k_insert",
      "k_edit","k_update","k_hapus","rekap_kinerja",
      "rk_cetak","rk_detail","rk_cetak_detail",
      "stok_masukM","sm_tambah","sm_insert","sm_edit",
      "sm_update","sm_hapus","rekap_sm","rsm_cetak",
      "rsm_detail","rsm_cetak_detail","stok_keluarM",
      "sk_tambah","sk_insert","sk_edit","sk_update",
      "sk_hapus","rekap_sk","rsk_cetak","rsk_detail",
      "rsk_cetak_detail"
   );

   if(isset($_GET['hal']) && !empty($_GET['hal'])) $hal = $_GET['hal'];
   else $hal = "dashboard";

   foreach($halamanArr as $h){
      if ($h == $hal) {
         foreach($maintenanceArr as $m) {
            if ($h == $m) {
               include "maintenance.php";
               break 2;
            }
         }
         include "content/$h.php";
         break;
      } 
   }
?>
