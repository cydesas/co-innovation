<?php

namespace controllers;

use controllers\base\Web;
use models\IdeaModel;
use models\UserModel;
use utils\SessionHelpers;
use utils\Template;

class MainController extends Web
{

    private UserModel $userModel;
    private IdeaModel $ideaModel;
    private String $jsonld_website;
    private String $jsonld_organization;
    private String $canonical;

    function __construct()
    {
        $this->userModel = new UserModel();
        $this->ideaModel = new IdeaModel();
        $this->jsonld_website =
            '{
            "@context": "http://schema.org/",
            "@type": "WebSite",
            "url": "https://co-innovation.fr",
            "name": "Co-Innovation",
            "alternateName": "CO-INNOVATION"
        }';

        $this->jsonld_organization =
            '{
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "Cyde",
            "url": "https://cyde.fr",
            "logo": "https://www.cyde.fr/images/ico2.svg",
            "alternateName": "Cyde",
            "legalName": "Cyde",
            "sameAs": [
                "https://www.linkedin.com/company/cyde-sas/"
            ]
        }';

        $this->canonical = "https://co-innovation.fr/";
    }

    function home()
    {
        $titre = 'CO-INNOVATION | Innover, développer, partager des idées ensemble';

        $description = "Vous souhaitez innover et booster votre entreprise ? Parcourez les idées proposées sur 
            notre plateforme et trouvez des partenaires pertinents pour développer votre activité !";

        $jsonld_breadcrumb =
        '{
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "item": {
                        "@id": "https://co-innovation.fr",
                        "name": "Accueil"
                    }
                }
            ]
        }';

        $canonical = $this->canonical;

        Template::render("views/global/home.php", array(
            "titre" => $titre,
            "description" => $description,
            "jsonld_website" => $this->jsonld_website,
            "jsonld_organization" => $this->jsonld_organization,
            "jsonld_breadcrumb" => $jsonld_breadcrumb,
            "canonical" => $canonical,
            "ideas" => $this->ideaModel->getFilter(1),  // 1 = offset du résultat de la requête SQL
            "model" => $this->ideaModel));
    }

    function entreprise()
    {
        $titre = 'CO-INNOVATION | Innover à coûts réduits, efficacement et davantage';

        $description = "Vous souhaitez innover et booster votre entreprise ? Parcourez les idées proposées sur 
            notre plateforme et trouvez des partenaires pertinents pour développer votre activité !";

        $jsonld_breadcrumb =
            '{
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "item": {
                        "@id": "https://co-innovation.fr",
                        "name": "Accueil"
                    }
                },
                                {
                    "@type": "ListItem",
                    "position": 2,
                    "item": {
                        "@id": "https://co-innovation.fr/entreprise",
                        "name": "Entreprise"
                    }
                }
            ]
        }';

        $canonical = $this->canonical."entreprise";

        Template::render("views/global/entreprise.php", array(
            "titre" => $titre,
            "description" => $description,
            "jsonld_website" => $this->jsonld_website,
            "jsonld_organization" => $this->jsonld_organization,
            "jsonld_breadcrumb" => $jsonld_breadcrumb,
            "canonical" => $canonical
        ));
    }

    function esn()
    {
        $titre = 'CO-INNOVATION | Proposer ses services et augmenter son activité';

        $description = "Vous souhaitez innover et booster votre entreprise ? Parcourez les idées proposées sur 
            notre plateforme et trouvez des partenaires pertinents pour développer votre activité !";

        $jsonld_breadcrumb =
            '{
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "item": {
                        "@id": "https://co-innovation.fr",
                        "name": "Accueil"
                    }
                },
                                {
                    "@type": "ListItem",
                    "position": 2,
                    "item": {
                        "@id": "https://co-innovation.fr/esn",
                        "name": "ESN"
                    }
                }
            ]
        }';

        $canonical = $this->canonical."esn";

        Template::render("views/global/esn.php", array(
            "titre" => $titre,
            "description" => $description,
            "jsonld_website" => $this->jsonld_website,
            "jsonld_organization" => $this->jsonld_organization,
            "jsonld_breadcrumb" => $jsonld_breadcrumb,
            "canonical" => $canonical
        ));
    }

    function particulier()
    {
        $titre = 'CO-INNOVATION | Partager et découvrir des idées créatives';

        $description = "Vous souhaitez innover et booster votre entreprise ? Parcourez les idées proposées sur 
            notre plateforme et trouvez des partenaires pertinents pour développer votre activité !";

        $jsonld_breadcrumb =
            '{
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "item": {
                        "@id": "https://co-innovation.fr",
                        "name": "Accueil"
                    }
                },
                                {
                    "@type": "ListItem",
                    "position": 2,
                    "item": {
                        "@id": "https://co-innovation.fr/particulier",
                        "name": "Particulier"
                    }
                }
            ]
        }';

        $canonical = $this->canonical."particulier";

        Template::render("views/global/particulier.php", array(
            "titre" => $titre,
            "description" => $description,
            "jsonld_website" => $this->jsonld_website,
            "jsonld_organization" => $this->jsonld_organization,
            "jsonld_breadcrumb" => $jsonld_breadcrumb,
            "canonical" => $canonical
        ));
    }

    function login()
    {
        $this->userModel->login();

        $titre = 'CO-INNOVATION | Se connecter';

        $description = "Connectez vous à votre compte pour accéder à votre espace personnel et gérer vos idées 
        ou entrer en contact avec des des personnes qui en proposent!";

        $jsonld_breadcrumb =
        '{
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "item": {
                        "@id": "https://co-innovation.fr",
                        "name": "Accueil"
                    }
                },
                                {
                    "@type": "ListItem",
                    "position": 2,
                    "item": {
                        "@id": "https://co-innovation.fr/connexion",
                        "name": "Connexion"
                    }
                }
            ]
        }';

        $canonical = $this->canonical."connexion";

        Template::render("views/global/login.php", array(
            "titre" => $titre,
            "description" => $description,
            "jsonld_website" => $this->jsonld_website,
            "jsonld_organization" => $this->jsonld_organization,
            "jsonld_breadcrumb" => $jsonld_breadcrumb,
            "canonical" => $canonical
        ));
    }

    function signup()
    {
        $this->userModel->signup();

        $titre = 'CO-INNOVATION | S\'inscrire';

        $description = "Créez votre compte pour accéder à votre espace personnel et gérer vos idées";

        $jsonld_breadcrumb =
            '{
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "item": {
                        "@id": "https://co-innovation.fr",
                        "name": "Accueil"
                    }
                },
                                {
                    "@type": "ListItem",
                    "position": 2,
                    "item": {
                        "@id": "https://co-innovation.fr/inscription",
                        "name": "Inscription"
                    }
                }
            ]
        }';

        $canonical = $this->canonical."inscription";

        Template::render("views/global/signup.php", array(
            "titre" => $titre,
            "description" => $description,
            "jsonld_website" => $this->jsonld_website,
            "jsonld_organization" => $this->jsonld_organization,
            "jsonld_breadcrumb" => $jsonld_breadcrumb,
            "canonical" => $canonical
        ));
    }

    function validation_signup()
    {
        $titre = 'CO-INNOVATION | S\'inscrire';

        $description = "Créez votre compte pour accéder à votre espace personnel et gérer vos idées";

        $jsonld_breadcrumb =
        '{
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "item": {
                        "@id": "https://co-innovation.fr",
                        "name": "Accueil"
                    }
                },
                                {
                    "@type": "ListItem",
                    "position": 2,
                    "item": {
                        "@id": "https://co-innovation.fr/inscription",
                        "name": "Inscription"
                    }
                }
            ]
        }';

        $canonical = $this->canonical."inscription";

        Template::render("views/global/validation-signup.php", array(
            "titre" => 'Inscription',
            "description" => "CO-INNOVATION est un site de CYDE, entreprise de produits et services digitaux indépendante, 
            implantée à Lille. Il a pour objectif de faciliter la mise en relation entre Entreprises et Partenaires pour 
            favoriser l'innovation",
            "error" => $this->userModel->validation_signup()
        ));
    }

    function new_mdp_form()
    {
        $error = $this->userModel->sendNewPwd();
        Template::render("views/global/new-mdp-form.php", array(
            "titre" => 'Mot de passe oublié',
            "description" => "CO-INNOVATION est un site de CYDE, entreprise de produits et services digitaux indépendante, 
            implantée à Lille. Il a pour objectif de faciliter la mise en relation entre Entreprises et Partenaires pour 
            favoriser l'innovation",
            "error" => $error
        ));
    }

    function edit_mdp_form()
    {
        $error = $this->userModel->editPwd();
        Template::render("views/global/edit-mdp-form.php", array(
            "titre" => 'Mot de passe oublié',
            "description" => "CO-INNOVATION est un site de CYDE, entreprise de produits et services digitaux indépendante, 
            implantée à Lille. Il a pour objectif de faciliter la mise en relation entre Entreprises et Partenaires pour 
            favoriser l'innovation",
            "error" => $error
        ));
    }

    function logout()
    {
        Template::render("views/global/logout.php", array(
            "titre" => 'Déconnexion',
            "description" => "CO-INNOVATION est un site de CYDE, entreprise de produits et services digitaux indépendante, 
            implantée à Lille. Il a pour objectif de faciliter la mise en relation entre Entreprises et Partenaires pour 
            favoriser l'innovation"));
    }

    function profil()
    {
        // Condition pour définir le profil à afficher
        if (isset($_GET['id'])) {
            $user = $this->userModel->getOne($_GET['id']);
            $ideas = $this->ideaModel->getIdeasByUser($_GET['id']);
        } else if (SessionHelpers::isLogin()) {
            $user = $this->userModel->getOne($_SESSION['USER']);
            $ideas = $this->ideaModel->getIdeasByUser(SessionHelpers::getConnected());
        } else {
            echo '<script>window.location.replace("/")</script>';
        }

        // On prévient une erreur au cas ou le user n'a pas d'idée
        if ($ideas == null) {
            $nb_ideas = 0;
        } else {
            $nb_ideas = count($ideas);
        }

        Template::render("views/global/profil.php", array(
            "titre" => 'Profil',
            "description" => "CO-INNOVATION est un site de CYDE, entreprise de produits et services digitaux indépendante, 
            implantée à Lille. Il a pour objectif de faciliter la mise en relation entre Entreprises et Partenaires pour 
            favoriser l'innovation",
            "user" => $user,
            "ideas" => $ideas,
            "nb_ideas" => $nb_ideas
        ));
    }

    function edit_profil()
    {
        $this->userModel->edit_profile();
        Template::render("views/global/edit-profil.php", array(
                "titre" => 'Editer le Profil',
                "description" => "CO-INNOVATION est un site de CYDE, entreprise de produits et services digitaux indépendante, 
                implantée à Lille. Il a pour objectif de faciliter la mise en relation entre Entreprises et Partenaires pour 
                favoriser l'innovation",
                "user" => $this->userModel->getOne(SessionHelpers::getConnected()))
        );
    }

    function mentions_legales()
    {
        Template::render("views/common/mentions-legales.php", array(
            "titre" => 'Mentions Légales',
            "description" => "CO-INNOVATION est un site de CYDE, entreprise de produits et services digitaux indépendante, 
                implantée à Lille. Il a pour objectif de faciliter la mise en relation entre Entreprises et Partenaires pour 
                favoriser l'innovation",
        ));
    }
}