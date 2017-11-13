<?php

/** 
 * @Entity
 * @Table(name="fredouil.post")
 */
class post{

	/** @Id @Column(type="integer")
	 *  @GeneratedValue
	 */ 
	public $id;

	/** @Column(type="string", length=2000) */ 
	public $texte;

	/** @Column(type="datetime", length=4000) */ 
	public $date;

	/** @Column(type="string", length=200) */  
	public $image;

	/**
	* Constructeur de la classe post
	*
	* @author Duret Nicolas
	*/
	public function __construct($texte, $image=NULL) {
		$this->texte = $texte;
		$this->date = new DateTime("now");
		$this->image = $image;
	}
}

?>
