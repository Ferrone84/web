$(document).ready(function(){
	//si on click sur le lien de déconnection
	$("#logout").on('click', function(event){
		event.preventDefault(); //évite le comportement par défault du lien
		logout();
	});

	$("#chat").resizable({ alsoResize: "#chats,#chat_form" }).on('resize', function(e) {
		e.stopPropagation();
	});
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

/*
https://www.google.fr/search?client=ubuntu&hs=4UV&channel=fs&dcr=0&biw=1375&bih=769&ei=YvQBWvXVGYvca9n0iugF&q=jquery+ui+resizable+also+resize+window&oq=jquery+ui+resizable+also+resize+window&gs_l=psy-ab.3..33i22i29i30k1.718508.720857.0.720977.13.13.0.0.0.0.142.1040.9j2.11.0....0...1.1.64.psy-ab..2.11.1034...35i39k1.0.GdavuEmy4yI
https://stackoverflow.com/questions/7494378/jquery-ui-resizable-fire-window-resize-event
https://stackoverflow.com/questions/23473105/jquery-ui-resize-also-triggers-a-resize-on-window
*/