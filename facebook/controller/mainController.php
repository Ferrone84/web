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
		$context->setLayout("layout");

		return context::SUCCESS;
	}

	/**
	* Action pour connecter l'utilisateur
	* @author Duret Nicolas
	*/
	public static function login ($request, $context)
	{
		//si l'utilisateur est déjà connecté il ne peut pas venir ici
		if($context->getSessionAttribute('user_id') != NULL) 
			$context->redirect("facebook.php");

		$context->setLayout("layoutLogin");

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

				$context->setLayout("layout");
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

	/**
	* Action pour déconnecter l'utilisateur
	* @author Duret Nicolas
	*/
	public static function logout($request,$context){
		session_destroy();
		$context->redirect("facebook.php");
		return context::NONE;
	}


	/**
	* @brief Action pour afficher les messages en fonction de la pagination et du profil utilisateur
	* Gère la pagination
	* Gère l'affichage like / dislike (en fonction des malins qui tapent directement dans la db en rajoutant des valeurs négatives)
	* @author LE VEVE Mathieu
	*/
	public static function showMessage($request, $context) {
		$id = $context->getSessionAttribute('user_id');
		$context->current_user = utilisateurTable::getUserById($id);
		if (!empty($request['id'])) {
			$id = strip_tags($request['id']);
		}

        if(!empty($request['page'])) {
            $context->page = '&page='.htmlspecialchars($request['page']);
        }

		$context->user = utilisateurTable::getUserById($id);
        if ($context->user !== NULL) {
        	$page = 1;
        	if (!empty($request['page'])) {
        		$page = strip_tags($request['page']);
        	}

            if(!empty($request['mess_id'])){
                    messageTable::addLike($request['mess_id']);
            }

			$context->messages = $context->user->messages; 
			if($context->messages[0] != NULL) { 
			//vérifie si l'utilisateur a des messages
				$messages = array();
				for ($i = ($page*5)-5; $i < $page*5; $i++){
					if ($context->messages[$i] === NULL){
						break;
					}
					$messages[$i] = $context->messages[$i];
				}

				$context->messageList=$messages;
				return context::SUCCESS;
			}
			$context->notif = "<span class=\"error\">Cet utilisateur n'a pas de messages.</span>";
			return context::ERROR;
		}

        else {
        	$context->user = $context->current_user;
        	$context->messages =$context->user->messages; //raccourcit
			return context::SUCCESS;
		}
		return context::ERROR;
	}

	/* 
	* Action pour afficher la liste des amis enregistrés.
	* @author LE VEVE Mathieu
	*/
	public static function displayFriendList($request, $context){
		$id = $context->getSessionAttribute('user_id');
		$context->current_user = utilisateurTable::getUserById($id);

		if (!empty($request['id'])) {
			$id = strip_tags($request['id']);
		}

		$context->user = utilisateurTable::getUserById($id);
		if ($context->user !== NULL) {
			$context->avatar = "https://cdn1.iconfinder.com/data/icons/unique-round-blue/93/user-256.png";
			$context->users = utilisateurTable::getUsers();
			return context::SUCCESS;
		}

		else {
			$context->user = $context->current_user;
			$context->avatar = "https://cdn1.iconfinder.com/data/icons/unique-round-blue/93/user-256.png";
			$context->users = utilisateurTable::getUsers();
			return context::SUCCESS;
		}
	}

	/* 
	* Action qui gère la pagination.
	* @author LE VEVE Mathieu
	*/
	public static function pagination($request, $context){

		if (!empty($request['id'])) {
			$id = strip_tags($request['id']);
		}

		 if ($context->user !== NULL){
			$context->count = count($context->messages);
			$pagination = array();

			for ($i = 1; $i <= (int)$context->count/5 ; $i++){
				$pagination[] = $i;
			}

			if ($context->count%5 !== 0){
				$last_index = count($pagination)+1 ;
				$pagination[$last_index] = $last_index;
			}

			$context->pagination=$pagination;
			return context::SUCCESS;
		}
	}

	/* 
	* Action qui envoie un message d'un formulaire a la liste de messages.
	* @author LE VEVE Mathieu
	*/
	public static function sendMessage($request, $context){
		$id = $context->getSessionAttribute('user_id');
		$context->current_user = utilisateurTable::getUserById($id);

		if (!empty($request['id'])) {
			$id = strip_tags($request['id']);
		}

		$context->user = utilisateurTable::getUserById($id);

		if ($context->user !== NULL) {
			if (!empty($request['send_post'])) {
				$texte = strip_tags($request['send_post']);	

				// l'image sera ajoutée dans la base plus tard
				if(!empty($request['file'])) {
					$image = strip_tags($request['file']);
				}

				$emetteur = $context->getSessionAttribute('user_id');
				$emetteur = utilisateurTable::getUserById($emetteur);
				$destinataire = utilisateurTable::getUserById(strip_tags($request['id']));
				messageTable::addMessage($emetteur, $destinataire, $emetteur, $texte, 0);
			}

			if(!empty($request['mess_id_share'])){
				$context->message = messageTable::getMessageById(strip_tags($request['mess_id_share']));
				$emetteur = $context->getSessionAttribute('user_id');
				$emetteur = utilisateurTable::getUserById($emetteur);
				if($context->message->parent!= $emetteur) {
					if($context->message->post !== NULL) {
						//echo($emetteur->id.', '.$parent.', '.$context->message->post->id.', '.'0');
						messageTable::addSharedMessage($emetteur, 
							($context->message->parent != null ? $context->message->parent : $context->message->emetteur),
							$context->message->post,
							0);
					}
				}
            }

            return context::SUCCESS;
		}

		else {
			$context->user = $context->current_user;
			return context::SUCCESS;
		}
	}

	/**
	* Action pour le profil de l'utilisateur
	*
	* @author Duret Nicolas
	*/
	public static function profil($request, $context) {
		$context->setLayout("layoutProfil");

		$id = $context->getSessionAttribute('user_id');
		$context->current_user = utilisateurTable::getUserById($id);
		if (!empty($request['id'])) {
			$id = strip_tags($request['id']);
			$context->user = utilisateurTable::getUserById($id);
			if ($context->user == NULL)
				$context->user = $context->current_user;
		}
		else
			$context->user = $context->current_user;

		//----- variable contenant l'avatar -----
		$context->avatar = "https://cdn1.iconfinder.com/data/icons/unique-round-blue/93/user-256.png";
		if ($context->user->avatar != NULL && substr($context->user->avatar, 0, 5) === "https")
			$context->avatar = $context->user->avatar;

		//----- modifier le statut -----
		if (!empty($request['modif_statut'])) {
			$context->notif = "<span class=\"success\">Vous avez bien modifié votre statut.</span>";
			$context->user->statut = strip_tags($request['modif_statut']);
			utilisateurTable::updateUser($context->user);
		}

		return context::SUCCESS;
	}

	/**
	* Action pour le chat de l'utilisateur
	*
	* @author Duret Nicolas
	*/
	public static function chat($request, $context) {
		$id = $context->getSessionAttribute('user_id');
		$context->user = utilisateurTable::getUserById($id);
		if(!empty($request['id'])) {
			$context->id = '&amp;id='.htmlspecialchars($request['id']);
		}

		if (!empty($request['send_chat'])) {
			$emetteur = $context->user;
			$texte = strip_tags($request['send_chat']);
			chatTable::addChat($emetteur, $texte);
		}
		
		$context->chats = array_reverse(chatTable::getXLastChats(15));

		return context::SUCCESS;
	}
}
