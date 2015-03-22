<?php
if(isset($_GET['mode'])=='delete'){
	 $id_info=$_GET['id_info'];
	 mysql_query("delete from tbl_informasi where id_info='$id_info'");
	 
	 ?><script language="javascript">document.location.href="?page=info-ujian"</script><?php
}
?>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<style type="text/css">
html { height: 100% }
			body { height: 100%; margin: 0; padding: 0 }
			#title { height: 10%; width : 100%; }
			#sidebar {height : 85% ; width : 20%; float : left}
			#petaku{ height : 100% ; width : 80%; float : left}
 </style>
 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6QymIKKv7qrk64Jk4riqIzUIv_0fvWT0&sensor=false"></script>
<script type="text/javascript" src="jquery-1.4.3.min.js"></script>
<script type="text/javascript">



var peta;
var pertama = 0;

var judulx = new Array();
var desx = new Array();
var provx = new Array();
var lokasix = new Array();
var ujianx = new Array();
var id_infox = new Array();

var pesertax = new Array();
var penyebabx = new Array();
var kerusakanx = new Array();
var bantuanx = new Array();
var pengungsix = new Array();
var tglx = new Array();
var tahunx = new Array();



var i;
var url;

var gambar_tanda;

var map,layer;var tampungKode1,tampungKode2,tampungKode3;
			var infoWindow = new google.maps.InfoWindow();
			function peta_awal() {
				google.maps.visualRefresh = true;
				var petaOptions = {
					center: new google.maps.LatLng(-3.337954,117.320251),
					zoom: 5,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				peta = new google.maps.Map(document.getElementById("petaku"),
				petaOptions);																
				
				$.ajax({
					type:'GET',						
					url:'data.php',
					dataType:'json',
					success: function(data) {							
						var kel1,kel2,kel3;
						var min="";
						var med="";
						var max="";						
						var jumlah2015,kode;						
						for(var i=0;i<data.provinsi.length;i++)
						{
							jumlah2015=data.provinsi[i].jumlah2015;
							kode=data.provinsi[i].kode;
							if(jumlah2015<=0)
							{
								min+=kode+",";							
							}
							else if(jumlah2015>0&&jumlah2015<3000)
							{
								med+=kode+",";
							}
							else if(jumlah2015>=3000)
							{
								max+=kode+",";
							}							
						}					
						fusiontablelayer(min,med,max);
					}					
				});				
				var homeControlDiv=document.createElement('div');			
				var homeControls=new legenda(homeControlDiv,map);
				homeControlDiv.index = 1;
				map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(homeControlDiv);
				
			

layer.setMap(peta);
	/*untuk tgl*/
	new JsDatePick({
		useMode:2,
		target:"tgl",
		dateFormat:"%Y-%m-%d"
		
	});
	
}
function fusiontablelayer(kode1,kode2,kode3)
			{			
				kode1=removeLastString(kode1);
				kode2=removeLastString(kode2);
				kode3=removeLastString(kode3);
				tampungKode1=kode1;tampungKode2=kode2;tampungKode3=kode3;
				layer = new google.maps.FusionTablesLayer({
					query: {
						select: 'geometry',
						from: '12s5oKFfyL-G_orulSQXuqGvzMGr85H2p6YI5nRM',	
						
					},
					options: {
						suppressInfoWindows:true
						},
					styles: [{				
						where: 'kode IN ('+kode1+')',
						polygonOptions:{
							fillColor:'#00FF00'
						}
						},{
						where: 'kode IN ('+kode2+')',
						polygonOptions:{
							fillColor:'#FFFF00'
						}
						},{
						where: 'kode IN ('+kode3+')',
						polygonOptions:{
							fillColor:'#FF0000'
						}							
					}]				
				});
				layer.setMap(peta);	
				google.maps.event.addListener(layer,'click',function(e){showData(e)});	
			}
			function removeLastString(kode)
			{
				kode = kode.substring(0,kode.length-1)+'';				
				return kode;
			}
			function showData(e)
			{
				var kodeBPS=e.row['kode'].value;
				var location=e.latLng;
				$.ajax({
					type:'GET',						
					url:'data.php',
					dataType:'json',
					success: function(data) {
						var isi="";
						for(var i=0;i<data.provinsi.length;i++)
						{
							if(data.provinsi[i].kode==kodeBPS)
							{
								isi+="<b>Provinsi : </b>"+data.provinsi[i].provinsi+"</br>";
								isi+="<b>Ibukota : </b>"+data.provinsi[i].ibukota+"</br>";
								isi+="<b>Target Yang Belum Tercapai : </b>"+data.provinsi[i].jumlah2015+" orang</br>";
								$('#showdata').html(isi);
								infoWindow.setContent("<b>"+data.provinsi[i].provinsi+"</b>");
								infoWindow.setPosition(location);
								infoWindow.open(map);
							}
						}
					}
				});
				
			}

$(document).ready(function(){
    $("#tombol_simpan").click(function(){

		
        var judul = $("#judul").val();
        var des = $("#deskripsi").val();
		var id_info = $("#id_info").val();
		var kode = $("#kode").val();
		var id_lokasi = $("#id_lokasi").val();
		var id_ujian = $("#id_ujian").val();
		var peserta = $("#peserta").val();
		var penyebab = $("#penyebab").val();
		var kerusakan = $("#kerusakan").val();
		var bantuan = $("#bantuan").val();
		var pengungsi = $("#pengungsi").val();
		var tgl = $("#tgl").val();
		var tahun = $("#tahun").val();
		
        $("#loading").show();
        $.ajax({
            url: "simpanlokasi.php",
            data: "&id_info="+id_info+"&kode="+kode+"&id_lokasi="+id_lokasi+"&id_ujian="+id_ujian+"&peserta="+peserta+"&penyebab="+penyebab+"&kerusakan="+kerusakan+"&bantuan="+bantuan+"&pengungsi="+pengungsi+"&tgl="+tgl+"&tahun="+tahun,
            cache: false,
            success: function(msg){
                alert(msg);
                $("#loading").hide();
				$("#id_info").val("");
				$("#peserta").val("");
				$("#penyebab").val("");
				$("#kerusakan").val("");
				$("#bantuan").val("");
				$("#pengungsi").val("");
				$("#tgl").val("");
				$("#tahun").val("");
                ambildatabase('akhir');
				document.location.href='?page=info-ujian';
            }
        });
    });
    $("#tutup").click(function(){
        $("#jendelainfo").fadeOut();
    });
});





function ambildatabase(akhir){
    if(akhir=="akhir"){
        url = "ambildata.php?akhir=1";
    }else{
        url = "ambildata.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
		
            for(i=0;i<msg.wilayah.petak.length;i++){
                judulx[i] = msg.wilayah.petak[i].judul;
                desx[i] = msg.wilayah.petak[i].deskripsi;
				provx[i] = msg.wilayah.petak[i].provinsi;
				lokasix[i] = msg.wilayah.petak[i].nama_lokasi;
				ujianx[i] = msg.wilayah.petak[i].nama_ujian;
				id_infox[i] = msg.wilayah.petak[i].id_info;
				pesertax[i] = msg.wilayah.petak[i].peserta;
				penyebabx[i] = msg.wilayah.petak[i].penyebab;
				kerusakanx[i] = msg.wilayah.petak[i].kerusakan;
				bantuanx[i] = msg.wilayah.petak[i].bantuan;
				pengungsix[i] = msg.wilayah.petak[i].pengungsi;
					
				tglx[i] = msg.wilayah.petak[i].tgl;
				tahunx[i] = msg.wilayah.petak[i].tahun;
				
				
               

            }
        }
    });
}



