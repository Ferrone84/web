<div class = "message-list">
	<div class="destinataire">
		<p>
			<?php echo htmlspecialchars($context->user->prenom)." ";
            echo htmlspecialchars($context->user->nom)." ";
			echo htmlspecialchars($context->user->identifiant)." "; 
			echo "<span class=\"date\">".htmlspecialchars($context->user->date_de_naissance->format('d-m-y'))."</span>";?>
		</p>
			Cet utilisateur n'a actuellement aucun message.
	</div>
</div>