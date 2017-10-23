<?php if($context->membre != NULL):?> <!-- si l'utilisateur vient de se connecter -->
<p>
	<a href="facebook.php">Page par défaut</a> 
	<span id="logout"> ou <a href="facebook.php?action=logout">Deconnectez vous !</a></span>
</p>
<?php endif;?>