function setinfo(petak, nomor){
    google.maps.event.addListener(petak, 'click', function() {
        $("#jendelainfo").fadeIn();
        $("#teksjudul").html(judulx[nomor]);
        $("#teksdes").html(desx[nomor]);
		$("#teksprov").html(provx[nomor]);
		$("#tekslokasi").html(lokasix[nomor]);
		$("#teksujian").html(ujianx[nomor]);
		$("#teksid_info").html(id_infox[nomor]);
		$("#tekspeserta").html(pesertax[nomor]);
		$("#tekspenyebab").html(penyebabx[nomor]);
		$("#tekskerusakan").html(kerusakanx[nomor]);
		$("#teksbantuan").html(bantuanx[nomor]);
		$("#tekspengungsi").html(pengungsix[nomor]);
		$("#tekstgl").html(tglx[nomor]);
		$("#tekstahun").html(tahunx[nomor]);
		
	
		 infowindow.open(map, marker);
    });
}
</script>


<style>
#jendelainfo{position:absolute;z-index:1000;top:100;
left:400;background-color:yellow;display:none;}
</style>
</head>
<body onload="peta_awal()">
<center>
<table id="jendelainfo" border="0" cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#FFCC00" height="140">
  <tr>
    <td width="248" bgcolor="#000000" height="19"><font color=white>ID Info : <span id="teksid_info"></span></font></td>
    <td width="30" bgcolor="#000000" height="19">
    <p align="center"><font color="#FFFFFF"><a style="cursor:pointer" id="tutup"><b>X</b></a></font></td>
  </tr>
  <tr>
    <td bgcolor="#FFCC00" valign="top" colspan="2"> 
    Provinsi : <span id="teksprov"></span><br>
	Lokasi : <span id="tekslokasi"></span><br>
	Ujian : <span id="teksujian"></span><br>
	Tanggal : <span id="tekstgl"></span><br>
	Peserta : <span id="tekspeserta"></span><br>
	Penyebab : <span id="tekspenyebab"></span><br>
	Kerusakan : <span id="tekskerusakan"></span><br>
	Bantuan : <span id="teksbantuan"></span><br>
	Pengungsi : <span id="tekspengungsi"></span><br>
	Tahun : <span id="tekstahun"></span><br>
	

	</td>
  </tr>
