<?php

/** 
 * @Entity
 * @Table(name="fredouil.message")
 */
class message{

	/** @Id @Column(type="integer")
	 *  @GeneratedValue
	 */ 
	public $id;

	/** @Column(type="integer") */ 
	public $emetteur;

	/** @Column(type="integer") */ 
	public $destinataire;

	/** @Column(type="integer") */ 
	public $parent;

	/** @Column(type="integer") */ 
	public $post;

	/** @Column(type="integer") */ 
	public $aime;
}

?>
