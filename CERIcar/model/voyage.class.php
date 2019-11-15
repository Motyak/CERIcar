<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.voyage")
 */
class voyage{

	/** @Id @Column(type="integer")
	 *  @GeneratedValue
	 */ 
	public $id;

	/** @ManyToOne(targetEntity="utilisateur",inversedBy="id")
	 * @JoinColumn(name="conducteur",referencedColumnName="id")
	 */ 
	public $conducteur;
		
	/** @ManyToOne(targetEntity="trajet",inversedBy="id")
	 * @JoinColumn(name="trajet",referencedColumnName="id")
	 */ 
	public $trajet;

	/** @Column(type="integer") */ 
	public $tarif;
	
	/** @Column(type="integer") */ 
	public $nbplace;
	
	/** @Column(type="integer") */ 
	public $heuredepart;
	
	/** @Column(type="string",length=500) */ 
	public $contraintes;
	

	
}

?>


