<div class="form-send-message">
    <form action="facebook.php?action=profil&amp;id=<?= htmlspecialchars($context->user->id) ?>" method="post" class="form-control">
        <div>
            <textarea class="text-area" cols="50" rows="20" placeholder="Ecrivez un message"></textarea>
            <div class="div-btn-submit col-sm-6">
                <div class="btn-submit col-sm-6">
                    <button type="submit">
                        <span class="btn-label-submit">Envoyer votre message</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>