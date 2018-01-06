<?php
$uid = $_GET['id'];
$query = "DELETE * FROM users WHERE id = $uid";
$result = mysqli_query($dbc, $query);
$row = mysqli_num_rows($result);
if ($row != 0){
echo "<div class='alert alert-success alert-dismissable fade in'><a href='admin.php?content=usermgt' data-dimiss='alert' class='close' aria-label='close'><i class='fa fa-window-close' aria-hidden='true'></i></a>User ID#: $uid deleted. $row User affected.</div>";


}else{
	echo "<div class='alert alert-danger alert-dismissable fade in'><a href='admin.php?content=usermgt' data-dimiss='alert' class='close' aria-label='close'><i class='fa fa-window-close' aria-hidden='true'></i></a><strong>Error:</strong> Unable to delete user: $userid at this time. </div>";

}



?>