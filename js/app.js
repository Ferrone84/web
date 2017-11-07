$(document).ready(function(){
	//si on click sur le lien de déconnection
	$("#logout").on('click', function(event){
		event.preventDefault(); //évite le comportement par défault du lien
		logout();
	});

	$("#chat").resizable({ alsoResize: "#chats" }).draggable({ cursor: "move", handle: "#chat_toolbar" });

	$("#reduce").on('click', function(event) {
		$("#notif").html("<span class=\"success\">Vous vous êtes bien déconnecté.</span>");
		$("#chats").css('display', 'none');
		$("#chat_form").css('display', 'none');
		$(this).replaceWith("<span id=\"maximize\" class=\"glyphicon glyphicon-resize-full\" style=\"cursor: pointer\"></span>");
	});

	$("#maximize").on('click', function(event) {
		$("#notif").html("<span class=\"success\">Vous vous êtes bien cac.</span>");
		$("#chats").css('display', 'block');
		$("#chat_form").css('display', 'block');
		$(this).replaceWith("<span id=\"reduce\" class=\"glyphicon glyphicon-resize-small\" style=\"cursor: pointer\"></span>");
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

/*https://codepen.io/kompiajaib/pen/rOZyWQ*/