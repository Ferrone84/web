<!-- ici on affiche le formulaire de connexion s'il est pas envoyé une 1ere fois ou si l'utilisateur rentre des données erronées -->
<h1 class="center">Connexion</h1>
<form action="facebook.php?action=login" method="POST" id="formConnection">
	<label>Login : </label><input type="text" name="login" /> <br>
	<label>Mot de passe : </label><input type="password" name="mdp" /> <br>
	<input type="submit" name="formConnec" value="Se connecter">
</form>