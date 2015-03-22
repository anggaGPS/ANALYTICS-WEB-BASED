<?php
if(isset($_POST['submit'])){

	$id_target=$_POST['id_target'];
	$target=ucwords($_POST['target']);
	$kode=ucwords($_POST['kode']);
$tahun=ucwords($_POST['tahun']);	
	$query=mysql_query("insert into tbl_target values('$id_target','$target','$kode', '$tahun')");
	
	if($query){
		?><script language="javascript">alert('Berhasil Input Data')</script><?php
		?><script language="javascript">document.location.href="?page=info-target"</script><?php
	}else{
		echo mysql_error();
	}
	
}else{
	unset($_POST['submit']);
}

if(isset($_GET['mode'])=='delete'){
	 $id_target=$_GET['id_target'];
	 mysql_query("delete from tbl_target where id_target='$id_target'");
}
?><?php
include "koneksi.php";


$id_target = $_GET['id_target'];
$kode  = $_GET['kode'];
$target  = $_GET['target'];
$tahun  = $_GET['tahun'];

$masuk = mysql_query("insert into tbl_target(id_target,target,kode,tahun)
values('$id_target','$target,'$kode','$tahun')");
if($masuk){
    echo "Berhasil Menyimpan Data";
}else{
    echo "Gagal : ".mysql_error();

}

?>

<link href="dist/css/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="dist/css/flat-ui.css" rel="stylesheet">
    <link href="docs/assets/css/demo.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">

<table width="477" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
	<td align="left" valign="top" class="heading"></td>
  </tr>
  
  
	<td align="left" valign="top" style="padding-top:20px;"><form method="post" action="?page=info-target" style="margin:auto;">
	  <table width="94%" border="0" align="left" cellpadding="0" cellspacing="0" class="border">
		
		 <div class="row">
        <div class="col-xs-3">
          <div class="form-group">
		  <tr>
		   <td width="36%" align="left" valign="middle"><span style="color:#858585;">ID Target : </span></td>
           <td> <input type="text" value="" name="id_target" placeholder="id target" class="form-control" /> </td>
		   </tr>
          </div>
        </div>
		
		<tr>
 <div class="row">
        <div class="col-xs-3">
          <div class="form-group">
		  <tr>
		   <td width="36%" align="left" valign="middle"><span style="color:#858585;">Target : </span></td>
           <td> <input type="text" value="" name="target" placeholder="Target" class="form-control" /> </td>
		   </tr>
          </div>
        </div>
		</tr>
		<tr>
		 <div class="row">
        <div class="col-xs-3">
          <div class="form-group">
		  <tr>
		   <td width="36%" align="left" valign="middle"><span style="color:#858585;">Provinsi: </span></td>
           <td> <select name="kode" id="kode">
<?php 
$query=mysql_query("select * from tbl_provinsi order by provinsi asc");

while($row=mysql_fetch_array($query))
{
	?><option value="<?php  echo $row['kode']; ?>"><?php  echo $row['provinsi']; ?></option><?php 
}
?>

</select>
			 </td>
		   </tr>
          </div>
        </div>
		  </tr>
		  <tr>
		 <div class="row">
        <div class="col-xs-3">
          <div class="form-group">
		  <tr>
		   <td width="36%" align="left" valign="middle"><span style="color:#858585;">Tahun: </span></td>
           <td> <input type="text" value="" name="tahun" placeholder="Tahun" class="form-control" /> </td>
		   </tr>
          </div>
        </div>
		  </tr>
		<tr>
		  <td align="left" valign="middle">&nbsp;</td>
		  <td colspan="2" style="padding-top:6px; padding-bottom:6px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			   <tr>
			   <div class="row demo-row">
        <div class="col-xs-3">
				<td width="33%"><input class="btn btn-primary btn-lg btn-block"  type="submit" name="submit" value="Submit"></td>
				<td width="67%"></td>
				  </div>
				  </div> 
			  </tr>
		  </table></td>
		</tr>
	  </table>
	</form></td>
  </tr>
</table>

	<div id="tabelExport" align="center" class="table table-bordered table-hover">
<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
	<thead>
		<tr>

			<th><h3>ID target</h3></th>
			<th><h3>Target</h3></th>
			<th><h3>Provinsi</h3></th>
			<th><h3>Tahun</h3></th>

			<th><h3>Aksi</h3></th>
		</tr>
	</thead>
	<tbody>
	 <?php
		$query=mysql_query("SELECT * FROM tbl_target");					

		while($row=mysql_fetch_assoc($query)){
			?>
			<tr>
			
				<td><?php echo $row['id_target'];?></td>
				<td><?php echo $row['target'];?></td>
				<td><?php echo $row['kode'];?></td>
				<td><?php echo $row['tahun'];?></td>
				<td><img src="images/edit.png"> <a href="?page=info-target&mode=delete&id_target=<?php echo $row['id_target'];?>" onClick="return confirm('Apakah Anda Yakin?')"><img src="images/delete.png"></a></td>
			</tr>
			<?php
		}
	?>
	</tbody>
</table>
<button class="btn btn-primary" id="tombolExport">Export Excel</button>
           
		</div>
		<br>
		1:pulau Sumatera 2=Jawa 
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