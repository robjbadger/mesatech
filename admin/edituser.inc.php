<div class="section-frame">
<?php

//check if user submitted form:
$uid = $_GET['id'];

echo "<form class='horiztonal-form' action:'edit-user' method='post'>";
//connect to database:

	$sql = mysqli_query($dbc, "SELECT id, userid, firstname, lastname, phone, ext, email, roleid, custid, catalogid, created, last_login FROM users WHERE id = $uid");
	while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
		$nuserid = $row['userid'];
		$fname = $row['firstname'];
		$lname = $row['lastname'];
		$nroleid = $row['roleid'];
		$ncustid = $row['custid'];
		$nemail = $row['email'];
		$created = $row['created'];
		echo "<h1 class='section-title' align='center'>Edit User ID: $userid</h1><hr>";
		echo "<div class='form-group'>";
			echo "<label class='col-sm-offset-2 col-sm-2  control-label' for='nuserid'>User Id:</label>";
			echo "<div class='col-sm-8'>";
				echo "<input type='text' class='form-control' name='nuserid' placeholder='$nuserid'>";
			echo "</div>";

		echo "</div>";
				echo "<div class='form-group'>";
			echo "<label class='col-sm-offset-2 col-sm-2  control-label' for='fname'>First Name:</label>";
			echo "<div class='col-sm-8'>";
				echo "<input type='text' class='form-control' name='fname' placeholder='$fname'>";
			echo "</div>";

		echo "</div>";
				echo "<div class='form-group'>";
			echo "<label class='col-sm-offset-2 col-sm-2  control-label' for='lname'>Last Name:</label>";
			echo "<div class='col-sm-8'>";
				echo "<input type='text' class='form-control' name='lname' placeholder='$lname'>";
			echo "</div>";

		echo "</div>";
				echo "<div class='form-group'>";
			echo "<label class='col-sm-offset-2 col-sm-2  control-label' for='nroledi'>Role Id:</label>";
			echo "<div class='col-sm-8'>";
				echo "<input type='text' class='form-control' name='nroleid' placeholder='$nroleid'>";
			echo "</div>";

		echo "</div>";
				echo "<div class='form-group'>";
			echo "<label class='col-sm-offset-2 col-sm-2  control-label' for='ncatalogid'>Catalog Id:</label>";
			echo "<div class='col-sm-8'>";
				echo "<input type='text' class='form-control' name='ncustid' placeholder='$ncustid'>";
			echo "</div>";

		echo "</div>";
				echo "<div class='form-group'>";
			echo "<label class='col-sm-offset-2 col-sm-2  control-label' for='nemail'>Email:</label>";
			echo "<div class='col-sm-8'>";
				echo "<input type='email' class='form-control' name='nemail' placeholder='$nemail'>";
			echo "</div>";

		echo "</div>";
				echo "<div class='form-group'>";
			echo "<label class='col-sm-offset-2 col-sm-2  control-label' for='disabledTextInput' id='inputDisabled'>Created:</label>";
			echo "<div class='col-sm-8'>";
				echo "<input type='text' class='form-control'placeholder='$created' readonly>";
			echo "</div>";

		echo "</div>";
				echo "<div class='form-group'>";
			echo "<div class='col-sm-offset-4 col-sm-8>";
		echo 	"<div class='btn-group' role='group' aria-label='...'>";
		 	echo "<button type='submit' class='btn btn-mesa'><i class='fa fa-save' aria-hidden='true'></i></button>";
  	echo "<button type='button' class='btn btn-danger'><a href='admin.php?content=deleteuser&id=$uid'><i class='fa fa-trash' aria-hidden='true' style='color:#fff'></i></a></button>";
  	echo "<button type='button' class='btn btn-default'><a href='admin.php?content=usermgt'>Back</a></button>";
echo "</div>";
			

		echo "</div>";
	}

/*create query to update values on database:	
	$q = "UPDATE users SET first_name='$ffname', last_name='$llname', email='$demail' WHERE id='$idnow'";

	$r = mysqli_query($dbc, $q);

//check if there are any affected rows:	
	if(mysqli_affected_rows($dbc) == 1){
	
		echo "The user info has been changed succesfully!";
	
	}else{
	
		echo "Error! Something went wrong...";
	
	}
	
} */

?>





</div>
<br><br>