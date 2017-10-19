<!-- @author DURET Nicolas -->
<div id="destinataire">
	Message du user <?= htmlspecialchars($context->user->id) ?> : <?php echo htmlspecialchars($context->user->nom)." "; echo htmlspecialchars($context->user->prenom)." "; echo htmlspecialchars($context->user->identifiant)." "; echo htmlspecialchars($context->user->date_de_naissance->format('d-m-y'));?>
</div>
<div id="messages">
<?php foreach($context->messages as $message) : ?>
<?php if($message != NULL) : ?>
	<div class="message">
		---> <?= htmlspecialchars($message->post->texte) ?> écrit par <?= htmlspecialchars($message->emetteur->identifiant) ?> à destination de <?= htmlspecialchars($message->destinataire->identifiant) ?> (le parent étant : <?= htmlspecialchars($message->parent->identifiant) ?>)
	</div>
<?php endif; ?>
<?php endforeach; ?>
</div>