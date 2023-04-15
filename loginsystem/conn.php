<?php
    $server="localhost";
    $username="root";
    $pass="u";
    $db="rbh";
    try{
    $conn=mysqli_connect($server,$username,$pass,$db);
    }
    catch(Exception $e)
    {
       // echo "An error occur red: " . $e->getMessage();
    }
     
 
?>