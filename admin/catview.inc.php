
 
  <?php 

if(!isset($_SESSION['mesa_admin']))
{
include "../mylibrary/loginalert.php";
 }
 else{ 
echo "<div class='section-frame'>";
echo "<h1 class='section-title' align='center'>Categories</h1><hr>";






   $query = "SELECT catid, name, catalogid, created FROM categories order by catid ASC";
   $fudge = mysqli_query($dbc, $query);
echo "<table class='table table-hover table-bordered'>";
echo "<thead><tr><th>Cat Id</th><th>Name</th><th>Catalog Id</th><th>Created</th><th>Edit</th></tr></thead>";
echo "<tbody>";
   while($row = mysqli_fetch_array($fudge, MYSQLI_ASSOC))  {
	   $catid = $row['catid'];
      $name = $row['name'];
      $catalogid = $row['catalogid'];
      $created = $row['created'];

	 
	   echo "<tr><td>$catid</td><td>$name</td><td>$catalogid</td><td>$created</td>";
     echo "<td><a href='admin.php?content=editproducts&cat=$catid&name=$name'><i class='fa fa-edit' style='font-size:14px'></i></a> &nbsp;&nbsp;";
     echo "<a href='admin.php?content=delete-cat&cat=$catid'><i class='fa fa-trash' style='font-size:14'></i></a></td></tr>";
   }
		echo "<tr border='none'><td colspan='5' align='right' style='padding:0px 50px'><a type='button' class='btn btn-mesa' href='admin.php?content=newcat'>Add New</a></td></tr>";
echo "</tbody>";
   echo"</table>";
         echo "<br>";
	   echo "</div>";

 } 
 ?>
  <br><br>