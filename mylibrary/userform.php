
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$userid = $_POST['userid'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$comments = $_POST['comments'];
$password = $_POST['password'];

		if(!empty($fname) && !empty($lname) && !empty($email) && !empty($gender) && !empty($age) && !empty($comments) && !empty($password)){
		
			include('webconn.php');
			
		}else{
		
			echo "ERROR: you left some values in blank!";
		
		}


}else{

	echo "<strong>Please complete the form...</strong>";

}

?>

<html>

<head>
<title></title>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<form action="userform.php" method="post">
	
		<p>First Name: <input type="text" name="fname" size="20" maxlength="50" /></p>
		<p>Last Name: <input type="text" name="lname" size="20" maxlength="50" /></p>
		<p>Email: <input type="text" name="email" size="40" maxlength="50" />
		<p>Gender: <input type="radio" name="gender" value="M" /> Male 
		<input type="radio" name="gender" value="F" /> Female</p>
		<p>Age:<select name="age">
					<option value="0-29">Under 30</option>
					<option value="30-60">Between 30 and 60</option>
					<option value="60+">Over 60</option>
			   </select></p>
		<p>Comments:<br /><textarea name="comments" rows="3" cols="40" maxlength="200"></textarea></p>
        <p>Password:<input type="password" name="password" maxlength="50"></textarea></p>		
		<p><input type="submit" name="submit" value="Submit" /></p>	   

	</form>


</body>


</html>