<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<?php

@mysql_connect("localhost","root","");
@mysql_select_db("db_smb");

include"FusionCharts/FC_Colors.php";
include"FusionCharts/FusionCharts_Gen.php";
include"FusionCharts/FusionCharts.php";

echo"<SCRIPT LANGUAGE='Javascript' SRC='FusionCharts/FusionCharts.js'></SCRIPT>";
   
 $strXML="<graph caption='Grafik Penjualan' numberPrefix='  ' yAxisName='peserta' decimalPrecision='0' formatNumberScale='0'>";
 
   
	$kategori="<categories>";
	$data = "<dataset seriesName='2015' color='".getFCColor()."' >";
	$data1 = "<dataset seriesName='2016' color='".getFCColor()."' >";
	$data2 = "<dataset seriesName='2017' color='".getFCColor()."' >";
	$data3 = "<dataset seriesName='2018' color='".getFCColor()."' >";
	$data4 = "<dataset seriesName='2019' color='".getFCColor()."' >";
	$data5 = "<dataset seriesName='2020' color='".getFCColor()."' >";
	$data6 = "<dataset seriesName='2021' color='".getFCColor()."' >";
	$data7 = "<dataset seriesName='2022' color='".getFCColor()."' >";
	$data8 = "<dataset seriesName='2023' color='".getFCColor()."' >";

	
	$sql="SELECT * FROM analisis_ujianpertahun "; $qr=mysql_query($sql); while($Data=mysql_fetch_array($qr)){
   
   	$arrData[0][1]="$Data[nama_ujian]";
   
   	$arrData[0][2]="$Data[tahun2015]";
   
   	$arrData[0][3]="$Data[tahun2016]";
	
    $arrData[0][4]="$Data[tahun2017]";
	   	
	$arrData[0][5]="$Data[tahun2018]";
   
   	$arrData[0][6]="$Data[tahun2019]";
	
    $arrData[0][7]="$Data[tahun2020]";
	
   	$arrData[0][8]="$Data[tahun2021]";
   
   	$arrData[0][9]="$Data[tahun2022]";
	
    $arrData[0][10]="$Data[tahun2023]";
	
	  
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
<br></br><link rel="stylesheet" href="tabel.css" />

<body onLoad="document.postform.elements['nama_ujian'].focus();">

<?php
//untuk koneksi database

	
//untuk menantukan tahun awal dan tahun akhir data di database
$min_tahun=mysql_fetch_array(mysql_query("select min(tahun) as min_tahun from total_ujian"));
$max_tahun=mysql_fetch_array(mysql_query("select max(tahun) as max_tahun from total_ujian"));
?>

<form action="?page=grafikujian" method="post" name="postform">
<table width="435" border="0">
<tr>
    <td width="111">Nama Ujian</td>
	<div class="input-group margin">
	<span class="input-group-btn">
    <td colspan="2"><input type="text" class="form-control" name="nama_ujian" value="<?php if(isset($_POST['nama_ujian'])){ echo $_POST['nama_ujian']; }?>"/></td>
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
	$nama_ujian=$_POST['nama_ujian'];
	$tahun_awal=$_POST['tahun_awal'];
	$tahun_akhir=$_POST['tahun_akhir'];
	
	if(empty($nama_ujian) and empty($tahun_awal) and empty($tahun_akhir)){
		//jika tidak menginput apa2
		$query=mysql_query("select * from total_ujian");
		$jumlah=mysql_fetch_array(mysql_query("select sum(jumlah) as total from total_ujian"));
		
	}else{
		
		?><i><b>Informasi : </b> Pencarian nama nama_ujian <b>
		<?php echo ucwords($_POST['nama_ujian']);?></b> dari tahun <b>
		<?php echo $_POST['tahun_awal']?></b> sampai dengan tahun <b>
		<?php echo $_POST['tahun_akhir']?></b></i><?php
		
		$query=mysql_query("select * from total_ujian where nama_ujian like '%$nama_ujian%' and tahun between '$tahun_awal' and '$tahun_akhir'");
		$jumlah=mysql_fetch_array(mysql_query("select sum(jumlah) as total from total_ujian where nama_ujian like '%$nama_ujian%' and tahun between '$tahun_awal' and '$tahun_akhir'"));
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
 <td> <a href="exportgrafikujian.php" class="btn btn-info btn-flat">Export Data</a></td>
                  <table id="example2" class="table table-bordered table-hover">
	<tr>
    	<th width="34">No</th>
    	<th width="90">Tahun</th>
    	<th width="131">Nama Ujian</th>
    	<th width="104">Jumlah Total Bedasrkan Jalur Seleksi</th>
    </tr>
	<?php
	//untuk penomoran data
	$no=0;
	
	//menampilkan data
	while($row=mysql_fetch_array($query)){
	?>
    <tr>
    	<td><?php echo $no=$no+1; ?></td><td><?php echo $row['tahun']; ?></td>
		<td><?php echo $row['nama_ujian'];?></td><td align="left">
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