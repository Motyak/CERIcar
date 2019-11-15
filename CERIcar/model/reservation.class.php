<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.reservation")
 */
class reservation{

	/** @Id @Column(type="integer")
	 *  @GeneratedValue
	 */ 
	public $id;

	/** @ManyToOne(targetEntity="voyage",inversedBy="id")
	 * @JoinColumn(name="voyage",referencedColumnName="id")
	 */ 
	public $voyage;
		
	/** @ManyToOne(targetEntity="utilisateur",inversedBy="id")
	 * @JoinColumn(name="voyageur",referencedColumnName="id")
	 */ 
	public $voyageur;

}
