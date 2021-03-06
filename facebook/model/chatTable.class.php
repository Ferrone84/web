<?php
// Inclusion de la classe chat
require_once "chat.class.php";

class chatTable {

	/**
	* Renvoie tous les chats de la db
	* @author LE VEVE Mathieu
	*
	*
	*/
	public static function getChats(){
		$ch = dbconnection::getInstance()->getEntityManager() ;
		$chatRepository = $ch->getRepository('chat');
		$chats = $chatRepository->findAll();
		return $chats;
	}

	/**
	* Retourne le dernier chat posté
	*@author LE VEVE Mathieu
	*
	*
	*/
	public static function getLastChat(){
		$ch = dbconnection::getInstance()->getEntityManager() ;
		$chatRepository = $ch->getRepository('chat');
		$chat = $chatRepository->findOneBy(array(), array("id" => "DESC")); //sélectionne le premier élément de la table en partant de la fin
		return $chat;
	}

	/**
	* Méthode qui retourne les '$number' derniers chats de la table chat
	*
	* @author Duret Nicolas
	*/
	public static function getXLastChats($number){
		$em = dbconnection::getInstance()->getEntityManager();
		$chatRepository = $em->getRepository('chat');
		$chat = $chatRepository->findBy(
			array(), 
			array("id" => "DESC"),
			$number
		);
		return $chat;
	}

	/**
	* Permet de créer et d'ajouter un chat dans la base
	*
	* @author Duret Nicolas
	*/
	public static function addChat($emetteur, $texte, $image = NULL) {
		$em = dbconnection::getInstance()->getEntityManager();
		
		$post = postTable::addPost($texte, $image);
		$chat = new chat($emetteur, $post);

		$em->persist($chat);
		$em->flush();
	}

	/**
	* Méthode qui retourne les chats plus récent que l'id $id
	*
	* @author Duret Nicolas
	*/
	public static function getRecentChats($id){
		$em = dbconnection::getInstance()->getEntityManager();
		try{
			$qb = $em->createQueryBuilder();

			$chats = $em->createQueryBuilder()
			->select('chat')
			->from('chat', 'chat')
			->where('chat.emetteur IS NOT NULL')
			->andWhere('chat.post IS NOT NULL')
			->where(
			 $qb->expr()->gt('chat.id', $id)
			)
			->orderBy('chat.id', 'ASC')
			->getQuery()->GetResult();
		}
		catch(Exception $e) {
			echo $e->getMessage();
		}

		return $chats;
	}
}

?>
