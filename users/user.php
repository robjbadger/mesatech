<?php  
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>TST Mtech</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon"  type="image/png" sizes="32x32" href="../favicon-16x16.png">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link rel="stylesheet" href="../css/style.css">
</head>

<body>


<div id="wrapper">
<div id="mesanav">
					<?php 
					include "../mylibrary/webconn.php";
					include "custnav.inc.php";  

					?>
					</div>
		<?php
	if(!isset($_REQUEST['content'])){
			
				if(!isset($_SESSION ['mesa_user']))
				{
					
				
					include "../login.html";

				}else{
					
					
				
					include "usermain.inc.php";}
				
				
				}else{
			$content = $_REQUEST['content'];
			$nextpage = $content.".inc.php";
			include ($nextpage);
						
		}
	
	include "user.bottom.php";
					echo "</div>";
	?>
    <!-- /end wrapper -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
  <script src="https://use.fontawesome.com/5684041910.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
   
</body>
</html>