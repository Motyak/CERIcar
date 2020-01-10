<?php
// Inclusion de la classe trajet
require_once "trajet.class.php";

class trajetTable {
	public static function getTrajet($depart,$arrivee)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';

		$trajetRepository = $em->getRepository('trajet');
		if($trajetRepository == null)
			return "Erreur : La table 'trajet' n'existe pas";

		$trajet = $trajetRepository->findOneBy(array('depart' => $depart, 'arrivee' => $arrivee));	
		
		return $trajet;
	}
	
	public static function addTrajet($trajet)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		if($em == null){
		return 'Erreur : La connection à la BDD a échouée';}
		
		// ajout du trajet dans la table trajet
		$em->persist($trajet);
		$em->flush();
	}
}
?>
