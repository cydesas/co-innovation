<?php

namespace utils;

class Template
{
    static function render($filepath, $variables = array(), $withHeader = true): void
    {
        error_reporting(0);
        // Déclare l'ensemble des variables présent dans la variable $variales pour
        // les rendres accessibles directement. Exemple :
        // array("nom" => "Brosseau", "prenom" => "Valentin") va générer
        // $nom = "Brosseau" et $prenom = "Valentin"
        extract($variables);

        if ($withHeader) Template::header($titre, $description, $jsonld_website, $jsonld_organization, $jsonld_breadcrumb, $canonical);
        include($filepath);
        if ($withHeader) Template::footer();
    }

    static private function header($titre, $description, $jsonld_website,
                                   $jsonld_organization, $jsonld_breadcrumb, $canonical): void
    {
        include_once("./views/common/header.php");
    }

    static private function footer(): void
    {
        include_once("./views/common/footer.php");
    }
}