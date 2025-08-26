<body>
<main>

    <div class="form-connexion">

        <form action="" method="POST">
            <h2>Vous êtes déjà inscrit ?<br>Connectez-vous</h2>
            <p>
                <label for="email">Adresse E-mail</label><br>
                <input name="email" id="email" required placeholder="" type="email" maxlength="60" tabindex="1"/>
            </p>
            <p>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required size="16" minlength="8" maxlength="20"
                       tabindex="2"/><br>
                <a href="changer-mdp">Mot de passe oublié ?</a>
            </p>
            <button class="cta-blue" type="submit" id="soumission" name="soumission" tabindex="3">Se connecter</button>
        </form>

        <div class="right-container">
            <div class="pasDeCompte">
                <h2>Pas de compte ?</h2>
                <a href="inscription" class="cta-yellow">Créer un compte</a>
            </div>
        </div>

    </div>
</main>