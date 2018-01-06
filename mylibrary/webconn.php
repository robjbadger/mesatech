<?php
/*
Live Web TST DB
define('DB_SERVER', ''www.mesatechcorp.com:3306');
define('DB_USERNAME', 'meztest');
define('DB_PASSWORD', 'mesa2017);
define('DB_NAME', 'tst-mesa');

$dbc = mysqli_connect("$host", "$user", "$password", "$db") or die ('<h2 color="red"> Could not connect to database '.mysqli_connect_error().'</h2><hr>');

	$host= gethostname();
	$ip = gethostbyname($host);

Local Test DB
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'mezdec17');
define('DB_PASSWORD', 'K96,C}kK0K}J');
define('DB_NAME', 'mezadb');
____________

LIVE PRD WEB DB
define('DB_SERVER', 'www.mesatechcorp.com:3306');
define('DB_USERNAME', 'mezdec17');
define('DB_PASSWORD', 'K96,C}kK0K}J');
define('DB_NAME', 'mezadb');






*/
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'meztech');
define('DB_PASSWORD', 'K96,C}kK0K}J');
define('DB_NAME', 'mtech1117');



$dbc = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($dbc === false){
    die("<div class='alert alert-dismissable alert-danger fade in'><strong>ERROR:</strong> Could not connect. " . mysqli_connect_error()."</div>");
}

else{
/*
	$result = mysqli_query($dbc, "SHOW DATABASES");
	while ($row = mysqli_fetch_assoc($result)) {
			$host= gethostname();
		$ip = gethostbyname($host);
		$dname = $row['Database'];
		echo "<div class='alert alert-success alert-dismissable fade-in'>";
		echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Success!</strong> connected to database: $dname, IP: $ip </div>"; 

	

	

} */





	}
mysqli_set_charset($dbc,"utf8");








?>