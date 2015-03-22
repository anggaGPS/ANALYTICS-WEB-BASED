<!DOCTYPE html>
<html>
 <head>
 <title>Peta Provinsi</title>
 <meta name="viewport" content="initial-scale=1.0, userscalable=no"
/>
 <style type="text/css">
 html { height: 100% }
 body { height: 100%; margin: 0; padding: 0 }
 #title { height: 10%; width : 100%; }
 #sidebar {height : 85% ; width : 20%; float : left}
 #map_canvas { height : 85% ; width : 80%; float :
right}
 </style>
 <script type="text/javascript"

src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtL1rZGhn6YyXZu8uDULihzkNPWwbdV2k&sensor=false">
 </script>
 <script
src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
 <link href="css/bootstrap.css" rel="stylesheet"
media="screen">
 <link href="css/bootstrap-responsive.css" rel="stylesheet"
media="screen">
 <script type="text/javascript">
 function initialize() {
 var mapOptions = {
 center: new google.maps.LatLng(-3.337954,117.320251),
 zoom: 5,
 mapTypeId: google.maps.MapTypeId.ROADMAP
 };
 var map = new
google.maps.Map(document.getElementById("map_canvas"),
 mapOptions);

$.ajax({
type:'GET',
 url:'data.php',
dataType:'json',
 success: function(data) {
var min="";
 var med="";
 var max="";
 var provinsi,ibukota,jumlah;
 
 for(var i=0;i<data.provinsi.length;i++)
			{
						jumlah=data.provinsi[i].jumlah;
						kode=data.provinsi[i].kode;
						if(jumlah<=3000000)
					
						{
						min+=kode+",";
						}
						 else if(jumlah>3000000&&jumlah<6000000)
						{
						med+=kode+",";
						}	
						else if(jumlah>=6000000)
						{
						max+=kode+",";
						} 
 }
fusiontablelayer(min,med,max);
 
 }
 });
 

 
function fusiontablelayer(kode1,kode2,kode3)
	{
			 kode1=removeLastString(kode1);
			 kode2=removeLastString(kode2);
			 kode3=removeLastString(kode3);
			var layer = new google.maps.FusionTablesLayer({
				query: {
					select: 'geometry',
					from: '1XpAxe0EjqE7IAk4nuiIrqsWvmsBWhK87mGmfr0Rx',

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
	}

	function removeLastString(kode)
	{
	kode = kode.substring(0,kode.length-1)+'';
		return kode;
	}
	 	
  </script>
 </head>
 <body onload="initialize()">
 <pre>
 <div id="showdata">
 </div>
</pre>
 <div id="map_canvas"></div>
 </body>
</html>
