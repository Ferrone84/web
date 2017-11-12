<div id="profil">
	<div class="row">
		<img id="profil_avatar" class="col-xs-offset-3 col-xs-6 img-circle" src="<?= htmlspecialchars($context->avatar) ?>">
	</div>
	<br>
	<div class="row">
		<div id="profil_infos" class="col-xs-12">
			<p id="profil_nom"><?= htmlspecialchars($context->user->prenom)." ".htmlspecialchars($context->user->nom) ?></p>
			<p id="profil_id">@<?= htmlspecialchars($context->user->identifiant) ?></p>
			<p id="profil_statut"><?= htmlspecialchars($context->user->statut) ?></p>
		</div>
	</div>
	<?php if ($context->current_user == $context->user) : ?>
	<div class="row center">
		<form class="col-xs-12" action="facebook.php?action=profil" method="POST">
			<input class="col-sm-12 col-md-10" type="text" name="modif_statut" placeholder="Changer son statut"/>
			<button type="submit" class="btn btn-default btn-sm">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
		</form>
	</div>
	<br>
	<?php endif; ?>
</div>