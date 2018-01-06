<?php
   $catid=$_POST['catid'];

   $description=$_POST['description'];

   $count=$_POST['count'];

   $pack =$_POST['pack'];

   $price=$_POST['price'];

   $cmnum =$_POST['cmnum'];

   $mtcnum =$_POST['mtcnum'];

   $assocprod =$_POST['assocprod'];

   $assocprod2 =$_POST['assocprod2'];

   $assocprod3 =$_POST['assocprod3'];

   if (get_magic_quotes_gpc())

   {

      $catid = stripslashes($catid);

      $description = stripslashes($description);

      $count = stripslashes($count);

       $pack = stripslashes($pack);

      $price = stripslashes($price);

      $cmnum = stripslashes($cmnum );

      $mtcnum = stripslashes($mtcnum);

      $assocprod = stripslashes($assocprod);

      $assocprod2 = stripslashes($assocprod2);

      $assocprod3 = stripslashes($assocprod3);

   }

   $catid = mysqli_real_escape_string($catid);

   $description = mysqli_real_escape_string($description);

   $count = mysqli_real_escape_string($count);

   $pack = mysqli_real_escape_string($pack);

   $price = mysqli_real_escape_string($price);

   $cmnum = mysqli_real_escape_string($cmnum);

   $mtcnum = mysqli_real_escape_string($mtcnum);

   $assocprod = mysqli_real_escape_string($assocprod);

   $assocprod2 = mysqli_real_escape_string($assocprod2);

   $assocprod3 = mysqli_real_escape_string($assocprod3);

   $thumbnail = getThumb($_FILES['picture']);

   $thumbnail = mysqli_real_escape_string($thumbnail);

   $query = "INSERT INTO products (catid, description, count, pack, picture, price, cmnum, mtcnum, assocprod, assocprod2, assocprod3) " .

            " VALUES ('$catid','$description', '$count', '$pack','$thumbnail', '$price', '$cmnum', '$mtcnum', '$assocprod', '$assocprod2', '$assocprod3')";

   $result = mysql_query($query) or die('Unable to add product');

   if ($result)

      echo "<h2>New product added</h2>\n";

   else

      echo "<h2>Problem adding new product</h2>\n";

?>