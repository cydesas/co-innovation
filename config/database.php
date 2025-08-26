<?php

    if(!$_SERVER['REMOTE_ADDR'] == "127.0.0.1") {
        define("DBHOST", "localhost:3307");
        define("DBUSER", "root");
        define("DBPWD", "");
        define("DBNAME", "coinn1465238");
    }
    else {
        define("DBHOST", "localhost:3307");
        define("DBUSER", "root");
        define("DBPWD", "");
        define("DBNAME", "coinn1465238");
        /*define("DBHOST", "185.98.131.90");
        define("DBUSER", "coinn1465238");
        define("DBPWD", "mxvisuigu1");
        define("DBNAME", "coinn1465238");*/
    }

    $dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;

    try {
        $db = new PDO($dsn, DBUSER, DBPWD);
        
        $db->exec("SET NAMES UTF8");

        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    catch(PDOException $e) {
        die($e->getMessage());
    }

?>