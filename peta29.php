<!DOCTYPE html>
<html>
	<head>

		<title>Peta Provinsi</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<style type="text/css">
			html { height: 100% }
			body { height: 100%; margin: 0; padding: 0 }
			#title { height: 10%; width : 100%; }
			#sidebar {height : 85% ; width : 20%; float : left}
			#map_canvas { height : 100% ; width : 80%; float : right}
		</style>
		
		<script type="text/javascript"
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6QymIKKv7qrk64Jk4riqIzUIv_0fvWT0&sensor=false">		
		</script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>	
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
		 <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />



		<script type="text/javascript">
			var map,layer;var tampungKode1,tampungKode2,tampungKode3;
			var infoWindow = new google.maps.InfoWindow();
			function initialize() {
				google.maps.visualRefresh = true;
				var mapOptions = {
					center: new google.maps.LatLng(-3.337954,117.320251),
					zoom: 5,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				map = new google.maps.Map(document.getElementById("map_canvas"),
				mapOptions);																
				
				$.ajax({
					type:'GET',						
					url:'data.php',
					dataType:'json',
					success: function(data) {							
						var kel1,kel2,kel3;
						var min="";
						var med="";
						var max="";						
						var jumlah2016,kode;						
						for(var i=0;i<data.provinsi.length;i++)
						{
							
							jumlah2016=data.provinsi[i].jumlah2016;
							kode=data.provinsi[i].kode;
							if(jumlah2016<=0)
							{
								min+=kode+",";							
							}
							else if(jumlah2016>0&&jumlah2016<3000)
							{
								med+=kode+",";
							}
							else if(jumlah2016>=3000)
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
				layer.setMap(map);	
				google.maps.event.addListener(layer,'click',function(e){showData(e)});	
			}
			function removeLastString(kode)
			{
				kode = kode.substring(0,kode.length-1)+'';				
				return kode;
			}
			//buat nambahin legenda		
			function legenda(controlDiv,map){
				controlDiv.style.backgroundColor = 'white';					
				controlDiv.title = 'Legenda';	
				var isi1 = "<table class=\"table table-condensed\"><th><td>Legenda</td></th>";
				var isi2 = "<tr><td style=\"background-color:#00FF00\">&nbsp;&nbsp;&nbsp;</td><td><0 peserta</td></tr>";
				var isi3 = "<tr><td style=\"background-color:#FFFF00\">  </td><td>1-3000 peserta</td></tr>";
				var isi4 = "<tr><td style=\"background-color:#FF0000\">  </td><td>>3000 peserta</td></tr>";							
				var isi5 = "</table>";								
				controlDiv.innerHTML = isi1+isi2+isi3+isi4+isi5;					
			}
			function layerByPulau(kodeWilayah)
			{
				
				layer = new google.maps.FusionTablesLayer({
					query: {
						select: 'geometry',
						from: '12s5oKFfyL-G_orulSQXuqGvzMGr85H2p6YI5nRM',
						where: 'kode IN ('+kodeWilayah+')',
					},
					options: {
						suppressInfoWindows:true
						},
					styles: [{				
						where: 'kode IN ('+tampungKode1+')',
						polygonOptions:{
							fillColor:'#00FF00'
						}
						},{
						where: 'kode IN ('+tampungKode2+')',
						polygonOptions:{
							fillColor:'#FFFF00'
						}
						},{
						where: 'kode IN ('+tampungKode3+')',
						polygonOptions:{
							fillColor:'#FF0000'
						}							
					}],		
				});
				
				layer.setMap(map);
				google.maps.event.addListener(layer,'click',function(e){showData(e)});	
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
								
								isi+="<b>Target Yang Belum Tercapai : </b>"+data.provinsi[i].jumlah2016+" orang</br>";
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
				$('input[name="pulau"]').on('change', function(){
					layer.setMap(null);
					var value=$(this).val();
					var jawa="61";
					var sumatera="2016";
					var kalimantan="61,62,63,64";
					var sulawesi="71,72,73,74,75,76";
					var papua="91,94";
					switch(value)
					{
						case "Jawa":
						layerByPulau(jawa);						
						break;
						case "Sumatera":
						layerByPulau(sumatera);
						break;
						case "Kalimantan":
						layerByPulau(kalimantan);
						break;
						case "Sulawesi":
						layerByPulau(sulawesi);
						break;
						case "Papua":
						layerByPulau(papua);
						break;
						default:					  
					}
				});
				
			});
			
		</script>


	</head>
		<body class="skin-blue">
   <body onload="initialize()">
	
		<div id="map_canvas"></div>
		
		
	
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo"><b>Admin</b>LTE</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- Notifications: style can be found in dropdown.less -->
              
              <!-- Tasks: style can be found in dropdown.less -->
              
              <!-- User Account: style can be found in dropdown.less -->
              
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
         
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="dashboard.php""><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Layout Options</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
         
           
         
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          
          <ol class="breadcrumb">
            <div id="">
			<?php    
// Koneksi 
 
@mysql_connect("localhost","root","");    
@mysql_select_db("db_smb");    
$result = mysql_query("select * from view_jumlah2016");  
$jsArray = "var tahun = new Array();\n";  
echo 'tahun : <select name="tahun" onchange="document.getElementById(\'YEAR(NOW())\').value = tahun[this.value]">';  
echo '<option>-------</option>';  
while ($row = mysql_fetch_array($result)) {  
    echo '<option value="' . $row['tahun'] . '">' . $row['tahun'] . '</option>';  
    $jsArray .= "tahun['" . $row['tahun'] . "'] = '" . addslashes($row['jumlah2016']) . "';\n";  
}  
echo '</select>';  
?>  <br></br>

			<input type="radio" name="pulau" value="Jawa">Jawa<br>
			<input type="radio" name="pulau" value="Sumatera">Sumatera</br>
			<input type="radio" name="pulau" value="Kalimantan" >Kalimantan</br>
			<input type="radio" name="pulau" value="Sulawesi">Sulawesi</br>			
			<input type="radio" name="pulau" value="Papua">Papua</br></br>
			<button onclick="initialize()" class="btn btn-primary">Show All</button>
			</br></br>			
			<pre>
			<div id="showdata">
			</pre>
			</div>
          </ol>
        </section>

        <!-- Main content -->
        
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
	
  

<script type="text/javascript">  
<?php echo $jsArray; ?>  
</script>   
		<script src="js/bootstrap.js"></script>
		
	</body>
</html>


