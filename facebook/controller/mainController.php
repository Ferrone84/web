<?php
/*
 * All doc on :
 * Toutes les actions disponibles dans l'application 
 *
 */

class mainController
{
	public static function helloWorld($request,$context)
	{
		$context->mavariable="hello world";
		return context::SUCCESS;
	}

	public static function index($request,$context)
	{
		return context::SUCCESS;
	}

	public static function login ($request, $context)
	{
		//si l'utilisateur est déjà connecté il ne peut pas venir ici
		if($context->getSessionAttribute('user_id') != NULL) 
			$context->redirect("facebook.php");

		//si le formulaire est envoyé
		if(isset($request['formConnec'])){
			if(!empty($request['login']) && !empty($request['mdp'])) { //si les informations ne sont pas vides
				$context->login = strip_tags($request['login']);
				$context->mdp = strip_tags($request['mdp']);
				$context->membre = utilisateurTable::getUserByLoginAndPass($context->login,$context->mdp);
				//si les infos sont correctes => on le connecte
				if($context->membre != NULL) {
					$context->setSessionAttribute('user_id', $context->membre->id);
					$context->notif = "<span class=\"success\">Bonjour ".htmlspecialchars($context->membre->prenom).", ".htmlspecialchars($context->membre->nom).". Votre connection s'est bien passée.</span>";
				}
				else {
					$context->notif = "<span class=\"error\">Votre login et votre mot de passe ne concorde pas.</span>";
					return context::ERROR;
				}

				return context::SUCCESS;
			}
			else {
				$context->notif = "<span class=\"error\">Veuillez remplir tous les champs.</span>";
				return context::ERROR;
			}
		}
		else
			return context::ERROR;
	}

	public static function logout($request,$context){
		session_destroy();
		$context->redirect("facebook.php");
		return context::NONE;
	}


	// la partie en commentaires permet de tester getChats(). Penser a mettre la partie non commentée en commentaires. @LE VEVE Mathieu
	// la partie non commentée teste getUsers et getMessages @DURET Nicolas
	public static function showMessage($request, $context) {	
		//$context->chats = chatTable::getChats();	
		//$context->lastChat = chatTable::getLastChat();	

		if (!empty($request['id'])) {
			$id = strip_tags($request['id']);
			if (utilisateurTable::getUserById($id) !== NULL) {
				$context->messages = messageTable::getMessages($id);
				//var_dump($context->messages);
				return context::SUCCESS;
			}
			else {
				$context->notif = "<span class=\"error\">Veuillez saisir un id valide.</span>";
				return context::ERROR;
			}
		}
		$context->notif = "<span class=\"error\">Veuillez saisir un id.</span>";
		return context::ERROR;
		//return context::SUCCESS;
	}
}
