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