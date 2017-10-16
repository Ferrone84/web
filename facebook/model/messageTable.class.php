<?php
// Inclusion de la classe message
require_once "message.class.php";

class messageTable {
	public static function getMessages($id) {
		$em = dbconnection::getInstance()->getEntityManager() ;

		$messageRepository = $em->getRepository('message');
		$messages = $messageRepository->findByParent(array('parent' => $id));

		return $messages; 
	}

	
}

?>
