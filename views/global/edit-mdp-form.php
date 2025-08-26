<div class="form-connexion">
    <form action="" method="POST">
        <h2>Saisissez votre nouveau mot de passe</h2>
        <p>
            <label for="password">Mot de passe*</label>
            <input type="password" id="password" name="password" required size="16" minlength="8" maxlength="20" placeholder="********" tabindex="7" <?php if (isset($password)) {
                                                                                                                                                                echo ("value='" . $password ."'");
                                                                                                                                                            } ?> />
        </p>
        <p>
            <label for="password2">Confirmez le mot de passe*</label>
            <input type="password" id="password2" name="password2" required size="16" minlength="8" maxlength="20" placeholder="********" tabindex="8" <?php if (isset($password2)) {
                                                                                                                                                                    echo ("value='" . $password2 ."'");
                                                                                                                                                                } ?> />
        </p>

        <input type="hidden" name="key" value="<?=$key?>" />
        <button class="cta-blue" type="submit" id="soumission" name="soumission" tabindex="2">Envoyer</button>
    </form>
</div>