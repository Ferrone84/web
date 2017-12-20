<div class="user-list">
	<div class="user-label">Amis <span class="friend-number"><?php echo (count($context->users));?></span></div>
	<div class="user-scrollable">
		<?php foreach($context->users as $user) : ?>
		<div class="block">
			<p>
				<div class="col-sm-12  col-md-4 div-img-profile">
					<a href="facebook.php?action=profil&amp;id=<?= htmlspecialchars($user->id) ?>">
						<?php if ($user->avatar != NULL && substr($user->avatar, 0, 4) === "http") : ?>
							<img class="img-circle"  src="<?= htmlspecialchars($user->avatar) ?>"/>
						<?php else : ?>
							<img class="img-circle" src="<?= htmlspecialchars($context->avatar) ?>"/>
						<?php endif; ?>
				</div>
				<div class="col-sm-12 col-md-8 user-id">
					<?php echo ($user->identifiant != NULL) ? 
						'<span class = "friend_id">'.htmlspecialchars($user->identifiant).'</span>' : 
						'<span class = "friend_id">Unknown</span>';
					?>
					</a>
				</div>
			</p>
		</div>
		<?php endforeach; ?>
	</div>
</div>