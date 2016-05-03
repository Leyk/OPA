<?php
include "inc/_var_fv.php";


unset($erreur);
/*$posteur_email = preg_replace("/[^a-z].-_@/i",'', strtolower($_POST["posteur_email"]));
if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $posteur_email))
{
  $erreur = true;
  $erreurmsg = "Adresse email invalide.";  
}*/


/*if (isset($_POST['email']) && isset($_POST['contenu']) && isset($_POST['idproj'])){
	$posteur_email = $_POST['email'];
	$posteur_msg = $_POST['contenu'];
	$idproj = $_POST['idproj'];
}
else {
	$erreur = "Erreur formulaire";
}

if(!isset($erreur)){
	// récup de l'adresse à laquelle envoyer le mail
	$sql = "SELECT posteur_email FROM actions_initiatives WHERE id=".$idproj ;
	$rs = $connexion->prepare($sql);
	$rs->execute() or die ("Erreur : ".__LINE__." : ".$sql);
	$nb_lignes = $rs->rowCount();
	if($nb_lignes){
		echo "Success";
	} else{
		echo "Failed";
	}
}*/

if(true){
	echo "Success";
} else {
	echo "Failed";
}

?>