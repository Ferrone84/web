$(document).ready(function(){
	//si on click sur le lien de déconnection
	$("#logout").on('click', function(event){
		event.preventDefault(); //évite le comportement par défault du lien
		logout();
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
