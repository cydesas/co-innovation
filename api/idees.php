<?php

/**
 * il faudra trouver un moyen pour rendre l'autoloader compatible avec les requêtes AJAX pour éviter multiple require
 */

use models\base\Database;

require_once '../utils/SessionHelpers.php';
require_once '../utils/Common.php';
require_once '../models/base/Database.php';
require_once '../models/base/IDatabase.php';
require_once '../models/base/SQL.php';
require_once '../models/IdeaModel.php';

session_start();

$db = Database::connect();


// début méthode
$select = "SELECT idee.id_idee, idee.titre_idee, idee.visuel_idee, idee.date_creation_idee, vue_domaine_idee.libelle_idee_domaine, idee.est_protegee_idee";
$count = "SELECT COUNT(id_idee)";
$from = " FROM idee, vue_domaine_idee";
$where = " WHERE idee.id_idee = vue_domaine_idee.id_idee_vue ";
$orderBy = " ORDER BY idee.date_creation_idee DESC ";
$limit = " LIMIT 9 ";

$tab = [];

if (isset($_GET['statut'])) {
    $where .= " AND idee.id_idee_statut=".$_GET['statut'];
}
else {
    $where .= " AND idee.id_idee_statut=3";
}

if (isset($_GET['utilisateur'])) {
    $where .= " AND idee.id_utilisateur=".$_GET['utilisateur'];
}

// Gestion des filtres
// On attend une URL du type : /api/idees.php?domaine=1;3&type_utilisateur=1;3
// Si on filtre sur un ou plusieurs domaines
if (isset($_GET['domaine'])) {
    // chaque domaine est séparé par un ;
    $domaines = explode(';', $_GET['domaine']);
    $counter = 1;
    $where .= " AND (";
    foreach ($domaines as &$domaine) {
        if($counter == 1) {
            $where .= " id_domaine.id_idee_domaine = ".$domaine;
        }
        else {
            $where .= " OR id_domaine.id_idee_domaine = ".$domaine;
        }
        $counter++;
    }
    $where .= ")";
}

// Si on filtre sur un ou plusieurs types d'utilisateurs
if (isset($_GET['type_utilisateur'])) {
    // chaque domaine est séparé par un ;
    $utilisateurs = explode(';', $_GET['type_utilisateur']);
    $counter = 1;
    $where .= " AND idee.id_utilisateur IN (SELECT id_utilisateur FROM utilisateur WHERE ";
    foreach ($utilisateurs as &$utilisateur) {
        if($counter == 1) {
            $where .= " id_utilisateur_type = ".$utilisateur;
        }
        else {
            $where .= " OR id_utilisateur_type = ".$utilisateur;
        }
        $counter++;
    }
    $where .= ")";
}

if (isset($_GET['firstTime']) || isset($_GET['slider'])) {
    $where = " WHERE idee.id_idee = vue_domaine_idee.id_idee_vue AND idee.id_idee_statut=".IDEE_PUBLIEE;
}

// Si aucun paramètre limit n'est furni, on utilise le limit par défaut (9 idées)
// Si un paramètre 'limit' est fourni, il s'agit du nombre d'idfées à ramener
// Si deux paramètres 'limit' sont fournis, le premier est l'offset et le second le nombre d'idées à ramener
if (isset($_GET['limit'])) {
    // chaque domaine est séparé par un ;
    $limits = explode(';', $_GET['limit']);

    if(count($limits) == 2) {
        $limit = " LIMIT ".$limits[0].", ".$limits[1];
    }
    else {
        $limit = " LIMIT ".$limits[0];
    }
}

// On compte d'abord le nombre de réponse
$requete = $count.$from.$where;

$query = $db->prepare($requete);
$query->execute();
$result = $query->fetch();

if ($result == true) {
    $tab[0] = array("count" => $result['COUNT(id_idee)']);
}

// On exécute maintenant la requêtecomplète
$requete = $select.$from.$where.$orderBy.$limit;

$query = $db->prepare($requete);

$query->execute();
$result = $query->fetchAll();

if ($result == true) {
    $tab[1] = $result;
}

echo json_encode($tab);

?>