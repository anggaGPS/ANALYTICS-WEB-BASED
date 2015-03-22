<?php include('config.php') ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Laporan Excel</title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    </head>
    
    <body>
        <div class="row" style="width:800px; margin:0 auto;">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <h2>Total Penjualan PIN Provinsi</h2>
                    <table id="tabelExport" class="table table-bordered table-hover">
                        <thead>
                           
    	<th width="34">No</th>
    	<th width="90">Tahun</th>
    	<th width="131">Nama Ujian</th>
    	<th width="104">Jumlah Total Bedasrkan Jalur Seleksi</th>
	                </thead>
	                <tbody>
	                <?php 
			$no = 0;
	                $query = mysql_query("SELECT * FROM total_ujian ");
	                while($row = mysql_fetch_array($query)) {
	                ?>
                            <tr>
					<td><?php echo $no=$no+1; ?></td><td><?php echo $row['tahun']; ?></td>
		<td><?php echo $row['nama_ujian'];?></td><td align="left">
		<?php echo number_format($row['jumlah'],0,',','');?></td>
                               
                            </tr>
	                <?php 
                        
			} ?>
	                </tbody>
                    </table>		  
	        </div>
                <button class="btn btn-primary" id="tombolExport">Export Excel</button>
            </div>
        </div><!-- /.row -->
	
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
    </body>
</html>