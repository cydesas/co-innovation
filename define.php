<?php

define ('SITE_ROOT', realpath(dirname(__FILE__)));

if(!defined('ENTREPRISE')) {
    // Types d'utilisateurs
    define("ADMINISTRATEUR", 1);  
    define("PARTICULIER", 2);
    define("ENTREPRISE", 3);
    define("ESN", 4);

    // Statut des utilisateurs
    define("ATTENTE_VALIDATION", 1);
    define("VALIDE", 2);
    define("BLOQUE", 3);
    define("SUPPRIME", 4);

    // Statut des idées
    define("IDEE_BROUILLON", 1);
    define("IDEE_A_MODERER", 2);
    define("IDEE_PUBLIEE", 3);
    define("IDDE_ANNULEE", 4);
    define("IDDE_ARCHIVEE", 5);

}

?>