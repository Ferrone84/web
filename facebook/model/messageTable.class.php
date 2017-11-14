<?php
// Inclusion de la classe message
require_once "message.class.php";

class messageTable {
	/**
	* Permet de créer et d'ajouter un message dans la base
	*
	* @author LE VEVE Mathieu
	*/
	public static function addMessage($emetteur, $destinataire, $parent, $texte = NULL, $like, $image = NULL) {
		$em = dbconnection::getInstance()->getEntityManager();
		
		$post = postTable::addPost($texte, $image);
		$message = new message($emetteur, $destinataire, $parent, $post, $like);

		$em->persist($message);
		$em->flush();
	}

	public static function addLike($id){
		$em = dbconnection::getInstance()->getEntityManager();
        $messageRepository = $em->getRepository('message');
        $message = $messageRepository->findOneById($id);
        return $message;
	}
}
?>
