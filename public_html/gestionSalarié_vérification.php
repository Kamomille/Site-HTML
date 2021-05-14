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
var_dump($_POST);
if (!preg_match("#^([0-9]){5}$#",$_POST['codePostal'])){
    $erreur=$erreur."&codePostale=erreur";
    $check=true;
    
}


if (preg_match("#^0[1-9][0-9]{5}$#",$_POST['telephone'] )){
    
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
        $nationalite=strval($_POST['nationalite']) ;
        $adresse=$_POST['codePostal'].",".$_POST['Ville'].",".$_POST['Rue'];
        $age=$_POST['age'];
        $sexe=$_POST['sexe'];
        $situationFamiliale=$_POST['situationFamiliale'] ;
        $tel=strval($_POST['telephone']);
        $contrat=strval($_POST['contrat']);
        $contratDuree_mois=intval($_POST['contratDuree_mois']);
        
        $req="UPDATE authentification SET nom=?,prenom=?,nationalite=?,adresse=?,age=?,sexe=?,situationFamiliale=?,tel=?,contrat=?,contratDuree_mois=?  WHERE id=?;";
        $res= mysqli_prepare($connect, $req);
        $var= mysqli_stmt_bind_param($res,'ssssissssii',$nom,$prenom,$nationalite,$adresse,$age,$sexe,$situationFamiliale,$tel,$contrat,$contratDuree_mois,$id);
        $var= mysqli_execute($res);
        mysqli_stmt_close($res);       
        
    }
    else {
        $identifiant=$_POST["nom"].".".$_POST["prenom"]."@esme.com";;
        $mdp=strtoupper($_POST["nom"])."_".strtolower($_POST["prenom"]).strval(random_int(1000000,99999999));

        if(($_POST["contrat"]=="CDD" &&$_POST["contratDuree_mois"]>3) || $_POST["contrat"]!="CDD"){
           if($_POST["fonction"]=="enseignant"){
               $RTT=10;
               $congesPayes=24;
            }
           else {
               $RTT=5;
               $congesPayes=24;             
            }
        }
        elseif ($_POST["contrat"]=="CDD" && $_POST["contratDuree_mois"]<=3) {
               $RTT=0;
               $congesPayes=0;      
       }
       $nom=$_POST['nom'];
       $prenom=$_POST['prenom'];
       $nationalite=$_POST['nationalite'];
       $adresse=$_POST['codePostal'].",".$_POST['Ville'].",".$_POST['Rue'];
       $age=$_POST['age'];
       $sexe=$_POST['sexe'];
       $situationFamiliale=$_POST['situationFamiliale'];
       $tel=$_POST['telephone'];
       $contrat=$_POST['contrat'];
       $contratDuree_mois=$_POST['contratDuree_mois'];


       $req="INSERT INTO authentification(identifiant,mdp,fonction,congesPayes,congesRTT,nom,prenom,nationalite,adresse,age,sexe,situationFamiliale,tel,contrat,contratDuree_mois) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
       $res= mysqli_prepare($connect ,$req);
       $var= mysqli_stmt_bind_param($res,'sssiissssissssi',$identifiant,$mdp,$fonction,intval($congesPayes),intval($RTT),$nom,$prenom,$nationalite,$adresse,intval($age),$sexe,$situationFamiliale,$tel,$contrat,intval($contratDuree_mois));
       $var= mysqli_execute($res);
       mysqli_stmt_close($res);
    }

    mysqli_close($connect);
    header("Location:http://localhost/projetSite_HTML/public_html/gestionSalarié.php");
    
    
}
?>