<?php
$programid = $_GET['programid'];
$name = $_GET['name'];
echo "<div class='section-frame'>";
echo "<h1 class='section-title' align='center'>Edit Program '$name'</h1><hr>";

/* responsive table */
echo " <div class='table-responsive'> ";
echo "  <table class='table table-hover table-bordered'>";



$sql = "SELECT programid, name, details, start_date, end_date FROM programs WHERE programid = $programid";
$result = mysqli_query($dbc,$sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$programid = $row['programid'];
	$details = $row['details'];
	$start_date = $row['start_date'];
	$end_date = $row['end_date'];
	echo "<tr><th>Program Id:</th><td>$programid</td></tr>";
	echo "<tr><th>Details</th><td>$details</td></tr>";
	echo "<tr><th>Image:</th><td align='center'><img src='showprog.php?programid=$programid'  class='img-responsive'></td></tr>";

	echo "<tr><th>Start Date</th><td> $start_date</td></tr>";
	echo "<tr><th>End Date</th><td> $end_date</td></tr>";
	
}
echo "</table>";
echo "</div>";	

echo "</div>";
echo "<br><br>";
?>