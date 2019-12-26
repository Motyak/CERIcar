<?php
// Inclusion de la classe reservation
require_once "reservation.class.php";

class reservationTable {
	public static function getReservationsByVoyage($voyage)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';

		$reservationRepository = $em->getRepository('reservation');
		if($reservationRepository == null)
			return "Erreur : La table 'reservation' n'existe pas";

		$reservations = $reservationRepository->findBy(array('voyage' => $voyage));	

		return $reservations;
	}

	public static function getReservationsByVoyageur($voyageur)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';

		$reservationRepository = $em->getRepository('reservation');
		if($reservationRepository == null)
			return "Erreur : La table 'reservation' n'existe pas";

		$reservations = $reservationRepository->findBy(array('voyageur' => $voyageur->id));	

		return $reservations;
	}

	public static function addReservation($reservation)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';

		// ajout de la reservation dans la table reservation
		$em->persist($reservation);
		$em->flush();
	}
}
?>
