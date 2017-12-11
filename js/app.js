/**
* Fichier contenant tout le js executé dans l'application
*
* @author Duret Nicolas
* @author LE VEVE Mathieu
*/
$(document).ready(function(){
	//------ Partie Initialisation ------

	//si le chat est sur la vue courrante
	if ($("#chat").length) {
		var chat_twinkle;
		initChat();
		refreshChat();
	}

	//si on clique sur la zone de notification ça la vide
	$("#notif").on('click', function() {
		$("#notif").empty();
	});


	//------ Partie Ajax ------

	//si on click sur le lien de déconnection
	$("#logout").on('click', function(event){
		event.preventDefault(); //évite le comportement par défault du lien
		logout();
	});

	//si on valide le formulaire d'envoie de statut
	$("#form_statut").submit(function(event){
		event.preventDefault(); //évite le comportement par défault du bouton
		if ($("#texte_statut").val().length === 0) {
			$("#notif").html("<span class=\"error\">Vous ne pouvez pas envoyer de statut vide.</span>");
			$("#statut_submit").blur(); //enlève le focus du bouton
			return;
		}
		var form = this;
		updateStatut(form);
	});

	//si on valide le formulaire d'envoie d'avatar
	$("#form_avatar").submit(function(event){
		event.preventDefault(); //évite le comportement par défault du bouton
		if ($("#texte_avatar").val().length === 0) {
			$("#notif").html("<span class=\"error\">Vous ne pouvez pas envoyer d'avatar vide.</span>");
			$("#avatar_submit").blur(); //enlève le focus du bouton
			return;
		}
		var form = this;
		updateAvatar(form);
	});

	//si on valide le formulaire d'envoie de chat
	$("#chat_form").submit(function(event){
		event.preventDefault(); //évite le comportement par défault du bouton
		if ($("#texte_chat").val().length === 0) {
			$("#notif").html("<span class=\"error\">Vous ne pouvez pas envoyer de chat vide.</span>");
			$("#chat_submit").blur(); //enlève le focus du bouton
			return;
		}
		var form = this;
		sendChat(form);
	});

	/*
	* @author LE VEVE Mathieu
	* @brief si on appuie sur le bouton like
	*
	*
	*/
	$(".like_form").submit(function(event){
		event.preventDefault(); //évite le comportement par défault du bouton
		var form = this;
		id = $(this).find(".hidden-id").val();
		likeUpdating(form,id);
	});

	/*
	* @author LE VEVE Mathieu
	* @brief si on appuie sur le bouton partager
	*
	*/
	$(".share-form").submit(function(event){
		event.preventDefault(); //évite le comportement par défault du bouton
		var form = this;
		shareUpdating(form);
	});

});


//------ Toutes les fonctions utilisées dans l'application ------
function initChat() {
	$("#chats").scrollTop($("#chats").prop('scrollHeight'));

	$("#chat").resizable({ minWidth: 260, minHeight: 230, handles: 'n, e, s, w, nw, ne, sw, se' });
	$("#chat").draggable({ cursor: "move", handle: "#chat_toolbar" });

	//------ Gère le chat ------
	$("#reduce").on('click', function() {
		saveWidth = $("#chat").width()+2;
		saveHeight = $("#chat").height()+2;
		$("#chats").css('display', 'none');
		$("#chat_form").css('display', 'none');
		$(this).hide();
		$("#maximize").show();
		$("#chat").css('width', '260');
		$("#chat").css('height', '24');
		$("#chat").resizable('disable');
	});

	$("#maximize").on('click', function() {
		$("#chats").css('display', 'block');
		$("#chat_form").css('display', 'block');
		$(this).hide();
		$("#reduce").show();
		$("#chat").css('width', saveWidth);
		$("#chat").css('height', saveHeight);
		$("#chat").resizable('enable');
	});

	$("#chats").on('click', function() {
		stopChatTwinkle();
	});
}

function refreshChat() {
	lastChatId = $("#last_id").val();
	url = 'facebookAjax.php?action=chat&refresh='+lastChatId;

	$.ajax({
		type: "POST", //type de la requette ajax
		url: url, //page sur laquelle on effectue la requette
		cache: false,
		contentType: false,
		processData: false,
		success: function(data)	{
			new_id = $(data).find("#last_id").val();
			if (new_id != "") {
				retour_view = $(data).find('#chats').html(); //récuppère tout ce qui est contenu dans la div avec l'id chats
				$("#chats").append(retour_view);
				$("#nb_notif").val( +$("#nb_notif").val() + 1 ); //on incrémente la valeur du nombre de notifcations
				numberOfNotifcations = $("#nb_notif").val();
				$("#chat_toolbar_texte").empty().append("("+numberOfNotifcations+") Chat"); //on les affiches pour que l'utilisateur puisse voir combien de chats il a raté
				chatTwinkle(); //on fait clignoter le chat
				$("#last_id").val(new_id);
			}
		},
		error: function() {}
	});

	setTimeout(refreshChat, 10000); //rappel cette fonction toutes les 10 secondes
}

function chatTwinkle() {
	$("#chat_toolbar").css('background-color', 'red');
	chat_twinkle = setTimeout(function() {
		$("#chat_toolbar").css('background-color', '#4267b2');
	}, 500);
	chat_twinkle = setTimeout(chatTwinkle, 1000);
}

