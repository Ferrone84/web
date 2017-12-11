/**
* Fichier contenant tout le js executé dans l'application
*
* @author Duret Nicolas
*/
$(document).ready(function(){
	//------ Partie Initialisation ------

	//si le chat est sur la vue courrante
	if ($("#chat").length) {
		initChat();
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

	$(".like_form").submit(function(event){
		event.preventDefault(); //évite le comportement par défault du bouton
		var form = this;
		id = $(this).find(".hidden-id").val();
		//alert(id);
		likeUpdating(form,id);
	});

});


//------ Toutes les fonctions utilisées dans l'application ------
function initChat() {
	$("#chats").scrollTop($("#chats").prop('scrollHeight'));

	$("#chat").resizable({ alsoResize: "#chats,#chat_form", minWidth: 260, minHeight: 230, handles: 'n, e, s, w, nw, ne, sw, se' });
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
			$("#notif").html("<span class=\"error\">Erreur lors de la modiffication du profil.</span>");
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
			retour_view = $(data).find('#chats').html(); //récuppère tout ce qui est contenu dans la div avec l'id profil_statut
			$("#chats").empty().append(retour_view);
			form.reset(); //reset tous les champs du formulaire
			$("#chat_submit").blur(); //enlève le focus du bouton
			$("#notif").html("<span class=\"success\">Vous avez bien envoyé votre chat.</span>");
		},
		error: function() {
			$("#notif").html("<span class=\"error\">Erreur lors de l'envoie d'un chat.</span>");
		}
	});
}

//en travaux

function likeUpdating(form, id) {
	var data = new FormData(form);
	data.append('send_like', '');

	$.ajax({
		type: "POST", //type de la requette ajax
		url:'facebookAjax.php?action=showMessage', //page sur laquelle on effectue la requette
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data)	{
			div = "";
			temp = $(data).find("div.like");
			//console.log(id);
			console.log(temp);
			console.log("id : "+id);
			for (var i =0; i < temp.length; i++)
			{
				console.log(i + " : "+temp[i].children);
				/*if (temp[i].children[3].attributes[1].value === id){
					console.log(temp[i].children[3].attributes[1]);
					//div = temp[i].children[3];
				}*/
			}
			/*test =  $(div).parent().find(".like")[0].innerText;
			console.log(test);
			$(div).empty().append(test);*/
			$("#notif").html("<span class=\"success\">Vous avez bien laisse un like.</span>");
		},
		error: function() {
			$("#notif").html("<span class=\"error\">Erreur lors de la mise à jour du like.</span>");
		}
	});
}