</table>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>



<table border=0>
<tr><td width="700">
<div id="petaku" style="width:550px; height:500px"></div>
</td>
<td width="80" valign=top>

ID Info :<br>
<input type=text id="id_info" placeholder="urutkan nomor bedasarkan jumlah2015 ujian" size=30>
Provinsi : <br>
<select name="kode" id="kode">
<?php 
$query=mysql_query("select * from tbl_provinsi order by provinsi asc");

while($row=mysql_fetch_array($query))
{
	?><option value="<?php  echo $row['kode']; ?>"><?php  echo $row['provinsi']; ?></option><?php 
}
?>

</select>
<br>
Ujian : <br>
<select name="id_ujian" id="id_ujian">
<?php 
$query2=mysql_query("select * from tbl_ujian order by nama_ujian asc");

while($row2=mysql_fetch_array($query2))
{
	?><option value="<?php  echo $row2['id_ujian']; ?>"><?php  echo $row2['nama_ujian']; ?></option><?php 
}
?>

</select>
<br>
Lokasi Ujian : <br>
<select name="id_lokasi" id="id_lokasi">
<?php 
$query2=mysql_query("select * from tbl_lokasi order by nama_lokasi asc");

while($row2=mysql_fetch_array($query2))
{
	?><option value="<?php  echo $row2['id_lokasi']; ?>"><?php  echo $row2['nama_lokasi']; ?></option><?php 
}
?>

</select>
<br>
Peserta :<br>
<input type=text name="peserta" placeholder="Jumlah Peserta "id="peserta" size=30>
penyebab :<br>
<input type=text name="penyebab" id="penyebab" size=30>
Kerusakan : <br>
<input type=text name="kerusakan" placeholder="Total Kerugian (dalam Rp)" id="kerusakan" size=30>
Bantuan Dibutuhkan :<br>
<input type=text name="bantuan" id="bantuan" size=30>
Jumlah Pengungsi :<br>
<input type=text name="pengungsi" placeholder="Total Jumlah Pengungsi" id="pengungsi" size=30>
Tanggal : <br>
<input type="text" name="tgl" id="tgl" size="12">
<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>	
<br>
Tahun :<br>
<input type=text name="tahun" placeholder="Tahun" id="tahun" size=30>

