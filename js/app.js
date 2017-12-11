/**
* Fichier contenant tout le js executé dans l'application
*
* @author Duret Nicolas
*/
$(document).ready(function(){
	//------ Partie Initialisation ------

	//@author Duret Nicolas
	//si le chat est sur la vue courrante
	if ($("#chat").length) {
		var chat_twinkle;
		initChat();
		refreshChat();
		chatTwinkle();
	}

	//@author Duret Nicolas
	//si on clique sur la zone de notification ça la vide
	$("#notif").on('click', function() {
		$("#notif").empty();
	});


	//------ Partie Ajax ------

	//@author Duret Nicolas
	//si on click sur le lien de déconnection
	$("#logout").on('click', function(event){
		event.preventDefault(); //évite le comportement par défault du lien
		logout();
	});

	//@author Duret Nicolas
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

	//@author Duret Nicolas
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

	//@author Duret Nicolas
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

	//ici tu met ton formulaire quand il est submit

});


//------ Toutes les fonctions utilisées dans l'application ------
//@author Duret Nicolas
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

	$("#texte_chat").on('click', function() {
		stopChatTwinkle();
	});
}

//@author Duret Nicolas
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

//@author Duret Nicolas
function chatTwinkle() {
	if ($("#chat_toolbar").css('background-color') == 'rgb(66, 103, 178)')
		$("#chat_toolbar").css('background-color', 'red');
	else
		$("#chat_toolbar").css('background-color', '#4267b2');
	chat_twinkle = setTimeout(chatTwinkle, 500);
}

//@author Duret Nicolas
function stopChatTwinkle() {
	try {
		$("#chat_toolbar_texte").empty().append("Chat");
		$("#nb_notif").val(0);
		clearTimeout(chat_twinkle);
		$("#chat_toolbar").css('background-color', '#4267b2');
	} 
	catch (err) { }
}

//@author Duret Nicolas
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

//@author Duret Nicolas
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

//@author Duret Nicolas
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

//@author Duret Nicolas
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
			$("#chats").scrollTop($("#chats").prop('scrollHeight'));
		},
		error: function() {
			$("#notif").html("<span class=\"error\">Erreur lors de l'envoie d'un chat.</span>");
		}
	});
}

//et ici tu met la fonction qui correspond en ajax

