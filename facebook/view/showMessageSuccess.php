<div id="messages">
<?php foreach($context->messages as $message) : ?>
<?php if($message != NULL) : ?>
	<div class="message">
		<?= htmlspecialchars($message->parent) ?> dit : <?= htmlspecialchars(postTable::getPostById($message->post)->texte) ?>
	</div>
	<br><br>
<?php endif; ?>
<?php endforeach; ?>
</div>