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

	/** @Column(type="integer") */ 
	public $emetteur;

	/** @Column(type="integer") *
	* @OneToMany(targetEntity="chat", mappedBy="post")
	* @JoinColumn(name="post", referencedColumnName="id")
	*/
	public $post;
}

?>
