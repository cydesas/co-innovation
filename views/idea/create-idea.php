<body>
<main>
    <form action="" method="POST">
        <div class="idee-container-haut">
            <div class="grid idee-container-haut2">
                <section class="grid idee-entete">
                    <h3>1- Présentation</h3>
                    <article class="idee-bloc grid">
                        <div class="idee-bloc-left">
                            <p>
                                <label for="titreIdee" id="lbl-titreIdee">Nom du projet*</label>
                                <input name="titreIdee" id="titreIdee" type="text" maxlength="48" placeholder="|"
                                       tabindex="1" required
                                    <?php if (isset($idea)) : ?>
                                       value='<?= $idea['titre_idee'] ?>'
                                <?php endif; ?>
                            </p>
                            <p>
                                <label for="domaineIdee">Domaine*</label>
                                <select id="domaineIdee" name="domaineIdee" tabindex="2">
                                    <?php foreach ($domaines as $domaine) : ?>
                                        <option value='<?= $domaine["id_idee_domaine"] ?>'
                                            <?php if (isset($idea) && $domaine["id_idee_domaine"] == $idea["id_idee_domaine"]) : ?>
                                                selected
                                            <?php endif; ?>
                                        >
                                            <?= $domaine['libelle_idee_domaine'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </p>
                            <p>
                                <label for="visuelIdee">Ajoutez une image pour la présentation (2 Mo max)</label>
                            </p>
                            <div id="drop_file_zone" class="drop_file"
                                 ondrop="upload_file(event, '#drop_file_zone', '#hiddenImgSrc')"
                                 ondragover="return false">
                                <div id="drag_upload_file" class="drag_upload">
                                    <p>Déposez une image ici<br>
                                        ou
                                    </p>
                                    <input type="button" class="cta-blue" id="btnfile" value="Sélectionnez un fichier"
                                           tabindex="3"
                                           onclick="file_explorer('selectfile', '#drop_file_zone', '#hiddenImgSrc');"/>
                                    <input type="file" id="selectfile" class="selectfile"
                                           accept=".png, .gif, .jpg, .jpeg" tabindex="4"/>
                                    <input type="hidden" id="hiddenImgSrc" name="hiddenImgSrc"
                                        <?php if (isset($idea)) : ?>
                                           value="<?= $idea['visuel_idee_one'] ?>"/>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="img-content"></div>
                        </div>
                        <div class="idee-bloc-resume">
                            <p class="resume">
                                <label for="resumeeIdee">Résumé de votre projet (500 characters max)*</label>
                                <textarea name="resumeeIdee" id="resumeeIdee" maxlength="500" tabindex="5"></textarea>
                                <input type="hidden" id="hiddenResumeIdea" name="hiddenResumeIdea"
                                    <?php if (isset($idea)) : ?>
                                       value="<?= $idea['resume_idee'] ?>"/>
                                <?php endif; ?>
                            </p>
                        </div>
                    </article>
                </section>
            </div>
        </div>

        <div class="idee-container-bas">
            <h3>2- Détails</h3>
            <section class="idee-description">
                <p>
                    <label for="descriptionIdee">Décrivez votre projet (3000 characters max)*</label><br>
                    <textarea name="descriptionIdee" id="descriptionIdee" maxlength="3000" tabindex="6"></textarea>
                    <input type="hidden" id="hiddenDescIdea" name="hiddenDescIdea"
                        <?php if (isset($idea)) : ?>
                           value="<?= $idea['objet_idee'] ?>"/>
                    <?php endif; ?>
                </p>
            </section>
            <p>
                <label for="est_protegee" class="container">
                    <input type="checkbox" id="est_protegee" name="est_protegee"
                           tabindex="7"
                            <?php if (isset($est_protegee)) : ?>
                           checked
                            <?php endif; ?>/>
                    <span class="checkmark"></span>
                    Cette idée est protégée
                </label>
            </p>
            <p class="align-right">
                <button class="cta-yellow" type="submit" id="brouillon" name="brouillon" tabindex="8">Enregistrer dans
                    le brouillon
                </button>
                <button class="cta-blue" type="submit" id="soumission" name="soumission" tabindex="9">Finaliser et
                    publier
                </button>
            </p>
        </div>
    </form>
</main>
<script src="../public/js/simplemde.min.js"></script>
<script src="../public/js/utils.js"></script>
<script src="../public/js/idees.js"></script>