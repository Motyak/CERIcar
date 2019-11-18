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
	
	public static function rechercherVoyages($request,$context)
	{
		return context::SUCCESS;
	}
	
	public static function printVoyagesByDepartArrivee($request,$context)
	{
		if(!isset($request["villeDepart"]))
		{
			$context->error="Le parametre 'villeDepart' n'a pas été renseigné";
			return context::ERROR;
		}
		if(!isset($request["villeArrivee"]))
		{
			$context->error="Le parametre 'villeArrive' n'a pas été renseigné";
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
