<?php
	include('koneksi.php');
	//session_start();
	//tangkap data dari form login
	$nip = $_POST['nip'];
	$password = $_POST['password'];
	

	

	
	echo " nip = ".$nip." dan password = ".$password;
	$q = mysql_query("SELECT * FROM tbl_user WHERE nip='$nip' AND password='$password' "); 
	if (mysql_num_rows($q) == 1) {
		//kalau username dan password sudah terdaftar di database
		header('location:dashboard0.php');
	}else{
	header('location:userdata.php');
		
	}
?>

