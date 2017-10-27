<div class="row">
	<div id="profil" class="col-sm-5 col-md-4 col-lg-3">
		<img id="profil_avatar" src="<?= htmlspecialchars($context->avatar) ?>">
		<div id="profil_infos">
			<p id="profil_nom"><?= htmlspecialchars($context->user->prenom) ?> <?= htmlspecialchars($context->user->nom) ?></p>
			<p id="profil_date"><?= htmlspecialchars($context->user->date_de_naissance->format('d-m-Y')) ?></p>
			<p id="profil_statut"><?= htmlspecialchars($context->user->statut) ?></p>
		</div>
		<br><br>
		<?php if ($context->current_user == $context->user) : ?>
		<input class="centrerElem" type="button" name="modifier_profil" value="modifier"/>
		<?php endif; ?>
	</div>
</div>




<!-- 
<div class="row">
	<div class="col-lg-offset-4 col-lg-4">
		<div class="row">
			<div id="profil" class="col-lg-offset-2 col-lg-8">
				<img id="profil_avatar" src="<?= htmlspecialchars($context->avatar) ?>">
				<div id="profil_infos">
					<p id="profil_nom"><?= htmlspecialchars($context->user->prenom) ?> <?= htmlspecialchars($context->user->nom) ?></p>
					<p id="profil_date"><?= htmlspecialchars($context->user->date_de_naissance->format('d-m-Y')) ?></p>
					<p id="profil_statut"><?= htmlspecialchars($context->user->statut) ?></p>
				</div>
				<br>
				<?php if ($context->current_user == $context->user) : ?>
				<input type="button" name="modifier_profil" value="modifier"/>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
 -->