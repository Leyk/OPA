<?php
include "inc/_var_fv.php";

$posteur_name = $_POST['posteur_nom'];
$posteur_prenom = $_POST['posteur_prenom'];
$posteur_msg = $_POST['posteur_message'];

$posteur_email = preg_replace("/[^a-z].-_@/i",'', strtolower($_POST["posteur_email"]));
if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $posteur_email))
{
  $erreur = true;
  $erreurmsg = "Adresse email invalide.";  
}


?>