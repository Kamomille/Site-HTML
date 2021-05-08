<?php
session_start() ;
include 'database.php';


if(is_int ($_POST["nbJour"]) == true){
    echo "faut un entier";
}
else{
    echo "ok";
}


$id_personne=$_SESSION['identifiant'];
echo "$id_personne";
$id=1;
$date_demande=$_POST['date_demande'];
$date_congé=$_POST['date_congé'];
$nbJour=$_POST['nbJour'];
$état="non validé";

$sql="INSERT INTO congé(id,id_personne,date_demande,date_congé,nbJour,état) VALUES('$id','$id_personne','$date_demande','$date_congé','$nbJour','$état')";

echo "$sql";

$sql="INSERT INTO congé(nbJour,état) VALUES(1)";
mysqli_query($connect,$sql) OR Die *('It does not work');

//header("Location:http://localhost/projetSite_HTML/public_html/menu.php");

    ?>