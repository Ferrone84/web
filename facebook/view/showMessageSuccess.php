<!-- @author DURET Nicolas -->
<div class = "message-list">
	<div class="user-message">
		<p>
			<?php echo htmlspecialchars($context->user->nom)." "; 
			echo htmlspecialchars($context->user->prenom)." "; 
			echo htmlspecialchars($context->user->identifiant)." "; 
			echo "<span class=\"date\">".htmlspecialchars($context->user->date_de_naissance->format('d-m-y'))."</span>";?>
		</p>
	</div>
	<div class="messages">
		<?php foreach($context->messages as $message) : ?>
			<div class="message">
				<?php if (htmlspecialchars($message->post != NULL)) : ?>
					<?php echo "<span class=\"post\">".htmlspecialchars($message->post->texte)."</span>" ;?>
				<?php endif; ?>
				<div class="emetteur">
					emetteur :
					<?php if (htmlspecialchars($message->emetteur->identifiant != NULL)) : ?>
						<?php echo (htmlspecialchars($message->emetteur->identifiant)) ?>
			        <?php else : ?>
						<?php echo ($context->unknown);?>
					<?php endif; ?>
				</div>
				<div class="destinataire">
					destinataire :  
					<?php if (htmlspecialchars($message->destinataire->identifiant != NULL)) : ?>
						<?php echo (htmlspecialchars($message->destinataire->identifiant)) ?>
			        <?php else : ?>
						<?php echo ($context->unknown);?>
					<?php endif; ?>
				</div>
				<div class="parent">
					origine: 
					<?php if (htmlspecialchars($message->parent != NULL)) : ?>
						<?php echo (htmlspecialchars($message->parent->identifiant)) ?>
		            <?php else : ?>
						<?php echo ($context->unknown);?>
					<?php endif; ?>
				</div>
			</div>
			
					

		<?php endforeach; ?>
	</div>
</div>
