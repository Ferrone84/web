<div id="profil">
	<div class="row" id="div_profil_avatar">
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
		<form id="form_statut" class="col-xs-12" action="facebook.php?action=profil" method="POST">
			<input id="texte_statut" class="col-sm-12 col-md-offset-1 col-md-8" type="text" name="modif_statut" placeholder="Changer statut"/>
			<button id="statut_submit" type="submit" class="col-md-2 btn btn-default btn-sm">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
		</form>
	</div>
	<div class="row center">
		<form id="form_avatar" class="col-xs-12" action="facebook.php?action=profil" method="POST">
			<input id="notif_avatar" type="hidden" name="notif_avatar" value="<?=htmlspecialchars($context->notif)?>">
			<input id="texte_avatar" class="col-sm-12 col-md-offset-1 col-md-8" type="text" name="modif_avatar" placeholder="Changer avatar"/>
			<button id="avatar_submit" type="submit" class="col-md-2 btn btn-default btn-sm">
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
		</form>
	</div>
	<br>
	<?php endif; ?>
</div>