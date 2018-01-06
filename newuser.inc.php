


	<div class="col-sm-12 section-title"><h2 align="center">Add new User</h2><hr></div>
		<form class="form-horiztonal reg-form" action="adduser.php" method="post">
	
		<div class="form-group">
	<label class="control-label col-sm-3" for="user_name">User Name:</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="user_name" maxlength="50">
		</div>
	</div>
		<div class="form-group">
	<label class="control-label col-sm-3" for="first_name">First Name:</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="first_name" maxlength="50">
		</div>
	</div>
		<div class="form-group">
	<label class="control-label col-sm-3" for="last_name">Last Name:</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="last_name" maxlength="50">
		</div>
	</div>
	<div class="form-group">
	<label class="control-label col-sm-3" for="email">Email:</label>
		<div class="col-sm-8">
			<input type="email" class="form-control" maxlength="50">
		</div>
	</div>
		<div class="form-group">
	<label class="control-label col-sm-3" for="custid">Cust. #:</label>
		<div class="col-sm-8">
		<?php 
			include "../mylibrary/connection.php";
			$query = "SELECT custid, company_name FROM customers ORDER BY custid ASC";
			$result = mysqli_query($dbc, $query);
			echo "<select id='custid'><option>Select</option>";
						while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{		
				$custid = $row['custid'];
				$company_name = $row['company_name'];
				echo "<option id='$custid'>$company_name</option>";
				}	
				
			echo "</select>";
				?>
		</div>
			</div>
		<div class="form-group">

		<div class="col-sm-8 col-sm-push-3">
			<input type="submit" class="btn btn-mesa" value="submit">
		</div>
	</div>
</form>
