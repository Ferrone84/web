<div class = "message-list">
	<div class="user-message">
		<p>
			<?php echo htmlspecialchars($context->user->prenom)." ";
            echo htmlspecialchars($context->user->nom)." ";
			echo htmlspecialchars($context->user->identifiant)." "; 
			echo "<span class=\"date\">".htmlspecialchars($context->user->date_de_naissance->format('d-m-y'))."</span>";?>
		</p>
	</div>
	<div class="messages">
		<?php foreach($context->test as $message) : ?>
			<div class="message">
				<?php if (htmlspecialchars($message->post != NULL)) : ?>
					<?php echo "<span class=\"post\">".htmlspecialchars($message->post->texte)."</span>" ;?>
				<?php endif; ?>
				<div class="like">
					<?php if (htmlspecialchars($message->aime != NULL)) : ?>
						<?php echo (htmlspecialchars($message->aime))." like." ;?>
					<?php else : ?>
						<?php echo (0)." like.";?>
					<?php endif; ?>
				</div>
				<div class="image">
					<?php if (htmlspecialchars($message->post->image != NULL)) : ?>
						<?php echo (htmlspecialchars($message->post->image)) ?>
			        
					<?php endif; ?>
				</div>
				<div class="emetteur">
					emetteur :
					<?php if (htmlspecialchars($message->emetteur->identifiant != NULL)) : ?>
						<?php echo (htmlspecialchars($message->emetteur->identifiant)) ?>
			        <?php else : ?>
						<?php echo "<span class=\"undefined\">".htmlspecialchars($context->unknown)."</span>";?>
					<?php endif; ?>
				</div>
				<div class="destinataire">
					destinataire :  
					<?php if (htmlspecialchars($message->destinataire->identifiant != NULL)) : ?>
						<?php echo (htmlspecialchars($message->destinataire->identifiant)) ?>
			        <?php else : ?>
						<?php echo "<span class=\"undefined\">".htmlspecialchars($context->unknown)."</span>";?>
					<?php endif; ?>
				</div>
				<div class="parent">
					origine: 
					<?php if (htmlspecialchars($message->parent != NULL)) : ?>
						<?php echo (htmlspecialchars($message->parent->identifiant)) ?>
		            <?php else : ?>
						<?php echo "<span class=\"undefined\">".htmlspecialchars($context->unknown)."</span>";?>
					<?php endif; ?>
				</div>
                <div class="div-like">
                    <!--<form action="facebook.php?action=showMessage&amp;id=<?= htmlspecialchars($context->user->id);?>"
                          method="post">-->
                            <a href="#">J'aime</a>
                            <!--<input type="hidden" id="postId" name="postLike" value="<?php //echo ($message->post->id);?>"/>
                    </form>-->
                    <?php //echo ($message->post->id);?>
                </div>
                <div class="div-donot-like">
                    <a href="#">Je n'aime pas</a>
                </div>
			</div>
			
					

		<?php endforeach; ?>
	</div>
</div>
