<?php

namespace controllers;

use ArrayObject;
use controllers\base\Web;
use models\IdeaModel;
use utils\SessionHelpers;
use utils\Template;

class IdeaController extends Web
{
    private IdeaModel $ideaModel;

    function __construct()
    {
        $this->ideaModel = new IdeaModel();
    }

    function list_ideas()
    {
        // On vérifie le paramètre "page" dans l'URL. S'il n'existe pas, on le définit à 1
        if (!isset ($_GET['page'])) {
            $page = 1;
            echo '<script>window.location.replace("/liste-idees?page=1")</script>';
        } else {
            $page = $_GET['page'];
        }

        // On récupère les filtres de la page dans l'URL après le "&" afin de garder les filtres lors de la navigation par pagination
        $actual_url_filters = explode('&', "$_SERVER[REQUEST_URI]", 2);
        (new ArrayObject($actual_url_filters))->OffsetExists(1) ? $actual_url_filters = $actual_url_filters[1] : $actual_url_filters = '';

        // On calcule le nombre de pages à afficher en fonction du nombre d'idées à afficher par page ainsi que du nombre total d'idées
        $ideas_per_page = 9;
        ($this->ideaModel->getFilter(1) != null) ? $nb_pages = ceil($this->ideaModel->getFilter($page)[count($this->ideaModel->getFilter($page)) - 1] / $ideas_per_page) : $nb_pages = 0;


        Template::render("views/idea/list-ideas.php",
            array("titre" => 'Liste d\'idées',
                "description" => "CO-INNOVATION est un site de CYDE, entreprise de produits et services digitaux indépendante, 
                implantée à Lille. Il a pour objectif de faciliter la mise en relation entre Entreprises et Partenaires pour 
                favoriser l'innovation",
                "domaines" => $this->ideaModel->getDomains(),
                "types_utilisateur" => $this->ideaModel->getUserTypes(),
                "ideas" => $this->ideaModel->getFilter($page),
                "page" => $page,
                "nb_pages" => $nb_pages,
                "url_filters" => $actual_url_filters
            ));
    }

    function idea()
    {
        // On vérifie le paramètre "idee" dans l'URL. S'il n'existe pas, on redirige vers la liste des idées
        if (!isset ($_GET['idee'])) {
            echo '<script>window.location.replace("/idee?idee=1")</script>';
        } else {
            // Si l'idée passée en paramètre n'existe pas, on redirige vers la liste d'idée
            // (on pourrait afficher une erreur à la place)
            if (!$this->ideaModel->getIdea($_GET['idee'])) {
                echo '<script>window.location.replace("/liste-idees?page=1")</script>';
            }
        }

        $id = $_GET['idee'];

        $nb_likes = ($this->ideaModel->getNbLikes($id) == null) ? 0 : $this->ideaModel->getNbLikes($id)['Total'];
        $nb_likes = ($this->ideaModel->getNbLikes($id)== null) ? 0 : $this->ideaModel->getNbLikes($id)['Total'];
        $section_idee = ($this->ideaModel->getSectionIdea($id)== null) ? 0 : $this->ideaModel->getSectionIdea($id);
        $faq_idee = ($this->ideaModel->getFaqIdea($id)== null) ? 0 : $this->ideaModel->getFaqIdea($id);
        $comments_idee = ($this->ideaModel->getCommentsIdea($id)== null) ? 0 : $this->ideaModel->getCommentsIdea($id);

        Template::render("views/idea/idea.php", array(
                "titre" => 'Idea',
                "description" => "CO-INNOVATION est un site de CYDE, entreprise de produits et services digitaux indépendante, 
            implantée à Lille. Il a pour objectif de faciliter la mise en relation entre Entreprises et Partenaires pour 
            favoriser l'innovation",
                "values" => $this->ideaModel->getIdea($id),
                "section_idee" => $section_idee,
                "faq_idee" => $faq_idee,
                "comments_idee" => $comments_idee,
                "nb_likes" => $nb_likes,
                "is_liked" => $this->ideaModel->isliked($id))
        );

    }

    function create_idea()
    {
        // Si on est sur une idée existante, on va récupérer ses infos pour les afficher dans la vue
        (isset($_GET['id'])) ? $idea = $this->ideaModel->getIdea($_GET['id']) : $idea = null;

        Template::render("views/idea/create-idea.php", array(
            "titre" => 'Create/Edit Idea',
            "description" => "CO-INNOVATION est un site de CYDE, entreprise de produits et services digitaux indépendante, 
            implantée à Lille. Il a pour objectif de faciliter la mise en relation entre Entreprises et Partenaires pour 
            favoriser l'innovation",
            "domaines" => $this->ideaModel->getDomains(),
            "idea" => $idea));
        $this->ideaModel->createIdea();
    }

    function admin()
    {
        $ideaModel = new IdeaModel();
        Template::render("views/ideas/admin.php", array("values" => $ideaModel->getOne(SessionHelpers::getConnected()),
            "titre" => 'Admin',
            "description" => "CO-INNOVATION est un site de CYDE, entreprise de produits et services digitaux indépendante, 
            implantée à Lille. Il a pour objectif de faciliter la mise en relation entre Entreprises et Partenaires pour 
            favoriser l'innovation",));
    }

}