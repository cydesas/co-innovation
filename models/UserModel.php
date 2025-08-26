<?php

namespace models;

use models\base\Database;
use utils\Common;
use utils\SessionHelpers;

class UserModel extends \models\base\SQL
{
    public function __construct()
    {
        parent::__construct('utilisateur', 'id_utilisateur');
    }

    public function sendNewPwd()
    {
        if(isset($_POST['soumission'])) {

            $db = Database::connect();

            // on compare l'adresse mail avec la base de données
            $query = $db->prepare("SELECT id_utilisateur, guid_utilisateur FROM utilisateur WHERE email_utilisateur=:email");
            $query->execute(['email' => $_POST['email']]);
            $rowCount = $query->rowCount();
            // Si pas, message pour indiquer qu'adresse mail pas dans la base
            if ($rowCount == 0) {
                Common::showError("Aucun utilisateur avec cette adresse mail !");
            }
            else {
                // On envoie un mail à l'adresse avec un lien unique
                // et on affiche un message pour l'indiquer
                $result = $query->fetch();

                if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                {
                    $url = "https";
                }
                else
                {
                    $url = "http";
                }
                $url .= "://";
                $url .= $_SERVER['HTTP_HOST'];
                $url .= "/entrer-nouveau-mdp?key=".$result['guid_utilisateur'];

                $body = "<p>Vous avez oublié votre mot de passe ?<br><br>
                Pas de soucis !<br>
                Pour changer de mot de passe, veuillez cliquer sur <a href='".$url."'>ce lien</a>.</p>À bientôt,<br>L’équipe Co-innovation.";

                Common::sendMail($_POST['email'], "Changez votre mot de passe Co-innovation", $body);
                echo "<script>window.location.replace('/changer-mdp')</script>";

                return "<h2>Un e-mail avec les instructions pour changer votre mot de passe vient de vous être envoyé.</h2>";
            }

            return "";
        }

        return null;
    }

    public function editPwd()
    {
        if (!(isset($_GET['key']) || isset($_POST['soumission']))) {
            session_unset();
            session_destroy();
            header('Location: index.php');
            exit();
        }

        if(isset($_GET['key']))
            $key = $_GET['key'];
        if(isset($_POST['key']))
            $key = $_GET['key'];

        if (isset($_POST['soumission'])) {
            extract($_POST);

            // Bloc de code correspondant à la recherche d'erreurs dans le formulaire
            if ($password != $password2) {
                Common::showError("Les mots de passe ne correspondent pas");
            } else {
                $hash = password_hash($password, PASSWORD_BCRYPT);

                $guid = Common::guidv4($key);

                $db = Database::connect();

                $query = $db->prepare("UPDATE utilisateur 
                                SET guid_utilisateur=:new_guid, password_utilisateur=:password 
                                WHERE guid_utilisateur=:old_guid");

                $result = $query->execute([
                    'new_guid' => $guid,
                    'old_guid' => $key,
                    'password' => $hash
                ]);

                if (!$result) {
                    Common::showError("Une erreur inconnue s'est produite. Veuillez essayer plus tard.");
                    return null;
                } else {
                    Common::showError("ok");
                    echo "<script>window.location.replace('/')</script>";
                    return $result;
                }
            }
        }
    }

    public function signup()
    {
        if (SessionHelpers::isLogin()) {
            header('Location: index.php');
            exit();
        }

        if (isset($_POST['soumission'])) {
            extract($_POST);

            // Bloc de code correspondant à la recherche d'erreurs dans le formulaire
            if ($password != $password2 || (empty($robot) || empty($conditions))) {
                if ($password != $password2) {
                    Common::showError("Les mots de passe ne correspondent pas");
                } else {
                    if (empty($robot)) {
                        Common::showError("Veuillez cocher la case 'Je ne suis pas un robot'");
                    } else {
                        if (empty($conditions)) {
                            Common::showError("Veuillez accepter les conditions d'utilisation");
                        }
                    }
                }
            } else {
                $db = Database::connect();
                $query = $db->prepare("INSERT INTO utilisateur (id_utilisateur_type, email_utilisateur, password_utilisateur, 
                         guid_utilisateur, nom_utilisateur, prenom_utilisateur, siret_utilsateur, raison_sociale_utilisateur) 
                         VALUES (:id_type, :email, :password, :guid, :nom, :prenom, :siret, :raison_sociale)");

                $password = password_hash($password, PASSWORD_BCRYPT);
                $guid = Common::guidv4($email);

                $query->execute([
                    'id_type' => $typeutilisateur,
                    'email' => $email,
                    'password' => $password,
                    'guid' => $guid,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'siret' => $siret,
                    'raison_sociale' => $raisonsociale
                ]);

                if (!Common::is_dev()) {
                    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                        $url = "https://" . $_SERVER['HTTP_HOST'] . "/verif-inscription?key=" . $guid;
                    } else {
                        $url = "http://" . $_SERVER['HTTP_HOST'] . "/verif-inscription?key=" . $guid;
                    }

                    $body = ",<p>Pour activer votre compte, cliquez sur <a href='" . $url . "'>ce lien</a>.</p>À bientôt,<br>L’équipe Co-innovation.";

                    ini_set( 'display_errors', 1);
                    error_reporting( E_ALL );
                    Common::sendMail($email, "Activez votre compte Co-innovation", $body);

                    echo "<h3>Inscription réussie !</h3><p>Un e-mail de confirmation a été envoyé à l'adresse " . $email . ". Pour activer votre compte, veuillez cliquer sur le lien dans le mail.";
                } else {
                    echo "<h3>Inscription réussie !</h3>";
                }
            }
        }
    }

