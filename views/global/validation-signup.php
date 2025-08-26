<?php

use utils\Common;

if($error != null) {
        Common::showError($error);
    } else {
        echo "<h3>Votre compte est validé</h3>";
        echo "<p><a href='/'>Cliquez ici</a> pour revenir à l'accueil</p>";
    }
?>