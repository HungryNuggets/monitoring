<?php

// TWIG
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

// OVH
use \Ovh\Api;
use GuzzleHttp\Client;

// SESSION
session_start();

// CONST ROOT
define('ROOT', dirname(__DIR__));

// MAIN DEPENDENCIES
require_once ROOT . "/bin/config.php";
require_once ROOT . "/vendor/autoload.php";

// AUTOLOAD
spl_autoload_register(
    function ($className) {
        require ROOT . "/model/" . $className . ".php";
    }
);

// SINGLETON DB CONNECTION
$DB = MyPDO::getInstance(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT . ";charset=" . DB_CHARSET, DB_USER, DB_PASSWORD, ENV_DEV);