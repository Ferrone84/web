<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Facebook</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
	   
	</head>
	<body>
		<!-- Zone de notification -->
		<div id="notif" class="center"><?=$context->notif?></div>
		<div id="view"><?php include($template_view); ?></div>
	    
	</body>
</html>
