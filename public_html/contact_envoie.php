<?php
include 'database.php';

session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$personne=$_SESSION['id'];
$objet=$_POST['objet'];
$message=$_POST['message'];
$destinataire=$_POST['destinataire'];

$req="INSERT INTO commentaire(personne,objet,message,destinataire) VALUES(?,?,?,?)";
$result = mysqli_prepare($connect,$req);
$var= mysqli_stmt_bind_param($result,'issi',$personne,$objet,$message,$destinataire);
$var= mysqli_execute($result);
mysqli_stmt_close($result);

mysqli_close($connect);
header("Location:http://localhost/projetSite_HTML/public_html/menu.php");

?>
