
 
  <?php 

if(!isset($_SESSION['mesa_admin']))
{
	echo "<h2>Sorry, you must be logged in to access this feature.</h2><hr>";
	echo "<a href='admin.php'>Try Again</a>";
 }
 else{ 
echo "<div class='section-frame'>";
echo "<h1 class='section-title' align='center'>Programs</h1><hr>";






   $query = "SELECT programid, name FROM programs order by programid ASC";
   $fudge = mysqli_query($dbc, $query);
echo "<table class='table table-hover table-bordered'>";
echo "<thead><tr><th>Prog Id</th><th>Name</th><th>Edit</th></tr></thead>";
echo "<tbody>";
   while($row = mysqli_fetch_array($fudge, MYSQLI_ASSOC))  {
	   $programid = $row['programid'];
      $name = $row['name'];

	 
	   echo "<tr><td>$programid</td><td>$name</td>";
     echo "<td><a href='admin.php?content=editprograms&programid=$programid&name=$name'><i class='fa fa-edit style='font-size:14px'></i></a>";
     echo "&nbsp; &nbsp; <a href='admin.php?content=deleteprogramt&programid=$programid'>Delete</a></td></tr>";
   }
		echo "<tr><td colspan='3'><a type='button' class='btn btn-mesa' href='admin.php?content=newcat'>Add New</a></td></tr>";
echo "</tbody>";
   echo"</table>";
         echo "<br>";
	   echo "</div>";

 } 
 ?>
  <br><br>