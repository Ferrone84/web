<div class="form-send-message">
    <form action="facebook.php?action=profil&amp;id=<?= htmlspecialchars($context->user->id) ?>" method="post">
        <textarea class = "form-control text-area" placeholder="Ecrivez un message" name="send_post"></textarea>
        <div class = "div-btn-submit">
            <div>
                <button type="btn-submit col-sm-5">
                    <span class="btn-label-submit">Envoyer votre message</span>
                </button>
            </div>
        </div>
    </form>
</div>