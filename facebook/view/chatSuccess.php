<div id="chat" class="visible-md visible-lg ui-widget-content">
	<div id="chat_toolbar" class="ui-widget-content">
		<span id="reduce" class="glyphicon glyphicon-resize-small"></span>
		<span id="chat_toolbar_texte">Chat</span>
	</div>
	<div id="chats">
		<?php foreach ($context->chats as $chat) : ?>
			<?php if ($chat->emetteur != NULL && $chat->post != NULL) : ?>
				<?php if ($context->user->id != $chat->emetteur->id) : ?>
				<div class="chat_message">
					<span class="chat_message_id">@<?= htmlspecialchars($chat->emetteur->identifiant) ?></span>
					<br>
					<span class="chat_message_post"><?= htmlspecialchars($chat->post->texte) ?></span>
				</div>
				<?php else : ?>
				<div class="chat_message_user">
					<span class="chat_message_id_user"> Moi </span>
					<br>
					<span class="chat_message_post_user"><?= htmlspecialchars($chat->post->texte) ?></span>
				</div>
				<br>
				<?php endif; ?>
			<?php endif; ?>
			<br>
		<?php endforeach; ?>
	</div>
	<div id="chat_form">
		<form action="facebook.php?action=profil" method="POST">
			<input type="text" name="send_chat" placeholder="Envoyer un chat"/>
			<button type="submit" class="btn btn-default btn-sm">
				<span class="glyphicon glyphicon-send"></span> Send
			</button>
		</form>
	</div>
</div>