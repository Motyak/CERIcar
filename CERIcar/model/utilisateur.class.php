<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.utilisateur")
 */
class utilisateur{

	/** @Id @Column(type="integer")
	 *  @GeneratedValue
	 */ 
	public $id;

	/** @Column(type="string", length=45) */ 
	public $identifiant;
		
	/** @Column(type="string", length=45) */ 
	public $pass;

	/** @Column(type="string", length=45) */ 
	public $nom;

	/** @Column(type="string", length=45) */ 
	public $prenom;

	/** @Column(type="string", length=200) */ 
	public $avatar;

	function __construct($identifiant,$pass,$nom,$prenom,$avatar)
	{
		$this->identifiant=$identifiant;
		$this->pass=$pass;
		$this->nom=$nom;
		$this->prenom=$prenom;
		$this->avatar=$avatar;
	}
}
?>