<button id="tombol_simpan">Simpan</button>
<img src="ajax-loader.gif" style="display:none" id="loading">
</td>
<pre>
			<div id="showdata">
			</pre>
			</div>
</tr>
</table>
<iframe width=174 height=189 name="gToday:normal:calender/normal.js" id="gToday:normal:calender/normal.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
</body>
</html>


<br>
<?php
	$entries=11;
	$query=mysql_query("select * from view_informasi"); //input
	$get_pages=mysql_num_rows($query);
	
	if ($get_pages>$entries)  //proses
	{
		$jumlah2015_halaman=ceil($get_pages/$entries);
		$halaman_aktif=$_GET['id'];
		
		//untuk prev
		if(($halaman_aktif)>0){
			$prev=$halaman_aktif-1;
			?><a href="?page=info-ujian&id=<?php  echo $prev; ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"> &laquo;Prev&nbsp;&nbsp;</font></a><?php 
		}
		
		//echo "Halaman : ";
		$pages=1;
		while($pages<=ceil($get_pages/$entries))
		{
			
			//untuk menandai halaman yang aktif
			if (($pages-1)==$halaman_aktif){
				$font="<font size='2' face='verdana' color='red'>";
			}else{
				$font="<font size='2' face='verdana' color='#009900'>";
			}
		?>
			
		<?php 
				$pages++;
		}
	}else{
		$pages=0;
	}
	$jumlah2015_halaman=10;
	//untuk next
	if($pages<$jumlah2015_halaman){
		$next=$pages+1;
		?>&nbsp;&nbsp;<a href="?page=info-ujian&id=<?php  echo $next; ?> " 
		style="text-decoration:none"><font size="2" face="verdana" color="#009900">Next&raquo;</font></a>
<?php 
	}
	
	//proses halaman
	$page=(int)$pages;
	$offset=$page*$entries;
	$result=mysql_query("select * from view_informasi order by id_info asc limit $offset,$entries"); //output
	$jumlah2015=mysql_num_rows($query);
	
	//akhir paging
	echo "</center>";

	if ($jumlah2015){
	?>
<div class="row" style="width:800px; margin:0 auto;">
            <div class="col-lg-12">
                <div class="table-responsive">
		

	<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
		<thead>
			<tr>
				<th><h3>Aksi</h3></th>
				<th><h3>ID Info</h3></th>
				<th><h3>Kode Provinsi</h3></th>
				<th><h3>Nama Provinsi</h3></th>
				<th><h3>Nama Lokasi</h3></th>
				<th><h3>Nama Ujian</h3></th>
				<th><h3>Tanggal</h3></th>
				<th><h3>Peserta</h3></th>
				<th><h3>Tahun</h3></th>
				
				
		
			</tr>
		</thead>
		<tbody>
		 <?php
			$query=mysql_query("SELECT * FROM view_informasi");					

		
			while($row=mysql_fetch_assoc($query)){
				?>
				<tr>
					<td><img src="images/edit.png"> <a href="?page=info-ujian&mode=delete&id_info=<?php echo $row['id_info'];?>" onClick="return confirm('Apakah Anda Yakin?')"><img src="images/delete.png"></a></td>
					
					<td><?php echo $row['id_info'];?></td>
					<td><?php echo $row['kode'];?></td>
					<td><?php echo $row['provinsi'];?></td>
					<td><?php echo $row['nama_lokasi'];?></td>
					<td><?php echo $row['nama_ujian'];?></td>
					<td><?php echo $row['tgl'];?></td>
					<td><?php echo $row['peserta'];?></td>
					<td><?php echo $row['tahun'];?></td>
					
				</tr>
			<?php 
                        $i++; 
			} ?>
		
		</tbody>
		</table>
		</div>
                <button class="btn btn-primary" id="tombolExport">Export Excel</button>
           
        </div>
		</div>
		<center>Jumlah Data : <?php echo $jumlah2015;?></center>
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
<?php 	
}else{
	?><p><center><font color="#FF0000" face="verdana" size="2"><b>Belum ada data!!</b></font></center><br /><?php 
}
?>