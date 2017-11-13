<div class="user-list">
    <div class="user-label">Amis</div>
    <!-- peut être rajouter le nombre d'amis enregistrés -->
    <div class="user-scrollable">
        <?php foreach($context->users as $user) : ?>
        <div class="block">
            <p>
            <div class="col-sm-12  col-md-4 user-avatar">
                <?php if ($user->avatar != NULL) : ?>
                    <img class="img-profil-avatar"  src="<?= htmlspecialchars($user->avatar) ?>">
                <?php else : ?>
                    <img class="img-profil-avatar" src="<?= htmlspecialchars($context->avatar) ?>">
                <?php endif; ?>
            </div>
            <div class="col-sm-12 col-md-8 user-id">
                <a href="facebook.php?action=profil&amp;id=<?= htmlspecialchars($user->id) ?>">
                    <span class = "friend_id"><?= htmlspecialchars($user->identifiant) ?></span>
                </a>
            </div>
            </p>
        </div>
        <?php endforeach; ?>
    </div>
</div>