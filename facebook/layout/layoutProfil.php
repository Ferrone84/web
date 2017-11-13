<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Facebook</title>
		<link rel="icon" type="image/png" href="https://facebookbrand.com/wp-content/themes/fb-branding/prj-fb-branding/assets/images/fb-art.png">
		<link rel="stylesheet" type="text/css" href="lib/core/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<!-- Zone de notification -->
		<div id="notif" class="center"><?=$context->notif?></div>
		<div id="view">
			<div class="container">
				<?php include($template."headband.php"); ?>
				<div class="row">
					<div class="col-sm-3">
						<?php include($template_view); ?>
						<br>
						<?php addView("chat"); ?>
					</div>
					<div class="col-sm-6">
						<?php addView("sendMessage");?>
						<br>
						<?php addView("showMessage"); ?>
					</div>
					<div class="col-sm-3 hidden-xs">
						<?php addView("displayFriendList"); ?>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="lib/core/vendor/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
