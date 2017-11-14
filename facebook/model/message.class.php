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

	/**
	 *  @OneToOne(targetEntity="utilisateur", cascade={"remove", "persist"})
	 *  @JoinColumn(name="emetteur", referencedColumnName="id")
	 */ 
	public $emetteur;

	/**
	 *  @OneToOne(targetEntity="utilisateur", cascade={"remove", "persist"})
	 *  @JoinColumn(name="destinataire", referencedColumnName="id")
	 */ 
	public $destinataire;

	/** 
	 *  @OneToOne(targetEntity="utilisateur", cascade={"remove", "persist"})
	 *  @JoinColumn(name="parent", referencedColumnName="id")
	 */ 
	public $parent;

	/** 
	 *  @OneToOne(targetEntity="post", cascade={"remove", "persist"})
	 *  @JoinColumn(name="post", referencedColumnName="id")
	 */ 
	public $post;

	/** @Column(type="integer") */ 
	public $aime;

	public function __construct($emetteur, $destinataire, $parent, $post, $aime) {
		$this->emetteur = $emetteur;
		$this->destinataire = $destinataire;
		$this->parent = $parent;
		$this->post = $post;
		$this->aime = $aime;
	}
}

?>
