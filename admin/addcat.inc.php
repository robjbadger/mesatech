
<?php





$catalogid = mysqli_real_escape_string($dbc, $_POST['catalogid']);
 $name =  mysqli_real_escape_string($dbc,$_POST['name']);


$sql = "INSERT INTO categories (catalogid, name) VALUES ('$catalogid','$name')";


	$result = mysqli_query($dbc, $sql);
  $row = mysqli_affected_rows($dbc);
	if($row!=0){
	 echo "<div class='alert alert-success alert-dismissable fade in'>
    <a href='admin.php?content=catview' class='close' data-dismiss='alert' aria-label='close'><i class='fa fa-window-close' aria-hidden='true'></i></a>
    <strong>Success!</strong> Category $name created for Catalog: $catalogid
  </div>"; 
	
	}else{
		 echo "<div class='alert alert-danger alert-dismissable fade in'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'><i class='fa fa-window-close' aria-hidden='true'></i></a>
    <strong>Error:</strong> there is a problem with your request.
  </div>"; 

	}


?>
