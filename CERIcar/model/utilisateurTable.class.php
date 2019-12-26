<?php
// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";

class utilisateurTable {

  	public static function getUserByLoginAndPass($login,$pass)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';

		$userRepository = $em->getRepository('utilisateur');
		if($userRepository == null)
			return "Erreur : La table 'utilisateur' n'existe pas";

		// $user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));
		$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => $pass));	

		return $user; 
	}

	public static function getUserById($id)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';

		$userRepository = $em->getRepository('utilisateur');
		if($userRepository == null)
			return "Erreur : La table 'utilisateur' n'existe pas";

		// $user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));
		$user = $userRepository->findOneBy(array('id' => $id));	

		return $user; 
	}

	public static function getUserByIdentifiant($identifiant)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';

		$userRepository = $em->getRepository('utilisateur');
		if($userRepository == null)
			return "Erreur : La table 'utilisateur' n'existe pas";

		$user = $userRepository->findOneBy(array('id' => $identifiant));

		return $user; 
	}

	public static function addUser($user)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		if($em == null)
			return 'Erreur : La connection à la BDD a échouée';

		// ajout de l'utilisateur dans la table utilisateur
		$em->persist($user);
		$em->flush();
	}
}
?>
