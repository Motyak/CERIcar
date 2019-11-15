<?php
// Inclusion de la classe voyage
require_once "voyage.class.php";

class voyageTable {

  	public static function getVoyagesByTrajet($trajet)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';
		  
		$voyageRepository = $em->getRepository('voyage');
		if($voyageRepository == null)
			return "Erreur : La table 'voyage' n'existe pas";


		$voyages = $voyageRepository->findBy(array('trajet' => $trajet));	
		
		return $voyages;
	}
}
?>
