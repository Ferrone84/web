<?php
// Inclusion de la classe message
require_once "message.class.php";

class messageTable {
	public static function getMessagesByDestinataire($id) {
		$em = dbconnection::getInstance()->getEntityManager() ;

		$messageRepository = $em->getRepository('message');
		$messages = $messageRepository->findByDestinataire(array('destinataire' => $id));

		return $messages;
	}
}

?>
