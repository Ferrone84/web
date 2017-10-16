<div id="messages">
<?php foreach($context->messages as $message) : ?>
<?php if($message != NULL) : ?>
	<div class="message">
		<?php var_dump($message) ?>
	</div>
	<br><br>
<?php endif; ?>
<?php endforeach; ?>
</div>