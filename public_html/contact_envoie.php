<?php
include 'database.php';

session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var_dump($_POST);

$personne=$_SESSION['id'];
$objet=$_POST['objet'];
$message=$_POST['message'];

$sql="INSERT INTO commentaire(personne,objet,message) VALUES('$personne','$objet','$message')";
echo "$sql";
mysqli_query($connect, $sql);
header("Location:http://localhost/projetSite_HTML/public_html/menu.php");

?>
