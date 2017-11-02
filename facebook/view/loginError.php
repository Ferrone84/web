<!-- ici on affiche le formulaire de connexion si l'utilisateur n'est pas connecté ou s'il rentre des données erronées -->
<div id="login" class="row">
	<h1 id="loginTitle" class="center">Connexion</h1>
	<form action="facebook.php?action=login" method="POST" id="formConnection">
		<label>Login : </label><input type="text" name="login" value="<?php if(isset($_POST['login'])) echo htmlspecialchars($_POST['login']); ?>" /> <br>
		<label>Mot de passe : </label><input type="password" name="mdp" value="<?php if(isset($_POST['mdp'])) echo htmlspecialchars($_POST['mdp']); ?>" /> <br>
		<input type="submit" name="formConnec" value="Se connecter">
	</form>
	<br>
</div>