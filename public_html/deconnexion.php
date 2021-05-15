<?php

session_destroy ( );

if (isset($_COOKIE['id'])){
    setcookie("id",$_SESSION['id'],time()+3600*24*2);
    unset($_COOKIE['id']);
}
if (isset($_COOKIE['madp'])){
    setcookie("mdp",$mdp,time()+3600*24*2);
    unset($_COOKIE['mdp']);
}
if (isset($_COOKIE['identifiant'])){
    setcookie("identifiant",$_SESSION['identifiant'],time()+3600*24*2);
    unset($_COOKIE['identifiant']);
}
if (isset($_COOKIE['role'])){
    setcookie("role",$_SESSION['role'],time()+3600*24*2);
    unset($_COOKIE['role']);
}
header("Location:http://localhost/projetSite_HTML/public_html/index.html");



?>