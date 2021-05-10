<?php
session_start();
include 'database.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$erreur="";
$check=false;
var_dump($_POST);
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
        $nom=strval($_POST['nom']);
        $prenom=strval($_POST['prenom']);
        $nationalite=strval($_POST['nationalite']);
        $adresse=strval($_POST['adresse']);
        $age=$_POST['age'];
        $sexe=$_POST['sexe'];
        $situationFamiliale=$_POST['situationFamiliale'];
        $tel=strval($_POST['telephone']);
        $contrat=strval($_POST['contrat']);
        $contratDurée_mois=intval($_POST['contratDurée_mois']);
        
        $listUpdate=["nom" => $nom,"prenom" => $prenom,"nationalite" => $nationalite,"adresse" => $adresse,"age" => $age,"sexe" => $sexe,"situationFamiliale" => $situationFamiliale,"tel" => $tel,"contrat" => $contrat,"contratDurée_mois" => $contratDurée_mois];
        $sql="UPDATE authentification SET ";
        
        foreach($listUpdate as $key => $val){
            if ($val!=NULL){
                $sql= $sql."$key"."=".'"'."$val".'"'.",";
            }
        }
        $sql=substr($sql,0,-1)." WHERE id=$id;";
     
        echo"$sql";
    }
    else {
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
       $nom=$_POST['nom'];
       $prenom=$_POST['prenom'];
       $nationalite=$_POST['nationalite'];
       $adresse=$_POST['adresse'];
       $age=$_POST['age'];
       $sexe=$_POST['sexe'];
       $situationFamiliale=$_POST['situationFamiliale'];
       $tel=$_POST['telephone'];
       $contrat=$_POST['contrat'];
       $contratDuree_mois=$_POST['contratDurée_mois'];
       $fonction=$_POST["fonction"];

       $sql="INSERT INTO authentification(identifiant,mdp,mail,fonction,congésPayés,congésRTT,nom,prenom,nationalite,adresse,age,sexe,situationFamiliale,tel,contrat,contratDurée_mois) VALUES('$identifiant','$mdp','$mail','$fonction','$congésPayés','$RTT','$nom','$prenom','$nationalite','$adresse','$age','$sexe','$situationFamiliale','$tel','$contrat','$contratDuree_mois')";


    }
    mysqli_query($connect,$sql);
    var_dump($_GET);
    if($_GET['pageprofil']==True){
        $_SESSION['pageprofil']=False;
         
        $_SESSION['nom']=$nom ;
        $_SESSION['prenom']=$prenom; 
        $_SESSION['tel']=$tel ;
        $_SESSION['situationFamiliale']=$situationFamiliale ;
        $_SESSION['nationalite']=$nationalite;
        $_SESSION['adresse']=$adresse ;
        $_SESSION['age']=$age;
    }
 
    header("Location:http://localhost/projetSite_HTML/public_html/gestionSalarié.php");
    
    
}
?>