    public function validation_signup()
    {

        if (!isset($_GET['key'])) {
            session_unset();
            session_destroy();
            exit();
        }

        $db = Database::connect();
        $query = $db->prepare("SELECT id_utilisateur, id_utilisateur_statut, id_utilisateur_type FROM utilisateur WHERE guid_utilisateur=:key");
        $query->execute(['key' => $_GET['key']]);
        $rowCount = $query->rowCount();

        if ($rowCount == 0) {
            $error = "Ce code de confirmation n'existe pas";
        } else {
            $result = $query->fetch();

            $statut = $result['id_utilisateur_statut'];

            switch ($statut) {
                case ATTENTE_VALIDATION:
                    // Ok, on passe en validé
                    $query2 = $db->prepare("UPDATE utilisateur SET id_utilisateur_statut=:statut
                    WHERE id_utilisateur=:id_utilsateur");

                    $result2 = $query2->execute([
                        'statut' => VALIDE,
                        'id_utilsateur' => $result['id_utilisateur']
                    ]);

                    if (!$result2) {
                        $error = "Une Erreur inconnue s'est produite. Veuillez essayer plus tard.";
                    } else {
                        $_SESSION['connected'] = true;
                        $_SESSION['id_utilisateur'] = $result['id_utilisateur'];
                        $_SESSION['type_utilisateur'] = $result['id_utilisateur_type'];
                    }

                    break;
                case VALIDE:
                    $error = "Votre compte a déjà été validé";
                    break;
                case BLOQUE:
                case SUPPRIME:
                    $error = "Utilisateur non valide";
                    break;
            }

        }

        return $error;
    }

    public function login()
    {
        if (SessionHelpers::isLogin()) {
            header('Location: index.php');
            exit();
        }

        if (isset($_POST['soumission'])) {
            extract($_POST);

            $db = Database::connect();
            $query = $db->prepare("SELECT id_utilisateur, id_utilisateur_statut, email_utilisateur, password_utilisateur FROM utilisateur WHERE email_utilisateur=:email");
            $query->execute(['email' => $email]);
            $user = $query->fetch();

            if ($user) {
                if (password_verify($password, $user['password_utilisateur']) && $user['id_utilisateur_statut'] == VALIDE) {
                    $_SESSION['USER'] = $user['id_utilisateur'];
                    $_SESSION['USER_TYPE'] = $user['id_utilisateur_type'];
                    echo '<script type="text/javascript">window.location.replace("/")</script>';
                } else {
                    ($user['id_utilisateur_statut'] == VALIDE) ? Common::showError("Mot de passe incorrect") : Common::showError("Compte non validé. Vérifiez vos mails");
                }
            } else {
                Common::showError("L'utilisateur renseigné n'existe pas");
            }
        }
    }

    public function edit_profile()
    {
        if (!SessionHelpers::isLogin()) {
            header('Location: /Co-Innovation');
            exit();
        }

        if (isset($_POST['soumission'])) {
            extract($_POST);

            // On vérifie si des images ont été uploadées
            if (!isset($hiddenImgSrc))
                $hiddenImgSrc = '';
            if (!isset($hiddenImgSrc2))
                $hiddenImgSrc2 = '';

            $to_update = array(
                'visuel_profil_utilisateur' => $hiddenImgSrc,
                'visuel_banner_utilisateur' => $hiddenImgSrc,
                'visuel_logo_utilisateur' => $hiddenImgSrc2,
                'url_linkedin_utilisateur' => $linkedin,
                'url_twitter_utilisateur' => $twitter,
                'url_instagram_utilisateur' => $instagram,
                'url_facebook_utilisateur' => $facebook,
                'presentation_utilisateur' => $presentation,
                'description_utilisateur' => $description
            );

            $this->updateOne(SessionHelpers::getConnected(), $to_update);

            // redirection vers affichage du profil avec message de réussite MàJ
            echo "<script type='text/javascript'>
                    window.location.replace('profil?update=ok');
                  </script>";

        }
    }
}