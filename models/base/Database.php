<?php

namespace models\base;

use PDO;
use utils\Common;

class Database
{

    static function connect(): PDO
    {
        $config = Common::get_db_info();

        $pdo = new PDO ($config["DB_DSN"], $config["DB_USER"], $config["DB_PASSWORD"]);

        if ($pdo) {
            // ACTIVER LE DEBUG DES REQUÊTES
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return $pdo;
    }
}