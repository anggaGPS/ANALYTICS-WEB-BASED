<?php
include "koneksi.php";



$id_info  = $_GET['id_info'];
$kode  = $_GET['kode'];
$id_lokasi  = $_GET['id_lokasi'];
$id_ujian  = $_GET['id_ujian'];
$peserta  = $_GET['peserta'];
$penyebab  = $_GET['penyebab'];
$kerusakan  = $_GET['kerusakan'];
$bantuan  = $_GET['bantuan'];
$pengungsi  = $_GET['pengungsi'];
$tgl  = $_GET['tgl'];
$tahun  = $_GET['tahun'];

$masuk = mysql_query("insert into tbl_informasi(id_info,id_lokasi,kode,id_ujian,peserta,penyebab,kerusakan,bantuan, pengungsi,tgl,tahun)
values('$id_info','$id_lokasi','$kode','$id_ujian','$peserta','$penyebab','$kerusakan','$bantuan','$pengungsi','$tgl','$tahun')");
if($masuk){
    echo "Berhasil Menyimpan Data";
}else{
    echo "Gagal : ".mysql_error();

}

?>
