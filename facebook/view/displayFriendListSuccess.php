<div class="user-scrollable">
	<?php foreach($context->users as $user) : ?>
		<div class="user">
			<a href="facebook.php?action=showMessage&amp;id=<?= $user->id ?>">
				<?= htmlspecialchars($user->identifiant) ?> 
			</a>
		</div>
	<?php endforeach; ?>
</div>