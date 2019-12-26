<?php

class mainController
{

	// public static function helloWorld($request,$context)
	// {
	// 	$context->mavariable="hello world";
	// 	return context::SUCCESS;
	// }

	public static function index($request,$context)
	{
		if(isset($_SESSION['authUser']))
			$context->authUser=json_decode($_SESSION['authUser']);

		return context::SUCCESS;
	}

	// public static function superTest($request,$context)
	// {

	// 	if(isset($request["param1"]) && isset($request["param2"]))
	// 		$context->mavariable=$request["param1"] . ", " . $request["param2"];
	// 	else
	// 		$context->mavariable="param1" . ", " . "param2";

	// 	return context::SUCCESS;
	// }

	public static function userSignin($request,$context)
	{
		// si la session user est set, faire une redirection vers index
		if(isset($_SESSION['authUser']))
		{
			return context::NONE;
		}

		// si tentative d'inscription
		if(isset($request['firstName']) && isset($request['lastName']) && isset($request['dateOfBirth']) && isset($request['username']) && isset($request['password']))
		{
			if(utilisateurTable::getUserByIdentifiant($request['username']) instanceof utilisateur)
			{
				$context->error = "Ce nom d'utilisateur existe déjà !";
				return context::SUCCESS;
			}

			// creation de l'utilisateur a partir des parametres
			$u = new utilisateur($request['username'],md5($request['password']),$request['lastName'],$request['firstName'],null);

			// on ajoute l'utilisateur, la méthode retourne l'utilisateur si tout s'est bien passé
			$res=utilisateurTable::addUser($u);

			// si erreur connexion bdd
			if(is_string($context->res))
			{
				// message d'erreur
				$context->error=$res;
			}
			else
			{
				//recuperer le user complet, avec id généré par la base de données
				$u=utilisateurTable::getUserByIdentifiant($request['username']);
				//me connecter
				$_SESSION['authUser'] = json_encode($u);
				return context::NONE;
			}
		}
        return context::SUCCESS;
	}

	public static function userLogin($request,$context)
	{
		// si la session user est set, faire une redirection vers index
		if(isset($_SESSION['authUser']))
		{
			return context::NONE;
		}

		// si tentative de connexion
		if(isset($request['login']) && isset($request['pwd']))
		{
			$u=utilisateurTable::getUserByLoginAndPass($request['login'],md5($request['pwd']));
			// $context->user=utilisateurTable::getUserByIdentifiant($request['login']);

			// si aucun utilisateur trouve
			if($u==null)
			{
				$context->error = "Login ou mot de passe incorrect !";
			}

			// si erreur connexion bdd
			else if($u instanceof utilisateur == false)
			{
				// car le message d'erreur est retourne a la place de l'utilisateur
				$context->error=$u;
			}
			
			// si utilisateur trouve
			else
			{
				$_SESSION['authUser'] = json_encode($u);
				return context::NONE;
			}
		}
        return context::SUCCESS;
	}
	
	public static function userLogout($request,$context)
	{
		//suppression variable session authUser + redirection vers index en retournant context none
		unset($_SESSION['authUser']);
		return context::NONE;
    }

	public static function printUserByLoginAndPass($request,$context)
	{
		if(!isset($request["login"]))
		{
			$context->error="Le parametre 'login' n'a pas été renseigné";
			return context::ERROR;
		}	
		if(!isset($request["pass"]))
		{
			$context->error="Le parametre 'pass' n'a pas été renseigné";
			return context::ERROR;
		}

		$context->user=utilisateurTable::getUserByLoginAndPass($request["login"],$request["pass"]);

		if($context->user == null)
			// return context::NONE;
			return context::SUCCESS;
		else if($context->user instanceof utilisateur == false)
		{
			$context->error=$context->user;
			return context::ERROR;
		}
		else
			return context::SUCCESS;
	}

	public static function printUserById($request,$context)
	{
		if(!isset($request["id"]))
		{
			$context->error="Le parametre 'id' n'a pas été renseigné";
			return context::ERROR;
		}

		$context->user=utilisateurTable::getUserById($request["id"]);

		if($context->user == null)
			// return context::NONE;
			return context::SUCCESS;
		else if($context->user instanceof utilisateur == false)
		{
			$context->error=$context->user;
			return context::ERROR;
		}
		else
			return context::SUCCESS;
	}

