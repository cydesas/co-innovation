<body>
<main>
    <input type="hidden" name="utilisateur" id="utilisateur" value="<?=$_SESSION['id_utilisateur']?>" />

    <section class="profil grid">
        <img class ="pprofil" src="img/<?=$visuel_profil?>">
        <article class="pres-particulier">
            <div>
                <h3><?=$prenom." ".$nom?> |</h3>
                <h3>Administrateur</h3>
                <p></p>
            </div>

            <div class="btn-profil">
                <a href="edition-profil.php" class="cta-blue-profil">Modifier le profil</a>

                <div class="profil-social">
                    <a href="<?=$url_linkedin?>" target="_blank">
                        <i class="fa-brands fa-linkedin fa-2x"></i>
                    </a>
                    <a href="<?=$url_twitter?>" target="_blank">
                        <i class="fa-brands fa-twitter fa-2x"></i>
                    </a>
                    <a href="<?=$url_instagram?>" target="_blank">
                        <i class="fa-brands fa-instagram fa-2x"></i>
                    </a>
                    <a href="<?=$url_facebook?>" target="_blank">
                        <i class="fa-brands fa-facebook fa-2x"></i>
                    </a>
                </div>
            </div>
        </article>
    </section>

    <section class="grid grid-idees">
        <H2 class="dernieres-idees">idées en attente de modération</H2>
        <div class="pagination">
        </div>
    </section>

    <section class="grid grid-idees ideas-container">
    </section>

</main>
<script src="../public/js/idees.js"></script>
<script src="../public/js/admin-idees.js"></script>