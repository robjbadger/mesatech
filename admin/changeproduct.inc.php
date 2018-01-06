<?php
	$delete = $_POST['button'];
	if($delete == "Delete Product")
	{
		$prodid = $_POST['prodid'];
		$query = "DELETE FROM products WHERE prodid = $prodid";
		$result = mysqli_query($dbc, $query);
		if($result){
			echo "<h2>Product $prodid deleted</h2><hr>";
			  exit;
		}else{
			echo "<h2>Problem deleting product</h2><hr>";
			  exit;
		}
		} 
		else{
			$prodid = $_POST['prodid'];
			$catid = $_POST['catid'];
			$description = $_POST['description2'];
			$count = $_POST['count2'];
			$pack = $_POST['pack2'];
			$upc = $_POST['upc'];

			$description = mysqli_real_escape_string($dbc, $description);
			$count = mysqli_real_escape_string($dbc, $count);
			$pack = mysqli_real_escape_string($dbc, $pack);
			$upc = mysqli_real_escape_string($dbc, $upc);

			$PictName = $_FILES['picture']['name'];
			if($PictName)
			{
		 $thumbnail = getThumb($_FILES['picture']);
         $thumbnail = mysqli_real_escape_string($thumbnail);
         $query = "UPDATE products SET catid='$catid', description = '$description', " .
                 "count= $count, pack = $pack, upca = $upc, picture = '$thumbnail' " .
                 "WHERE prodid = $prodid";
			}
			else{
				$result = mysqli_query_($dbc, $query) or die(mysqli_error());
				if($result)
				{
					echo "<h2>Product Information Updated</h2><hr>";
				}
				else{
					echo "<h2>Sorry, product not updated</h2><hr>";
				}
			
		}
	}


?>