<?php
include('koneksi.php');


								
$nip = $_POST['nip'];
$password = $_POST['password'];
$nama = $_POST['nama'];
$provinsi = $_POST['provinsi'];


										
	$query=mysql_query("insert into tbl_user values('$nip','$password','$nama','$provinsi')");									 

											
											
// code D
	if($query){
	echo "<p>Data Anda berhasil disimpan. Silahkan Login</p>";
		?><script language="javascript">alert('Berhasil Input Data, Klik ok dan Login')</script><?php
		?><script language="javascript">document.location.href="userdata.php"</script><?php
	}else{
		echo mysql_error();
	}
									
?>
