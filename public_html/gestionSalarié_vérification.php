<?php
session_start();
include 'database.php';


$CV="";
if(isset($_FILES['CV'])){
    $file_name = $_FILES['CV']['name'];
    $file_tmp = $_FILES['CV']['tmp_name'];
    $path = "CV/".$file_name;
    move_uploaded_file($file_tmp,$path);
    $CV=$path;
}

$erreur="";
$check=false;
$page=false;
$id=0;
foreach ( $_POST as $key => $val)
    if ($val=="Envoyer"){
        $id=$key;
    }

if (strlen($_POST['nom'])<2){
    $erreur=$erreur."&nom=erreur";
    $check=true;
}

if (isset($_POST['mdp'])){
    $page=true;
    $mdp=$_POST['mdp'];
    if(!preg_match("#^[A-Z]([a-z A-Z 0-9 _ -]){6,}[0-9]$#",$_POST['mdp'])){
    $erreur=$erreur."&mdp=erreur";
    $check=true;   
    }
    
    if (!preg_match("#[A-Z a-z 0-9 _ - .]{2,}[@esme.fr]$#",$_POST['identifiant'] )){
        
        $erreur=$erreur."&email=erreur";
        $check=true;    
    }

    
}



if (strlen($_POST['prenom'])<2){
    $erreur=$erreur."&prenom=erreur";
    $check=true;
    
}
if (!preg_match("#^([0-9]){5}$#",$_POST['codePostal'])){
    $erreur=$erreur."&codePostale=erreur";
    $check=true;
    
}


if (!preg_match("#^0[1-9][0-9]{6}$#",$_POST['telephone'] )){
    
    $erreur=$erreur."&tel=erreur";
    $check=true;    
}


if ($check){
    if($page){
        header("Location:http://localhost/projetSite_HTML/public_html/gestionProfil_formulaire.php?id=$id"."$erreur");
    }
    else {
        if($id==0){
            header("Location:http://localhost/projetSite_HTML/public_html/gestionSalarié_ajouter.php?id=$id"."$erreur");
        }
        else {
            header("Location:http://localhost/projetSite_HTML/public_html/gestionSalarié_modifier.php?id=$id"."$erreur");
        }
    }
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
        $identifiant=strval($_POST['identifiant']);
        $contratDuree_mois=intval($_POST['contratDuree_mois']);
        
        if(isset($mdp))
        {
        $_SESSION['mdp']=$mdp;
        var_dump($mdp);
        $req="UPDATE authentification SET identifiant=?,nom=?,prenom=?,nationalite=?,adresse=?,age=?,sexe=?,situationFamiliale=?,tel=?,contrat=?,contratDuree_mois=?,mdp=?, CV=?  WHERE id=?;";
        $res= mysqli_prepare($connect, $req);
        $var= mysqli_stmt_bind_param($res,'sssssissssissi',$identifiant,$nom,$prenom,$nationalite,$adresse,$age,$sexe,$situationFamiliale,$tel,$contrat,$contratDuree_mois,$mdp,$CV,$id);
        $var= mysqli_execute($res);
        mysqli_stmt_close($res);       
        }
        else {
        $req="UPDATE authentification SET identifiant=?,nom=?,prenom=?,nationalite=?,adresse=?,age=?,sexe=?,situationFamiliale=?,tel=?,contrat=?,contratDuree_mois=?,CV=?  WHERE id=?;";
        $res= mysqli_prepare($connect, $req);
        $var= mysqli_stmt_bind_param($res,'sssssissssisi',$identifiant,$nom,$prenom,$nationalite,$adresse,$age,$sexe,$situationFamiliale,$tel,$contrat,$contratDuree_mois,$CV,$id);
        $var= mysqli_execute($res);
        mysqli_stmt_close($res);                
        }
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
       $fonction=$_POST['fonction'];
       $contrat=$_POST['contrat'];
       if($_POST["contrat"]=="CDD"){
           $contratDuree_mois=$_POST['contratDuree_mois'];
       }
        else {
           $contratDuree_mois=null;
        }
       
       $req="INSERT INTO authentification(identifiant,mdp,fonction,congesPayes,congesRTT,nom,prenom,nationalite,adresse,age,sexe,situationFamiliale,tel,contrat,contratDuree_mois,CV) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
       $res= mysqli_prepare($connect ,$req);
       $var= mysqli_stmt_bind_param($res,'sssiissssissssis',$identifiant,$mdp,$fonction,intval($congesPayes),intval($RTT),$nom,$prenom,$nationalite,$adresse,intval($age),$sexe,$situationFamiliale,$tel,$contrat,intval($contratDuree_mois),$CV);
       $var= mysqli_execute($res);
       mysqli_stmt_close($res);
    }
    mysqli_close($connect);
    
    if($page){
        header("Location:http://localhost/projetSite_HTML/public_html/gestionProfil.php");
    }
    else{
        header("Location:http://localhost/projetSite_HTML/public_html/gestionSalarié.php");
    }
    
    
    
}
?>