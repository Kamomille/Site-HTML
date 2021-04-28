<?php
include 'database.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$erreur="";
$check=false;

foreach ( $_POST as $key => $val)
    if ($val=="Envoyer"){
        $id=$key;
    }

if (strlen($_POST['nom'])<2){
    $erreur=$erreur."&nom=erreur";
    $check=true;
    
    
}

if (strlen($_POST['prenom'])<2){
    $erreur=$erreur."&prenom=erreur";
    $check=true;
    
}

if (strlen(intval($_POST['telephone']))!=7 || strval($_POST['telephone'])[0]!="0" ){
    $erreur=$erreur."&tel=erreur";
    $check=true;    
}

if ($check==true){
    header("Location:http://localhost/projetSite_HTML/public_html/gestionSalarié_modifier_ajouter.php?id=$id"."$erreur");
}
else {
    if ($id!=0){
        $sql="UPDATE authentification SET nom=".$_POST["nom"].",prenom=".$_POST["prenom"].",nationalite=".$_POST["nationalite"].",adresse=".$_POST["adresse"].",age=".$_POST["age"].",sexe=".$_POST["sexe"].",situationFamiliale=".$_POST["situationFamiliale"].",tel=".$_POST["telephone"].",contrat=".$_POST["contrat"].",contratDurée_mois=".$_POST["contratDurée_mois"]
." WHERE id=".$id;
    }
    else {
        echo 'oui';
     $mail=$_POST["nom"].".".$_POST["prenom"]."@esme.com";
     $identifiant=strtoupper($_POST["nom"]).strtolower($_POST["prenom"]).strval(random_int(0,100));
     $mdp=strtoupper($_POST["nom"])."_".strtolower($_POST["prenom"]).strval(random_int(1000000,99999999));
     
     if(($_POST["contrat"]=="CDD" &&$_POST["contratDurée_mois"]>3) || $_POST["contrat"]!="CDD"){
        if($_POST["fonction"]=="enseignant"){
            $RTT=10;
            $congésPayés=24;
         }
        else {
            $RTT=5;
            $congésPayés=24;             
         }
     }
     elseif ($_POST["contrat"]=="CDD" &&$_POST["contratDurée_mois"]<=3) {
            $RTT=0;
            $congésPayés=0;      
    }

     echo 'oui';
    echo $nom=$_POST['nom'];
    echo $prenom=$_POST['prenom'];
    echo $nationalite=$_POST['nationalite'];
    echo $adresse=$_POST['adresse'];
    echo $age=$_POST['age'];
    echo $sexe=$_POST['sexe'];
    echo $situationFamiliale=$_POST['situationFamiliale'];
    echo $tel=$_POST['telephone'];
    echo $contrat=$_POST['contrat'];
    echo $contratDuree_mois=$_POST['contratDurée_mois'];
    echo $fonction=$_POST["fonction"];
    
    $sql="INSERT INTO authentification(identifiant,mdp,mail,fonction,congésPayés,congésRTT,nom,prenom,nationalite,adresse,age,sexe,situationFamiliale,tel,contrat,contratDurée_mois) VALUES('$identifiant','$mdp','$mail','$fonction','$congésPayés','$congésRTT','$nom','$prenom','$nationalite','$adresse','$age','$sexe','$situationFamiliale','$tel','$contrat','$contratDuree_mois')";
    
    echo $sql;
    }
    mysqli_query($connect,$sql);
    header("Location:http://localhost/projetSite_HTML/public_html/gestionSalarié.php");
}
?>