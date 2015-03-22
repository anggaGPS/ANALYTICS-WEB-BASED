<?php
if(isset($_POST['submit'])){

	$nip=$_POST['nip'];
	$password=ucwords($_POST['password']);
	$nama=ucwords($_POST['nama']);
	
	
	$query=mysql_query("insert into tbl_user values('$nip','$password','$nama')");
	
	if($query){
		?><script language="javascript">alert('Berhasil Input Data')</script><?php
		?><script language="javascript">document.location.href="?page=data-password"</script><?php
	}else{
		echo mysql_error();
	}
	
}else{
	unset($_POST['submit']);
}

if(isset($_GET['mode'])=='delete'){
	 $nip=$_GET['nip'];
	 mysql_query("delete from tbl_user where nip='$nip'");
}
?>



	<div id="tabelExport" align="center" class="table table-bordered table-hover">
<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
	<thead>
		<tr>

			<th><h3>nip</h3></th>
			<th><h3>Password</h3></th>
			<th><h3>Nama</h3></th>
			<th><h3>Provinsi</h3></th>
			<th><h3>Aksi</h3></th>
			
		</tr>
	</thead>
	<tbody>
	 <?php
		$query=mysql_query("SELECT * FROM tbl_user");					

		while($row=mysql_fetch_assoc($query)){
			?>
			<tr>
			
				<td><?php echo $row['nip'];?></td>
				<td><?php echo $row['password'];?></td>
				<td><?php echo $row['nama'];?></td>
				<td><?php echo $row['provinsi'];?></td>
				
				<td><img src="images/edit.png"> <a href="?page=datauser&mode=delete&nip=<?php echo $row['nip'];?>" onClick="return confirm('Apakah Anda Yakin?')"><img src="images/delete.png"></a></td>
			</tr>
			<?php
		}
	?>
	</tbody>
</table>
<button class="btn btn-primary" id="tombolExport">Export Excel</button>
           
		</div>
		
	<script type="text/javascript" src="script.js"></script>
	<script type="text/javascript">
		var sorter = new TINY.table.sorter("sorter");
		sorter.head = "head";
		sorter.asc = "asc";
		sorter.desc = "desc";
		sorter.even = "evenrow";
		sorter.odd = "oddrow";
		sorter.evensel = "evenselected";
		sorter.oddsel = "oddselected";
		sorter.paginate = true;
		sorter.currentid = "currentpage";
		sorter.limitid = "pagelimit";
		sorter.init("table",0);
	</script>
<script src="js/jquery-2.0.1.min.js"></script>
	<script src="js/jquery.base64.js"></script>
        <script src="js/jquery.btechco.excelexport.js"></script>
	<script>
            $(document).ready(function () {
                $("#tombolExport").click(function () {
                    $("#tabelExport").btechco_excelexport({
                        containerid: "tabelExport"
                       , datatype: $datatype.Table
                    });
                });
            });
	</script>