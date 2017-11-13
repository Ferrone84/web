<?php
require_once "post.class.php";

class postTable {
	public static function getPostById($id) {
		$em = dbconnection::getInstance()->getEntityManager() ;

		$postRepository = $em->getRepository('post');
		$post = $postRepository->findOneById(array('id' => $id));

		return $post; 
	}

	/**
	* Permet de créer et d'ajouter un post dans la base
	*
	* @author Duret Nicolas
	*/
	public static function addPost($texte, $image = NULL) {
		$em = dbconnection::getInstance()->getEntityManager();
		$post = new post($texte, $image); //la date est créée dans le constructeur

		$em->persist($post);
		$em->flush();

		return $post;
	}
}

?>
