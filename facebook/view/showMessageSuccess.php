<div class = "message-list">
	<div class="messages">
		<?php foreach($context->messageList as $message) : ?>
			<div class="message">
				<div class="header-emetteur">
					<?php if ($message->emetteur != NULL) : ?>
						<?php if ($message->emetteur->id != NULL) : ?>
							<a href="facebook.php?action=profil&amp;id=<?= htmlspecialchars($message->emetteur->id)?>">
								<?php if ($message->emetteur->avatar != NULL) : ?>
									<img class="img-circle area-profile-avatar"  src="<?= htmlspecialchars($message->emetteur->avatar) ?>"/>
								<?php else : ?>
									<img class="img-circle area-profile-avatar"  src="https://cdn1.iconfinder.com/data/icons/unique-round-blue/93/user-256.png"/>
								<?php endif; ?>
							</a>
						<?php endif; ?>
					<?php else : ?>
						<img class="img-circle area-profile-avatar"  src="https://cdn1.iconfinder.com/data/icons/unique-round-blue/93/user-256.png"/>
					<?php endif; ?>

					<div class="area-emetteur">
						by :
						<span class = "emetteur-alias">
						<?php if ($message->emetteur != NULL) : ?>
							<?php if ($message->parent != NULL ) : ?>
								<?php if($message->parent->identifiant != NULL ) : ?>
									<?php if ($message->emetteur->identifiant != NULL) :?>
										<?php echo ($message->parent->identifiant == $message->emetteur->identifiant) ?
											'<a href="facebook.php?action=profil&amp;id='.htmlspecialchars($message->emetteur->id).'">'.htmlspecialchars($message->emetteur->identifiant).'</a></span>' :

												'<a href="facebook.php?action=profil&amp;id='.htmlspecialchars($message->parent->id).'">'.htmlspecialchars($message->parent->identifiant).'</a> partagé par: <a href="facebook.php?action=profil&amp;id='.htmlspecialchars($message->emetteur->id).'">'.htmlspecialchars($message->emetteur->identifiant).'</a></span>';?>
									<?php endif; ?>
								<?php endif; ?>
							<?php else : ?>
								<?php echo ($message->emetteur->identifiant != NULL) ?  
									'<a href="facebook.php?action=profil&amp;id="'.htmlspecialchars($message->emetteur->id)."> ".
									htmlspecialchars($message->emetteur->identifiant).'</a></span>' : 
									' unknown </span>' 
								?>
							<?php endif; ?>
						<?php else : ?>
							unknown</span>
						<?php endif; ?>
						</span>
					</div>

					<div class="area-date">
						<span class = "emetteur-time">
						<?php if ($message->post != NULL) : ?>
							<?php if ($message->post->date != NULL) : ?>
								<?php echo (htmlspecialchars($message->post->date->format('Y-m-d H:i'))); ?>
							<?php endif; ?>
						<?php else : ?>
							unknown
						<?php endif; ?>
						</span>
					</div>
				</div>

				<div class="image">
					<?php if ($message->post != NULL) : ?>
						<?php if ($message->post->image != NULL)  : ?>
							<?php echo (htmlspecialchars($message->post->image)) ?>
						<?php endif; ?>
					<?php endif; ?>
				</div>

				<?php if ($message->post != NULL) : ?>
					<?php if ($message->post->texte != NULL) : ?>
						<div class="area-post">
							<?php echo "<p><span class=\"post\">".htmlspecialchars($message->post->texte)."</span></p>" ;?>
						</div>
					<?php endif; ?>
				<?php endif; ?>

                <div class="div-like">
                    <form action="facebook.php?action=profil&amp;id=<?=htmlspecialchars($context->user->id)?><?=htmlspecialchars($context->page)?>" method="POST">
                        <input type="hidden" value="<?= htmlspecialchars($message->id)?>" name="mess_id"/>
                        <button type="submit" class="btn-aime btn btn-link">
                        	<span class="glyphicon glyphicon-thumbs-up"></span>
                        	J'aime
                        </button>
                    </form>
                </div>

                <div class="div-share">
                    	<form action="facebook.php?action=profil&amp;id=<?=htmlspecialchars($context->current_user->id)?>&amp;page=1" method="POST">
                        <input type="hidden" value="<?= htmlspecialchars($message->id)?>" name="mess_id_share"/>
                        <button type="submit">
                        	<span class="glyphicon glyphicon-share"></span>
                        	Partager
                        </button>
                       <!-- <input type="submit" value="Partager"/>-->
                    </form>
                </div>

                <div class="like">
					<?php if ($message->aime != NULL) : ?>
	                    <?php if ($message->aime >= 0) : ?>
	                        <?php echo (htmlspecialchars($message->aime))." likes." ;?>
	                    <?php elseif ($message->aime <= 0) : ?>
	                        <?php echo (htmlspecialchars(substr($message->aime,1))." dislikes.") ;?>
	                    <?php endif; ?>
	                	<?php else : ?>
							0 like.
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
