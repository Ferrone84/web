<!-- @author DURET Nicolas -->
<div id="destinataire">
	<p>
		Messages du user <?= htmlspecialchars($context->user->id) ?> : 
		<?php echo htmlspecialchars($context->user->nom)." "; echo htmlspecialchars($context->user->prenom)." "; 
		echo htmlspecialchars($context->user->identifiant)." "; 
		echo htmlspecialchars($context->user->date_de_naissance->format('d-m-y'));?>
	</p>
</div>
<div id="messages">
	<?php foreach($context->messages as $message) : ?>
		<div class="message">
			<?php if (htmlspecialchars($message->post != NULL)) : ?>
				<?= htmlspecialchars($message->post->texte) ?>
			<?php endif; ?>
		</div>
		<div class="emetteur">
			emetteur :
			<?php if (htmlspecialchars($message->emetteur->identifiant != NULL)) : ?>
				<?= htmlspecialchars($message->emetteur->identifiant) ?>
	        <?php else : ?>
				<?php echo ($context->unknown);?>
			<?php endif; ?>
		</div>
		<div class="destinataire">
			destinataire :  
			<?php if (htmlspecialchars($message->destinataire->identifiant != NULL)) : ?>
				<?= htmlspecialchars($message->destinataire->identifiant) ?>
	        <?php else : ?>
				<?php echo ($context->unknown);?>
			<?php endif; ?>
		</div>
		<div class="parent">
			origine: 
			<?php if (htmlspecialchars($message->parent != NULL)) : ?>
				<?=  htmlspecialchars($message->parent->identifiant) ?>
            <?php else : ?>
				<?php echo ($context->unknown);?>
			<?php endif; ?>
		</div>
		
				

	<?php endforeach; ?>
</div>
