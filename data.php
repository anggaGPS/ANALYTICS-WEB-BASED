<?php
 $server = "localhost";
 $username = "root";
 $password = "";
 $database = "db_smb";
 $con = mysql_connect($server, $username, $password) or die
("Could not connect: " . mysql_error());
 mysql_query('SET CHARACTER SET utf8');
 mysql_select_db($database, $con);
 $sql = "SELECT * FROM analisis_selisihpertahun";
 $result = mysql_query($sql) or die ("Query error: " .
mysql_error());
 $records = array();
 while($row = mysql_fetch_assoc($result)) {
 $records[] = $row;
 }
 mysql_close($con);

 $data = "{\"provinsi\" : ".json_encode($records)."}";
 echo $data;
 
?>
