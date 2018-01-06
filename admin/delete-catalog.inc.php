<?php
include "../mylibrary/bootlinks.php";
$catalogid= $_GET['catalogid'];
$query = "DELETE FROM catalogs WHERE catalogid = $catalogid";
$result = mysqli_query($dbc, $query);

if (mysqli_affected_rows($dbc) == 0){
	echo "<div class='alert alert-warning alert-dismissable fade in'>";
	echo "<a href='admin.php?content=catview' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error: </strong> Action could not be completed</div>";
 
}else{
	 echo "<div class='alert alert-success alert-dismissable fade in>";
  echo "<a href=admin.php?content=catview' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong>$catid deleted!  $row rows affected.</div>";

}



?>