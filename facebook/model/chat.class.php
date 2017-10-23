<!-- @AUTHOR: LE VEVE Mathieu -->
<!-- @DATE: 2017-10-16 -->
<?php

/** 
 * @Entity
 * @Table(name="fredouil.chat")
 */
class chat{

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
	 *  @OneToOne(targetEntity="post", cascade={"remove", "persist"})
	 *  @JoinColumn(name="post", referencedColumnName="id")
	 */
	public $post;
}

?>
