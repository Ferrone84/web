<div class="user-list">
    <div class="user-label">Amis</div>
    <!-- peut être rajouter le nombre d'amis enregistrés -->
    <div class="user-scrollable">
        <?php foreach($context->users as $user) : ?>
            <div class="user-avatar">
                <?php if ($user->avatar != NULL) : ?>
                    <img id="profil_avatar" src="<?= htmlspecialchars($context->user->avatar) ?>" width="20px">
                <?php else : ?>
                    <img id="profil_avatar" src="<?= htmlspecialchars($context->avatar) ?>" width="20px">
                <?php endif; ?>
                <p class="user-id">
                    <a href="facebook.php?action=profil&amp;id=<?= htmlspecialchars($user->id) ?>">
                        <span class = "friend_id"><?= htmlspecialchars($user->identifiant) ?></span>
                    </a>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>