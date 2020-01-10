<?php

// Inclusion de la classe voyage
require_once "voyage.class.php";
class voyageTable
{

    public static function getVoyagesByTrajet($trajet){
        $con = dbconnection::getInstance()->getEntityManager();
            $voyageRepository = $con->getRepository('voyage');
            $Listvoyages  = $voyageRepository->findBy(array('trajet' => $trajet));

            return $Listvoyages;
}

public static function addVoyage($voyage)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';
		// ajout du voyage 
		$em->persist($voyage);
		$em->flush();
	}
}