<?php
include "koneksi.php";


$id_target = $_GET['id_target'];
$id_prov  = $_GET['id_prov'];
$target  = $_GET['target'];
$tgl  = $_GET['tgl'];

$masuk = mysql_query("insert into tbl_target(id_target,target,id_prov,tgl)
values('$id_target','$target,'$id_prov','$tgl')");
if($masuk){
    echo "Berhasil Menyimpan Data";
}else{
    echo "Gagal : ".mysql_error();

}

?>
