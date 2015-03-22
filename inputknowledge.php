<?php
if(isset($_POST['submit'])){

	$ID=$_POST['ID'];
	$solusi_dan_pertanyaan=ucwords($_POST['solusi_dan_pertanyaan']);
	$bila_benar=ucwords($_POST['bila_benar']);
		$bila_salah=ucwords($_POST['bila_salah']);
	$mulai=ucwords($_POST['mulai']);
	$selesai=ucwords($_POST['selesai']);
	
	
	$query=mysql_query("insert into tbl_knowledge values('$ID','$solusi_dan_pertanyaan','$bila_benar','$bila_salah','$mulai','$selesai')");
	
	if($query){
		?><script language="javascript">alert('Berhasil Input Data')</script><?php
		?><script language="javascript">document.location.href="?page=inputknowledge"</script><?php
	}else{
		echo mysql_error();
	}
	
}else{
	unset($_POST['submit']);
}

if(isset($_GET['mode'])=='delete'){
	 $ID=$_GET['ID'];
	 mysql_query("delete from tbl_knowledge where ID='$ID'");
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
  
  
	<td align="left" valign="top" style="padding-top:20px;"><form method="post" action="?page=inputknowledge" style="margin:auto;">
	  <table width="94%" border="0" align="left" cellpadding="0" cellspacing="0" class="border">
		
		 <div class="row">
		   <div class="col-xs-3">
          <div class="form-group">
		  <tr>
		   <td width="36%" align="left" valign="middle"><span style="color:#858585;">ID : </span></td>
           <td> <input type="text" value="" name="ID" placeholder="id" class="form-control" /> </td>
		   </tr>
          </div>
        </div>
        <div class="col-xs-3">
          <div class="form-group">
		  <tr>
		   <td width="36%" align="left" valign="middle"><span style="color:#858585;">Pertanyaan : </span></td>
           <td> <input type="text" value="" name="solusi_dan_pertanyaan" placeholder="id" class="form-control" /> </td>
		   </tr>
          </div>
        </div>
		
		<tr>
 <div class="row">
        <div class="col-xs-3">
          <div class="form-group">
		  <tr>
		   <td width="36%" align="left" valign="middle"><span style="color:#858585;">Alur Pertanyaan Benar : </span></td>
           <td> <input type="text" value="" name="bila_benar" placeholder="Nama Provinsi" class="form-control" /> </td>
		   </tr>
          </div>
        </div>
		</tr>
		<tr>
		 <div class="row">
        <div class="col-xs-3">
          <div class="form-group">
		  <tr>
		   <td width="36%" align="left" valign="middle"><span style="color:#858585;">Alur Pertanyaan Tidak: </span></td>
           <td> <input type="text" value="" name="bila_salah" placeholder="Ibuku Kota" class="form-control" /> </td>
		   </tr>
          </div>
        </div>
		  </tr>
		  <tr>
		 <div class="row">
        <div class="col-xs-3">
          <div class="form-group">
		  <tr>
		   <td width="36%" align="left" valign="middle"><span style="color:#858585;">Alur Mulai: </span></td>
           <td> <select type="text" value="" name="mulai" placeholder="Ibuku Kota" class="form-control" > 
		   
<option>Y</option>
<option>N</option>

</select> </td>
		   </tr>
          </div>
        </div>
		  </tr>
		  <tr>
		 <div class="row">
        <div class="col-xs-3">
          <div class="form-group">
		  <tr>
		   <td width="36%" align="left" valign="middle"><span style="color:#858585;">Alur Selesai: </span></td>
           <td> <select type="text" value="" name="selesai" placeholder="Ibuku Kota" class="form-control" > 
		   
<option>Y</option>
<option>N</option>

</select>
</td>
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

			<th><h3>ID </h3></th>
			<th><h3>Pertanyaan</h3></th>
			<th><h3>Bila Benar</h3></th>
			<th><h3>Bila Salah</h3></th>
			<th><h3>Mulai</h3></th>
			<th><h3>salah</h3></th>
			
		</tr>
	</thead>
	<tbody>
	 <?php
		$query=mysql_query("SELECT * FROM tbl_knowledge ");					

		while($row=mysql_fetch_assoc($query)){
			?>
			<tr>
			
				<td><?php echo $row['ID'];?></td>
				<td><?php echo $row['solusi_dan_pertanyaan'];?></td>
				<td><?php echo $row['bila_benar'];?></td>
				<td><?php echo $row['bila_salah'];?></td>
				<td><?php echo $row['mulai'];?></td>
				<td><?php echo $row['selesai'];?></td>
				<td><img src="images/edit.png"> <a href="?page=inputknowledge&mode=delete&ID=<?php echo $row['ID'];?>" onClick="return confirm('Apakah Anda Yakin?')"><img src="images/delete.png"></a></td>
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
