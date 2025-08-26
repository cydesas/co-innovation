<body>
<main>
    <div class="grid">
        <form class="form-inscription" action="" method="POST">
            <h1>Formulaire d'inscription</h1>

            <div class="grid">
                <div class="left-container">
                    <p>
                        <label for="typeutilisateur">Vous êtes :</label>
                        <select id="typeutilisateur" name="typeutilisateur" tabindex="1">
                            <option value="3" <?php if (isset($typeutilisateur) && $typeutilisateur == ENTREPRISE) {
                                echo(" selected");
                            } ?>>Une entreprise
                            </option>
                            <option value="4" <?php if (isset($typeutilisateur) && $typeutilisateur == ESN) {
                                echo(" selected");
                            } ?>>Une Entreprise de Services Numériques
                            </option>
                            <option value="2" <?php if (isset($typeutilisateur) && $typeutilisateur == PARTICULIER) {
                                echo(" selected");
                            } ?>>Un particulier
                            </option>
                        </select>
                    </p>
                    <p>
                        <label for="raisonsociale" id="lbl-raisonsociale">Raison Sociale*</label>
                        <input name="raisonsociale" id="raisonsociale" type="text" maxlength="131" placeholder="|"
                               tabindex="2" <?php if (isset($raisonsociale) && $raisonsociale != '/') {
                            echo("value='" . $raisonsociale . "'");
                        } ?> />
                    </p>
                    <p>
                        <label for="siret" id="lbl-siret">Numéro Siret*</label>
                        <input name="siret" id="siret" type="text" maxlength="14" placeholder="|"
                               tabindex="3" <?php if (isset($siret) && $siret != '/') {
                            echo("value='" . $siret . "'");
                        } ?> />
                    </p>
                    <p>
                        <label for="nom" id="lbl-nom">Nom*</label>
                        <input name="nom" id="nom" type="text" maxlength="50" placeholder="|"
                               tabindex="4" <?php if (isset($nom) && $nom != '/') {
                            echo("value='" . $nom . "'");
                        } ?> />
                    </p>
                    <p>
                        <label for="prenom" id="lbl-prenom">Prénom*</label>
                        <input name="prenom" id="prenom" type="text" maxlength="50" placeholder="|"
                               tabindex="5" <?php if (isset($prenom) && $prenom != '/') {
                            echo("value='" . $prenom . "'");
                        } ?> />
                    </p>
                </div>

                <div class="right-container">
                    <p>
                        <label for="email">Adresse e-mail*</label>
                        <input type="email" id="email" name="email" required maxlength="50" placeholder="|"
                               tabindex="6" <?php if (isset($email)) {
                            echo("value='" . $email . "'");
                        } ?> />
                    </p>
                    <p>
                        <label for="password">Mot de passe*</label><br>
                    <div class="mdp-explain">Au moins 8 caractères et doit contenir au moins une majuscule, minuscule,
                        chiffre et caractère spécial(@$!%*#&)
                    </div>
                    <input type="password" id="password" name="password" required size="16" minlength="8" maxlength="20"
                           placeholder="********" tabindex="7" <?php if (isset($password)) {
                        echo("value='" . $password . "'");
                    } ?> />
                    </p>
                    <p>
                        <label for="password2">Confirmez le mot de passe*</label>
                        <input type="password" id="password2" name="password2" required size="16" minlength="8"
                               maxlength="20" placeholder="********" tabindex="8" <?php if (isset($password2)) {
                            echo("value='" . $password2 . "'");
                        } ?> />
                    </p>
                    <p>
                        <label for="robot" class="container">
                            <input required type="checkbox" id="robot" name="robot" tabindex="9"/>
                            <span class="checkmark"></span>
                            Je ne suis pas un robot
                        </label>
                    </p>
                    <p>
                        <label for="conditions" class="container">
                            <input required type="checkbox" id="conditions" name="conditions" tabindex="10"/>
                            <span class="checkmark"></span>
                            J'accepte les conditions d'utilisation
                        </label>
                    </p>
                </div>
            </div>

            <p class="align-right">
                <a href="connexion" class="cta-yellow" tabindex="11">Se connecter via un compte</a>
                <button class="cta-blue" type="submit" id="soumission" name="soumission" tabindex="12">Créer un compte
                </button>
            </p>

        </form>
    </div>
</main>
<script src="../public/js/inscription.js"></script>
<script src="../public/js/utils.js"></script>