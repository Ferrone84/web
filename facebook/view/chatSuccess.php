<div id="chat" class="visible-md visible-lg ui-widget-content">
	<div id="chat_toolbar" class="ui-widget-content">
		<span id="reduce" class="glyphicon glyphicon-resize-small"></span>
		<span id="maximize" class="glyphicon glyphicon-resize-full"></span>
		<span id="chat_toolbar_texte">Chat</span>
	</div>
	<div id="chats">
		<?php foreach ($context->chats as $chat) : ?>
			<?php if ($chat->emetteur != NULL && $chat->post != NULL) : ?>
				<?php if ($context->user->id != $chat->emetteur->id) : ?>
				<div class="chat_message">
					<a href="facebook.php?action=profil&id=<?=$chat->emetteur->id?>">
						<span class="chat_message_id">@<?= htmlspecialchars($chat->emetteur->identifiant) ?></span>
					</a>
					<br>
					<div class="chat_message_post"><?= htmlspecialchars($chat->post->texte) ?></div>
				</div>
				<?php else : ?>
				<div class="chat_message_user">
					<span class="chat_message_id_user"> Moi </span>
					<br>
					<div class="chat_message_post_user"><?= htmlspecialchars($chat->post->texte) ?></div>
				</div>
				<?php endif; ?>
				<br>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<div id="div_chat_form">
		<form id="chat_form" action="facebook.php?action=profil<?=$context->id?>" method="POST">
			<input id="texte_chat" type="text" name="send_chat" placeholder="Envoyer un chat"/>
			<button id="chat_submit" type="submit" class="btn btn-default btn-sm">
				<span class="glyphicon glyphicon-send"></span> Send
			</button>
		</form>
	</div>
</div>
