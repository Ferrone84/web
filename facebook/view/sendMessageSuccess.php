<div class="form-send-message">
    <form class="send-form" action="facebook.php?action=profil&amp;id=<?= htmlspecialchars($context->user->id) ?>" method="post">
        <textarea class = "form-control text-area" placeholder="Ecrivez un message" name="send_post"></textarea>
        <div class = "div-btn-submit">
            <div>
                <input id="texte_avatar" class="text-center" maxlength="200" type="text" name="file" placeholder="Ajouter URL"/>
            </div>
            <div>
                <button type="btn-submit col-sm-5">
                    <span class="glyphicon glyphicon-envelope"><span class="btn-label-submit"> Envoyer votre message</span></span>
                </button>
            </div>
        </div>
    </form>
</div>