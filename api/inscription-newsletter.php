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

if (isset($_GET['email'])) {

    $query = $db->prepare("INSERT INTO newsletter (email_newsletter)
    VALUES (:email)");

    $result = $query->execute([
        'email' => $_GET['email']
    ]);

    if ($result) {
        echo "insert ok";
    } else {
        echo "insert KO";
    }
}

?>