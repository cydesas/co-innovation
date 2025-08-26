<?php echo $error; ?>
<div class="form-connexion">
    <form action="" method="POST">
        <h2>Saisissez votre adresse mail</h2>
        <p>
            <label for="email">Adresse e-mail*</label><br>
            <input name="email" id="email" required placeholder="E-mail de votre inscription" type="text" maxlength="60" tabindex="1" />
        </p>

        <button class="cta-blue" type="submit" id="soumission" name="soumission" tabindex="2">Envoyer</button>
    </form>
</div>