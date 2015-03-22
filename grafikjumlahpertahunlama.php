<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">

<?php
//untuk koneksi database

	
//untuk menantukan tahun awal dan tahun akhir data di database
$min_tahun=mysql_fetch_array(mysql_query("select min(tahun) as min_tahun from view_jumlah"));
$max_tahun=mysql_fetch_array(mysql_query("select max(tahun) as max_tahun from view_jumlah"));
?>

<form action="?page=grafikjumlahpertahunlama" method="post" name="postform">
<table width="435" border="0">
<tr>
    <td width="111">Provinsi</td>
	<div class="input-group margin">
	<span class="input-group-btn">
    <td colspan="2"><input type="text" class="form-control" name="provinsi" value="<?php if(isset($_POST['provinsi'])){ echo $_POST['provinsi']; }?>"/></td>
	</span>
					</div>
</tr>
<tr>

    <td>Tahun Awal</td>
	<div class="input-group margin">
                   
	<span class="input-group-btn">
    <td colspan="2"> <input type="text" class="form-control"  name="tahun_awal" size="15" value="<?php echo $min_tahun['min_tahun'];?>"/>
    				
    </td>
	
                      
                    </span>
					</div>
</tr>
<tr>
    <td>Tahun Akhir</td>
	<div class="input-group margin">
                   
	<span class="input-group-btn">
    <td colspan="2"><input type="text" class="form-control" name="tahun_akhir" size="15" value="<?php echo $max_tahun['max_tahun'];?>"/>
   				
    </td>
	</span>
					</div>
</tr>
</tr>
<tr>
    <td> <button class="btn btn-info btn-flat"  type="submit" value="Tampilkan Data" name="cari">Tampilkan Data</button></td>
    <td colspan="2">&nbsp;</td>
</tr>
</table>
</form>
<p>

<?php
//di proses jika sudah klik tombol cari
if(isset($_POST['cari'])){
	
	//menangkap nilai form
	$provinsi=$_POST['provinsi'];
	$tahun_awal=$_POST['tahun_awal'];
	$tahun_akhir=$_POST['tahun_akhir'];
	
	if(empty($provinsi) and empty($tahun_awal) and empty($tahun_akhir)){
		//jika tidak menginput apa2
		$query=mysql_query("select * from view_jumlah");
		$jumlah=mysql_fetch_array(mysql_query("select sum(jumlah) as total from view_jumlah"));
		
	}else{
		
		?><i><b>Informasi : </b> Pencarian nama provinsi <b>
		<?php echo ucwords($_POST['provinsi']);?></b> dari tahun <b>
		<?php echo $_POST['tahun_awal']?></b> sampai dengan tahun <b>
		<?php echo $_POST['tahun_akhir']?></b></i><?php
		
		$query=mysql_query("select * from view_jumlah where provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir'");
		$jumlah=mysql_fetch_array(mysql_query("select sum(jumlah) as total from view_jumlah where provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir'"));
	}
	
	?>
</p>
<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pejualan Pin per Provinsi</h3>
<div class="box-body">
    <td> <a href="exportgrafik.php" class="btn btn-info btn-flat">Export Data</a></td>
                  <table id="example2" class="table table-bordered table-hover">
	<tr>
    	<th width="34">No</th>
    	<th width="90">Tahun</th>
    	<th width="131">Provinsi</th>
    	<th width="104">Jumlah</th>
    </tr>
	<?php
	//untuk penomoran data
	$no=0;
	
	//menampilkan data
	while($row=mysql_fetch_array($query)){
	?>
    <tr>
    	<td><?php echo $no=$no+1; ?></td><td><?php echo $row['tahun']; ?></td>
		<td><?php echo $row['provinsi'];?></td><td align="left">
		<?php echo number_format($row['jumlah'],0,',','');?></td>
    </tr>
    <?php
	}
	?>
    <tr>
    	<td colspan="3" align="right"><strong>TOTAL</strong></td><td align="center"><?php echo number_format($jumlah['total'],0,',','.');?></td>
    </tr>
    
    <tr>
    	<td colspan="4" align="center"> 
		<?php
		//jika data tidak ditemukan
		if(mysql_num_rows($query)==0){
			echo "<font color=red><blink>Tidak ada data yang dicari!</blink></font>";
		}
		?>
        </td>
    </tr>
     
</table>
</div>
</div>
</div>
</div>
</div>
</section>


<?php
}else{
	unset($_POST['cari']);
}
?>

<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
<?php

@mysql_connect("localhost","root","");
@mysql_select_db("db_smb");

include"FusionCharts/FC_Colors.php";
include"FusionCharts/FusionCharts_Gen.php";
include"FusionCharts/FusionCharts.php";

echo"<SCRIPT LANGUAGE='Javascript' SRC='FusionCharts/FusionCharts.js'></SCRIPT>";
   
 $strXML="<graph caption='Grafik Selisih Target' numberPrefix='  ' yAxisName='peserta' decimalPrecision='0' formatNumberScale='0'>";
 
   
	$kategori="<categories>";
	$data = "<dataset seriesName='' color='".getFCColor()."' >";

	

	
	$sql="SELECT * FROM view_jumlah where provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir' "; $qr=mysql_query($sql); while($Data=mysql_fetch_array($qr)){
   
   	$arrData[3][4]="$Data[provinsi]";
   
   	$arrData[3][5]="$Data[jumlah]";
   
  
	
	  
   foreach ($arrData as $arSubData) {
      $kategori .= "<category name='".$arSubData[4]."' />";
      $data .= "<set value='".$arSubData[5] ."' />";
      
	 
	  
	
   }
}
$kategori .= "</categories>";

   $data .= "</dataset>";
   $data1 .= "</dataset>";
   $data2 .= "</dataset>";
  
   $strXML .= $kategori . $data ;
   $strXML .= "</graph>";
   echo renderChart("FusionCharts/FCF_StackedBar2D.swf", "", $strXML, "productSales", 1225, 500);

?>
<br></br>
<br></br><link rel="stylesheet" href="tabel.css" />

<body onLoad="document.postform.elements['provinsi'].focus();">
