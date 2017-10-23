<?php
// Inclusion de la classe post
require_once "post.class.php";

class postTable {
	public static function getPostById($id) {
		$em = dbconnection::getInstance()->getEntityManager() ;

		$postRepository = $em->getRepository('post');
		$post = $postRepository->findOneById(array('id' => $id));

		return $post; 
	}
}

?>
