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
		success: function()	{
			$("#notif").html("<span class=\"success\">Vous vous êtes bien déconnecté.</span>")/*.fadeIn(800).delay(800).fadeOut(1500)*/;
			$("#logout").empty(); //évite le spam du bouton
		},
		error: function() {
			$("#notif").html("<span class=\"error\">Erreur lors de la déconnexion.</span>").fadeIn(800).delay(800).fadeOut(1500);
		}
	});
}