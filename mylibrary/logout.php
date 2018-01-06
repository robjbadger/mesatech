
<?php
session_start();
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy();
echo "<h1>Thank you, you have successfully logged out.</h1>";

header( "refresh:1; url=../index.php" );
exit;
?>
