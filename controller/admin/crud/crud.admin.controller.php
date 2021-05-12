<?php

// IF THE PROFIL ISN'T THE LOGGED ADMIN
if ($_SESSION['id_admin'] !== $_GET['profil']) {

    header('Location: ?admin');
    exit();

}

// TWIG RENDER
echo $twig->render("admin/profil_admin.html.twig",
    [
        "admin"=>'yes',
        "session"=>$_SESSION,
        "thisAdmin"=>$adminManager->selectOneAdmin($_GET['profil'])
    ]);