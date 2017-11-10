<div class="col-sm-3 hidden-xs user-list">
    <div class="user-label">Amis</div>
    <!-- peut être rajouter le nombre d'amis enregistrés -->
    <div class="user-scrollable">
        <?php foreach($context->users as $user) : ?>
            <div class="user-avatar">
                <?php if ($user->avatar != NULL) : ?>
                    <!-- pensez a mettre balises img -->
                    <img id="friend_avatar" src="<?= htmlspecialchars($user->avatar) ?>" width="auto">
                <? else : ?>
                    <!-- mettre une image random no recorded -->
                    <!-- pensez a mettre balises img -->
                    <img id="friend_avatar" src="<?= htmlspecialchars($context->avatar) ?>" width="auto">
                <div class="user-id">
                    <a href="facebook.php?action=profil&amp;id=<?= htmlspecialchars($user->id) ?>">
                        <span class = "friend_id"><?= htmlspecialchars($user->identifiant) ?></span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>