<?php
	$prodid = $_GET['prodid'];


		$sql = "SELECT prodid, product_num, catalogid, catid, description, count, pack, picture, price, cmn, mtc, assocprod, upca FROM products WHERE prodid  = $prodid";
	
		$result = mysqli_query($dbc, $sql);
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$product_num = $row['product_num'];
	$catid = $row['catid'];
	$description = $row['description'];
	$count = $row['count'];
	$pack = $row['pack'];
	$cmn = $row['cmn'];
	$mtc = $row['mtc'];
	$upca = $row['upca'];
	$query = "SELECT name FROM categories WHERE catid=$catid";
	$result = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$catname = $row['name'];
echo "<div class='section-frame'>";
	echo "<h1 class='section-title' align='center'>Update Product Information ProdID: $prodid</h1><hr>";
	echo "<form class='horizontal-form' enctype='multipar/form-data' action='admin.php' method='post'>";
	echo "<input type='hidden' name='content' value='changeproduct'>";
	echo "<input type='hidden' name='prodid' value='$prodid'>";
echo "<div class='container'>";
// start form group
echo "<div class='row'>";
	echo "<div class='form-group'>";
		echo "<label class='col-sm-offset-2 col-sm-2' align='right' for='prodid'>Prod. Id:</label>";
		echo "<div class='col-sm-8' class='form-control-static'>$prodid:</div>";

	echo "</div>";
echo "</div>";
	//end form group
// start form group
echo "<div class='row'>";
	echo "<div class='form-group'>";
		echo "<label class='col-sm-offset-2 col-sm-2' align='right' for='catid2'>Category:</label>";
		echo "<div class='col-sm-8'>";
	echo "<select name='catid' class='form-contol'>";
	$query = "SELECT catid, name FROM categories";
	$result = mysqli_query($dbc, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$tempcatid = $row['catid'];
		$name = $row['name'];
		if($tempcatid == $catid)
			echo "<option value='$tempcatid' selected='selected'>$name</option>";
		else
			echo "<option value='$tempcatid'>$name</option>";
	}
	echo "</select>";
		echo "</div>";
	echo "</div>";
echo "</div>";
	//end form group
// start form group
echo "<div class='row'>";
	echo "<div class='form-group'>";
		echo "<label class='col-sm-offset-2 col-sm-2' align='right'>Product #:</label>";
		echo "<div class='col-sm-8'>";
			echo "<input type='text' class='form-control' name='newprod_num' placeholder='$product_num'>";
		echo "</div>";
	echo "</div>";
echo "</div>";
//end form group


// start form group
	echo "<div class='row'>";
	echo "<div class='form-group'>";
		echo "<label class='col-sm-offset-2 col-sm-2' align='right' for='description2'>Description:</label>";
		echo "<div class='col-sm-8'>";
			echo "<input type='text' class='form-control' name='description2' placeholder='$description'>";
		echo "</div>";
	echo "</div>";
	echo "</div>";
//end



// start form group
	echo "<div class='row'>";
	echo "<div class='form-group'>";
		echo "<label class='col-sm-offset-2 col-sm-2' align='right' for='count2'>Count:</label>";
		echo "<div class='col-sm-8'>";
			echo "<input type='text' class='form-control' name='count2' placeholder='$count'>";
		echo "</div>";
	echo "</div>";
	echo "</div>";


	//end form group

	// start form group
	echo "<div class='row'>";
	echo "<div class='form-group'>";
		echo "<label class='col-sm-offset-2 col-sm-2' align='right' for='pack2'>Pack:</label>";
		echo "<div class='col-sm-8'>";
			echo "<input type='text' class='form-control' name='pack2' placeholder='$pack'>";
		echo "</div>";
	echo "</div>";
	echo "</div>";

	//end form group// start form group
	echo "<div class='row'>";
	echo "<div class='form-group'>";
		echo "<label class='col-sm-offset-2 col-sm-2' align='right' for='cmn2'>CoreMark #:</label>";
		echo "<div class='col-sm-8'>";
			echo "<input type='text' class='form-control' name='cmn2' placeholder='$cmn'>";
		echo "</div>";
	echo "</div>";
echo "</div>";
	//end form group// 
// start form group
echo "<div class='row'>";
	echo "<div class='form-group'>";
		echo "<label class='col-sm-offset-2 col-sm-2' align='right' for='mtc2'><span class='mesa-name'>MesaTech</span>#:</label>";
		echo "<div class='col-sm-8'>";
			echo "<input type='' class='form-control' name='mtc2' placeholder='$mtc'>";
		echo "</div>";
	echo "</div>";
echo "</div>";
	//end form group
// start form group
echo "<div class='row'>";
	echo "<div class='form-group'>";
		echo "<label class='col-sm-offset-2 col-sm-2' align='right' for='nassocprod'>Assoc. Prod:</label>";
		echo "<div class='col-sm-8'>";
			echo "<input type='' class='form-control' name='nassocprod' placeholder=''>";
		echo "</div>";
	echo "</div>";
echo "</div>";
	//end form group
// start form group
echo "<div class='row'>";
	echo "<div class='form-group'>";
		echo "<label class='col-sm-offset-2 col-sm-2' align='right' for='upc'>Barcode:</label>";
		echo "<div class='col-sm-8'>";
			echo "<input type='' class='form-control' name='upc' placeholder='$upca'>";
		echo "</div>";
	echo "</div>";
echo "</div>";
	//end form group
// start form group
echo "<div class='row'>";
	echo "<div class='form-group'>";
		echo "<label class='col-sm-offset-2 col-sm-2' align='right' for='picture'>Picture:</label>";
		echo "<div class='col-sm-8'>";
		echo "<img src='showimage.php?id=$prodid' width='80' height='60' class='img-responsive center-block'>";
			echo "<input type='' class='form-control' name='picture' placeholder=''>";
		echo "</div>";
	echo "</div>";
echo "</div>";
	//end form group

// start form group
echo "<div class='row'>";
	echo "<div class='form-group'>";
		echo "<label class='col-sm-offset-2 col-sm-2' align='right' for='picture'>Update Picture:</label>";
		echo "<div class='col-sm-8'>";
			echo "<input type='file' name='picture'>";
		echo "</div>";
	echo "</div>";
echo "</div>";
	//end form group
echo "<br>";
// start form group
echo "<div class='row'>";
	echo "<div class='form-group'>";

		echo "<div class='col-sm-offset-4 col-sm-8'>";
			echo "<button type='submit' class='btn btn-success' name='button' value='Update'><i class='fa fa-save' aria-hidden='true'></i></button> &nbsp; <button type='submit' class='btn btn-danger' name='button'><i class='fa fa-trash' aria-hidden='true' style='color:#fff'></i></button>";
		echo "</div>";
	echo "</div>";
echo "</div>";
echo "<br><br>";
	//end form group

		echo "</div>";
		echo "</form>";
echo "</div>";

}









	?>
