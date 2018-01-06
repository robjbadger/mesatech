		<div class="section-frame">

	<h1 class="section-title" align='center'>Add new User</h1>
		<hr>
	

  <?php 
if(!isset($_SESSION['mesa_admin']))
{
	include "../mylibrary/loginalert.php";
 }
 else{ 


		echo "<form class='form-horizontal admin-forms' action='admin.php' method='post'>";
	  		echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for='userid'>User Name:</label>";
	echo "<div class='col-sm-10'>";
		echo "<input type='text' class='form-control' id='userid' name='userid'auto-focus='true' autofocus required>";
	echo "</div>";
	 echo "</div>";
;
		echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for='firstname'>First Name:</label>
	<div class='col-sm-10'><input type='text' class='form-control' id='firstname' name='firstname' required></div>";
	 echo "</div>";
		echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for='lastname'>Last Name:</label>
	<div class='col-sm-10'><input type='text' class='form-control' id='lastname' name='lastname' required></div>";
	 echo "</div>";

		echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for='phone'>Phone:</label>
	<div class='col-sm-10'><input type='tel' class='form-control' id='phone' name='phone' required></div>";
	
	 echo "</div>";
	 echo "<div class='form-group'>";
	 	echo "<label class='col-sm-2 control-label'>Ext:</label>";
	 	echo "<div class='col-sm-10'>";
	 		echo "<input type='text' class='form-control' name='ext'>";
	 	echo "</div>";


	 echo "</div>";


	 	 		echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for='roleid'>User Role:</label>
	<div class='col-sm-10'>";
		echo "<select class='form-control'  name='roleid' required><option>Select</option>";
						
							$query = "SELECT roleid, name FROM roles WHERE roleid != '99' ORDER BY name ASC";
							$result = mysqli_query($dbc, $query);
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
								$roleid = $row['roleid'];
								$role = $row['name'];
								echo "<option name='$roleid'>$role</option>";
							}
						
					
					
				echo "</select>";

	echo  "</div>";
	 echo "</div>";
	 	echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for='email'>Email:</label>
	<div class='col-sm-10'><input type='email' class='form-control' id='email' name='email' required></div>";
	 echo "</div>";
	echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for='password1' required>Password:</label>
	<div class='col-sm-10'><input type='password' class='form-control' id='password1' name='password1' size='41' required></div>";
	echo "</div>";
		echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for='cpassword' required>Confirm:</label>
	<div class='col-sm-10'><input type='password' class='form-control' id='cpassword' name='cpassword' size='41' placeholder='Confirm Password' required></div>";
	echo "</div>";

	 		echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for='roleid'>Customer:</label>
	<div class='col-sm-10'>";
		echo "<select class='form-control'  name='custid' ><option>Select</option>";
						
							$queryci = "SELECT custid, company_name FROM customers ORDER BY company_name";
							$resultci = mysqli_query($dbc, $queryci);
							while($row = mysqli_fetch_array($resultci, MYSQLI_ASSOC)){
								$custid = $row['custid'];
								$company_name = $row['company_name'];
								echo "<option name='$custid'>$company_name</option>";
							}
						
					
					
				echo "</select>";

	echo  "</div>";
	 echo "</div>";
	 echo "<div class='form-group'>";
	 echo "<div class='col-sm-2'><input type='hidden' name='content' value='adduser'></div><div class='col-sm-10'><input type='submit'' value='Add' class='btn btn-mesa' /></div>";
 
	echo "</form>";
	
} 
 ?>
</div>
</div>
<br><br>
