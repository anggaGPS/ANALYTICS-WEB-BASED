<?php include('config.php') ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Membuat Laporan Excel </title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    </head>
    
    <body>
        <div class="row" style="width:800px; margin:0 auto;">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <h2>Trend Penjualan PIN Setiap Jalur Seleksi per Provinsi</h2>
                    <table id="tabelExport" class="table table-bordered table-hover">
                        <thead>
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
	                </thead>
	                <tbody>
	                <?php 
			$i = 1;
	                $query = mysql_query("SELECT * FROM view_banding ");
	                while($row = mysql_fetch_array($query)) {
	                ?>
                            <tr>
						<td><?php echo $i; ?></td><td>
						<?php echo $row['tahun']; ?></td>
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
                        $i++; 
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