<?php
include "koneksi.php";
$akhir = $_GET['akhir'];
if($akhir==1){
    $query = "SELECT * FROM view_informasi ORDER BY id_info DESC LIMIT 1";
}else{
    $query = "SELECT * FROM view_informasi";
}
$data = mysql_query($query);

$json = '{"wilayah": {';
$json .= '"petak":[ ';
while($x = mysql_fetch_array($data)){
    $json .= '{';
    $json .= '"id":"'.$x['id_info'].'",
        "judul":"'.htmlspecialchars($x['nama']).'",
        "deskripsi":"'.htmlspecialchars($x['deskripsi']).'",
		"provinsi":"'.htmlspecialchars($x['provinsi']).'",
		"nama_lokasi":"'.htmlspecialchars($x['nama_lokasi']).'",
		"nama_ujian":"'.htmlspecialchars($x['nama_ujian']).'",
		"peserta":"'.htmlspecialchars($x['peserta']).'",
		"kode":"'.htmlspecialchars($x['kode']).'",
		"tahun":"'.htmlspecialchars($x['tahun']).'",
		
		"korban":"'.htmlspecialchars($x['korban']).'",
		"penyebab":"'.htmlspecialchars($x['penyebab']).'",
		"kerusakan":"'.htmlspecialchars($x['kerusakan']).'",
		"bantuan":"'.htmlspecialchars($x['bantuan']).'",
		"pengungsi":"'.htmlspecialchars($x['pengungsi']).'",
		"tgl":"'.htmlspecialchars($x['tgl']).'",
		"id_info":"'.htmlspecialchars($x['id_info']).'",
        "x":"'.$x['lat'].'",
        "y":"'.$x['lng'].'",
		
        "jenis":"'.$x['jenis'].'"
    },';
}
$json = substr($json,0,strlen($json)-1);
$json .= ']';

$json .= '}}';
echo $json;

?>
