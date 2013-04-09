<?php

switch ($_GET['type'])
{
	case "pdf":
		$rep = "/var/www/voeux/";
		break;
	case "carte":
		$rep = "/var/www/voeux/img/cartes/";
}

$nom = $_GET['nom'];

$chemin = $rep.$nom; 
header('Pragma: public');   
header('Expires: 0');   
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header("Content-Type: application/octet-stream");
header('Content-Disposition: attachment; filename="'.$nom.'"');
header('Content-Transfer-Encoding: binary');
readfile($chemin);
die();