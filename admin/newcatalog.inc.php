
<div class="section-frame">
		<h1 class="section-title" align="center">Add new product catalog</h1>		<hr>

 
  <?php 
	if(!isset($_SESSION['mesa_admin']))
{
	include "../mylibrary/loginalert.php";
 }
 else{ 

	echo "<div class='container'>";
		echo "<form class='form-horizontal ' action='admin.php' method='post'>";
		echo "<div class='row'>";
	 echo "<div class='form-group'>";
	 echo "<label class='col-sm-2 control-label' for='cname'>Catalog Name:</label>";
	 	echo "<div class='col-sm-10'>";
	 		echo "<input type='text' class='form-control' name='cname' placeholder='enter catalog name' autofocus required>";
	 	echo "</div>";
	 echo "</div>";
	 echo "</div>";
	 
	 echo "<div class='row'>";
	 echo "<div class='form-group'>";
	 	 		 echo "<label class='col-sm-2 control-label' for='start_date'>Start Date:</label>";

	 	echo "<div class='col-sm-4'>";
	
	echo " <div class='input-group margin-bottom-sm'>";
  echo "<span class='input-group-addon'><i class='fa fa-calendar'></i></span>
  <input class='form-control' type='date' name='start_date' placeholder='Start Date'>";
  echo "</div>";
 echo "</div>";

	 		 echo "<label class='col-sm-2 control-label' for='start_date'>End Date:</label>";

	 	echo "<div class='col-sm-4'>";
	
	echo " <div class='input-group '>";
  echo "<span class='input-group-addon'><i class='fa fa-calendar'></i></span>
  <input class='form-control' type='date' name='end_date' placeholder='End Date'>";
  echo "</div>";
 echo "</div>";


	echo "</div>";
	echo "</div>";

	 echo "<div class='form-group'>";
	 echo "<div class='col-sm-offset-1 col-sm-3'><input type='hidden' name='content' value='addcat'><input type='submit' class='btn btn-mesa' value='Add'></div>";
 echo "</div>";
	echo "</form>";
	
	echo "</div>";
} 
 ?>
</div>