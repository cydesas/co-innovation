<?php

use models\IdeaModel;
require '\define.php';

$db = new IdeaModel();
$result = $db->getNbLikes($_GET['idee']);

if ($result) {
    echo json_encode($result);
}

