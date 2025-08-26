<?php  use utils\Common; ?>
<body>
<main>

    <section class="grid grid-idees">

        <div class="titrefiltres titreflitres1">
            <div class="filtrenom">
                <h4>Domaine</h4>
                <div class="trait"></div>
            </div>
            <div class="checkbox checkbox1">
                <?php
                for ($i = 0; $i < 3; $i++) : ?>
                    <label class="container"><?= ucfirst($domaines[$i]["libelle_idee_domaine"]) ?><input
                                id="domain<?= $domaines[$i]["id_idee_domaine"] ?>" type="checkbox"
                                checked><span class="checkmark"></span></label>
                <?php endfor; ?>
            </div>
            <div class="checkbox checkbox2">
                <?php for ($i; $i < count($domaines); $i++) : ?>
                    <label class="container"><?= ucfirst($domaines[$i]["libelle_idee_domaine"]) ?><input
                                id="domain<?= $domaines[$i]["id_idee_domaine"] ?>" type="checkbox"
                                checked><span class="checkmark"></span></label>
                <?php endfor; ?>
            </div>
        </div>

        <div class="titrefiltres titreflitres2">
            <div class="filtrenom">
                <h4>Créateur</h4>
                <div class="trait"></div>
            </div>
            <div class="checkbox checkbox3">
                <?php foreach ($types_utilisateur as $type) :
                    if ($type["libelle_utilisateur_type"] === "administrateur" || $type["libelle_utilisateur_type"] === "esn") :
                        continue;
                    else : ?>
                        <label class="container"><?= ucfirst($type["libelle_utilisateur_type"]) ?><input
                                    id="user<?= ucfirst($type["id_utilisateur_type"]) ?>" type="checkbox" checked><span
                                    class="checkmark"></span></label>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="pagination">
            <ul>
                <button id="filter"><i class="fa-solid fa-repeat"></i><i class="fa-solid fa-filter"></i></button>
                <?php
                /**
                 * Règles pagination :
                 * - S'il y a 5 pages ou moins, on affiche toute la pagination
                 * - S'il y a plus de 5 pages, on affiche la première, la dernière, la page courante et les 2 pages adjacentes
                 */
                if ($nb_pages <= 5) :
                    for ($i = 1; $i <= $nb_pages; $i++) :
                        if ($i == $_GET['page']) : ?>
                                    <li class="active"><a href="liste-idees?page=<?= $i ?>&<?= $url_filters ?>"><?= $i ?></a></li>
                        <?php else : ?>
                              <li><a href="liste-idees?page=<?= $i ?>&<?= $url_filters ?>"><?= $i ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                <?php else : ?>
                    <?php switch ($page) : case 1 : ?>
                        <li class="active"><a href="liste-idees?page=1&<?= $url_filters ?>">1</a></li>
                        <li><a href="liste-idees?page=2&<?= $url_filters ?>">2</a></li>
                        <li>...</li>
                        <li><a href="liste-idees?page=<?= $nb_pages ?>&<?= $url_filters ?>"><?= $nb_pages ?></a></li>
                    <?php break; case 2 : ?>
                        <li><a href="liste-idees?page=1&<?= $url_filters ?>">1</a></li>
                        <li class="active"><a href="liste-idees?page=2&<?= $url_filters ?>">2</a></li>
                        <li><a href="liste-idees?page=3&<?= $url_filters ?>">3</a></li>
                        <li>...</li>
                        <li><a href="liste-idees?page=<?= $nb_pages ?>&<?= $url_filters ?>"><?= $nb_pages ?></a></li>
                    <?php break; case $nb_pages-1 : ?>
                        <li><a href="liste-idees?page=1&<?= $url_filters ?>">1</a></li>
                        <li>...</li>
                        <li><a href="liste-idees?page=<?= $nb_pages-2 ?>&<?= $url_filters ?>"><?= $nb_pages-2 ?></a></li>
                        <li class="active"><a href="liste-idees?page=<?= $nb_pages-1 ?>&<?= $url_filters ?>"><?= $nb_pages-1 ?></a></li>
                        <li><a href="liste-idees?page=<?= $nb_pages ?>&<?= $url_filters ?>"><?= $nb_pages ?></a></li>
                    <?php break; case $nb_pages : ?>
                        <li><a href="liste-idees?page=1&<?= $url_filters ?>">1</a></li>
                        <li>...</li>
                        <li><a href="liste-idees?page=<?= $nb_pages-1 ?>&<?= $url_filters ?>"><?= $nb_pages-1 ?></a></li>
                        <li class="active"><a href="liste-idees?page=<?= $nb_pages ?>&<?= $url_filters ?>"><?= $nb_pages ?></a></li>
                    <?php break; default : ?>
                        <li><a href="liste-idees?page=1&<?= $url_filters ?>">1</a></li>
                        <li>...</li>
                        <li><a href="liste-idees?page=<?= $page-1 ?>&<?= $url_filters ?>"><?= $page-1 ?></a></li>
                        <li class="active"><a href="liste-idees?page=<?= $page ?>&<?= $url_filters ?>"><?= $page ?></a></li>
                        <li><a href="liste-idees?page=<?= $page+1 ?>&<?= $url_filters ?>"><?= $page+1 ?></a></li>
                        <li>...</li>
                        <li><a href="liste-idees?page=<?= $nb_pages ?>&<?= $url_filters ?>"><?= $nb_pages ?></a></li>
                    <?php endswitch; ?>
                <?php endif; ?>
            </ul>
        </div>
    </section>

    <?php $i = 1; // compteur pour définir le numéro de la classe "cartel" pour l'élément article ?>
    <section class="grid grid-idees ideas-container">
        <?php if($ideas != null) :
        foreach ($ideas as $idea) :

            if (!isset($idea["id_idee"])) :
                break;
            endif;

            if ($idea["est_protegee_idee"]) :
                $img = "protected.jpg" and $titre = "Cette idée est protégée";
            else :
                $img = $idea["visuel_idee_one"] and $titre = $idea["titre_idee"];
            endif; ?>

            <article class="cartel cartel<?= $i ?>">
                <a class="cartel-anchor" href="idee?idee=<?= $idea['id_idee'] ?>">
                    <div class="img-cartel">
                        <img src="public/img/<?= $img ?>" alt="<?= $titre ?>">
                    </div>
                    <div class="text">
                        <div class="text-haut"><h4 class="nom"><?= $titre ?></h4>
                            <div class="domaine"><h4><?= ucfirst($idea["libelle_idee_domaine"]) ?></h4></div>
                        </div>
                        <p class="date"><?= Common::convertDate($idea['date_creation_idee']) ?></p>
                        <?php if ($idea["Total"] == null) : ?>
                            <p class="nb-likes">0 <i class="fa-solid fa-heart"></i></p>
                        <?php else : ?>
                            <p class="nb-likes"><?= $idea["Total"] ?> <i class="fa-solid fa-heart"></i></p>
                        <?php endif; ?>
                    </div>
                </a>
                <?php if($i >= 3) : $i = 1; else : $i++; endif; ?>
            </article>
        <?php endforeach; endif; ?>
    </section>

</main>
<script src="../public/js/idees.js"></script>
<script src="../public/js/grille-idees.js"></script>