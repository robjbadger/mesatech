<div class="section-frame">

<?php

if(!isset($_SESSION['mesa_admin'])){
            include "..mylibrary/loginalert.inc.php";
}else
{
            
            $catid= $_GET['cat'];
            $name = $_GET['name'];
echo "<h1 class='section-title' align='center'>Click on a $name product to edit it</h1><hr> ";
            if(!isset($_GET['page']))
                        $page = 1;

            else
                        $page = $_GET['page'];

            
showproducts($catid, $page, "admin.php?content=editproducts","admin.php?content=updateproduct"); 
}










?>
</div>
<br><br>