	public static function printTrajetByDepartArrivee($request,$context)
	{
		if(!isset($request["depart"]))
		{
			$context->error="Le parametre 'depart' n'a pas été renseigné";
			return context::ERROR;
		}	
		if(!isset($request["arrivee"]))
		{
			$context->error="Le parametre 'arrivee' n'a pas été renseigné";
			return context::ERROR;
		}

		$context->trajet=trajetTable::getTrajet($request["depart"],$request["arrivee"]);
		
		if($context->trajet == null)
			// return context::NONE;
			return context::SUCCESS;
		else if($context->trajet instanceof trajet == false)
		{
			$context->error=$context->trajet;
			return context::ERROR;
		}
		else
			return context::SUCCESS;
	}
	
	public static function printVoyagesByTrajet($request,$context)
	{
		if(!isset($request["trajet"]))
		{
			$context->error="Le parametre 'trajet' n'a pas été renseigné";
			return context::ERROR;
		}	

		$context->voyages=voyageTable::getVoyagesByTrajet($request["trajet"]);

		if($context->voyages == null)
			// return context::NONE;
			return context::SUCCESS;
		else if(!is_array($context->voyages))
		{
			$context->error=$context->voyages;
			return context::ERROR;
		}
		else
			return context::SUCCESS;
	}

	public static function printReservationsByVoyage($request,$context)
	{
		if(!isset($request["voyage"]))
		{
			$context->error="Le parametre 'voyage' n'a pas été renseigné";
			return context::ERROR;
		}

		$context->reservations=reservationTable::getReservationsByVoyage($request["voyage"]);

		if($context->reservations == null)
			// return context::NONE;
			return context::SUCCESS;
		else if(!is_array($context->reservations))
		{
			$context->error=$context->reservations;
			return context::ERROR;
		}
		else
			return context::SUCCESS;
	}

	public static function printUserReservations($request,$context)
	{
		// si l'utilisateur n'est pas connecté => redirection index
		if(!isset($_SESSION['authUser']))
			return context::NONE;

		// je lui passe l'utilisateur pour qui je souhaite recuperer les reservations
		$context->reservations=reservationTable::getReservationsByVoyageur(json_decode($_SESSION["authUser"]));

		// si aucune reservation trouvee, on affiche quand meme la page
		if($context->reservations==null)
			return context::SUCCESS;

		if(!is_array($context->reservations))
		{
			$context->error=$context->reservations;
			return context::ERROR;
		}
		
		return context::SUCCESS;
	}
	
	public static function rechercherVoyages($request,$context)
	{
		return context::SUCCESS;
	}
	
	public static function printVoyagesByDepartArrivee($request,$context)
	{
		// si utilisateur authentifié et demande de réservation
		if(isset($_SESSION['authUser']) && isset($request['reservationIdVoyage']))
		{
			// recuperer voyage pour la construction de la reservation
			$v = voyageTable::getVoyageByIdentifiant(intval($request['reservationIdVoyage']));
			// recuperer utilisateur pour la construction de la reservation
			$u = utilisateurTable::getUserByIdentifiant(139);
			// creation de la reservation
			$r = new reservation($v,$u);

			// ajouter reservation dans la table
			reservationTable::addReservation($r);

			// decrementer nombre de place pour le voyage de la reservation concerné
			voyageTable::decrementerNbplace(intval($request['reservationIdVoyage']));
		}
		
		if(!isset($request["villeDepart"]))
		{
			$context->error="Le parametre 'villeDepart' n'a pas été renseigné";
			return context::ERROR;
		}
		if(!isset($request["villeArrivee"]))
		{
			$context->error="Le parametre 'villeArrivee' n'a pas été renseigné";
			return context::ERROR;
		}

		$context->voyages=voyageTable::getVoyagesByTrajet(
			trajetTable::getTrajet($request["villeDepart"],$request["villeArrivee"])
		);

		if($context->voyages == null)
			// return context::NONE;
			return context::SUCCESS;
		else if(!is_array($context->voyages))
		{
			$context->error=$context->voyages;
			return context::ERROR;
		}
		else
			return context::SUCCESS;
	}

}
