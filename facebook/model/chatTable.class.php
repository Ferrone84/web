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
		$idLastChat = /* recuperer l'id du dernier chat */
		/* to do:  récupérer le dernier post  grâce aux tag jointures non testées encore */
		//$chats = $chatRepository->findOneBy(array('id' = ...)); 
		// ne retourne qu'un seul résultat
		return $chats;
	}
}

?>
