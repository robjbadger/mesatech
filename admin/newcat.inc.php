		<div class="section-frame">

	<h1 class="section-title" align='center'>Add new Category</h1><hr>
	


  <?php 
	
	if(!isset($_SESSION['mesa_admin']))
{
	include "../mylibrary/loginalert.php";
 }
 else{ 
 echo "<form class='form-horizontal ' action='admin.php' method='post'>";
echo "<div class='form-group'>";
echo "<label class='col-sm-2 control-label' for='name'>Category Name:</label>";
echo "<div class='col-sm-10'>";
	echo "<input type='text' class='form-control' name='name' required>";
echo "</div>";


echo "</div>";
		echo "<div class='form-group'>";
			echo "<label class='col-sm-2 control-label' for='catalogid'>Catalog:</label>";
			echo "<div class='col-sm-10'>";
				echo "<select class='form-control' name='catalogid'><option value=''></option>";
				$sql="SELECT catalogid, cname FROM catalogs WHERE catalogid < 999 ORDER BY cname ASC";
				$result = mysqli_query($dbc, $sql);
				while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
					$catalogid = $row['catalogid'];
					$cname = $row['cname'];
					echo "<option value='$catalogid'>$cname</option>";
				}
				echo "</select>";
	 		echo "</div>";
	 	echo "</div>";

	 echo "<div class='form-group'>";
	 echo " <div class='col-sm-offset-2 col-sm-10'><input type='hidden' name='content' value='addcat'><input type='submit' class='btn btn-mesa' value='Add'></div>";


	echo "</form>";
  
	}
 ?>

</div>
</div>
<br><br>
