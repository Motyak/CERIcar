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

	public static function getVoyageByIdentifiant($identifiant)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';
		  
		$voyageRepository = $em->getRepository('voyage');
		if($voyageRepository == null)
			return "Erreur : La table 'voyage' n'existe pas";


		$voyage = $voyageRepository->findOneBy(array('id' => $identifiant));	
		
		return $voyage;
	}

	public static function decrementerNbPlace($voyageId)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';
		  
		$voyageRepository = $em->getRepository('voyage');
		if($voyageRepository == null)
			return "Erreur : La table 'voyage' n'existe pas";

		// on fetch le voyage a modifier
		$v = $voyageRepository->findOneBy(array('id' => $voyageId));
		
		// on decremente l'attribut si nbplace > 0
		if($v->nbplace>0)
			$v->nbplace--;
		
		//on flush pour mettre à jour la bdd (l'entité est déjà managed par Doctrine car je l'ai fetch)
		$em->flush();
	}
}
?>
