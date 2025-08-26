<?php

namespace models;

use utils\SessionHelpers;

class IdeaModel extends \models\base\SQL
{
    public function __construct()
    {
        parent::__construct('idee', 'id_idee');
    }

    /**
     * Permet de récupérer la table idee_domaine
     * @return array|void
     */
    public function getDomains()
    {
        $query = $this->pdo->prepare("SELECT * FROM idee_domaine");
        $query->execute();
        $result = $query->fetchAll();

        if ($result) {
            return $result;
        }
    }


    /**
     * Permet de récupérer la table utilisateur_type
     * @return array|void
     */
    public function getUserTypes()
    {
        $query = $this->pdo->prepare("SELECT * FROM utilisateur_type");
        $query->execute();
        $result = $query->fetchAll();

        if ($result) {
            return $result;
        }
    }


    /**
     * Cette méthode permet de générer une requête SQL pour récupérer les idées à afficher
     * en fonction des filtres sélectionnés
     * @return array|void
     */
    public function getFilter($page)
    {
        // Définition clause where selon les paramètres de l'URL
        $where = "WHERE idee.id_idee_statut = 3 ";

        // Si on filtre sur un ou plusieurs domaines
        if (isset($_GET['domaine'])) {
            $domaines = explode(';', $_GET['domaine']);
            $where .= " AND (vue_domaine_idee.id_idee_domaine = " . $domaines[0];

            if (count($domaines) >= 1) {
                for ($i = 1; $i < count($domaines); $i++) {
                    $where .= " OR vue_domaine_idee.id_idee_domaine = " . $domaines[$i];
                }
                $where .= ')';
            }
        }

        // Si on filtre sur un ou plusieurs types d'utilisateurs
        if (isset($_GET['type_utilisateur'])) {
            $utilisateurs = explode(';', $_GET['type_utilisateur']);
            $where .= " AND (utilisateur_type.id_utilisateur_type = " . $utilisateurs[0];

            if (count($utilisateurs) >= 1) {
                for ($i = 1; $i < count($utilisateurs); $i++) {
                    $where .= " OR utilisateur_type.id_utilisateur_type = " . $utilisateurs[$i];
                }
                $where .= ')';
            }
        }

        // Préparation & exécution de la requête
        $query = $this->pdo->prepare
        ("
            SELECT *, idee.id_idee FROM idee
                LEFT JOIN vue_domaine_idee ON (idee.id_idee= vue_domaine_idee.id_idee_vue)
                LEFT JOIN utilisateur_type ON (idee.id_utilisateur = utilisateur_type.id_utilisateur_type)
                LEFT JOIN nb_likes_par_idee ON (idee.id_idee = nb_likes_par_idee.id_idee) 
             " .
            $where
            . " ORDER BY idee.date_creation_idee DESC
            LIMIT ? OFFSET ?;
         ");
        $query->bindValue(2, ($page - 1) * 9, \PDO::PARAM_INT);
        $query->bindValue(1, 9, \PDO::PARAM_INT);
        $query->execute();  // on souhaite 9 résultats par page
        $result = $query->fetchAll();

        if ($result) {
            // On recommence une requête pour compter le nombre d'occurences trouvées avec ces critères
            // Il n'existe pas d'alternative pour compter le nombre de lignes retournées par une requête avec LIMIT
            $query2 = $this->pdo->prepare
            ("
                SELECT COUNT(*) FROM idee
                LEFT JOIN vue_domaine_idee ON idee.id_idee = vue_domaine_idee.id_idee_vue
                LEFT JOIN utilisateur_type ON idee.id_utilisateur = utilisateur_type.id_utilisateur_type " .
                $where
            );
            $query2->execute();
            $result2 = $query2->fetchAll();

            // On place cette information à la fin de notre tableau
            array_push($result, $result2[0]['COUNT(*)']);
            return $result;
        }
    }

    /**
     * Permet de récupérer les idées d'un utilisateur, en plus de son nom et son prénom
     * @param $id
     * @return array|void
     */
    public function getIdea($id)
    {
        $query = $this->pdo->prepare("SELECT idee.*, vue_domaine_idee.*, utilisateur.id_utilisateur, utilisateur.description_utilisateur, 
        utilisateur.visuel_profil_utilisateur, utilisateur.url_twitter_utilisateur, utilisateur.url_linkedin_utilisateur, 
        utilisateur.url_facebook_utilisateur, utilisateur.url_instagram_utilisateur, utilisateur.nom_utilisateur, 
        utilisateur.prenom_utilisateur FROM `idee`, `utilisateur`, `vue_domaine_idee` 
        WHERE id_idee = ? 
        AND utilisateur.id_utilisateur = idee.id_utilisateur;");
        $query->execute([$id]);
        $result = $query->fetchAll();

        if ($result) {
            return $result[0];
        }
    }

        /**
     * Permet de récupérer les section (description) d'une idee
     * @param $id
     * @return array|void
     */
    public function getSectionIdea($id)
    {
        $query = $this->pdo->prepare("SELECT section_idee.* FROM `section_idee` WHERE section_idee.i_id = ?;");
        $query->execute([$id]);
        $result = $query->fetchAll();

        if ($result) {
            return $result;
        }
    }

    /**
     * Permet de récupérer les faq d'une idee
     * @param $id
     * @return array|void
     */
    public function getFaqIdea($id)
    {
        $query = $this->pdo->prepare("SELECT faq.* FROM `faq` WHERE faq.i_id = ?");
        $query->execute([$id]);
        $result = $query->fetchAll();

        if ($result) {
            return $result;
        }
    }

    /**
     * Permet de récupérer les commentaires d'une idee
     * @param $id
     * @return array|void
     */
    public function getCommentsIdea($id)
    {
        $query = $this->pdo->prepare("SELECT comments.*, utilisateur.id_utilisateur, utilisateur.nom_utilisateur, 
        utilisateur.prenom_utilisateur FROM `comments`, `utilisateur` 
        WHERE comments.i_id = ? 
        AND utilisateur.id_utilisateur = comments.user_id;");
        $query->execute([$id]);
        $result = $query->fetchAll();

        if ($result) {
            return $result;
        }
    }


    /**
     * Permet de retourner le nombre de likes d'une idée
     * @param $id
     * @return mixed|void
     */
    public function getNbLikes($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM nb_likes_par_idee WHERE id_idee = ?");
        $query->execute([$id]);
        $result = $query->fetch();

        if ($result) {
            return $result;
        }
    }

    /**
     * Permet de retourner l'ensemble des idéees proposées par un utilisateur
     * @return array
     */
    public function getIdeasByUser($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM idee WHERE id_utilisateur = ?");
        $query->execute([$id]);
        $result = $query->fetchAll();

        if ($result) {
            return $result;
        }
    }

    /**
     * Permet de liker une idée
     * @return bool
     */
    public function likeIdea($id_idee): bool
    {
        // On va d'abord vérifier si l'utilisateur est authentifié ou non, afin de déterminer sur quelle table exécuter
        // la requête
        if (SessionHelpers::isLogin()) {
            $table = 'user_like';
            $table_pk = 'u_id';
            $id = SessionHelpers::getConnected();
        } else {
            $table = 'guest_like';
            $table_pk = 'g_id';
            $id = $this->getIPAddress();

            // On vérifie si l'utilisateur est déjà présent dans la table guest
            $query = $this->pdo->prepare("SELECT * FROM guest WHERE g_ip = ?");
            $query->execute([$id]);
            $result = $query->fetch();

            // Si l'IP n'est pas connue, alors on créé un nouvel enregistrement
            if (!$result) {
                $query = $this->pdo->prepare("INSERT INTO guest (g_ip) VALUES (?)");
                $query->execute([$id]);

                // On réutilise la variable $id pour récupérer l'id du guest
                $id = $this->pdo->lastInsertId();
            } else {
                $id = $result['g_id'];
            }
        }

        // On prépare et exécute la requête
        $query = $this->pdo->prepare("INSERT INTO " . $table . " (" . $table_pk . ", i_id) VALUES (?, ?)");
        return $query->execute([$id, $id_idee]);
    }

    /**
     * Cette fonction (qui sera probablement déplacée ultérieurement) permet de récupérer l'adresse IP de l'utilisateur
     * @return mixed
     */
    public function getIPAddress()
    {
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }

    /**
     * Fonction qui permet de vérifier si l'utilisateur est derrière un VPN/proxy
     * @param string $ip
     */
    function isValidIpAddress($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP,
                FILTER_FLAG_IPV4 |
                FILTER_FLAG_IPV6 |
                FILTER_FLAG_NO_PRIV_RANGE |
                FILTER_FLAG_NO_RES_RANGE) === false) {
            return false;
        }
        return true;
    }

    /**
     * Cette fonction permet de retirer le like d'une idée de la part d'un utilisateur ou d'un guest
     * @param $id_idee
     */
    public function unlikeIdea($id_idee): bool
    {
        // On va d'abord vérifier si l'utilisateur est authentifié ou non, afin de déterminer sur quelle table exécuter
        // la requête
        if (SessionHelpers::islogin()) {
            $table = 'user_like';
            $table_pk = 'u_id';
            $id = SessionHelpers::getConnected();
        } else {
            $table = 'guest_like';
            $table_pk = 'g_id';
            $ip = $this->getIPAddress();
            $query = $this->pdo->prepare("SELECT * FROM guest WHERE g_ip = ?");
            $query->execute([$ip]);
            $id = $query->fetch()['g_id'];
        }

        // On prépare et exécute la requête
        $query = $this->pdo->prepare("DELETE FROM " . $table . " WHERE " . $table_pk . " = ? AND i_id = ?");
        return $query->execute([$id, $id_idee]);
    }

    /**
     * Cette fonction permet de créer une nouvelle idée, ou d'en modifier une si un id est passé en paramètre (pas opti
     * mais logique de l'ancienne version gardée pour le moment
     * @return void
     */
    public function createIdea()
    {
        var_dump($_GET);
        if (isset($_POST['soumission']) || isset($_POST['brouillon'])) {
            extract($_POST);

            $statut_idee = (isset($soumission)) ? IDEE_A_MODERER : IDEE_BROUILLON;
            $protegee = (isset($est_protegee)) ? 1 : 0;

            // Modification d'une idée
            if (isset($_GET['id'])) {

                $result = $this->updateOne($_GET['id'], array(
                    'titre_idee' => $titreIdee,
                    'resume_idee' => $resumeeIdee,
                    // 'objet_idee' => $descriptionIdee,
                    'visuel_idee_one' => $hiddenImgSrc,
                    // 'id_idee_domaine' => $domaineIdee,
                    'id_idee_statut' => $statut_idee,
                    'est_protegee_idee' => $protegee,
                ));

                if (!$result) {
                    echo 'erreur lors de la modification de l\'idée';
                } else {
                    // redirection vers affichage de l'idée avec message de réussite enregistrement
                    echo '<script type="text/javascript">
                        window.location.replace("idee?id=' . $_GET['id'] . '");
                    </script>';
                    exit();
                }
            } else {

                // Création d'une idée
                $result = $this->insertOne(array(
                    'titre_idee' => $titreIdee,
                    'resume_idee' => $resumeeIdee,
                    // 'objet_idee' => $descriptionIdee,
                    'visuel_idee_one' => $hiddenImgSrc,
                    'id_utilisateur' => SessionHelpers::getConnected(),
                    // 'id_idee_domaine' => $domaineIdee,
                    'id_idee_statut' => $statut_idee,
                    'est_protegee_idee' => $protegee
                ));

                if (!$result) {
                    echo 'erreur lors de la création de l\'idée';
                } else {
                    // redirection vers affichage de l'idée avec message de réussite enregistrement
                    echo '<script type="text/javascript">
                        window.location.replace("idee?id=' . $this->pdo->lastInsertId() . '");
                    </script>';
                    exit();
                }
            }
        }
    }

    /**
     * Cette fonction permet de vérifier si un utilisateur/guest a déjà liké une certaine publication
     * @param
     * @return bool
     */
    public function isliked($id_idee)
    {

        // On vérifie si l'utilisateur est authentifié
        if (SessionHelpers::isLogin()) {
            $table = "user_like";
            $pk = "u_id";
            $id = SessionHelpers::getConnected();
        } else {
            $table = "guest_like";
            $pk = "g_id";
            // Sinon, on va chercher son IP
            $ip = $this->getIPAddress();

            // On vérifie si l'utilisateur est déjà présent dans la table guest
            $query = $this->pdo->prepare("SELECT * FROM guest WHERE g_ip = ?");
            $query->execute([$ip]);
            $result = $query->fetch();

            // Si l'IP n'est pas connue, alors on créé un nouvel enregistrement
            if (!$result) {
                $query = $this->pdo->prepare("INSERT INTO guest (g_ip) VALUES (?)");
                $query->execute([$ip]);

                // On réutilise la variable $id pour récupérer l'id du guest
                $id = $this->pdo->lastInsertId();
            } else {
                // Sinon, on récupère l'id correspondant à l'IP
                $id = $result['g_id'];
            }
        }

        // On va chercher dans la bonne table si l'utilisateur a déjà liké la publication
        $query = $this->pdo->prepare("SELECT * FROM {$table} WHERE i_id = ? AND {$pk} = ?");
        $query->execute([$id_idee, $id]);
        return $query->fetch();
    }
}