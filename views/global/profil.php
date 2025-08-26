<?php use utils\SessionHelpers; ?>
<body>
<main>
    <input type="hidden" name="utilisateur" id="utilisateur" value="<?= $user['id_utilisateur'] ?>"/>

    <?php if ($user['id_utilisateur_type'] == ENTREPRISE || $user['id_utilisateur_type'] == ESN) : ?>
        <div class="image-couverture">
            <img src="img/<?= $user['visuel_banner_utilisateur'] ?>"/>
        </div>
        <section class="grid-entreprise profil-entreprise">
            <img class="pprofil" src="<?= $user['visuel_logo_utilisateur'] ?>">
            <article class="pres-entreprise">
                <div>
                    <h3><?= $user['raison_sociale_utilisateur'] ?> |</h3>
                    <h3><?= $user['presentation_utilisateur'] ?></h3>
                    <p><?= $user['description_utilisateur'] ?></p>
                </div>

                <div class="btn-profil">
                    <?php if (SessionHelpers::isLogin()) : ?>
                        <a href="edit-profil" class="cta-blue-profil">Modifier</a>
                        <a href="edit-idee" class="cta-yellow">Proposer une idée</a>
                    <?php else : ?>
                        <a href="#" class="cta-blue-profil">Entrer en contact</a>
                    <?php endif; ?>
                    <div class="profil-social">
                        <a href="<?= $user['url_linkedin_utilisateur'] ?>" target="_blank">
                            <i class="fa-brands fa-linkedin fa-2x"></i>
                        </a>
                        <a href="<?= $user['url_twitter_utilisateur'] ?>" target="_blank">
                            <i class="fa-brands fa-twitter fa-2x"></i>
                        </a>
                        <a href="<?= $user['url_instagram_utilisateur'] ?>" target="_blank">
                            <i class="fa-brands fa-instagram fa-2x"></i>
                        </a>
                        <a href="<?= $user['url_facebook_utilisateur'] ?>" target="_blank">
                            <i class="fa-brands fa-facebook fa-2x"></i>
                        </a>
                    </div>
                </div>
            </article>
        </section>
    <?php endif; ?>
    <?php if ($user['id_utilisateur_type'] == PARTICULIER || $user['id_utilisateur_type'] == ADMINISTRATEUR) : ?>
        <section class="profil grid">
            <img class="pprofil" src="../public/img/<?= $user['visuel_profil_utilisateur'] ?>">
            <article class="pres-particulier">
                <div>
                    <h3><?= $user['prenom_utilisateur'] . " " . $user['nom_utilisateur'] ?> |</h3>
                    <h3><?= $user['presentation_utilisateur'] ?></h3>
                    <p><?= $user['description_utilisateur'] ?></p>
                </div>

                <div class="btn-profil">
                    <?php if (SessionHelpers::isLogin()) : ?>
                        <a href="edit-profil" class="cta-blue-profil">Modifier le profil</a>
                        <a href="edit-idee" class="cta-yellow">Proposer une idée</a>
                    <?php else : ?>
                        <a href="#" class="cta-blue-profil">Entrer en contact</a>
                    <?php endif; ?>
                    <div class="profil-social">
                        <a href="<?= $user['url_linkedin_utilisateur'] ?>" target="_blank">
                            <i class="fa-brands fa-linkedin fa-2x"></i>
                        </a>
                        <a href="<?= $user['url_twitter_utilisateur'] ?>" target="_blank">
                            <i class="fa-brands fa-twitter fa-2x"></i>
                        </a>
                        <a href="<?= $user['url_instagram_utilisateur'] ?>" target="_blank">
                            <i class="fa-brands fa-instagram fa-2x"></i>
                        </a>
                        <a href="<?= $user['url_facebook_utilisateur'] ?>" target="_blank">
                            <i class="fa-brands fa-facebook fa-2x"></i>
                        </a>
                    </div>
                </div>
            </article>
        </section>
    <?php endif; ?>

    <section class="grid grid-idees">
        <H2 class="dernieres-idees">Dernières idées publiées</H2>
    </section>
    <section class="grid grid-idees ideas-container">
        <?php if($ideas != null) : foreach ($ideas as $idea) :
            if ($idea['id_idee_statut'] == 3) : ?>
                <div class="idea">
                    <div class="idea-img">
                        <img src="../public/img/<?= $idea['visuel_idee_one'] ?>" alt=""/>
                    </div>
                    <div class="idea-content">
                        <h3><?= $idea['titre_idee'] ?></h3>
                        <a href="idee?id=<?= $idea['id_idee'] ?>" class="cta-blue">Voir l'idée</a>
                    </div>
                </div>
            <?php endif;
        endforeach; endif; ?>
    </section>

    <section class="grid grid-idees">
        <H2 class="dernieres-idees">Brouillons</H2>
    </section>
    <section class="grid grid-idees ideas-container2">
        <?php if($ideas != null) : foreach ($ideas as $idea) :
            if ($idea['id_idee_statut'] == 1) : ?>
                <div class="idea">
                    <div class="idea-img">
                        <img src="../public/img/<?= $idea['visuel_idee_one'] ?>" alt=""/>
                    </div>
                    <div class="idea-content">
                        <h3><?= $idea['titre_idee'] ?></h3>
                        <a href="idee?id=<?= $idea['id_idee'] ?>" class="cta-blue">Voir l'idée</a>
                    </div>
                </div>
            <?php endif;
        endforeach; endif; ?>
    </section>

    <section class="grid grid-idees">
        <H2 class="dernieres-idees">En attente de modération</H2>
    </section>
    <section class="grid grid-idees ideas-container3">
        <?php if($ideas != null) : foreach ($ideas as $idea) :
            if ($idea['id_idee_statut'] == 2) : ?>
                <div class="idea">
                    <div class="idea-img">
                        <img src="../public/img/<?= $idea['visuel_idee_one'] ?>" alt=""/>
                    </div>
                    <div class="idea-content">
                        <h3><?= $idea['titre_idee'] ?></h3>
                        <a href="idee?id=<?= $idea['id_idee'] ?>" class="cta-blue">Voir l'idée</a>
                    </div>
                </div>
            <?php endif;
        endforeach; endif; ?>
    </section>

</main>
<script src="../public/js/idees.js"></script>
<script src="../public/js/profil-idees.js"></script>