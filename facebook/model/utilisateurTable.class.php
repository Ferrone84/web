<?php
// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";

class utilisateurTable {

	public static function getUserByLoginAndPass($login,$pass){
		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));

		return $user; 
	}

	/**
	* Renvoie l'utilisateur grâce à son id
	*
	* @author Duret Nicolas
	*/
	public static function getUserById($id){
		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findOneById(array('id' => $id));

		return $user; 
	}

	/**
	* Renvoie tous les utilisateurs de la base
	*
	* @author Duret Nicolas
	*/
	public static function getUsers() {
		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur');
		$users = $userRepository->findAll();

		return $users;
	}
}

?>
