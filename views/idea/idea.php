<?php use utils\SessionHelpers; ?>
<body>
<main>
    <div class="idee-container-haut">
        <div class="grid idee-container-haut2">
            <section class="grid idee-entete">
                <?php if ($values['est_protegee_idee']) : ?>
                    <h1 class="idee-nom">Cette idée est protégée | <?= $values['libelle_idee_domaine'] ?></h1>
                <?php else : ?>
                    <h1 class="idee-nom"><?= $values['titre_idee'] ?>
                        | <?= ucfirst($values['libelle_idee_domaine']) ?></h1>
                <?php endif; ?>

                <p class="idee-createur">Par <?= $values['nom_utilisateur'] . " " . $values['prenom_utilisateur'] ?> |
                    Le <?= date("d M Y", strtotime($values['date_creation_idee'])) ?></p>
                <article class="idee-bloc grid">
                    <div class="idee-bloc-left">
                        <div class="carousel-idee">
                            <?php if ($values['est_protegee_idee']) : ?>
                                <img class="idee-visuel" src="../public/img/protected.jpg"
                                    alt="Cette idée est protégée">
                            <?php else : ?>
                                <div class="carousel-left"><i class="fa-solid fa-caret-left"></i></div>
                                <img data-target="thumb-1" class="idee-visuel active" src="../public/img/<?= $values['visuel_idee_one'] ?>"
                                    alt="<?= $values['titre_idee'] ?>">
                                <img data-target="thumb-2" class="idee-visuel" src="../public/img/<?= $values['visuel_idee_two'] ?>"
                                    alt="<?= $values['titre_idee'] ?>">
                                <img data-target="thumb-3" class="idee-visuel" src="../public/img/<?= $values['visuel_idee_three'] ?>"
                                    alt="<?= $values['titre_idee'] ?>">
                                <img data-target="thumb-4" class="idee-visuel" src="../public/img/<?= $values['visuel_idee_four'] ?>"
                                    alt="<?= $values['titre_idee'] ?>">
                                <img data-target="thumb-5" class="idee-visuel" src="../public/img/<?= $values['visuel_idee_five'] ?>"
                                    alt="<?= $values['titre_idee'] ?>">
                                <div class="carousel-right"><i class="fa-solid fa-caret-right"></i></div>
                            <?php endif; ?>
                            </div>
                        <div class="thumbnails">

                            <?php if ($values['est_protegee_idee']) : ?>
                                <img class="idee-visuel" src="../public/img/protected.jpg"
                                    alt="Cette idée est protégée">
                            <?php else : ?>
                                <img id="thumb-1" data-count="0" class="thumbs active" src="../public/img/<?= $values['visuel_idee_one'] ?>"
                                    alt="<?= $values['titre_idee'] ?>">
                                <img id="thumb-2" data-count="1" class="thumbs" src="../public/img/<?= $values['visuel_idee_two'] ?>"
                                    alt="<?= $values['titre_idee'] ?>">
                                <img id="thumb-3" data-count="2" class="thumbs" src="../public/img/<?= $values['visuel_idee_three'] ?>"
                                    alt="<?= $values['titre_idee'] ?>">
                                <img id="thumb-4" data-count="3" class="thumbs" src="../public/img/<?= $values['visuel_idee_four'] ?>"
                                    alt="<?= $values['titre_idee'] ?>">
                                <img id="thumb-5" data-count="4" class="thumbs" src="../public/img/<?= $values['visuel_idee_five'] ?>"
                                    alt="<?= $values['titre_idee'] ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="idee-bloc-right">
                        <?php if ($values['est_protegee_idee']) : ?>
                            <input type="hidden" name="hiddenResume" id="hiddenResume"
                                   value="# Cette idée est protégée"/>
                            <p class="resume" id="afficheResume">
                            </p>
                        <?php else : ?>
                            <input type="hidden" name="hiddenResume" id="hiddenResume"
                                   value="<?= $values['resume_idee'] ?>"/>
                            <p class="resume" id="afficheResume">
                            </p>
                        <?php endif; ?>
                        <p>
                            <?php if (SessionHelpers::isLogin() && $_SESSION['USER_TYPE'] == ADMINISTRATEUR) :
                                if ($values['id_idee_statut'] == IDEE_A_MODERER) : ?>
                                    <a href="publication-idee?idee=<?= $values['id_idee'] ?>">
                                        <button class="cta-blue">Publier</button>
                                    </a>
                                <?php elseif ($_SESSION['id_utilisateur'] != $values['id_utilisateur']) : ?>
                                    <a href="profil?id=<?= $values['id_utilisateur'] ?>">
                                        <button class="cta-blue">Entrer en contact</button>
                                    </a>
                                    <a href="profil?id=<?= $values['id_utilisateur'] ?>">
                                        <button class="cta-red"><i class="fa-regular fa-heart"></i> J'aime</button>
                                    </a>
                                <?php endif; ?>
                            <?php else :
                                if (SessionHelpers::isLogin() && SessionHelpers::getConnected() == $values['id_utilisateur']) :
                                    if ($values['id_idee_statut'] == IDEE_BROUILLON) : ?>
                                        <a href="edit-idee?id=<?= $values['id_idee'] ?>">
                                            <button class="cta-blue">Modifier</button>
                                        </a>
                                    <?php endif;
                                else: ?>
                                    <a href="profil?id=<?= $values['id_utilisateur'] ?>">
                                        <button class="cta-blue">Entrer en contact</button>
                                    </a>
                                    <button class="cta-red" onclick="like()"><?= $nb_likes ?>
                                        <?php if ($is_liked) : ?>
                                            <i class="fa-solid fa-heart"></i> Je n'aime plus
                                        <?php else: ?>
                                            <i class="fa-regular fa-heart"></i> J'aime
                                        <?php endif; ?>
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </p>
                    </div>
                </article>
            </section>
        </div>
    </div>

    <div class="idee-container-bas">
        <h2 class="presentation-title"><span>Description du projet</span></h2>
        <section class="idee-description">

            <div class="idee-onglet">
                
                <div class="arrow-l" href="#arrow-l"><i class="fa-sharp fa-solid fa-angle-left"></i></div>
                <ul class="list_onglet">
                    
                    <li class="active" data-target="onglet-1"><div><i class="fa-sharp fa-solid fa-house"></i> Description</div></li>
                    <li data-target="onglet-2"><div><i class="fa-sharp fa-solid fa-house"></i> Ressources</div></li>
                    <li data-target="onglet-3"><div><i class="fa-sharp fa-solid fa-house"></i> F.A.Q</div></li>
                    <li data-target="onglet-4"><div><i class="fa-sharp fa-solid fa-house"></i> Commentaire</div></li>
                    <li data-target="onglet-5"><div><i class="fa-sharp fa-solid fa-house"></i> Porteur d'idée</div></li>
                    
                </ul>
                <div class="arrow-r"><i class="fa-sharp fa-solid fa-angle-right"></i></div>
                
                

            </div>

            <div class="idee-content">
                <div class="onglet-idee active" id="onglet-1">
                    <?php if ($values['est_protegee_idee']) : ?>
                        <input type="hidden" name="hiddenDesc" id="hiddenDesc" value="# Cette idée est protégée par sont auteur.
                        ## Pour en connaître le contenu, entrez en contact avec lui."/>
                        <p id="afficheDesc">
                    <?php else : ?>
                        <?php foreach($section_idee as $section){
                                echo '<h2>' . $section['title_section_idee'] . '</h2>' ;
                                echo '<p id="afficheDesc">' . $section['desc_section_idee'] . '</p>';
                            }
                        ?>

                    <?php endif; ?>
                </div>

                <div class="onglet-idee" id="onglet-2">
                <?php if ($values['est_protegee_idee']) : ?>
                        <input type="hidden" name="hiddenDesc" id="hiddenDesc" value="# Cette idée est protégée par sont auteur.
                        ## Pour en connaître le contenu, entrez en contact avec lui."/>
                        <p id="afficheDesc">
                    <?php else : ?>
                        <h2>Spécification</h2>
                        <p id="afficheDesc"><?= $values['spec_ressource_idee'] ?></p>

                        <h2>Ressources financières</h2>
                        <p id="afficheDesc"><?= $values['finance_ressource_idee'] ?></p>

                        <h2>Ressources humaines</h2>
                        <p id="afficheDesc"><?= $values['humain_ressource_idee'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="onglet-idee" id="onglet-3">
                    <div class="accordion">
                        <?php foreach($faq_idee as $faq){
                                echo '<div class="faq-box">';
                                echo '<div class="faq-label"><h3>' . $faq['question_faq'] . '</h3></div>' ;
                                echo '<p class="faq-content" id="afficheDesc">' . $faq['answer_faq'] . '</p></div>';
                            }
                        ?>
                    </div>
                    
                </div>

                <div class="onglet-idee" id="onglet-4">
                    <section class="full-comments">
                        <ul>
                            <?php 
                            if($comments_idee <=1) echo '<h3>'.count($comments_idee). ' commentaire</h3>';
                            else echo '<h4>'.count($comments_idee). ' commentaires</h4>';
                            foreach($comments_idee as $comment){
                                    echo '<li><div class="comment">' ;
                                    echo '<div class="comment-img"><img src="../public/img/user-avatar-filled.png" alt="avatar"></div>';
                                    echo '<div class="comment-content">';
                                    echo '<div class="comment-head">' . $comment['nom_utilisateur'].' '. $comment['prenom_utilisateur']. '</div>';
                                    echo '<div class="comment-body">' . $comment['desc_comment'].'</div>';
                                    echo '</div></div></li>';
                                }
                            ?>
                        </ul>
                    </section>
                </div>

                <div class="onglet-idee" id="onglet-5">
                    <div class="card">
                        <img class="card-img" src="../public/img/<?=$values['visuel_profil_utilisateur']?>" alt="profil utilisateur">
                        <div class="card-content">
                            <div class="card-name">
                                <p><?=$values['nom_utilisateur']?> <?=$values['prenom_utilisateur']?></p>
                            </div>
                            <div class="card-desc">
                                <p><?=$values['description_utilisateur']?></p>
                            </div>
                            <div class="card-social">
                                <a href="<?=$values['url_linkedin_utilisateur']?>"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="<?=$values['url_twitter_utilisateur']?>"><i class="fa-brands fa-twitter"></i></a>
                                <a href="<?=$values['url_facebook_utilisateur']?>"><i class="fa-brands fa-facebook"></i></a>
                                <a href="<?=$values['url_instagram_utilisateur']?>"><i class="fa-brands fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </section>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script src="../public/js/grille-idees.js"></script>
<script src="../public/js/idees.js"></script>