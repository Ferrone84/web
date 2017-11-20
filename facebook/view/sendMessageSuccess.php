<div class="form-send-message">
    <form action="facebook.php?action=profil&amp;id=<?= htmlspecialchars($context->user->id) ?>" method="post">
        <textarea class = "form-control text-area" placeholder="Ecrivez un message" name="send_post"></textarea>
        <div class = "div-btn-submit">
            <div>
                <!-- pensez a inclure / upload files-->
                <input class="input-file" name="file" type="file" style="display : none"></input>
            </div>
            <div>
                <button type="btn-submit col-sm-5">
                    <span class="glyphicon glyphicon-envelope"><span class="btn-label-submit"> Envoyer votre message</span></span>
                </button>
            </div>
        </div>
    </form>
</div>