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

// MANAGERS
$adminManager = new AdminManager($DB);
$customerManager = new CustomerManager($DB);
$issueManager = new IssueManager($DB);

// TWIG VIEWS
$loader = new FilesystemLoader(ROOT . '/view');
$twig = new Environment($loader, ['debug' => true]);
$twig->addExtension(new DebugExtension());

// SWIFTMAILER
$transport = (new Swift_SmtpTransport(MAIL_SMTP, MAIL_PORT, MAIL_ENCRYPTION))
    ->setUsername(MAIL_ADDRESS)
    ->setPassword(MAIL_PWD)
    ->setStreamOptions(array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )));

// OVH API STARTER
$ovh = new Api( APP_KEY,
    APP_SECRET,
    END_POINT,
    CON_KEY);

// ON ADMIN CONNECTION
if (isset($_SESSION['session_id']) && $_SESSION['session_id'] === session_id()) {

    require ROOT.'/controller/admin.controller.php';

// ON USER DEMAND
} else {

    require ROOT.'/controller/public.controller.php';

}