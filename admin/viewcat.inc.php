<link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text|Libre+Barcode+39+Extended+Text" rel="stylesheet">


<?php
if(!isset($_SESSION['mesa_admin']))
{
include "../mylibrary/loginalert.php";
 }
 else{ 
	 $catid = $_GET['cat'];
	$name = $_GET['name'];
echo "<div class='section-frame'>";
echo "<h1 class='section-title' align='center'>$name</h1><hr>";
echo "<div class='table-responsive'>";

echo "<table class='table table-bordered table-hover'>";



echo "<thead><tr><th align='center'>Picture</th><th>Product Id</th><th>Catalog</th><th >Description</th><th >Count</th><th >Pack</th><th>CM#</th><th >MT#</th><th >Assoc. Prod</th><th>Barcode</th></tr></thead>";
echo "<tbody>";
	 		
	 
$query = "SELECT  prodid, catalogid, description, count, pack, cmn, mtc, assocprod, upca FROM products WHERE catid = $catid ORDER BY catid ASC";
$result = mysqli_query( $dbc, $query );
while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {

	$prodid = $row[ 'prodid'];
	$catalogid = $row['catalogid'];
	$description = $row[ 'description' ];
	$count = $row['count'];
	$pack = $row['pack'];
	$cmno = $row[ 'cmn' ];
	$mtcno = $row[ 'mtc' ];
	$assoc1 = $row[ 'assocprod' ];
	$upca = $row['upca'];

	
	echo "<tr><td align='center'><img src='showimage.php?id=$prodid' width='80' height='auto' class='img-responsive center-block'></td><td>$prodid</td><td>$catalogid</td>";

	echo "<td>$description</td><td style='font-size:12px'>$count</td><td>$pack</td><td>$cmno</td><td>$mtcno</td><td>$assoc1</td><td class='barcode'>$upca</td></tr>";
}

echo "</table></div>";
echo "<br>";
echo "</div><br>";
 }
?>