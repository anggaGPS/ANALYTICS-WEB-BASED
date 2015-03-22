<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">

<body onLoad="document.postform.elements['provinsi'].focus();">

<?php
//untuk koneksi database

	
//untuk menantukan tahun awal dan tahun akhir data di database
$min_tahun=mysql_fetch_array(mysql_query("select min(tahun) as min_tahun from view_banding"));
$max_tahun=mysql_fetch_array(mysql_query("select max(tahun) as max_tahun from view_banding"));
?>

<form action="?page=h" method="post" name="postform">
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
		$query=mysql_query("select * from view_banding");
		$jumlah=mysql_fetch_array(mysql_query("select sum(UTG1) as total from view_banding"));
		$jumla=mysql_fetch_array(mysql_query("select sum(USM1) as total from view_banding"));
		$juml=mysql_fetch_array(mysql_query("select sum(JPPAN) as total from view_banding"));
		$jum=mysql_fetch_array(mysql_query("select sum(JPPAU) as total from view_banding"));
		$ju=mysql_fetch_array(mysql_query("select sum(USM2) as total from view_banding"));
		$j=mysql_fetch_array(mysql_query("select sum(UTG2) as total from view_banding"));
		$a=mysql_fetch_array(mysql_query("select sum(UTG3) as total from view_banding"));
		$b=mysql_fetch_array(mysql_query("select sum(CBT) as total from view_banding"));
		$c=mysql_fetch_array(mysql_query("select sum(Kemitraan) as total from view_banding"));
		
	}else{
		
		?><i><b>Informasi : </b> Pencarian nama provinsi <b>
		<?php echo ucwords($_POST['provinsi']);?></b> dari tahun <b>
		<?php echo $_POST['tahun_awal']?></b> sampai dengan tahun <b>
		<?php echo $_POST['tahun_akhir']?></b></i><?php
		
		$query=mysql_query("select * from view_banding where provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir'");
		$jumlah=mysql_fetch_array(mysql_query("select sum(UTG1) as total from view_banding where provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir'"));
		$jumla=mysql_fetch_array(mysql_query("select sum(USM1) as total from view_banding where provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir'"));
		$juml=mysql_fetch_array(mysql_query("select sum(JPPAN) as total from view_banding where provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir'"));
		$jum=mysql_fetch_array(mysql_query("select sum(JPPAU) as total from view_banding where provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir'"));
		$ju=mysql_fetch_array(mysql_query("select sum(USM2) as total from view_banding where provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir'"));
		$j=mysql_fetch_array(mysql_query("select sum(UTG2) as total from view_banding where provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir'"));
		$a=mysql_fetch_array(mysql_query("select sum(UTG3) as total from view_banding where provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir'"));
		$b=mysql_fetch_array(mysql_query("select sum(CBT) as total from view_banding where provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir'"));
		$c=mysql_fetch_array(mysql_query("select sum(Kemitraan) as total from view_banding where provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir'"));
	}
	
	?>

</p>
<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Trend Pejualan Pin Provinsi per Jenis Jalur Masuk</h3>
				  
<div class="box-body">
<tr>
    <td> <a href="exporttrend.php" class="btn btn-info btn-flat">Export Data</a></td>
    <td colspan="2">&nbsp;</td>
