<!-- @author DURET Nicolas -->
<div id="messages">
<?php foreach($context->messages as $message) : ?>
<?php if($message != NULL) : ?>
	<div class="message">
		<?= htmlspecialchars($message->emetteur->identifiant) ?> dit : <?= htmlspecialchars($message->post->texte) ?> 
	</div>
	<br><br>
<?php endif; ?>
<?php endforeach; ?>
</div>

<!-- @author LE VEVE Mathieu -->
<!-- <div id="chats">
<?php /* foreach($context->chats as $chats) : ?>
<?php if($chats != NULL) : ?>
	<div class="chats">
		<?php var_dump($chats) ?>
	</div>
	<br><br>
<?php endif; ?>
<?php endforeach; */?>
</div> -->

<!-- @author LE VEVE Mathieu -->
<!--<div id="lastChat">-->
<?php /*$context->lastChat */?>
