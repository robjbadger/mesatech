<div class="section-frame">

<h1 class="section-title" align="center">User: Manager</h1><hr>
<div class="table-resposnive ">
<table class="table table-hover">
<thead>
	<tr><th>User Name</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Role</th><th>Cust#</th><th>Edit</th></tr>
</thead>
<tbody>
<?php

	
	$query = "SELECT id, userid,  firstname, lastname, email,  roleid, custid  FROM users ORDER BY lastname ASC";
	$result = mysqli_query($dbc, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$uid = $row['id'];
		$userid = $row['userid'];
		$first_name = $row['firstname'];
		$last_name = $row['lastname'];
		$email = $row['email'];
		$role = $row['roleid'];
		$custid = $row['custid'];
	
		echo "<tr><td>$userid<td>$first_name</td><td>$last_name</td><td>$email</td><td>$role</td><td>$custid</td><td><a href='admin.php?content=edituser&id=$uid'>Edit</a></td></tr>";
	}
	

	echo "<tr><td colspan='7'><div class='btn btn-group'><a type='button' href='admin.php?content=newuser' class='btn btn-mesa'>Add user</a></td></tr>";
	?>
</tbody>
 
</table></div>

</div>
<br>
<br>