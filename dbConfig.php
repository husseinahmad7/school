<?php
    include_once 'dbConfig_PDO.php';
   $conn=mysqli_connect($servername,$username,$dbpassword,"$dbname");
   if(!$conn){
      die('Could not Connect My Sql');
   }
?>