function stopChatTwinkle() {
	try {
		$("#chat_toolbar_texte").empty().append("Chat");
		$("#nb_notif").val(0);
		clearTimeout(chat_twinkle);
	} 
	catch (err) { }
}

function logout() {
	$.ajax({
		type: "POST", //type de la requette ajax
		url:'facebookAjax.php?action=logout', //page sur laquelle on effectue la requette
		cache: false,
		contentType: false,
		processData: false,
		success: function(data)	{
			retour_view = $(data).filter('#view').html(); //récuppère tout ce qui est contenu dans la div avec l'id view
			$("#view").empty().append(retour_view);
			$("#notif").html("<span class=\"success\">Vous vous êtes bien déconnecté.</span>");
		},
		error: function() {
			$("#notif").html("<span class=\"error\">Erreur lors de la déconnexion.</span>");
		}
	});
}

function updateStatut(form) {
	var data = new FormData(form);
	data.append('statut_submit', '');

	$.ajax({
		type: "POST", //type de la requette ajax
		url:'facebookAjax.php?action=profil', //page sur laquelle on effectue la requette
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data)	{
			retour_view = $(data).find('#profil_statut').html(); //récuppère tout ce qui est contenu dans la div avec l'id profil_statut
			$("#profil_statut").empty().append(retour_view);
			form.reset(); //reset tous les champs du formulaire
			$("#statut_submit").blur(); //enlève le focus du bouton
			$("#notif").html("<span class=\"success\">Vous avez bien modifié votre statut.</span>");
		},
		error: function() {
			$("#notif").html("<span class=\"error\">Erreur lors de la modification du statut.</span>");
		}
	});
}

function updateAvatar(form) {
	var data = new FormData(form);
	data.append('avatar_submit', '');

	$.ajax({
		type: "POST", //type de la requette ajax
		url:'facebookAjax.php?action=profil', //page sur laquelle on effectue la requette
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data)	{
			var hiddenValueNotif = $('#notif_avatar', $(data)).val(); //récuppère ce que contient le context->notif
			retour_view = $(data).find('#profil_avatar').html(); //récuppère tout ce qui est contenu dans la div avec l'id profil_avatar
			$("#profil_avatar").empty().append(retour_view);
			form.reset(); //reset tous les champs du formulaire
			$("#avatar_submit").blur(); //enlève le focus du bouton
			$("#notif").html(hiddenValueNotif);
		},
		error: function() {
			$("#notif").html("<span class=\"error\">Erreur lors de la modification de l'avatar.</span>");
		}
	});
}

function sendChat(form) {
	var data = new FormData(form);
	data.append('chat_submit', '');

	$.ajax({
		type: "POST", //type de la requette ajax
		url:'facebookAjax.php?action=chat', //page sur laquelle on effectue la requette
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data)	{
			retour_view = $(data).find('#chats').html(); //récuppère tout ce qui est contenu dans la div avec l'id chats
			$("#chats").empty().append(retour_view);
			form.reset(); //reset tous les champs du formulaire
			$("#chat_submit").blur(); //enlève le focus du bouton
			$("#notif").html("<span class=\"success\">Vous avez bien envoyé votre chat.</span>");
			$("#last_id").val( +$("#last_id").val() + 1 );
		},
		error: function() {
			$("#notif").html("<span class=\"error\">Erreur lors de l'envoie d'un chat.</span>");
		}
	});
}

/*
* @author LE VEVE Mathieu
* @brief Cette fonction ajax permet de mettre à jour le champ like selon l'id d'un message récupéré par la fonction
* 		js. 
*
*
*/
function likeUpdating(form, id) {
	var data = new FormData(form);
	data.append('send_like', '');
	var url_ending = window.location.href;
	url_ending = url_ending.split("profil");
	// permet de rester sur la bonne URL (et de prendre les bons id message)
	url_ending = url_ending[1];
	// récupère tout ce qui se trouve après "profil"

	$.ajax({
		type: "POST", //type de la requette ajax
		url:'facebookAjax.php?action=showMessage&id='+url_ending, //page sur laquelle on effectue la requette
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data)	{
			temp = $(data).find("div.like");
			for (var i = 0; i < temp.length; i++)
			{
				if (temp[i].parentElement.attributes[1].value === id){
					div = temp[i].firstChild.textContent;
					div = div.split(' ')[44]+' '+div.split(' ')[45];
					index = i;
				}
			}

			$('.like')[index].innerText = div;
			$("#notif").html("<span class=\"success\">Vous avez bien laisse un like.</span>");
		},
		error: function() {
			$("#notif").html("<span class=\"error\">Erreur lors de la mise à jour du like.</span>");
		}
	});
}

/*
* @author LE VEVE Mathieu
* @brief 
* statut: fini mais a re factoriser pour traiter un cas  !! 
*
*/
function shareUpdating(form) {
	var data = new FormData(form);
	data.append('btn-share', '');
	var url = window.location.href;
	url_ending = url.split("profil");
	// permet de rester sur la bonne URL (et de prendre les bons id message)
	url_ending = url_ending[1];
	// récupère tout ce qui se trouve après "profil"

	$.ajax({
		type: "POST", //type de la requette ajax
		url:'facebookAjax.php?action=showMessage', //page sur laquelle on effectue la requete
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data)	{
			$("#notif").html("<span class=\"success\">Vous avez bien partagé ce message.</span>");
		},
		error: function() {
			$("#notif").html("<span class=\"error\">Erreur lors de la mise à jour du message.</span>");
		}
	});
}


