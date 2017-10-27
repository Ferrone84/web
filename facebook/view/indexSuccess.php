<!-- Bienvenue dans l'index ! <a href="facebook.php">Page par défaut</a> <br>
<span id="logout"><a href="facebook.php?action=logout">Deconnectez vous !</a></span>
<br><br> -->

<form action="facebook.php?action=showMessage&amp;id=" method="POST" id="formSM">
	<input type="number" name="id"/> 
	<input type="submit" name="subformSM" value="show messages">
</form>

<br>
<form action="facebook.php?action=displayFriendList&amp;id=" method="POST" id="formFL">
	<input type="number" name="id"/> 
	<input type="submit" name="subformFL" value="show friends">
</form>
<!-- 
<br>
<a href="facebook.php?action=profil">Ton profil</a> -->