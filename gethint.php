<!DOCTYPE html>
<?php
$q = $_REQUEST["q"];
if($q!=""){
    include_once 'dbConfig_PDO.php';
try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// check if name exist
$stmt = $conn->prepare("SELECT name FROM accounts");// where containt $q
$stmt->bindParam(':name', $name);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows= $stmt->fetchAll();
if($rows != NULL){
// double check..
foreach ( $rows as $row )
{
    if(strpos($row['name'],$q)!=NULL){
        echo $row['name']."</br>";
    }
}// end foreach
}//end if
}//end try
 catch(PDOException $e)
{
 echo "Error: " . $e->getMessage();
}
$conn = null;
}
?>


<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl">

<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
</body>
</html>