<?php

 
echo "<div class='section-frame'>";

 $user = $_SESSION['mesa_user'];
 echo "<h1 class='section-title' align='center'>Welcome Back $user</h1><hr>";
 echo "<div class='table-responsive'>";
 echo "<table class='table table-bordered'>";

$sql = "SELECT firstname, lastname, phone, ext, catalogid, email, custid FROM `users` WHERE userid = '$user'";
$result = mysqli_query($dbc, $sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

	$firstname = $row['firstname'];
	$lastname = $row['lastname'];
	$phone = $row['phone'];
	$ext = $row['ext'];
	$catalogid = $row['catalogid'];
	$email = $row['email'];
	$custid = $row['custid'];

	 echo "<tr><th>First Name: </th><td>$firstname</td></tr>";
	echo "<tr><th>Last Name: </th><td>$lastname</td></tr>";
	echo "<tr><th>Phone: </th><td>$phone</td></tr>";
	echo "<tr><th>Ext: </th><td>$ext</td></tr>";
	echo "<tr><th>Email: </th><td>$email</td></tr>";
	echo "<tr><th>Acct: </th><td>$custid</td></tr>";
	
}




 
echo "</table>";

echo "</div></div>";
?>











