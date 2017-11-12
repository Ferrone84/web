/**
* Fichier contenant tout le js executé dans l'application
*
* @author Duret Nicolas
*/
$(document).ready(function(){
	//si on click sur le lien de déconnection
	$("#logout").on('click', function(event){
		event.preventDefault(); //évite le comportement par défault du lien
		logout();
	});

	$("#chats").scrollTop($("#chats").prop('scrollHeight'));

	$("#chat").resizable({ alsoResize: "#chats,#chat_form" });
	$("#chat").draggable({ cursor: "move", handle: "#chat_toolbar" });

	$("#reduce").on('click', function() {
		saveHeight = $("#chat").height()+2;
		$("#chats").css('display', 'none');
		$("#chat_form").css('display', 'none');
		$(this).hide();
		$("#maximize").show();
		$("#chat").css('height', '24');
		$("#chat").resizable('disable');
	});

	$("#maximize").on('click', function() {
		$("#chats").css('display', 'block');
		$("#chat_form").css('display', 'block');
		$(this).hide();
		$("#reduce").show();
		$("#chat").css('height', saveHeight);
		$("#chat").resizable('enable');
	});
});

function logout() {
	$.ajax({
		type: "POST", //type de la requette ajax
		url:'facebookAjax.php?action=logout', //page sur laquelle on effectue la requette
		cache: false,
		contentType: false,
		processData: false,
		success: function(data)	{
			$("#notif").html("<span class=\"success\">Vous vous êtes bien déconnecté.</span>");
			retour_view = $(data).filter('#view').html(); //récuppère tout ce qui est contenu dans la div avec l'id view
			$("#view").empty().append(retour_view);
		},
		error: function() {
			$("#notif").html("<span class=\"error\">Erreur lors de la déconnexion.</span>");
		}
	});
}