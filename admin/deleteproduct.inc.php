<?php
$prodid = $_GET['prodid'];
$query = "DELETE FROM products WHERE prodid = $prodid";
$result= mysqli_query($dbc, $query);
$row = mysqli_num_rows($result);
if($row > 0){
echo "<div class='alert alert-success alert-dismissable fade in'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Success!</strong> $prodid has been deleted.
  </div>";
}else{
	echo "<div class='alert alert-danger alert-dismissable fade in'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Error:</strong> Unable to delete $prodid at this time. Please verify Prod ID and try again.
  </div>";
}


?>