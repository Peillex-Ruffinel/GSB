<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
switch($action){
	case 'selectionnerMois':{
		$lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
		include("vues/v_listeMois.php");
		break;
	}
        
        case 'selectionnerVisiteur':{
                $lesVisiteurs=$pdo->getVisiteurs();
                include("vues/v_listeVisiteurs.php");
                break;   
        }
        case 'selectionnerMoisVisiteur':{
                $idVisiteur =  $_REQUEST['lstVisiteur'];
                //print_r($idVisiteur);
                $_SESSION['idV']=$idVisiteur;
		$lesMois=$pdo->getLesMoisDisponiblesCL($idVisiteur);
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
                    if(count($lesMois)!=0){
                    $lesCles = array_keys( $lesMois );
                    $moisASelectionner = $lesCles[0];
                    }
                    include("vues/v_listeMois.php");
		break;
        }
        
	case 'voirEtatFrais':{
		$leMois = $_REQUEST['lstMois'];
                if ($_SESSION['statut']=='comptable'){
                    $idVisiteur=$_SESSION['idV'];
                    $_SESSION['mois']=$leMois;
                    $lesMois=$pdo->getLesMoisDisponiblesCL($idVisiteur);
                }else{
                    $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
                }
		$moisASelectionner = $leMois;
		include("vues/v_listeMois.php");
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
		$numAnnee =substr( $leMois,0,4);
		$numMois =substr( $leMois,4,2);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("vues/v_etatFrais.php");
	}
        
        case 'validerFrais':{
                $idVisiteur=$_SESSION['idV'];
                $leMois=$_SESSION['mois'];
                //majEtatFicheFrais($idVisiteur,$leMois,'VA');
        }
}
?>