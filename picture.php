<?php  
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Local Tech</title>
  <meta name="description" content="">
        <meta name="author" content="">
        <title>Local MesaTech</title>
          <meta name="description" content="c-store, bank supply, atm-supply, convenience store,">
        <meta name="author" content="badger">
	<link rel="icon"  type="image/png" sizes="32x32" href="favicon-16x16.png">
	<!-- Latest compiled and minified CSS -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<link rel="stylesheet" href="css/style.css">
</head>

<body>




	<div id="wrapper">
	<div id="mesanav">
		<?php 
			

 include "mylibrary/pubnav.php"; ?>
</div>
			<!-- /top common code -->
		<!-- content -->	
<?php
		if(!isset($_REQUEST['content'])){
			
	
					include "mylibrary/modify.inc.php";
				
				
				}else{
			$content = $_REQUEST['content'];
			$nextpage = $content.".inc.php";
			include ($nextpage);}
						
		
		
		
		
		
		?>

	


		
		<!-- End content -->
		

		<hr>
		<?php include "mylibrary/bottom.php" ?>

	 </div>
    <!-- /end wrapper -->
    


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>

<!-- <script type="text/javascript" src="jquery-barcode.js"></script> 

</body>
</html>