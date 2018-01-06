 <?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Local Tech</title>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text|Libre+Barcode+39+Extended+Text" rel="stylesheet">

<link rel="stylesheet" href="../css/style.css">
<script type="text/javascript">
window.onload = function(){
   document.getElementById('send').onclick = function(e){
       alert(document.getElementById("name").value);
       return false;
   }
}
</script>
</head>
<body>
   
  <?php include "../mylibrary/webconn.php"; 
		include "../mylibrary/getThumb.php";
      include "../mylibrary/showproducts.php";
          if(!isset($_REQUEST['content'])){
            if(!isset($_SESSION['mesa_admin'])){
			
              include "../mylibrary/login.html";
            }else{
				echo "<div id='wrapper'>";
				include "adminnav.inc.php";
				include "adminmain.inc.php";
				include "adminfooter.inc.php";
				echo "</div>";
		
            }
          }else{
			echo "<div id='wrapper'>";
			 include "adminnav.inc.php";
            $content = $_REQUEST['content'];
            $nextpage = $content.".inc.php";
            include($nextpage);
			include "adminfooter.inc.php";
			  echo "</div>";
          }



        ?>




	

	
	





<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>


</body>
</html>