</tr>
                  <table id="example2" class="table table-bordered table-hover">
	<tr>
				<th><h3>No.</h3></th>
				<th><h3>Tahun</h3></th>
				<th><h3>Provinsi</h3></th>
				<th><h3>UTG-1</h3></th>
				<th><h3>USM-1</h3></th>
				<th><h3>JPPA-N</h3></th>
				<th><h3>JPPA-U</h3></th>
				<th><h3>USM-2</h3></th>
				<th><h3>UTG-2</h3></th>
				<th><h3>UTG-3</h3></th>
				<th><h3>CBT</h3></th>
				<th><h3>Kemitraan</h3></th>
			</tr>
			<?php
	//untuk penomoran data
	$no=0;
	
	//menampilkan data
	while($row=mysql_fetch_array($query)){
	?>
	  <tr>
    	<td><?php echo $no=$no+1; ?></td><td><?php echo $row['tahun']; ?></td>
		<td><?php echo $row['provinsi'];?></td>
		<td><?php echo $row['UTG1'];?></td>
		<td><?php echo $row['USM1'];?></td>
		<td><?php echo $row['JPPAN'];?></td>
		<td><?php echo $row['JPPAU'];?></td>
		<td><?php echo $row['USM2'];?></td>
		<td><?php echo $row['UTG2'];?></td>
		<td><?php echo $row['UTG3'];?></td>
		<td><?php echo $row['CBT'];?></td>
		<td><?php echo $row['Kemitraan'];?></td>
		
    </tr>
	 <?php
	}
	?>
    <tr>
    	<td colspan="3" align="right"><strong>TOTAL</strong></td><td align="center"><?php echo number_format($jumlah['total'],0,',','.');?></td>
	
		<td align="center"><?php echo number_format($jumla['total'],0,',','.');?></td>
		<td align="center"><?php echo number_format($juml['total'],0,',','.');?></td>
		<td align="center"><?php echo number_format($jum['total'],0,',','.');?></td>
		<td align="center"><?php echo number_format($ju['total'],0,',','.');?></td>
		<td align="center"><?php echo number_format($j['total'],0,',','.');?></td>
		<td align="center"><?php echo number_format($a['total'],0,',','.');?></td>
		<td align="center"><?php echo number_format($b['total'],0,',','.');?></td>
		<td align="center"><?php echo number_format($c['total'],0,',','.');?></td>
		
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
   
 $strXML="<graph caption='Grafik Penjualan' numberPrefix='  ' yAxisName='peserta' decimalPrecision='0' formatNumberScale='0'>";
 
   
	$kategori="<categories>";
	$data = "<dataset seriesName='UTG1' color='".getFCColor()."' >";
	$data1 = "<dataset seriesName='USM1' color='".getFCColor()."' >";
	$data2 = "<dataset seriesName='JPPAN' color='".getFCColor()."' >";
	$data3 = "<dataset seriesName='JPPAU' color='".getFCColor()."' >";
	$data4 = "<dataset seriesName='USM2' color='".getFCColor()."' >";
	$data5 = "<dataset seriesName='UTG2' color='".getFCColor()."' >";
	$data6 = "<dataset seriesName='UTG3' color='".getFCColor()."' >";
	$data7 = "<dataset seriesName='CBT' color='".getFCColor()."' >";
	$data8 = "<dataset seriesName='Kemitraan' color='".getFCColor()."' >";

	
	$sql=("SELECT * FROM view_banding where  provinsi like '%$provinsi%' and tahun between '$tahun_awal' and '$tahun_akhir'"); $qr=mysql_query($sql); while($Data=mysql_fetch_array($qr)){
   
   	$arrData[0][1]="$Data[provinsi]";
   
   	$arrData[0][2]="$Data[UTG1]";
   
   	$arrData[0][3]="$Data[USM1]";
	
    $arrData[0][4]="$Data[JPPAN]";
	   	
	$arrData[0][5]="$Data[JPPAU]";
   
   	$arrData[0][6]="$Data[USM2]";
	
    $arrData[0][7]="$Data[UTG2]";
	
   	$arrData[0][8]="$Data[UTG3]";
   
   	$arrData[0][9]="$Data[CBT]";
	
    $arrData[0][10]="$Data[Kemitraan]";
	
	  
   foreach ($arrData as $arSubData) {
      $kategori .= "<category name='".$arSubData[1]."' />";
      $data .= "<set value='".$arSubData[2] ."' />";
      $data1 .= "<set value='".$arSubData[3] ."' />";
	  $data2 .= "<set value='".$arSubData[4] ."' />";
	  $data3 .= "<set value='".$arSubData[5] ."' />";
	  $data4 .= "<set value='".$arSubData[6] ."' />";
	  $data5 .= "<set value='".$arSubData[7] ."' />";
	  $data6 .= "<set value='".$arSubData[8] ."' />";
	  $data7 .= "<set value='".$arSubData[9] ."' />";
	  $data8 .= "<set value='".$arSubData[10] ."' />";
	  
	
   }
}
$kategori .= "</categories>";

   $data .= "</dataset>";
   $data1 .= "</dataset>";
   $data2 .= "</dataset>";
   $data3 .= "</dataset>";
   $data4 .= "</dataset>";
   $data5 .= "</dataset>";
   $data6 .= "</dataset>";
   $data7 .= "</dataset>";
   $data8 .= "</dataset>";
   $strXML .= $kategori . $data . $data1 . $data2 . $data3 . $data4. $data5. $data6. $data7. $data8;
   $strXML .= "</graph>";
   echo renderChart("FusionCharts/FCF_MSBar2D.swf", "", $strXML, "productSales", 1225, 600);

?>
<br></br>
<br></br>

