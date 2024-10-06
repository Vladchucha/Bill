<?php  // FILE password_w.php 
   if  ($_SERVER['HTTP_HOST'] ==  "localhost")
    {
	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "music";
    }
 else
 {
    $server = "rdbms.strato.de";
    $user = "U3613294";
    $password = "kireev#8LZ";
    $db = "DB3613294";
 }
// echo '<img class="imageBig" src="'.$pathSite .$photoRow['path'] .'/'. $photoRow['imageFile'] . '" ';
// $pathSite = '/foto'; 