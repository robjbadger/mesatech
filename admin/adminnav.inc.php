<script src="https://use.fontawesome.com/5684041910.js"></script>
<div id="mesanav">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <i class="fa fa-bars" aria-hidden="true"></i>
                              
      </button>
			


				<a class="navbar-brand"  href="../index.php"><img src="../favicon-16x16.png" alt="mesatech ico"></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="admin.php"><i class="fa fa-home" aria-hidden="true"></i></a>
					</li>
					
					<?php

				if (isset($_SESSION['mesa_admin'])){


				$userid = $_SESSION['mesa_admin'];


					echo "<li class='dropdown'>";
					echo " <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Users<span class='caret'></span></a>";
					echo " <ul class='dropdown-menu dropdown-content'>";
					echo "<li><a href='admin.php?content=usermgt'>User Management</a></li>";
					echo " <li><a href='admin.php?content=newuser'>Create user</a></li>";
					echo "<li class='divider'></li>";
					echo "<li><a href='admin.php?content=custmgt'>Customer Management</a></li>";
					echo "<li><a herf='admin.php?content=newcust'>Create Customer</a></li>";

					echo "</ul>";
					echo "</li>";
				
					echo "    <li class='dropdown'>";
					echo " <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Categories <span class='caret'></span></a>";
					echo " <ul class='dropdown-menu dropdown-content'>";
					echo "<li><a href='admin.php?content=catview'>View Categories</a></li>";
					echo " <li><a href='admin.php?content=newcat'>New Category</a></li>";

					echo "</ul>";
					echo "</li>";
					echo "<li class='dropdown'>";
                                       echo "<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Catalogs <span class='caret' href='admin.php?content=catalogs'></span></a>";
					echo " <ul class='dropdown-menu dropdown-content'>";
					$sql = "SELECT catalogid, cname FROM catalogs ORDER BY cname";
					$result = mysqli_query($dbc, $sql);
					while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
						$catalogid = $row['catalogid'];
						$cname = $row['cname'];
						echo "<li><a href='admin.php?content=viewcatalogs&id=$catalogid&name=$cname'>$cname</a></li>";
					}
                                             echo "<li><a href='admin.php?content=catalogs'>View All</a></li>";
						echo "</ul>";

echo"</li>";


					echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>Products <span class='caret'></span></a>";
					echo "<ul class='dropdown-menu dropdown-content'>";
					$query = "SELECT catid, name FROM categories ORDER BY name ASC";
					$result = mysqli_query( $dbc, $query );
					while ( $row = mysqli_fetch_array( $result, MYSQLI_ASSOC ) ) {
						$catid = $row[ 'catid' ];
						$name = $row[ 'name' ];
						echo "<li><a href='admin.php?content=editproducts&cat=$catid&name=$name'>$name</a></li>";
					}
					echo "<li class='divider'></li>";
					echo "<li><a href='admin.php?content=products'>View All</a></li>";
		

								echo "<li><a href='admin.php?content=newprod'>Add Product</a> </li>";


					echo "</ul>";

					echo "</li>";
						echo "    <li class='dropdown'>";
					echo " <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Programs <span class='caret'></span></a>";
					echo " <ul class='dropdown-menu dropdown-content'>";
					echo "<li><a href='admin.php?content=../mylibrary/chemical'>Chemical Program</a></li>";
					echo "<li><a href='admin.php?content=../mylibrary/dispenser'>Dispenser Program</a></li>";
					echo "<li><a href='admin.php?content=../mylibrary/mesagreen'><span class='mesa-name'>Mesa</span><span style='color:forestgreen'>Green</span> Program</a></li>";
echo "<li class='divider'></li>";;
					echo "<li><a href='admin.php?content=progview'>View Programs</a></li>";
		echo " <li><a href='admin.php?content=newprogram'>New Program</a></li>";

					echo "</ul>";
					echo "</li>";
					echo "</ul>";
					echo "<ul class='nav navbar-nav navbar-right'>";
						echo "<li><a href='admin.php?content=adminacct&userid=$userid'><i class='fa fa-user-secret' aria-hidden='true'></i></a></li>";
					echo "<li><a href='../mylibrary/logout.php' class='btn btn-mesa'><i class='fa fa-sign-out' aria-hidden='true'></i></a></li>";


					echo "</ul>";
					 } 

					?>
			</div>
		</div>
	</nav>
</div>