<body>
<main>
    <div class="grid">

        <form class="form-inscription" action="" method="POST">

            <div class="idee-container-haut">
                <div class="grid idee-container-haut2">
                    <section class="grid idee-entete">
                        <h1>Modifiez votre profil</h1>
                        <article class="idee-bloc grid">
                            <div class="idee-bloc-left">

                                <?php
                                if ($user['id_utilisateur_type'] == PARTICULIER || $user['id_utilisateur_type'] == ADMINISTRATEUR) : ?>
                                    <p>
                                        <label for="photoProfil">Ajoutez une photo pour la présentation (2 Mo
                                            max)</label>
                                    </p>
                                    <div id="drop_file_zone" class="drop_file"
                                         ondrop="upload_file(event, '#drop_file_zone', '#hiddenImgSrc')"
                                         ondragover="return false"
                                         style="background-size: contain; background-image: url(<?= "/public/img/" . $user['visuel_profil_utilisateur'] ?>);">
                                        <div id="drag_upload_file" class="drag_upload">
                                            <p>Déposez une image ici<br>
                                                ou
                                            </p>
                                            <input type="button" class="cta-blue" id="btnfile"
                                                   value="Sélectionnez un fichier" tabindex="3"
                                                   onclick="file_explorer('selectfile', '#drop_file_zone', '#hiddenImgSrc');"/>
                                            <input type="file" id="selectfile" class="selectfile"
                                                   accept=".png, .gif, .jpg, .jpeg" tabindex="4"/>
                                            <input type="hidden" id="hiddenImgSrc" name="hiddenImgSrc"
                                                   value="<?= $user['visuel_profil_utilisateur'] ?>"/>
                                        </div>
                                    </div>
                                    <div class="img-content"></div>
                                <?php endif; ?>

                                <?php if ($user['id_utilisateur_type'] == ENTREPRISE || $user['id_utilisateur_type'] == ESN) : ?>
                                    <p>
                                        <label for="banniere">Ajoutez une bannière pour la présentation (2 Mo
                                            max)</label>
                                    </p>
                                    <div id="drop_file_zone" class="drop_file drop_file_banner"
                                         ondrop="upload_file(event, '#drop_file_zone', '#hiddenImgSrc')"
                                         ondragover="return false">
                                        <div id="drag_upload_file" class="drag_upload">
                                            <p>Déposez une image ici<br>
                                                ou
                                            </p>
                                            <input type="button" class="cta-blue" id="btnfile"
                                                   value="Sélectionnez un fichier" tabindex="3"
                                                   onclick="file_explorer('selectfile', '#drop_file_zone', '#hiddenImgSrc');"/>
                                            <input type="file" id="selectfile" class="selectfile"
                                                   accept=".png, .gif, .jpg, .jpeg" tabindex="4"/>
                                            <input type="hidden" id="hiddenImgSrc" name="hiddenImgSrc"
                                                   value="<?= $user['visuel_banner_utilisateur'] ?>"/>
                                        </div>
                                    </div>
                                    <div class="img-content"></div>
                                    <p>
                                        <label for="logo">Ajoutez un logo pour la présentation (2 Mo max)</label>
                                    </p>
                                    <div id="drop_file_zone2" class="drop_file"
                                         ondrop="upload_file(event, '#drop_file_zone2', '#hiddenImgSrc2')"
                                         ondragover="return false">
                                        <div id="drag_upload_file2" class="drag_upload">
                                            <p>Déposez une image ici<br>
                                                ou
                                            </p>
                                            <input type="button" class="cta-blue" id="btnfile2"
                                                   value="Sélectionnez un fichier" tabindex="3"
                                                   onclick="file_explorer('selectfile2', '#drop_file_zone2', '#hiddenImgSrc2');"/>
                                            <input type="file" id="selectfile2" class="selectfile"
                                                   accept=".png, .gif, .jpg, .jpeg" tabindex="4"/>
                                            <input type="hidden" id="hiddenImgSrc2" name="hiddenImgSrc2"
                                                   value="<?= $user['visuel_logo_utilisateur'] ?>"/>
                                        </div>
                                    </div>
                                    <div class="img-content"></div>
                                <?php endif; ?>

                            </div>
                            <div class="idee-bloc-resume">
                                <p>
                                    <label for="presentation" id="lbl-presentation">Présentez-vous (max 65
                                        caractères)</label>
                                    <input name="presentation" id="presentation" type="text" maxlength="65"
                                           placeholder="|"
                                           tabindex="2"
                                           value="<?= $user['presentation_utilisateur'] ?>"
                                    />
                                </p>
                                <p>
                                    <label for="description" id="lbl-description">Décrivez votre activité (max 255
                                        caractères)</label>
                                    <input name="description" id="description" type="text" maxlength="255"
                                           placeholder="|"
                                           tabindex="2"
                                           value="<?= $user['description_utilisateur'] ?>"
                                    />
                                </p>
                                <p>
                                    <label for="linkedin" id="lbl-linkedin">Adresse de votre page Linkedin</label>
                                    <input name="linkedin" id="linkedin" type="text" maxlength="75" placeholder="|"
                                           tabindex="2"
                                           value="<?= $user['url_linkedin_utilisateur'] ?>"
                                    />
                                </p>
                                <p>
                                    <label for="twitter" id="lbl-twitter">Adresse de votre page Twitter</label>
                                    <input name="twitter" id="twitter" type="text" maxlength="75" placeholder="|"
                                           tabindex="2"
                                           value="<?= $user['url_twitter_utilisateur'] ?>"
                                    />
                                </p>
                                <p>
                                    <label for="instagram" id="lbl-instagram">Adresse de votre page Instagram</label>
                                    <input name="instagram" id="instagram" type="text" maxlength="75" placeholder="|"
                                           tabindex="2"
                                           value="<?= $user['url_instagram_utilisateur'] ?>"
                                    />
                                </p>
                                <p>
                                    <label for="facebook" id="lbl-facebook">Adresse de votre page Facebook</label>
                                    <input name="facebook" id="facebook" type="text" maxlength="75" placeholder="|"
                                           tabindex="2"
                                           value="<?= $user['url_facebook_utilisateur'] ?>"
                                    />
                                </p>
                                <p>
                                    <button class="cta-blue" type="submit" id="soumission" name="soumission"
                                            tabindex="12">Enregistrer les modifications
                                    </button>
                                </p>
                            </div>
                        </article>
                    </section>
                </div>
            </div>
        </form>
    </div>
</main>
<script src="/public/js/utils.js"></script>