<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
   <button class="btn btn-primary" id="tombolExport">Download Excel</button>
  	   	
			
<script type="text/javascript">
	$(function () {
		var chart;
		$(document).ready(function() {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'contain',
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'Selisi Penjualan Pin Terhadap Target	  '
				},
				tooltip: {
					formatter: function() {
						return '<b>'+
				this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' % ('+ this.y +' peserta)';
					}
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							color: '#000000',
							connectorColor: '#000000',
							formatter: function() {
								return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
							}
						}
					}
				},
				series: [{
				   type: 'pie',
					name: 'Browser share',
					data: [
					
					<?php 
						$query=mysql_query("SELECT provinsi FROM view_analisis");					
	
						while($row=mysql_fetch_assoc($query)){
							 $nama     = $row['provinsi'];
							 
							 $data = mysql_fetch_array(mysql_query("SELECT jumlah FROM view_analisis where provinsi='$nama'"));
							 $jumlah = $data['jumlah'];
							?>
							['<?php echo $nama?>',  
							<?php echo $jumlah;?>],
							<?php
						}
					?>
					
					]
				}]
			});
		});
		
	});
	</script>
	
	
	
	<div id="contain" style="min-width: 350px; height: 350px; margin: 0 auto"></div>
	
				<center><h3><a align="center" href="?page=peta28">Peta Urgensi</a></h3></center>
	<br><br>
<table id="tabelExport" class="table table-bordered table-hover">
	<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
		<thead>
			<tr>
				
				<th><h3>Provinsi</h3></th>
				<th><h3>Selisih Target</h3></th>
			</tr>
		</thead>
		<tbody>
		 <?php
			$query=mysql_query("SELECT provinsi FROM view_analisis");							
	
			while($row=mysql_fetch_assoc($query)){
							 $nama     = $row['provinsi'];
	
				 $data = mysql_fetch_array(mysql_query("SELECT jumlah FROM view_analisis where provinsi='$nama'"));
				 $jumlah = $data['jumlah']; 
				 ?>
				 
				<tr>
					
					
					<td><?php echo $nama;?></td>
					<td><?php echo $jumlah;?></td>
				</tr>
				<?php
			}
		?>
		</tbody>

				                       
	</table>
	
	 </div>
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
	
   
<script type="text/javascript">
	$(function () {
		var chart;
		$(document).ready(function() {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'container',
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'Diagram Jumlah Penjualan Pin Peserta per Ujian'
				},
				tooltip: {
					formatter: function() {
						return '<b>'+
				this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' % ('+ this.y +' peserta)';
					}
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							color: '#000000',
							connectorColor: '#000000',
							formatter: function() {
								return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
							}
						}
					}
				},
				series: [{
				   type: 'pie',
					name: 'Browser share',
					data: [
					
					<?php 
						$query=mysql_query("SELECT nama_ujian FROM total_ujian");					
	
						while($row=mysql_fetch_assoc($query)){
							 $nama     = $row['nama_ujian'];
							 
							 $data = mysql_fetch_array(mysql_query("SELECT jumlah FROM total_ujian where nama_ujian='$nama'"));
							 $jumlah = $data['jumlah'];
							?>
							['<?php echo $nama?>',  
							<?php echo $jumlah;?>],
							<?php
						}
					?>
					
					]
				}]
			});
		});
		
	});
	</script>
	
	
	<div id="container" style="min-width: 350px; height: 350px; margin: 0 auto"></div>
		<center><h3><a align="center" href="grafik.php"> Grafik Batang</a></h3></center>
	<br><br>
		
	<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
		<thead>
			<tr>
				
				<th><h3>Ujian Masuk</h3></th>
				<th><h3>Jumlah Peserta</h3></th>
			</tr>
		</thead>
		<tbody>
		 <?php
			$query=mysql_query("SELECT nama_ujian FROM total_ujian");							
	
			while($row=mysql_fetch_assoc($query)){
							 $nama     = $row['nama_ujian'];
	
				 $data = mysql_fetch_array(mysql_query("SELECT jumlah FROM total_ujian where nama_ujian='$nama'"));
				 $jumlah = $data['jumlah']; 
				 ?>
				 
				<tr>
					
					
					<td><?php echo $nama;?></td>
					<td><?php echo $jumlah;?></td>
				</tr>
				<?php
			}
		?>
		</tbody>
		
				                             
	</table>
	
<script type="text/javascript">
	$(function () {
		var chart;
		$(document).ready(function() {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'containe',
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false
				},
				title: {
					text: 'Diagram Jumlah Penjulan Pin per Provinsi'
				},
				tooltip: {
					formatter: function() {
						return '<b>'+
				this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' % ('+ this.y +' peserta)';
					}
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							color: '#000000',
							connectorColor: '#000000',
							formatter: function() {
								return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
							}
						}
					}
				},
				series: [{
				   type: 'pie',
					name: 'Browser share',
					data: [
					
					<?php 
						$query=mysql_query("SELECT provinsi FROM view_jumlah");					
	
						while($row=mysql_fetch_assoc($query)){
							 $nama     = $row['provinsi'];
							 
							 $data = mysql_fetch_array(mysql_query("SELECT jumlah FROM view_jumlah where provinsi='$nama'"));
							 $jumlah = $data['jumlah'];
							?>
							['<?php echo $nama?>',  
							<?php echo $jumlah;?>],
							<?php
						}
					?>
					
					]
				}]
			});
		});
		
	});
	</script>
	
	
	
	<div id="containe" style="min-width: 350px; height: 350px; margin: 0 auto"></div>
<center><h3><a align="center" href="?page=h"> Trend Penjualan Pin Provinsi</a></h3></center>
	<br><br>

	<table cellpadding="0" cellspacing="0" border="0" id="table" class="sortable">
		<thead>
			<tr>
				
				<th><h3>Provinsi</h3></th>
				<th><h3>Jumlah Peserta</h3></th>
			</tr>
		</thead>
		<tbody>
		 <?php
			$query=mysql_query("SELECT provinsi FROM view_jumlah");							
	
			while($row=mysql_fetch_assoc($query)){
							 $nama     = $row['provinsi'];
	
				 $data = mysql_fetch_array(mysql_query("SELECT jumlah FROM view_jumlah where provinsi='$nama'"));
				 $jumlah = $data['jumlah']; 
				 ?>
				 
				<tr>
					
					
					<td><?php echo $nama;?></td>
					<td><?php echo $jumlah;?></td>
				</tr>
				<?php
			}
		?>
		</tbody>

				                       
	</table>
	
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
	