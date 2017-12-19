<?php
// Inclusion de la classe message
require_once "message.class.php";

class messageTable {
	/**
	* @brief Permet de créer et d'ajouter un message dans la base
	*
	* @author LE VEVE Mathieu
	*/
	public static function addMessage($emetteur, $destinataire, $parent, $like, $texte, $image = NULL) {
		$em = dbconnection::getInstance()->getEntityManager();
		
		$post = postTable::addPost($texte, $image);
		$message = new message($emetteur, $destinataire, $parent, $post, $like);

		$em->persist($message);
		$em->flush();
	}

	public static function addSharedMessage($emetteur, $parent, $post, $like) {
		$em = dbconnection::getInstance()->getEntityManager();

		//$post = postTable::getPostById($post_id);
		$message = new message($emetteur, $emetteur, $parent, $post, $like);
		$em->persist($message);
		$em->flush();
	}


	/**
	* @brief Permet de rajouter un like dans la table
	*
	* @author LE VEVE Mathieu
	*/
	public static function addLike($id){
		$em = dbconnection::getInstance()->getEntityManager();
		$messageRepository = $em->getRepository('message');
		$message = $messageRepository->findOneById($id);
		$message->aime += 1;
		$em->flush($message);
	}

	/**
	* @brief Permet de rajouter un dislike dans la table
	*
	* @author LE VEVE Mathieu
	*/
	public static function addDislike($id){
		$em = dbconnection::getInstance()->getEntityManager();
		$messageRepository = $em->getRepository('message');
		$message = $messageRepository->findOneById($id);
		$message->aime -= 1;
		$em->flush($message);
	}

	/**
	* @brief Permet de récupérer un message par son id
	*
	* @author LE VEVE Mathieu
	*/
	public static function getMessageById($id){
		$em = dbconnection::getInstance()->getEntityManager() ;
		$messageRepository = $em->getRepository('message');
		$message = $messageRepository->findOneById($id);
		return $message; 
	}

	/**
	* @brief Permet de récupérer tous les messages (pour le moment je n'en prends que 30, on fixera une autre valeur plus tard)
	*
	* @author LE VEVE Mathieu
	*/
	public static function getMessages(){
		$em = dbconnection::getInstance()->getEntityManager() ;
		$messageRepository = $em->getRepository('message');
		$messages = $messageRepository->findBy(
			array(),
			array(),
			30
		);
		return $messages; 
	}

	/**
	* Renvoie tous les messages de la base, ordonnés par id
	*
	* @author Duret Nicolas
	*/
	public static function getAllMessages() {
		$em = dbconnection::getInstance()->getEntityManager() ;
		$messageRepository = $em->getRepository('message');
		$messages = $messageRepository->findBy(
			array(),
			array('id' => 'ASC')
		);
		
		return $messages;
	}

	/**
	* Renvoie un nombre $nombre de messages aléatoire
	*
	* @author Duret Nicolas
	*/
	public static function getRandMessages($nombre) {
		$em = dbconnection::getInstance()->getEntityManager() ;
		$messageRepository = $em->getRepository('message');
		$all_message = messageTable::getAllMessages();

		$messages_ids = array();
		foreach ($all_message as $message) {
			array_push($messages_ids, (int)$message->id);
		}

		shuffle($messages_ids);
		$messages_id = array_slice($messages_ids, 0, $nombre);

		$messages = array();
		foreach ($messages_id as $id) {
			$message =  messageTable::getMessageById($id);
			if ($message != NULL) //au cas où
				array_push($messages, $message);
		}

		return (object)$messages;
	}
}
?>
