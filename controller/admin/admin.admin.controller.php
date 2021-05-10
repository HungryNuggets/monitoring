<?php

// ISSUES GLOBAL DISPLAY WITH OPTIONS
$adminManager = new AdminManager($DB);

// TWIG RENDER
echo $twig->render("admin/admin.html.twig",
    [
        "admin"=>'yes',
        "session"=>$_SESSION,
        "allAdmin"=>$adminManager->selectAllAdmin()
    ]);