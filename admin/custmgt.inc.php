<div class="section-frame">
<h1 class="section-title" align="center">Customer Management</h1><hr>
<div class="table-responsive">
	<table class="table table-hover table-bordered">
		<thead><tr><th>Cust #</th><th>Company</th><th>Address</th><th>Address 2</th><th>City</th><th>State</th><th>Zip</th><th>Phone</th><th>Ext</th><th>Catalog</th></tr></thead>
<?php

$sql = "SELECT custid, company_name, address, address2, city, state, zip, phone, ext, email, catalogid FROM customers ORDER BY company_name";
$result = mysqli_query($dbc, $sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	$custid = $row['custid'];
	$company_name = $row['company_name'];
	$address = $row['address'];
	$address2 = $row['address2'];
	$city = $row['city'];
	$state = $row['state'];
	$zip = $row['zip'];
	$phone = $row['phone'];
	$ext = $row['ext'];
	$catalogid = $row['catalogid'];
	echo "<tr><td><a href='admin.php?content=editcust&id=$custid'>$custid</a></td><td>$company_name</td><td>$address</td><td>$address2</td><td>$city</td><td>$state</td><td>$zip</td><td>$phone</td><td>$ext</td><td>$catalogid</td></tr>";
}









?>

</table>


</div>


</div>
<br><br>