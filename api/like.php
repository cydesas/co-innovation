<?php

/**
 * il faudra trouver un moyen pour rendre l'autoloader compatible avec les requêtes AJAX pour éviter multiple require
 */

use models\IdeaModel;

require_once '../utils/SessionHelpers.php';
require_once '../utils/Common.php';
require_once '../models/base/Database.php';
require_once '../models/base/IDatabase.php';
require_once '../models/base/SQL.php';
require_once '../models/IdeaModel.php';

session_start();

$db = new IdeaModel();
$id = $_GET['idee'];

// On vérifie si l'utilisateur est connecté et s'il a déjà liké l'idée afin d'appeler les bonnes méthodes
if (!$db->isliked($id))
    $result = $db->likeIdea($id);
else
    $result = $db->unlikeIdea($id);


if ($result)
    echo json_encode($result);

?>