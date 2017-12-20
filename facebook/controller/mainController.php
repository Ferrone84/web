<?php
/*
 * All doc on :
 *	Toutes les actions disponibles dans l'application 
 *	
 *	headband
 *	index
 *	login
 *	logout
 *	showMessage
 *	displayFriendList
 *	pagination
 *	sendMessage
 *	profil
 *	chat
 *
 */

class mainController
{
	
	/**
	* Action qui affiche le bandeau 
	* @author Duret Nicolas
	*/
	public static function headband($request, $context) {
		$id = $context->getSessionAttribute('user_id');
		$context->user_ = utilisateurTable::getUserById($id);
		if (!empty($request['id'])) {
			$id = strip_tags($request['id']);
		}
		$context->avatar_ = "https://cdn1.iconfinder.com/data/icons/unique-round-blue/93/user-256.png";
		if ($context->user_->avatar != NULL) {
			if (@fopen($context->user_->avatar, "r")) {
				$context->avatar_ = $context->user_->avatar;
			}
		}

		return context::SUCCESS;
	}

	/**
	* Action qui affiche l'index du site avec une liste de messages aléatoires
	* @author Duret Nicolas
	*/
	public static function index($request,$context)
	{
		$context->setLayout("layout");

		$number = 5;
		if (!empty($request['number']) && $request['number'] >= 0)
			$number = strip_tags($request['number']);

		$context->messages = messageTable::getRandMessages($number);
		$context->number = $number;

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
            /* Cette partie gère le like */
            if(!empty($request['mess_id'])){
                    messageTable::addLike($request['mess_id']);
            }
            
            /* Cette partie gère le partage */
            if(!empty($request['mess_id_share'])){
				$context->message = messageTable::getMessageById(strip_tags($request['mess_id_share']));
				$emetteur = $context->getSessionAttribute('user_id');
				$emetteur = utilisateurTable::getUserById($emetteur);
				if($context->message->parent!= $emetteur) {
					if($context->message->post !== NULL) {
						messageTable::addSharedMessage($emetteur, 
							($context->message->parent != null ? $context->message->parent : $context->message->emetteur),
							$context->message->post,
							0);
					}
				}
            }

            /* Cette partie gère l'envoi de message */
            $emetteur_message = $context->getSessionAttribute('user_id');
            $emetteur_message = utilisateurTable::getUserById($emetteur_message);
            $destinataire_message = utilisateurTable::getUserById($id);
            if (!empty($request['send_post'])) {
                $texte = strip_tags($request['send_post']);
                if(!empty($request['file'])) {
                    if (strlen($request['file']) <= 200) {
                        $image = strip_tags($request['file']);
                        messageTable::addMessage($emetteur_message, $destinataire_message, $emetteur_message, 0, $texte, $image);
                    }
                }
                else messageTable::addMessage($emetteur_message, $destinataire_message, $emetteur_message, 0, $texte);
            }

            else {
                if (!empty($request['file'])) {
                    $image = strip_tags($request['file']);
                    messageTable::addMessage($emetteur_message, $destinataire_message, $emetteur_message, 0, "", $image);
                }
            }

            /* Cette partie gère l'affichage des messages */
            $context->messages = $context->user->messages;
            $page = 1;
        	$context->count = count($context->messages);
			$max_pagination = (int)($context->count/5);
			if ($context->count%5 !== 0) {
				$max_pagination = $max_pagination+1;
			}
			// echo($max_pagination);
        	if (!empty($request['page']) && $request['page'] > 0 && $request['page'] <= $max_pagination) {
        		$page = strip_tags($request['page']);
        	}
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

	/**
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

	/**
	* Action qui gère la pagination.
	* @author LE VEVE Mathieu
	*/
	public static function pagination($request, $context) {

		$page = 1;
		$context->count = count($context->messages);
		$max_pagination = (int)($context->count/5);
		if ($context->count%5 !== 0) {
			$max_pagination = $max_pagination+1;
		}

		if (!empty($request['page']) && $request['page'] > 0 && $request['page'] <= $max_pagination) {
			$page = strip_tags($request['page']);
		}
		$context->page = $page;

		if ($context->user !== NULL) {
			
			$pagination = array();
			for ($i = $page-5; $i <= $page+5 && $i <= $max_pagination; $i++) {
			    if ($i < 1) $i = 1 ;
				$pagination[] = $i;
			}

			$context->max_pagination = $max_pagination;
			$context->pagination=$pagination;
		}
		return context::SUCCESS;
	}

	/**
	* Action qui envoie un message d'un formulaire a la liste de messages.
	* @author LE VEVE Mathieu
	*/
	public static function sendMessage($request, $context){
		return context::SUCCESS;
	}

	/**
	* Action qui affiche le profil de l'utilisateur
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

		//----- modifier le statut -----
		if (!empty($request['modif_statut'])) {
			$context->notif = "<span class=\"success\">Vous avez bien modifié votre statut.</span>";
			$context->user->statut = strip_tags($request['modif_statut']);
			utilisateurTable::updateUser($context->user);
		}

		//----- modifier l'avatar -----
		if (!empty($request['modif_avatar'])) {
			$file = @fopen(strip_tags($request['modif_avatar']), "r");
			if ($file) {
				$context->notif = "<span class=\"success\">Vous avez bien modifié votre avatar.</span>";
				$context->user->avatar = strip_tags($request['modif_avatar']);
				utilisateurTable::updateUser($context->user);
			}
			else
				$context->notif = "<span class=\"error\">Vous devez mettre un lien vers une image.</span>";
		}

		//----- variable contenant l'avatar -----
		$context->avatar = "https://cdn1.iconfinder.com/data/icons/unique-round-blue/93/user-256.png";
		if ($context->user->avatar != NULL) {
			if (@fopen($context->user->avatar, "r")) {
				$context->avatar = $context->user->avatar;
			}
		}

		return context::SUCCESS;
	}

	/**
	* Action pour afficher le chat de l'utilisateur
	*
	* @author Duret Nicolas
	*/
	public static function chat($request, $context) {
		$id = $context->getSessionAttribute('user_id');
		$context->user = utilisateurTable::getUserById($id);

		if (!empty($request['id'])) {
			$context->id = '&amp;id='.htmlspecialchars($request['id']);
		}
		
		if (!empty($request['page'])) {
			$context->id = $context->id.'&amp;page='.htmlspecialchars($request['page']);
		}

		if (!empty($request['send_chat'])) {
			$emetteur = $context->user;
			$texte = strip_tags($request['send_chat']);
			chatTable::addChat($emetteur, $texte);
		}
		
		//si on est dans le cas où l'ajax demande s'il y a de nouveaux messages
		if (!empty($request['refresh']))
			$chats = chatTable::getRecentChats($request['refresh']);
		//sinon on get les 15 derniers messages normalement
		else
			$chats = array_reverse(chatTable::getXLastChats(15));

		$context->chats = $chats;
		$context->lastChatId = @end($chats)->id;

		return context::SUCCESS;
	}
}
