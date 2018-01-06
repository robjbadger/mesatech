 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<?php

session_start();



include ("webconn.php");



$userid = $_POST['userid'];

$password = $_POST['password'];


$query = "SELECT userid, firstname, roleid, catalogid from users where userid = '$userid' and password = PASSWORD('$password')";

$result = mysqli_query($dbc, $query);



if (mysqli_num_rows($result) == 0)

{
echo "<div class='alert alert-warning alert-dismissable fade in'>
    <a href='../index.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Error!</strong>  Your credentials are invalid</div>";

} else

{
while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
  $userid = $row['userid'];
  $role = $row['roleid'];
  $catalogid = $row['catalogid'];
  if($role == 99){
   $_SESSION['mesa_admin'] = $userid;
   header("Location: ../admin/admin.php");
}else if($role == 90){
   $_SESSION['mesa_admin'] = $userid;
   header("Location: ../admin/admin.php");
}else if($role == 105){
   $_SESSION['mesa_user'] = $userid;
   header("Location: ../user/nwp.php");
}else{
if($role == 1){
  $_SESSION['mesa_user'] = $userid;
  $_SESSION['catalog'] = $catalogid;
  header("Location: ../user/user.php");
}
}




}
}
?>
