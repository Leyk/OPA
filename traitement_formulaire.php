<?php
include "inc/_var_fv.php";


unset($erreur);
/*$posteur_email = preg_replace("/[^a-z].-_@/i",'', strtolower($_POST["posteur_email"]));
if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $posteur_email))
{
  $erreur = true;
  $erreurmsg = "Adresse email invalide.";  
}*/

if (isset($_POST['destinataire']) && isset($_POST['nom']) && isset($_POST['mail']) && isset($_POST['message']) && isset($_POST['id'])){
	$destinataire = $_POST['destinataire'];
	$posteur_nom = $_POST['nom'];
	$posteur_email = $_POST['mail'];
	$posteur_msg = $_POST['message'];
	$idproj = $_POST['id'];
}
else {
	$erreur = "Erreur formulaire";
	echo $erreur;
}

if(!isset($erreur)){
	// récup de l'adresse à laquelle envoyer le mail
	$sql = "SELECT posteur_email FROM actions_initiatives WHERE id=".$idproj ;
	$rs = $connexion->prepare($sql);
	$rs->execute() or die ("Erreur : ".__LINE__." : ".$sql);
	$nb_lignes = $rs->rowCount();
	if($nb_lignes){
		$res = $rs->fetch();
		echo "Success ".$res[0];
	} else{
		echo "Failed";
	}
}
?>