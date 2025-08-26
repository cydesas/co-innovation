<?php

use routes\base\Router;
use utils\SessionHelpers;

include_once("define.php");
include_once("autoload.php");

SessionHelpers::init();

$router = new Router();
$router->LoadRequestedPath();