
<?php

$dbServerName="localhost";
$dbUsername="root";
$dbPassword= "";
//$dbName="projetSite_HTML_database";
$dbName="compagnieaerienne";

try{
    $database = new PDO("mysql:host=$dbServerName;dbname=$dbName",$dbUsername,$dbPassword);
    echo 'oui';
    
} catch (PDOException $e) {
    echo 'error';
}




