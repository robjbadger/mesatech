<?php

				echo "<div class='section-frame'>";
echo "<div class='container'>";
/* print_r($_SESSION); */
   $welcome = $_SESSION['mesa_admin'];

   echo "<h1 class='section-title' align='center'>Welcome, $welcome</h1><hr>";


 


   $date = date("l, F j, Y");
   echo "<p>Today's date: $date</p><br>";
   echo "<h2>Admin messages:</h2>";
   if (is_readable("../mylibrary/messages.txt"))
   {
      $message = file_get_contents("../mylibrary/messages.txt");
      $message = nl2br($message);
      echo $message;
   }
   else
   {
      echo "No messages for today.";
   }
echo "</div>";

		echo "</div>";
			
?>
<br><br>