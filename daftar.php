<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>GIS Bencana dan Mitigasi</title>
    <meta name="description" content="Flat UI Kit Free is a Twitter Bootstrap Framework design and Theme, this responsive framework includes a PSD and HTML version."/>

    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="dist/css/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="dist/css/flat-ui.css" rel="stylesheet">
    <link href="docs/assets/css/demo.css" rel="stylesheet">

    <link rel="shortcut icon" href="images/google-map.png">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="dist/js/vendor/html5shiv.js"></script>
      <script src="dist/js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <!-- /demo-headline -->

       <!-- /tiles -->
	   
<form action="auth3.php" method="post">
      <div class="login">
        <div class="login-screen">
          <div class="login-icon">
            <img src="images/google-map.png" alt="Welcome to Mail App" />
            <h4>Welcome to <small></small></h4>
          </div>

          <div class="login-form">
            <div class="form-group">
              <input type="text" class="form-control login-field" value="" placeholder="nip/NIK" name="nip" />
              <label class="login-field-icon fui-user" ></label>
            </div>

            <div class="form-group">
              <input type="text" class="form-control login-field" value="" placeholder="Password" name="password" />
              <label class="login-field-icon fui-lock" ></label>
            </div>
			<div class="form-group">
              <input type="text" class="form-control login-field" value="" placeholder="Nama Lengkap" name="nama" />
              <label class="login-field-icon fui-lock" ></label>
            </div>
		<tr>
		
       
          <div class="form-group">
		  <tr>
		   <td width="36%" align="left" valign="middle"><span style="color:#858585;">Provinsi: </span></td>
           <td> <select name="provinsi" style="color:#858585;" id="provinsi">
<?php 
include "koneksi.php";
$query=mysql_query("select * from tbl_provinsi order by provinsi asc");

while($row=mysql_fetch_array($query))
{
	?><option value="<?php  echo $row['provinsi']; ?>"><?php  echo $row['provinsi']; ?></option><?php 
}
?>

</select>
			 </td>
		   </tr>
          </div>
     
		  </tr>
			
			

            <a class="btn btn-primary btn-lg btn-block" 
			<tr>
			<td align="center" valign="top">  </td>
			<td valign="top"><input class="btn btn-primary btn-lg btn-block"  type="submit" value="Daftar"> </a>
		</tr>
         
          </div>
        </div>
      </div>
</form>	
      </div>
    </footer>

    <script src="dist/js/vendor/jquery.min.js"></script>
    <script src="dist/js/flat-ui.min.js"></script>
    <script src="docs/assets/js/application.js"></script>

    <script>
      videojs.options.flash.swf = "dist/js/vendors/video-js.swf"
    </script>
  </body>
</html>
